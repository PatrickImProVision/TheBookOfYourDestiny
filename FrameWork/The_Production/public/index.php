<?php

/**
 * CodeIgniter 4 - Portable Bootstrap
 * Self-contained entry point that works without Composer
 */

// Define paths
define('BASEPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('FCPATH', BASEPATH . 'public' . DIRECTORY_SEPARATOR);
define('APPPATH', BASEPATH . 'app' . DIRECTORY_SEPARATOR);
define('CONFIGPATH', APPPATH . 'Config' . DIRECTORY_SEPARATOR);
define('VIEWPATH', APPPATH . 'Views' . DIRECTORY_SEPARATOR);
define('CONTROLLERPATH', APPPATH . 'Controllers' . DIRECTORY_SEPARATOR);
define('WRITEPATH', BASEPATH . 'writable' . DIRECTORY_SEPARATOR);

// Change to project root
chdir(BASEPATH);

// Load environment variables from .env file
function load_env_file()
{
    $envFile = BASEPATH . '.env';
    if (!file_exists($envFile)) {
        return;
    }

    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse the line
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            // Remove quotes if present
            $value = trim($value, '"\'');
            $_ENV[$key] = $value;
        }
    }
}

// Load .env file
load_env_file();

// Set error reporting based on APP_DEBUG
$appDebug = $_ENV['APP_DEBUG'] ?? 'true';
$appDebug = strtolower($appDebug) === 'true';

if ($appDebug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
    ini_set('display_errors', 0);
}

ini_set('log_errors', 1);
ini_set('error_log', WRITEPATH . 'logs' . DIRECTORY_SEPARATOR . 'php_errors.log');

// Simple autoloader for our application
function autoload_class($class)
{
    // Only autoload App\* and Config\* namespaces
    if (strpos($class, 'App\\') !== 0 && strpos($class, 'Config\\') !== 0) {
        return;
    }

    $parts = explode('\\', $class);
    $namespace = array_shift($parts);

    if ($namespace === 'App') {
        $basePath = APPPATH;
    } elseif ($namespace === 'Config') {
        $basePath = CONFIGPATH;
    } else {
        return;
    }

    $filePath = $basePath . implode(DIRECTORY_SEPARATOR, $parts) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
}

spl_autoload_register('autoload_class');

// Simple router
class SimpleRouter
{
    private $routes = [];
    private $uri = '';
    private $method = '';
    private $controllerNamespace = 'App\\Controllers\\';

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parseUri();
    }

    private function parseUri()
    {
        $baseUrl = $_ENV['APP_BASEURL'] ?? '';
        $basePath = parse_url($baseUrl, PHP_URL_PATH) ?: '';
        $basePath = rtrim($basePath, '/');

        $requestUri = $_SERVER['REQUEST_URI'];
        $this->uri = $requestUri;

        if (!empty($basePath) && strpos($requestUri, $basePath) === 0) {
            $this->uri = substr($requestUri, strlen($basePath));
        } else {
            $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
            $scriptDir = rtrim(str_replace('\\', '/', dirname($scriptName)), '/');
            if ($scriptDir !== '' && strpos($requestUri, $scriptDir) === 0) {
                $this->uri = substr($requestUri, strlen($scriptDir));
            }
        }

        $this->uri = '/' . ltrim(parse_url($this->uri, PHP_URL_PATH), '/');
        $this->uri = rtrim($this->uri, '/');
        if (empty($this->uri)) {
            $this->uri = '/';
        }
    }

    public function get($path, $handler)
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler)
    {
        $this->addRoute('POST', $path, $handler);
    }

    public function match($methods, $path, $handler)
    {
        foreach ((array)$methods as $method) {
            $this->addRoute(strtoupper($method), $path, $handler);
        }
    }

    private function addRoute($method, $path, $handler)
    {
        if ($path === '') {
            $path = '/';
        }
        if ($path[0] !== '/') {
            $path = '/' . $path;
        }
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch()
    {
        // Load routes - pass $this as $routes variable
        $routes = $this;
        require CONFIGPATH . 'Routes.php';

        foreach ($this->routes as $route) {
            if ($route['method'] !== $this->method && $route['method'] !== 'ANY') {
                continue;
            }

            if ($this->matchPath($route['path'])) {
                return $this->callHandler($route['handler']);
            }
        }

        // Route not found
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        echo "<p>The page you are looking for does not exist.</p>";
        return false;
    }

    private function matchPath($pattern)
    {
        // Handle special patterns: (:num) (:any) etc
        $pattern = str_replace('/', '\\/', $pattern);
        $pattern = str_replace('(:num)', '([0-9]+)', $pattern);
        $pattern = str_replace('(:any)', '([a-zA-Z0-9_-]+)', $pattern);
        $pattern = '/^' . $pattern . '$/i';

        return preg_match($pattern, $this->uri);
    }

    private function callHandler($handler)
    {
        // Extract parameters from the handler string (e.g., "Controller::method/param1/param2")
        $parts = explode('/', $handler);
        $controllerMethod = array_shift($parts);
        $routeParams = $parts;

        list($controller, $method) = explode('::', $controllerMethod);
        $controllerClass = $this->controllerNamespace . $controller;

        if (!class_exists($controllerClass)) {
            throw new Exception("Controller not found: {$controllerClass}");
        }

        $instance = new $controllerClass();

        if (!method_exists($instance, $method)) {
            throw new Exception("Method not found: {$method} in {$controllerClass}");
        }

        // Call method with parameters
        if (!empty($routeParams)) {
            echo $instance->$method(...$routeParams);
        } else {
            echo $instance->$method();
        }
        return true;
    }
}

// Simple view renderer
if (!function_exists('view')) {
    function view($viewName, $data = [])
    {
        extract($data);
        ob_start();
        include VIEWPATH . str_replace('.', DIRECTORY_SEPARATOR, $viewName) . '.php';
        return ob_get_clean();
    }
}

if (!function_exists('base_url')) {
    function base_url(): string
    {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $path = rtrim(str_replace(basename($scriptName), '', $scriptName), '/');
        return $scheme . '://' . $host . $path . '/';
    }
}

// Initialize and dispatch router
try {
    $routes = new SimpleRouter();
    $routes->dispatch();
} catch (Exception $e) {
    if ($_ENV['APP_DEBUG'] ?? false) {
        echo '<pre style="color: red; background: #f0f0f0; padding: 20px;">';
        echo 'Error: ' . htmlspecialchars($e->getMessage()) . '<br>';
        echo 'File: ' . htmlspecialchars($e->getFile()) . '<br>';
        echo 'Line: ' . htmlspecialchars($e->getLine()) . '<br><br>';
        echo htmlspecialchars($e->getTraceAsString());
        echo '</pre>';
    } else {
        http_response_code(500);
        echo '<h1>500 - Internal Server Error</h1>';
    }
}
