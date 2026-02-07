<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Note: Make sure cases are seeded first!
        $data = [
            // Books for Case A (The Book Of Destiny)
            [
                'canonical_id'     => 'A0',
                'case_id'          => 1, // Adjust based on actual case IDs
                'book_name'        => 'jesus-teachings',
                'book_title'       => 'The Complete Teachings of Jesus',
                'book_description' => 'All teachings and parables from the Gospel accounts.',
                'book_author'      => 'The Gospels',
                'book_type'        => 'fullstory',
                'status'           => 'published',
            ],
            [
                'canonical_id'     => 'A1',
                'case_id'          => 1,
                'book_name'        => 'cosmic-morality',
                'book_title'       => 'The Cosmos & Morality',
                'book_description' => 'Understanding the relationship between cosmic order and human morality.',
                'book_author'      => 'Patrick ImPro Vision',
                'book_type'        => 'knowledge',
                'status'           => 'published',
            ],
            [
                'canonical_id'     => 'A2',
                'case_id'          => 1,
                'book_name'        => 'fallen-angel',
                'book_title'       => 'The Fallen Angel',
                'book_description' => 'Historical and spiritual perspectives on the concept of the fallen angel.',
                'book_author'      => 'Patrick ImPro Vision',
                'book_type'        => 'biblelegend',
                'status'           => 'draft',
            ],
            // Books for Case B (Wisdom Collection)
            [
                'canonical_id'     => 'B0',
                'case_id'          => 2,
                'book_name'        => 'personal-evolution',
                'book_title'       => 'Personal Evolution & Growth',
                'book_description' => 'A journey towards spiritual and personal excellence.',
                'book_author'      => 'Wisdom Keepers',
                'book_type'        => 'leadership',
                'status'           => 'published',
            ],
            [
                'canonical_id'     => 'B1',
                'case_id'          => 2,
                'book_name'        => 'universal-love',
                'book_title'       => 'Universal Definition of Love',
                'book_description' => 'Exploring love in its cosmic and human dimensions.',
                'book_author'      => 'Philosophy Team',
                'book_type'        => 'knowledge',
                'status'           => 'published',
            ],
        ];

        $this->db->table('books')->insertBatch($data);
    }
}
