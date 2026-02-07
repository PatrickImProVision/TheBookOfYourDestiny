<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * THE BOOK OF YOUR DESTINY - Portable Entry Point
 * Framework can be installed anywhere and will work correctly
 *
 * @link https://codeigniter.com
 * @license https://opensource.org/licenses/MIT MIT License
 */

// Determine paths dynamically for portability
$fcPath = __DIR__ . DIRECTORY_SEPARATOR;
$rootPath = dirname($fcPath) . DIRECTORY_SEPARATOR;

// Define critical paths using dynamic resolution
define('FCPATH', $fcPath);
define('ROOTPATH', $rootPath);
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
define('SYSTEMPATH', ROOTPATH . 'vendor' . DIRECTORY_SEPARATOR . 'codeigniter4' . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR);
define('WRITEPATH', ROOTPATH . 'writable' . DIRECTORY_SEPARATOR);

// Check if vendor directory exists (composer installed)
if (!is_dir(SYSTEMPATH)) {
    die('CodeIgniter framework not found. Please run: composer install');
}

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

// Load the environment file
$dotenv = dirname(ROOTPATH) !== dirname(FCPATH) 
    ? ROOTPATH . '.env' 
    : dirname(dirname(ROOTPATH)) . DIRECTORY_SEPARATOR . '.env';

if (!file_exists($dotenv)) {
    $dotenv = ROOTPATH . '.env.example';
}

if (file_exists($dotenv)) {
    @include_once $dotenv;
}

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * the autoloader, loads the constant file, loads the config file,
 * defines the error/exception handlers, defines the theme of
 * errors, and captures the output buffering so nothing gets sent
 * prior to the header calls.
 */

require SYSTEMPATH . 'bootstrap.php';

/*
 *---------------------------------------------------------------
 * LOAD ENVIRONMENT FILE / APP CONFIGURATION
 *---------------------------------------------------------------
 */

require APPPATH . 'Config/Boot/production.php';

/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 * If we have a "front controller" at the root folder, that's what gets loaded here.
 * Otherwise, the system will try to look for one in your /system folder.
 */

require SYSTEMPATH . 'CodeIgniter.php';
