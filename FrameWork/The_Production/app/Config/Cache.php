<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * ===================================================================
 * Cache Settings
 * ===================================================================
 *
 * The Book Of Your Destiny - Cache Configuration
 */

class Cache extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Driver to use
     * --------------------------------------------------------------------------
     *
     * The name of the cache driver to use. This must be lowercase and must
     * match a driver class name or an alias. Example: 'dummy', 'file', 'memcached'
     *
     * @var string
     */
    public string $handler = 'file';

    /**
     * --------------------------------------------------------------------------
     * Cache Key Prefix
     * --------------------------------------------------------------------------
     *
     * If you have multiple applications using the same memcached server,
     * use this to prefix the cache keys for this application so you can
     * avoid key collisions.
     *
     * @var string
     */
    public string $prefix = 'book_destiny_';

    /**
     * --------------------------------------------------------------------------
     * Backup Handler
     * --------------------------------------------------------------------------
     */
    public string $backupHandler = 'dummy';

    // Various handlers' configuration
    public string $file = [
        'storePath' => WRITEPATH . 'cache/',
    ];

    /**
     * --------------------------------------------------------------------------
     * Key -> Class Mapping
     * --------------------------------------------------------------------------
     */
    public array $validHandlers = [
        'dummy'       => \CodeIgniter\Cache\Handlers\DummyHandler::class,
        'file'        => \CodeIgniter\Cache\Handlers\FileHandler::class,
        'memcached'   => \CodeIgniter\Cache\Handlers\MemcachedHandler::class,
        'predis'      => \CodeIgniter\Cache\Handlers\PredisHandler::class,
        'redis'       => \CodeIgniter\Cache\Handlers\RedisHandler::class,
        'wincache'    => \CodeIgniter\Cache\Handlers\WincacheHandler::class,
    ];
}
