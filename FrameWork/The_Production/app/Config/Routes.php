<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Routes Configuration
 * Routes define the 'controllers' and 'methods' that handle requests.
 *
 * The Book Of Your Destiny - Production Routes
 */
class Routes extends BaseConfig
{
    /*
     * You can use the $routes->get(), $routes->post(), $routes->put(), $routes->patch(), and $routes->delete()
     * instead of $routes->add() if you want to set the request method.
     */
    public $routes = [
        // Home/Index routes
        '/'                 => 'Home::index',
        'index'             => 'Home::index',

        // Authentication Routes (No filter needed - public access)
        'auth/login'        => 'AuthController::loginForm',
        'auth/register'     => 'AuthController::registerForm',
        'auth/logout'       => 'AuthController::logout',
        'auth/forgot'       => 'AuthController::forgotForm',
        'auth/forgot-password' => 'AuthController::forgotPassword',
        'auth/reset/(:segment)' => 'AuthController::resetForm/$1',
        'auth/reset-password' => 'AuthController::resetPassword',
        'auth/me'           => 'AuthController::me',

        // Case Management
        'case/list'         => 'Case::list',
        'case/create'       => 'Case::create',
        'case/edit/(:segment)' => 'Case::edit/$1',
        'case/view/(:segment)' => 'Case::view/$1',
        'case/delete/(:segment)' => 'Case::delete/$1',

        // Book Management
        'book/list'         => 'Book::list',
        'book/create'       => 'Book::create',
        'book/edit/(:segment)' => 'Book::edit/$1',
        'book/view/(:segment)' => 'Book::view/$1',
        'book/delete/(:segment)' => 'Book::delete/$1',

        // Page Management
        'page/list'         => 'Page::list',
        'page/create'       => 'Page::create',
        'page/edit/(:segment)' => 'Page::edit/$1',
        'page/view/(:segment)' => 'Page::view/$1',
        'page/delete/(:segment)' => 'Page::delete/$1',

        // View & Edit App routes (as per specification)
        'edit.app'          => 'Editor::index',
        'view.app'          => 'Viewer::index',
        'new.app'           => 'Creator::index',
    ];

    /*
     * Settings to determine how the paths are handled.  Uncomment default for backwards compatibility purposes,
     * however you are strongly encouraged to change these to more restrictive settings for your own project.
     */
    public $defaultNamespace = 'App\Controllers';
    public $defaultController = 'Home';
    public $defaultMethod = 'index';
    public $defaultLocale = 'en';

    public $translateURIDashes = false;

    public $strictURI = false;

    /*
     * When we cannot match routes, should matching URI against regular
     * expression patterns be attempted?  Off by default, since this has a
     * slight performance penalty.
     */
    public $enableExactMatching = false;

    /*
     * This option allows you to see what the router is trying to match the
     * request against, and what the 'before' and 'after' controller filters
     * are.  Only used in development or testing, but has to be kept in mind
     * when sending production code out.
     */
    public bool $displayAutoRouting = true;
}
