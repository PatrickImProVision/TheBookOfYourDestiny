<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePagesTable extends Migration
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
            'book_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Parent book ID',
            ],
            'section_type' => [
                'type'       => 'ENUM',
                'constraint' => ['preface', 'flagstone', 'fullstory', 'knowledge', 'biblelegend', 'leadership'],
                'default'    => 'fullstory',
                'comment'    => 'Section within the book',
            ],
            'page_sequence' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Display order within section',
            ],
            'page_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => false,
                'comment'    => 'Page title/heading',
            ],
            'page_moto' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'comment'    => 'Page motto/tagline',
            ],
            'page_subtitle' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'comment'    => 'Page subtitle/secondary heading',
            ],
            'page_author' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Page author/contributor',
            ],
            'book_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Reference to book name',
            ],
            'page_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Internal page identifier',
            ],
            'content_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'comment'    => 'Content identifier/category',
            ],
            'page_description' => [
                'type'    => 'TEXT',
                'null'    => true,
                'comment' => 'Short description/extract',
            ],
            'page_content' => [
                'type'    => 'LONGTEXT',
                'null'    => true,
                'comment' => 'Main page content (HTML)',
            ],
            'page_images' => [
                'type'    => 'JSON',
                'null'    => true,
                'comment' => 'Images data array',
            ],
            'page_uris' => [
                'type'    => 'JSON',
                'null'    => true,
                'comment' => 'Reference URIs array',
            ],
            'page_layout' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'default'    => 'default',
                'comment'    => 'Layout template',
            ],
            'align_text' => [
                'type'       => 'ENUM',
                'constraint' => ['left', 'center', 'right', 'justify'],
                'default'    => 'left',
                'comment'    => 'Text alignment',
            ],
            'align_images' => [
                'type'       => 'ENUM',
                'constraint' => ['left', 'center', 'right'],
                'default'    => 'center',
                'comment'    => 'Image alignment',
            ],
            'is_published' => [
                'type'    => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'comment' => 'Publication status flag',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'published', 'archived'],
                'default'    => 'draft',
                'comment'    => 'Page status',
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
        $this->forge->addKey('book_id');
        $this->forge->addKey('section_type');
        $this->forge->addKey('page_sequence');
        $this->forge->addKey('is_published');
        $this->forge->addKey('status');
        $this->forge->addKey('created_at');

        // Foreign key constraint
        $this->forge->addForeignKey('book_id', 'books', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pages', true);
    }

    public function down()
    {
        $this->forge->dropTable('pages', true);
    }
}
