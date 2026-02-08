<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Force Global HTTPS For Every Page
     * --------------------------------------------------------------------------
     *
     * Set this to true to force every page accessed via any means
     * (added links, form submissions, etc.) to be HTTPS.
     *
     * @var bool
     */
    public bool $forceHTTPS = false;

    /**
     * --------------------------------------------------------------------------
     * Session Variables
     * --------------------------------------------------------------------------
     *
     * 'sessionDriver'            = Session driver to use: 'files', 'database', or 'redis'
     * 'sessionCookieName'        = Name of session cookie
     * 'sessionExpiration'        = Number of SECONDS before expiring session
     * 'sessionSavePath'          = Save path for sessions
     *
     * @var string
     */
    public string $sessionDriver   = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName = 'PHPSESSID';
    public int $sessionExpiration   = 7200;
    public string $sessionSavePath  = WRITEPATH . 'session';

    /**
     * --------------------------------------------------------------------------
     * Session Match Settings
     * --------------------------------------------------------------------------
     *
     * Set up specific session match settings.
     *
     * @var bool
     */
    public bool $sessionMatchIP      = false;
    public bool $sessionMatchUserAgent = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF Protection
     * --------------------------------------------------------------------------
     *
     * 'CSRFProtection'    = 'true' enables CSRF protection
     * 'tokenRandomize'    = 'true' regenerates the token for every request
     * 'CSRFTokenName'     = Name of CSRF token
     * 'CSRFHeaderName'    = Name of CSRF token in headers
     * 'CSRFCookieName'    = Name of CSRF token in cookie
     * 'expires'           = Expiration date CSRF token
     *
     * @var bool|int
     */
    public bool $CSRFProtection  = true;
    public bool $tokenRandomize  = false;
    public string $tokenName     = 'csrf_token';
    public string $headerName    = 'X-CSRF-TOKEN';
    public string $cookieName    = 'csrf_cookie';
    public int $expires          = 7200;
    public bool $regenerate      = true;
    public bool $redact          = true;

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * Enables the Response's CSP Middleware to limit the source of
     * alternate content. Special keywords without surrounding quotes should
     * be used for best effect. Surround key with quotes for literal key value
     *
     * 'restrictionStatus' = Emission type ('enforce' or 'report_only')
     *
     * @var array|bool
     */
    public bool $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * HTML Purifier
     * --------------------------------------------------------------------------
     *
     * Enables library for sanitizing input.
     * @var bool
     */
    public bool $purifierEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * Cross-Origin Resource Sharing (CORS)
     * --------------------------------------------------------------------------
     *
     * Configures the headers that your server returns for CORS requests.
     * @var array
     */
    public array $cors = [];
}
