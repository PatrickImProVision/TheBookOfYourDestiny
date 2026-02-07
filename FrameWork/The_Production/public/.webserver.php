<?php
/**
 * THE BOOK OF YOUR DESTINY - PHP Built-in Server Router
 *
 * This file allows the application to run on PHP's built-in web server
 * Usage: php -S localhost:8080 -t public .webserver.php
 */

// Get the requested file
$file = __DIR__ . $_SERVER['REQUEST_URI'];

// Serve static files if they exist
if (is_file($file) && !is_dir($file)) {
    return false; // Serve the requested file
}

// Otherwise, route everything through index.php
require_once 'index.php';
