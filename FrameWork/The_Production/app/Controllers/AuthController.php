<?php

namespace App\Controllers;

use App\Models\UserModel;

/**
 * Class AuthController
 * 
 * Handles user authentication:
 * - User login
 * - User logout
 * - User registration
 * - Password reset
 */
class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    /**
     * Show login form
     * 
     * @return string Rendered login view
     */
    public function loginForm()
    {
        $data = [
            'title' => 'Login',
            'pageTitle' => 'User Login',
        ];

        return view('auth/login', $data);
    }

    /**
     * Process login
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function login()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $rules = [
            'email' => 'required|valid_email|trim',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Authenticate user
        $user = $this->userModel->authenticate($email, $password);

        if (!$user) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ]);
        }

        // Check if user is active
        if ($user['status'] !== 'active') {
            return $this->response
                ->setStatusCode(403)
                ->setJSON([
                    'success' => false,
                    'message' => 'Account is not active. Please contact administrator.',
                ]);
        }

        // Set session
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'logged_in' => true,
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Logged in successfully',
            'redirect' => base_url('/'),
        ]);
    }

    /**
     * Show registration form
     * 
     * @return string Rendered registration view
     */
    public function registerForm()
    {
        $data = [
            'title' => 'Register',
            'pageTitle' => 'Create Account',
        ];

        return view('auth/register', $data);
    }

    /**
     * Process registration
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function register()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Username already taken',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'Email already registered',
                ]
            ],
            'password' => 'required|min_length[8]|strong_password',
            'password_confirm' => 'required|matches[password]',
            'first_name' => 'required|min_length[2]|max_length[100]',
            'last_name' => 'required|min_length[2]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
        }

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $firstName = $this->request->getPost('first_name');
        $lastName = $this->request->getPost('last_name');

        // Create user
        $newUser = [
            'username' => $username,
            'email' => $email,
            'password_hash' => UserModel::hashPassword($password),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'role' => 'user',
            'status' => 'active',
            'email_verified' => 0,
        ];

        try {
            $userId = $this->userModel->insert($newUser);

            // Auto-login after registration
            $user = $this->userModel->find($userId);
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'logged_in' => true,
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Account created successfully',
                'redirect' => base_url('/'),
            ]);
        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'message' => 'Error creating account',
                ]);
        }
    }

    /**
     * Logout user
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    /**
     * Show "forgot password" form
     * 
     * @return string Rendered view
     */
    public function forgotForm()
    {
        $data = [
            'title' => 'Forgot Password',
            'pageTitle' => 'Reset Your Password',
        ];

        return view('auth/forgot', $data);
    }

    /**
     * Process password reset request
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function forgotPassword()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $rules = [
            'email' => 'required|valid_email',
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
        }

        $email = $this->request->getPost('email');
        $user = $this->userModel->findByEmail($email);

        if (!$user) {
            // Don't reveal if email exists (security best practice)
            return $this->response->setJSON([
                'success' => true,
                'message' => 'If email exists, password reset link has been sent',
            ]);
        }

        // Generate reset token
        $token = $this->userModel->generatePasswordResetToken($user['id']);

        // TODO: Send password reset email with token link
        // For now, just return success
        log_message('info', "Password reset requested for user {$user['id']}, token: {$token}");

        return $this->response->setJSON([
            'success' => true,
            'message' => 'If email exists, password reset link has been sent',
        ]);
    }

    /**
     * Show password reset form (with token)
     * 
     * @param string $token Password reset token
     * @return string Rendered view
     */
    public function resetForm(string $token = '')
    {
        $user = $this->userModel->verifyPasswordResetToken($token);

        if (!$user) {
            session()->setFlashdata('error', 'Invalid or expired password reset link');
            return redirect()->to(base_url('/auth/forgot'));
        }

        $data = [
            'title' => 'Reset Password',
            'pageTitle' => 'Enter New Password',
            'token' => $token,
        ];

        return view('auth/reset', $data);
    }

    /**
     * Process password reset
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function resetPassword()
    {
        if ($this->request->getMethod() !== 'post') {
            return $this->response->setStatusCode(405);
        }

        $rules = [
            'token' => 'required',
            'password' => 'required|min_length[8]|strong_password',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'success' => false,
                    'errors' => $this->validator->getErrors(),
                ]);
        }

        $token = $this->request->getPost('token');
        $newPassword = $this->request->getPost('password');

        $user = $this->userModel->verifyPasswordResetToken($token);

        if (!$user) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'Invalid or expired token',
                ]);
        }

        // Reset password
        $success = $this->userModel->resetPassword($user['id'], $newPassword);

        if ($success) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Password reset successfully',
                'redirect' => base_url('/auth/login'),
            ]);
        }

        return $this->response
            ->setStatusCode(500)
            ->setJSON([
                'success' => false,
                'message' => 'Error resetting password',
            ]);
    }

    /**
     * Get current user info (AJAX endpoint)
     * 
     * @return \CodeIgniter\HTTP\ResponseInterface
     */
    public function me()
    {
        if (!session()->has('user_id')) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'Not authenticated',
                ]);
        }

        $userId = session('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'success' => false,
                    'message' => 'User not found',
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
            ],
        ]);
    }
}
