<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Run seeders in dependency order
        $this->call('UserSeeder');
        $this->call('CaseSeeder');
        $this->call('BookSeeder');
        // Add more seeders as needed:
        // $this->call('PageSeeder');
    }
}
