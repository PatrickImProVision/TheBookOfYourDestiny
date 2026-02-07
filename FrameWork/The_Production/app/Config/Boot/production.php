<?php

/**
 * Production Bootstrap Configuration
 * 
 * The Book Of Your Destiny - Production Bootstrap
 * This file contains the bootstrap configuration for production environment
 */

// Production Environment Settings
if (!defined('CI_ENVIRONMENT')) {
    define('CI_ENVIRONMENT', 'production');
}

// Ensure environment is set correctly
if (CI_ENVIRONMENT !== 'production') {
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'The application environment is not set correctly.';
    exit(1);
}

// Set appropriate headers
if (!headers_sent()) {
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('X-XSS-Protection: 1; mode=block');
}
