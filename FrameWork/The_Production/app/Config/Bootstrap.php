<?php

/**
 * THE BOOK OF YOUR DESTINY - Application Bootstrap
 * 
 * This file provides centralized bootstrap functionality
 * for both web and CLI environments
 */

namespace Config;

/**
 * Get the application root path
 */
function getRootPath(): string
{
    return dirname(__DIR__) . DIRECTORY_SEPARATOR;
}

/**
 * Initialize application paths
 */
function initializePaths(): void
{
    $rootPath = getRootPath();

    if (!defined('ROOTPATH')) {
        define('ROOTPATH', $rootPath);
    }
    if (!defined('APPPATH')) {
        define('APPPATH', $rootPath . 'app' . DIRECTORY_SEPARATOR);
    }
    if (!defined('SYSTEMPATH')) {
        define('SYSTEMPATH', $rootPath . 'vendor' . DIRECTORY_SEPARATOR . 'codeigniter4' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR);
    }
    if (!defined('WRITEPATH')) {
        define('WRITEPATH', $rootPath . 'writable' . DIRECTORY_SEPARATOR);
    }
    if (!defined('FCPATH')) {
        define('FCPATH', $rootPath . 'public' . DIRECTORY_SEPARATOR);
    }
}

/**
 * Load environment variables
 */
function loadEnvironment(): void
{
    $envFile = ROOTPATH . '.env';
    
    if (!file_exists($envFile)) {
        $envFile = ROOTPATH . '.env.example';
    }

    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
                    putenv("$key=$value");
                }
            }
        }
    }
}

/**
 * Verify framework installation
 */
function verifyInstallation(): void
{
    if (!is_dir(SYSTEMPATH)) {
        die('CodeIgniter framework not found. Please run: composer install');
    }

    if (!is_dir(APPPATH)) {
        die('Application directory not found');
    }

    if (!is_writable(WRITEPATH)) {
        die('Writable directory is not writable: ' . WRITEPATH);
    }
}

/**
 * Set up error handling for portability
 */
function setupErrorHandling(): void
{
    error_reporting(E_ALL);
    
    if (ENVIRONMENT === 'production') {
        ini_set('display_errors', '0');
        ini_set('log_errors', '1');
        ini_set('error_log', WRITEPATH . 'logs' . DIRECTORY_SEPARATOR . 'php-errors.log');
    } else {
        ini_set('display_errors', '1');
    }
}
