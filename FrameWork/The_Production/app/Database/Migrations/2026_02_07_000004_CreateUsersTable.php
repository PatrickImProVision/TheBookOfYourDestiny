<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'unique'     => true,
                'null'       => false,
                'comment'    => 'Unique username',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
                'null'       => false,
                'comment'    => 'User email address',
            ],
            'password_hash' => [
                'type'    => 'VARCHAR',
                'constraint' => 255,
                'null'    => false,
                'comment' => 'Bcrypt hashed password',
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'User first name',
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
                'comment'    => 'User last name',
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'moderator', 'user', 'guest'],
                'default'    => 'user',
                'comment'    => 'User role/permission level',
            ],
            'avatar_url' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'comment'    => 'Profile picture URL',
            ],
            'bio' => [
                'type'    => 'TEXT',
                'null'    => true,
                'comment' => 'User biography',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['active', 'inactive', 'banned'],
                'default'    => 'active',
                'comment'    => 'Account status',
            ],
            'email_verified' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => 'Email verification flag',
            ],
            'email_verified_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'comment' => 'Email verification timestamp',
            ],
            'last_login_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'comment' => 'Last login timestamp',
            ],
            'password_reset_token' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Password reset token',
            ],
            'password_reset_expires' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'comment' => 'Password reset expiration',
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'comment' => 'Record creation timestamp',
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'comment' => 'Last update timestamp',
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'comment' => 'Soft delete timestamp',
            ],
        ]);

        $this->forge->addKey('id', false, false, 'PRIMARY');
        $this->forge->addKey('username');
        $this->forge->addKey('email');
        $this->forge->addKey('role');
        $this->forge->addKey('status');
        $this->forge->addKey('email_verified');
        $this->forge->addKey('created_at');

        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
