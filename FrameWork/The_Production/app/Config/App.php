<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     *
     * URL to your CodeIgniter root. Typically this will be your base URL,
     * WITH a trailing slash:
     *
     * E.g., http://example.com/
     */
    public string $baseURL = '';

    public function __construct()
    {
        $envBaseUrl = getenv('APP_BASEURL');
        if ($envBaseUrl === false || $envBaseUrl === '') {
            $envBaseUrl = getenv('app.baseURL');
        }

        if ($envBaseUrl !== false && $envBaseUrl !== '') {
            $this->baseURL = rtrim($envBaseUrl, '/') . '/';
            return;
        }

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $path = rtrim(str_replace(basename($scriptName), '', $scriptName), '/');
        $this->baseURL = $scheme . '://' . $host . $path . '/';
    }

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     *
     * Typically this will be your index.php file, unless you've renamed it to
     * something else. If you are using mod_rewrite to remove the page set this
     * variable so that it is blank.
     *
     * @var string
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     *
     * This item determines which getServer global should be used to retrieve the
     * URI string.  The default setting of 'REQUEST_URI' works for most servers.
     * If your links do not work, try one of the other delicious flavors:
     *
     * 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
     * 'SCRIPT_NAME'    Uses $_SERVER['SCRIPT_NAME']
     * 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
     *
     * WARNING: If you set this to 'PATH_INFO', URIs will always be URL-encoded!
     *
     * @var string
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     *
     * The Locale roughly represents the language and location that your visitor
     * is viewing the site from. It affects the language strings and other
     * strings to display to your user.  Setting a default here affects all
     * strings to be used by default.
     *
     * @var string
     */
    public string $defaultLocale = 'en';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     *
     * If true, the current Locale will be determined by the "Accept-Language"
     * header in the user's request browser language. If false, no automatic
     * locale selection will be performed.
     *
     * @var bool
     */
    public bool $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     *
     * If $negotiateLocale is true, this array lists the locales supported
     * by the application in descending order of priority. If no match is
     * found, the first locale will be used.
     *
     * @var string[]
     */
    public array $supportedLocales = ['en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     *
     * The default timezone that will be used in your application to convert
     * times to their local time. You can use any of the PHP supported
     * timezones, which are defined here:
     * http://php.net/manual/en/timezones.php
     *
     * @var string
     */
    public string $appTimezone = 'UTC';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     *
     * This determines which character set is used by default in various methods
     * throughout the framework. Default is UTF-8. If it is changed, both a UTF-8
     * library file and a JavaScript library file MUST be provided.
     *
     * @var string
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * URI REWRITE FOR NICE URLS
     * --------------------------------------------------------------------------
     *
     * If you need to rewrite your URLs, you'll set the suffix of your index
     * page. This can be empty, should you need perfect URLs within your own
     * system.
     *
     * Examples:
     *    '' Gets you mydomain.com/controller/
     *    '.html' Gets you mydomain.com/controller.html
     *    '.json' Gets you mydomain.com/controller.json
     *
     * @var string
     */
    public string $urlSuffix = '';

    /**
     * --------------------------------------------------------------------------
     * Default Controller
     * --------------------------------------------------------------------------
     *
     * Normally you will set your default controller in the routing config file.
     * You can, however, force a different controller to be used by uncommenting
     * this option, and setting it to the name of the controller class to use.
     *
     * @var string
     */
    public string $defaultController = 'Home';

    /**
     * --------------------------------------------------------------------------
     * Default Method
     * --------------------------------------------------------------------------
     *
     * Determines the default method that will be called in your controller
     * when a URI is not explicitly matched to a route.
     *
     * @var string
     */
    public string $defaultMethod = 'index';

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     *
     * ....
     *
     * @var array
     */
    public array $proxyIPs = [];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * Enables the Response's CSP Middleware to limit the source of
     * alternate content. Special keywords without surrounding quotes should
     * be used for best effect. Surround key with quotes for literal key value
     *
     * @var array|bool
     */
    public $CSPEnabled = false;
}
