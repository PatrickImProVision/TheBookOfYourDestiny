<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * ===================================================================
 * Logging Configuration
 * ===================================================================
 *
 * The Book Of Your Destiny - Logging Configuration
 */

class Logger extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Error Logging Threshold
     * --------------------------------------------------------------------------
     *
     * You can enable error logging by setting a threshold over zero. This will log
     * all of this application's errors to the specified file.
     *
     * @var int
     */
    public int $threshold = 4;

    /**
     * --------------------------------------------------------------------------
     * Logging Actions to Record
     * --------------------------------------------------------------------------
     */
    public array $allowedActions = [];

    /**
     * --------------------------------------------------------------------------
     * Log Deprecation Warnings
     * --------------------------------------------------------------------------
     */
    public bool $logDeprecations = true;

    /**
     * --------------------------------------------------------------------------
     * Logging Directory Path
     * --------------------------------------------------------------------------
     */
    public string $logsPath = WRITEPATH . 'logs/';

    /**
     * --------------------------------------------------------------------------
     * Log File Extension
     * --------------------------------------------------------------------------
     */
    public string $fileExtension = 'log';

    /**
     * --------------------------------------------------------------------------
     * Whether to Log to File
     * --------------------------------------------------------------------------
     */
    public bool $fileLogging = true;

    /**
     * --------------------------------------------------------------------------
     * Log Handler Classes
     * --------------------------------------------------------------------------
     */
    public array $handlers = [
        'CodeIgniter\Logs\Handlers\FileHandler' => [
            'handles'        => ['warning', 'error', 'critical', 'alert', 'emergency'],
            'permissions'    => [
                'file' => 0644,
                'dir'  => 0755,
            ],
        ],
    ];
}
