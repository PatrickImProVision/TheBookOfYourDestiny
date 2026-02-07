<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class AuthFilter
 * 
 * Middleware to protect routes and verify user authentication
 * 
 * Usage in Routes.php:
 * $routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
 *     // Protected routes
 * });
 */
class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not alter the request or response
     * but that is entirely up to the
     * discretion of the developer processing
     * the request.
     *
     * However, this might be a situation where the filter
     * needs to forward the user to a different
     * location, such as when an authorized access page
     * is requested. Or, the filter could
     * process the request with a payload.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to(base_url('/auth/login'))
                ->with('error', 'You must be logged in to access this page');
        }

        // Check for role-based access
        if (!empty($arguments)) {
            $requiredRole = $arguments[0];
            $userRole = session('role');

            if (!$this->hasAccess($userRole, $requiredRole)) {
                return redirect()->to(base_url('/'))
                    ->with('error', 'You do not have permission to access this page');
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not need to do anything
     * and can be left empty or removed.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }

    /**
     * Check if user role has access to required role
     * 
     * Role hierarchy:
     * admin > moderator > user
     * 
     * @param string $userRole User's current role
     * @param string $requiredRole Role required for access
     * @return bool True if user has access
     */
    private function hasAccess(string $userRole, string $requiredRole): bool
    {
        $roleHierarchy = [
            'guest' => 0,
            'user' => 1,
            'moderator' => 2,
            'admin' => 3,
        ];

        $userLevel = $roleHierarchy[$userRole] ?? 0;
        $requiredLevel = $roleHierarchy[$requiredRole] ?? 0;

        return $userLevel >= $requiredLevel;
    }
}
