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

    /**
     * Return a normalized view data payload for query parameters.
     *
     * @param array<string> $expectedKeys
     * @return array<string, mixed>
     */
    protected function buildQueryViewData(array $expectedKeys = []): array
    {
        $params = $_GET ?? [];

        $expectedIndex = array_flip($expectedKeys);
        $matched = array_intersect_key($params, $expectedIndex);
        $extra = array_diff_key($params, $expectedIndex);

        return [
            'params' => $params,
            'matchedParams' => $matched,
            'extraParams' => $extra,
            'expectedParams' => $expectedKeys,
        ];
    }
}
