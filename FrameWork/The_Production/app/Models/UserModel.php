<?php

namespace App\Models;

/**
 * Class UserModel
 * 
 * The Book Of Your Destiny - User Model
 * Represents a registered user account
 * 
 * Handles user authentication, roles, and permissions
 */
class UserModel extends BaseModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'id',
        'username',
        'email',
        'password_hash',
        'first_name',
        'last_name',
        'role',
        'avatar_url',
        'bio',
        'status',
        'email_verified',
        'email_verified_at',
        'last_login_at',
        'password_reset_token',
        'password_reset_expires',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'email_verified' => 'boolean',
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password_reset_expires' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Hash a password
     * 
     * @param string $password Raw password
     * @return string Hashed password
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    /**
     * Verify a password against hash
     * 
     * @param string $password Raw password to verify
     * @param string $hash Hash to verify against
     * @return bool True if password matches hash
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Find user by email
     * 
     * @param string $email User email address
     * @return array|null User data or null
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Find user by username
     * 
     * @param string $username Username
     * @return array|null User data or null
     */
    public function findByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Authenticate user by email and password
     * 
     * @param string $email User email
     * @param string $password User password
     * @return array|null User data if authenticated, null otherwise
     */
    public function authenticate(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);
        
        if ($user && self::verifyPassword($password, $user['password_hash'])) {
            // Update last login
            $this->update($user['id'], [
                'last_login_at' => date('Y-m-d H:i:s'),
            ]);
            
            return $user;
        }
        
        return null;
    }

    /**
     * Check if user has a specific role
     * 
     * @param string $userId User ID
     * @param string $role Role to check
     * @return bool True if user has role
     */
    public function hasRole(string $userId, string $role): bool
    {
        $user = $this->find($userId);
        return $user && $user['role'] === $role;
    }

    /**
     * Check if user is admin
     * 
     * @param string $userId User ID
     * @return bool True if user is admin
     */
    public function isAdmin(string $userId): bool
    {
        return $this->hasRole($userId, 'admin');
    }

    /**
     * Get all active users
     * 
     * @return array Active users
     */
    public function getActiveUsers(): array
    {
        return $this->where('status', 'active')
            ->where('deleted_at', null)
            ->findAll();
    }

    /**
     * Deactivate user account
     * 
     * @param string $userId User ID
     * @return bool Success
     */
    public function deactivate(string $userId): bool
    {
        return $this->update($userId, ['status' => 'inactive']);
    }

    /**
     * Activate user account
     * 
     * @param string $userId User ID
     * @return bool Success
     */
    public function activate(string $userId): bool
    {
        return $this->update($userId, ['status' => 'active']);
    }

    /**
     * Ban user account
     * 
     * @param string $userId User ID
     * @return bool Success
     */
    public function ban(string $userId): bool
    {
        return $this->update($userId, ['status' => 'banned']);
    }

    /**
     * Mark email as verified
     * 
     * @param string $userId User ID
     * @return bool Success
     */
    public function verifyEmail(string $userId): bool
    {
        return $this->update($userId, [
            'email_verified' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Generate password reset token
     * 
     * @param string $userId User ID
     * @return string Reset token
     */
    public function generatePasswordResetToken(string $userId): string
    {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+24 hours'));
        
        $this->update($userId, [
            'password_reset_token' => $token,
            'password_reset_expires' => $expiresAt,
        ]);
        
        return $token;
    }

    /**
     * Verify password reset token
     * 
     * @param string $token Reset token
     * @return array|null User data if token valid, null otherwise
     */
    public function verifyPasswordResetToken(string $token): ?array
    {
        $user = $this->where('password_reset_token', $token)->first();
        
        if (!$user) {
            return null;
        }
        
        // Check if token expired
        if (strtotime($user['password_reset_expires']) < time()) {
            return null;
        }
        
        return $user;
    }

    /**
     * Reset user password
     * 
     * @param string $userId User ID
     * @param string $newPassword New password
     * @return bool Success
     */
    public function resetPassword(string $userId, string $newPassword): bool
    {
        return $this->update($userId, [
            'password_hash' => self::hashPassword($newPassword),
            'password_reset_token' => null,
            'password_reset_expires' => null,
        ]);
    }
}
