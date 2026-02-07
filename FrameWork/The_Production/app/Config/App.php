<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * App Configuration
 *
 * This file contains core application settings.
 * For The Book Of Your Destiny Production System
 */
class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     * URL to your CodeIgniter root. Typically this will be your base URL,
     * WITH a trailing slash:
     *
     *    http://example.com/
     *
     * If this is not set then CodeIgniter will try to guess the protocol and path
     * your installation, but due to the ambiguity of this process we recommend
     * explicitly defining it
     */
    public string $baseURL = 'http://localhost:8080/';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     * Typically this will be your index.php file, unless you've renamed it to
     * something else. If you are using mod_rewrite to remove the page set this
     * variable so that it is blank.
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     * This item determines which getServer global should be used to retrieve the
     * URI string.  The default setting of 'REQUEST_URI' works for most servers.
     * If your links do not seem to work, try one of the other delicious flavors:
     *
     * 'REQUEST_URI'    Uses $_SERVER['REQUEST_URI']
     * 'QUERY_STRING'   Uses $_SERVER['QUERY_STRING']
     * 'PATH_INFO'      Uses $_SERVER['PATH_INFO']
     *
     * WARNING: If you set this to 'PATH_INFO', CodeIgniter will
     * whenever the getServer global is not set to what it expects.
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     * The Locale roughly represents the language a user in the application.
     * When Locale Negotiation & Locale Mapping is enabled, this Locale is used
     * as the default Locale and is used if no Locale can be determined from the
     * HTTP Accept-Language header. If Locale Negotiation & Locale Mapping is
     * enabled, this must be a valid locale.
     */
    public string $defaultLocale = 'en';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     * If true, the current Locale will be determined by the value of the Accept-Language
     * header in the HTTP request.  If false, the defaultLocale defined in this class
     * will be used regardless of the Accept-Language header.
     *
     * When false, to prevent use of the default Locale header set
     * $negotiateLocale to true and $supportedLocales to empty array.
     * The Locale will then be an empty string.
     */
    public bool $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     * If $negotiateLocale is true, this array should contain all supported
     * user languages that your application intends to support. This is for best
     * loaded from another source, such as the database.
     */
    public array $supportedLocales = ['en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     * The default timezone to use in the application. Note that individual
     * databases chosen in the config array can override this setting
     * by the 'timezone' setting for that connection.
     */
    public string $appTimezone = 'UTC';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     * This determines which character set is used by default in various methods
     * throughout the framework. Default is UTF-8 unless something else
     * is specified elsewhere in the application.
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * URI REWRITE
     * --------------------------------------------------------------------------
     * When true, gets the current URI from the $_SERVER array. When false, uses
     * mod_rewrite to work cleanly without needing to check $_SERVER['REQUEST_URI'].
     * Also applies to explicitly passed URIs in \CodeIgniter\HTTP\URI::setURI().
     */
    public bool $allowedURIChars = 'a-z 0-9-~%.:_\-';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     * Force all requests made to this application to be made via a secure
     * connection (HTTPS). You may exempt certain URLs from this requirement
     * by listing them in the $excludeURIs array.
     *
     * The auto-redirect can be disabled by setting this to false, allowing you
     * to configure it within your .htaccess file or as a Nginx rewrite in
     * your app initialization file (bootstrap) file.
     * RESULT OF OBEYING THIS RULE WILL RENDER YOUR APP UNMAINTAINABLE!
     *
     * Usage Notes:
     * If you need to change configurations for each environment, refer to
     * https://codeigniter.com/user_guide/general/managing_apps.html
     *
     */
    public bool $forceGlobalSecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     * Enables the Response\CSP class and set it up in the default
     * RequestFilter. CSP is added to every response. You can use
     * csp_header() in views when you want to add header Content-Security-Policy.
     */
    public bool $CSPEnabled = false;
}
