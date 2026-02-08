<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Encryption extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Encryption Key
     * --------------------------------------------------------------------------
     *
     * If you use the Encryption class, you must supply it a encryption key
     * via this setting. Read the user guide for more info.
     *
     * https://codeigniter4.github.io/userguide/libraries/encryption.html
     *
     * @var string
     */
    public string $key = '';

    /**
     * --------------------------------------------------------------------------
     * Encryption Driver
     * --------------------------------------------------------------------------
     *
     * The encryption driver to be used.
     * Supported drivers: OpenSSL, Sodium
     *
     * @var string
     */
    public string $driver = '\CodeIgniter\Encryption\Handlers\OpenSSLHandler';

    /**
     * --------------------------------------------------------------------------
     * Encryption Driver Details
     * --------------------------------------------------------------------------
     *
     * Store a driver name to a class to use if that driver is requested.
     *
     * If you only specify the handler property in each driver config,
     * the Encryption class will handle the logic of creating the actual
     * handler class instance at run time using just the name and this array.
     * However, you could, for example, extend a core handler with your own
     * extended versions and put your class names in this array, instead.
     * As long as the class implements EncrypterInterface, you're good to go.
     *
     * @var array
     */
    public array $drivers = [
        'openssl' => '\CodeIgniter\Encryption\Handlers\OpenSSLHandler',
        'sodium'  => '\CodeIgniter\Encryption\Handlers\SodiumHandler',
    ];

    /**
     * --------------------------------------------------------------------------
     * Encryption Cipher
     * --------------------------------------------------------------------------
     *
     * The cipher used with OpenSSLHandler.
     *
     * Applied automatically if you use the Encryption library, but you
     * are advised to only change this if you know what an encryption
     * cipher is and understand its implications.
     *
     * @var string
     */
    public string $cipher = 'AES-256-CBC';
}
