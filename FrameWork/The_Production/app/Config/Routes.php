<?php

/**
 * CodeIgniter 4 - Route Configuration
 * Define your application routes here
 *
 * $routes is available as the SimpleRouter instance
 */

// ============================================================================
// Main Routes
// ============================================================================

// Home page
$routes->get('/', 'Home::index', ['as' => 'home']);

// ============================================================================
// Example Routes (Remove these when you don't need them)
// ============================================================================

// Example: Simple string output
$routes->get('/example/hello/(:any)', 'Example::hello/$1');
$routes->get('/example/hello', 'Example::hello');

// Example: Form handling
$routes->get('/example/form', 'Example::form');
$routes->post('/example/form', 'Example::form');

// Example: JSON API
$routes->get('/example/json', 'Example::json');

// ============================================================================
// Additional Routes Examples (Uncomment to use)
// ============================================================================

// Basic routes:
// $routes->get('/about', 'Pages::about');
// $routes->get('/contact', 'Pages::contact');
// $routes->post('/contact/submit', 'Pages::contact_submit');

// Routes with parameters:
// $routes->get('/user/(:num)', 'User::profile/$1');           // /user/123
// $routes->get('/post/(:any)', 'Post::view/$1');              // /post/my-post-title

// Multiple methods:
// $routes->match(['get', 'post'], '/search', 'Search::index');

// Grouped routes (for admin panel):
// $routes->group('admin', function($routes) {
//     $routes->get('/', 'Admin::index');
//     $routes->get('users', 'Admin::users');
// });

// ============================================================================
// 404 Automatic Handling
// ============================================================================
// If a URL doesn't match any route above, a 404 error is automatically shown


