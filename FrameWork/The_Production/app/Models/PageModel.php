<?php

namespace App\Models;

/**
 * Class PageModel
 * 
 * The Book Of Your Destiny - Page Model
 * Represents a Page entity
 * 
 * A Page is the smallest content unit with:
 * - Title, Moto, SubTitle, Author
 * - BookName, PageTitle, ContentName, Description
 * - Text, Image, Uri support
 */
class PageModel extends BaseModel
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'canonical_id',
        'book_id',
        'section_type', // preface, flagstone, fullstory, knowledge, biblelegend, leadership
        'page_sequence',
        'page_title',
        'page_moto',
        'page_subtitle',
        'page_author',
        'book_name',
        'page_name',
        'content_name',
        'page_description',
        'page_content', // JSON content with TinyMCE HTML
        'page_images', // JSON array of image data
        'page_uris', // JSON array of URI data
        'page_layout', // Layout template for page
        'align_text', // Text alignment
        'align_images', // Image alignment
        'is_published',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'page_images' => 'json',
        'page_uris' => 'json',
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get pages by book
     */
    public function getPagesByBook($bookId)
    {
        return $this->where('book_id', $bookId)
            ->orderBy('page_sequence', 'ASC')
            ->findAll();
    }

    /**
     * Get page with rendered content
     */
    public function getPageWithContent($pageId)
    {
        $page = $this->find($pageId);
        if ($page) {
            // Decode JSON content if present
            if (is_string($page['page_content'])) {
                $page['page_content'] = json_decode($page['page_content'], true);
            }
            if (is_string($page['page_images'])) {
                $page['page_images'] = json_decode($page['page_images'], true);
            }
            if (is_string($page['page_uris'])) {
                $page['page_uris'] = json_decode($page['page_uris'], true);
            }
        }
        return $page;
    }

    /**
     * Search pages by content
     */
    public function searchPages($query, $bookId = null)
    {
        $builder = $this->where("MATCH(page_title, content_name, page_content) AGAINST('$query' IN BOOLEAN MODE)");
        
        if ($bookId) {
            $builder->where('book_id', $bookId);
        }
        
        return $builder->findAll();
    }
}
