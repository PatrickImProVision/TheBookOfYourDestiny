<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCasesTable extends Migration
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
            'canonical_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 36,
                'unique'     => true,
                'comment'    => 'A-Z/0-9 unique identifier',
            ],
            'case_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'comment'    => 'Internal case name/slug',
            ],
            'case_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => false,
                'comment'    => 'Display title of the case',
            ],
            'case_description' => [
                'type'    => 'LONGTEXT',
                'null'    => true,
                'comment' => 'Detailed description of case',
            ],
            'author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Case author name',
            ],
            'owner_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
                'comment'    => 'User ID of case owner',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'published', 'archived'],
                'default'    => 'draft',
                'comment'    => 'Publication status',
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
        $this->forge->addKey('canonical_id');
        $this->forge->addKey('owner_id');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');
        $this->forge->addKey('deleted_at');

        $this->forge->createTable('cases', true);
    }

    public function down()
    {
        $this->forge->dropTable('cases', true);
    }
}
