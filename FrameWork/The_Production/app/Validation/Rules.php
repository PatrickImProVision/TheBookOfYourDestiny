<?php

namespace App\Validation;

/**
 * Custom Validation Rules
 * 
 * Additional validation rules for the application
 */
class Rules
{
    /**
     * Validate strong password
     * 
     * Password must contain:
     * - At least 8 characters
     * - At least one uppercase letter
     * - At least one lowercase letter
     * - At least one number
     * - At least one special character (!@#$%^&*)
     * 
     * @param string $value Password to validate
     * @return bool True if password is strong
     */
    public function strong_password(string $value): bool
    {
        // At least 8 characters
        if (strlen($value) < 8) {
            return false;
        }

        // At least one uppercase letter
        if (!preg_match('/[A-Z]/', $value)) {
            return false;
        }

        // At least one lowercase letter
        if (!preg_match('/[a-z]/', $value)) {
            return false;
        }

        // At least one number
        if (!preg_match('/[0-9]/', $value)) {
            return false;
        }

        // At least one special character
        if (!preg_match('/[!@#$%^&*()_\-+=\[\]{};:\'",.<>?\\/|`~]/', $value)) {
            return false;
        }

        return true;
    }
}
