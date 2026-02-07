<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
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
            'case_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Parent case ID',
            ],
            'book_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'comment'    => 'Internal book name/slug',
            ],
            'book_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => false,
                'comment'    => 'Display title of the book',
            ],
            'book_description' => [
                'type'    => 'LONGTEXT',
                'null'    => true,
                'comment' => 'Detailed description of book',
            ],
            'book_author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Book author name',
            ],
            'book_type' => [
                'type'       => 'ENUM',
                'constraint' => ['inspirational_pages', 'preface', 'flagstone', 'fullstory', 'knowledge', 'biblelegend', 'leadership'],
                'default'    => 'inspirational_pages',
                'comment'    => 'Book category/type',
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
        $this->forge->addKey('case_id');
        $this->forge->addKey('book_type');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');

        // Foreign key constraint
        $this->forge->addForeignKey('case_id', 'cases', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('books', true);
    }

    public function down()
    {
        $this->forge->dropTable('books', true);
    }
}
