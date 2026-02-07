<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class BaseModel
 * 
 * The Book Of Your Destiny - Base Model
 * Provides common functionality for all models including canonical ID generation
 */
class BaseModel extends Model
{
    protected $allowedFields = [];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    /**
     * Generate a canonical ID
     * Based on alphabet (A-Z) and numbers (0-9)
     * Example: AAA, AAB, AA0, AA1, ..., 999
     * 
     * @param int $length ID length (default 3)
     * @param bool $capital Use capital letters
     * @param int $sequence Sequential number
     * @return string
     */
    protected function generateCanonicalId($length = 3, $capital = true, $sequence = 0)
    {
        $chars = $capital 
            ? array_merge(range('A', 'Z'), range('0', '9'))
            : array_merge(range('a', 'z'), range('0', '9'));
        
        $base = count($chars);
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id = $chars[$sequence % $base] . $id;
            $sequence = intdiv($sequence, $base);
        }

        return $id;
    }

    /**
     * Generate next canonical ID for a given type
     * 
     * @param string $type Entity type (e.g., 'case', 'book', 'page')
     * @param int $length ID length
     * @return string
     */
    protected function getNextCanonicalId($type = '', $length = 3)
    {
        $count = $this->countAll();
        return ($type ? strtoupper(substr($type, 0, 1)) : '') . $this->generateCanonicalId($length, true, $count);
    }

    /**
     * Before insert - generate canonical ID if needed
     */
    protected function beforeInsert(array $data)
    {
        if (!isset($data['data']['id']) && !isset($data['data']['canonical_id'])) {
            $data['data']['canonical_id'] = $this->getNextCanonicalId();
        }
        return $data;
    }
}
