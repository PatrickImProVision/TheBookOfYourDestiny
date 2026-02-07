<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CaseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'canonical_id'     => 'A',
                'case_name'        => 'the-book-of-destiny',
                'case_title'       => 'The Book Of Your Destiny',
                'case_description' => 'Primary collection featuring the complete teachings of Jesus, organized by spiritual themes.',
                'author'           => 'Patrick ImPro Vision',
                'owner_id'         => null,
                'status'           => 'published',
            ],
            [
                'canonical_id'     => 'B',
                'case_name'        => 'wisdom-collection',
                'case_title'       => 'Collection of Wisdom',
                'case_description' => 'Ancient wisdom and modern insights for personal evolution.',
                'author'           => 'Various Contributors',
                'owner_id'         => null,
                'status'           => 'published',
            ],
            [
                'canonical_id'     => 'C',
                'case_name'        => 'leadership-studies',
                'case_title'       => 'Leadership & Moral Excellence',
                'case_description' => 'Comprehensive guide to ethical leadership and decision making.',
                'author'           => 'Leadership Institute',
                'owner_id'         => null,
                'status'           => 'draft',
            ],
        ];

        $this->db->table('cases')->insertBatch($data);
    }
}
