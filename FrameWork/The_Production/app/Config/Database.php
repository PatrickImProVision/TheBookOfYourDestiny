<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 *
 * @template DefaultGroup of string
 */
class Database extends Config
{
    /**
     * The default database connection.
     *
     * @var string
     */
    public $defaultGroup = 'default';

    /**
     * The default database connections.
     *
     * @var array<string, array<string, bool|int|string|null>>
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'codeigniter4',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8mb4',
        'DBCollat' => 'utf8mb4_unicode_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'port'     => 3306,
        'timeout'  => 0,
    ];

    /**
     * This database connection is used when
     * running phpunit database tests.
     *
     * @var array<string, bool|int|string|null>
     */
    public $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => '',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'port'     => 3306,
        'timeout'  => 0,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database connection to a UTF-8 'mb4'
        // one, so that we can solve the main use case of utf8 emoticons safely.
        if (strpos($this->default['charset'], 'utf8') === 0) {
            preg_match('/^(utf8)mb4?/i', $this->default['charset'], $matches);

            if (empty($matches[1])) {
                throw new \Exception('Database charset must be "utf8" or "utf8mb4".');
            }

            if ($this->default['charset'] === 'utf8') {
                $this->default['charset'] = 'utf8mb4';
            }
        }
    }
}
