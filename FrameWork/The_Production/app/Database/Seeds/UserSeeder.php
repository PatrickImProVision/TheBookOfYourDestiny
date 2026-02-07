<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $data = [
            [
                'username'        => 'admin',
                'email'           => 'admin@bookofDestiny.com',
                'password_hash'   => UserModel::hashPassword('Admin123!@#'),
                'first_name'      => 'Admin',
                'last_name'       => 'User',
                'role'            => 'admin',
                'status'          => 'active',
                'email_verified'  => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'        => 'moderator',
                'email'           => 'moderator@bookofDestiny.com',
                'password_hash'   => UserModel::hashPassword('Moderator123!@#'),
                'first_name'      => 'Moderator',
                'last_name'       => 'User',
                'role'            => 'moderator',
                'status'          => 'active',
                'email_verified'  => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'        => 'john_doe',
                'email'           => 'john@example.com',
                'password_hash'   => UserModel::hashPassword('User123!@#'),
                'first_name'      => 'John',
                'last_name'       => 'Doe',
                'role'            => 'user',
                'status'          => 'active',
                'email_verified'  => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'        => 'jane_smith',
                'email'           => 'jane@example.com',
                'password_hash'   => UserModel::hashPassword('User123!@#'),
                'first_name'      => 'Jane',
                'last_name'       => 'Smith',
                'role'            => 'user',
                'status'          => 'active',
                'email_verified'  => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
