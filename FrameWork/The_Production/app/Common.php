<?php

/**
 * The purpose of this file is to hold commonly used functions that
 * are used by your views. It is recommended that you don't change
 * these core functions unless you know exactly what you are doing.
 *
 * The Book Of Your Destiny - Common Application Functions
 */

if (!function_exists('site_url')) {
    /**
     * Returns your site URL, as defined in the config file.
     * The index.php file is not included in URLs generated this way.
     *
     * @param string|string[] $path URI path(s)
     * @param string $protocol Protocol to use in URL
     * @param int $altConfig Alternate configuration group
     *
     * @return string
     */
    function site_url($path = '', $protocol = 'http://', $altConfig = null)
    {
        return service('url')->link($path, $protocol, $altConfig ?? config('App'));
    }
}

if (!function_exists('base_url')) {
    /**
     * Returns your base URL, as defined in the config file.
     * The index.php file is not included in URLs generated this way.
     *
     * @param string|string[] $path
     * @param string $protocol
     * @param int $altConfig Alternate configuration group
     *
     * @return string
     */
    function base_url($path = '', $protocol = 'http://', $altConfig = null)
    {
        return service('url')->baseUrl($path, $protocol, $altConfig ?? config('App'));
    }
}

/**
 * The Book Of Your Destiny - Application Helper Functions
 */

if (!function_exists('canonical_id')) {
    /**
     * Generate a canonical ID from length and style
     * Example: AAA, AAB, AA0, AA1, ..., 999
     *
     * @param int $length ID length (default 3)
     * @param bool $capital Use capital letters (default true)
     * @param int $count Which ID in sequence
     * @return string
     */
    function canonical_id($length = 3, $capital = true, $count = 0)
    {
        $alphabet = $capital ? array_merge(range('A', 'Z'), range(0, 9)) : array_merge(range('a', 'z'), range(0, 9));
        $base = count($alphabet);
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id = $alphabet[$count % $base] . $id;
            $count = intdiv($count, $base);
        }

        return $id;
    }
}

if (!function_exists('get_symbol_file')) {
    /**
     * Get symbol file path for alphabet or number
     * 
     * @param string $symbol Single letter (A-Z) or number (0-9)
     * @return string File path to symbol image
     */
    function get_symbol_file($symbol)
    {
        $symbol = strtoupper($symbol);
        return '/media/The_Language/The_Symbol_' . $symbol . '.png';
    }
}

if (!function_exists('generate_page_id')) {
    /**
     * Generate a page ID based on book and sequence
     * 
     * @param string $bookId
     * @param int $sequence
     * @return string
     */
    function generate_page_id($bookId, $sequence = 0)
    {
        return $bookId . '_P' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
}
