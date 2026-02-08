<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 */
class BaseController
{
    /**
     * An array of helpers to be loaded.
     *
     * @var array<string>
     */
    protected array $helpers = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        // Preload any models, libraries, etc, here.
    }
}
