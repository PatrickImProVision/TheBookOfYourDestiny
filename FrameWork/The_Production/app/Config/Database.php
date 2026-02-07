<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Database Configuration
 *
 * The Book Of Your Destiny - Production Database Configuration
 */
class Database extends BaseConfig
{
    /**
     * The default database connection.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connections
     */
    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'the_book_of_your_destiny',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_unicode_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'port'     => 3306,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database connection using the .env file's example values.
        $this->default = [
            'DSN'      => getenv('database.default.DSN') ?: '',
            'hostname' => getenv('database.default.hostname') ?: 'localhost',
            'username' => getenv('database.default.username') ?: 'root',
            'password' => getenv('database.default.password') ?: '',
            'database' => getenv('database.default.database') ?: 'the_book_of_your_destiny',
            'DBDriver' => getenv('database.default.DBDriver') ?: 'MySQLi',
            'DBPrefix' => getenv('database.default.DBPrefix') ?: '',
            'pConnect' => false,
            'DBDebug'  => (ENVIRONMENT !== 'production'),
            'charset'  => getenv('database.default.charset') ?: 'utf8mb4',
            'DBCollat' => getenv('database.default.DBCollat') ?: 'utf8mb4_unicode_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'port'     => getenv('database.default.port') ?: 3306,
        ];
    }
}
