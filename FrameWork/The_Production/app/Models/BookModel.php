<?php

namespace App\Models;

/**
 * Class BookModel
 * 
 * The Book Of Your Destiny - Book Model
 * Represents a Book entity
 * 
 * A Book contains Pages organized by sections:
 * PreFace, FlagStone, FullStory, Knowledge, BibleLegend, LeaderShip
 */
class BookModel extends BaseModel
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'canonical_id',
        'case_id',
        'book_name',
        'book_title',
        'book_description',
        'book_author',
        'book_type', // inspirational_pages, preface, flagstone, fullstory, knowledge, biblelegend, leadership
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get all pages for this book
     */
    public function getPages($bookId)
    {
        $pageModel = new PageModel();
        return $pageModel->where('book_id', $bookId)->findAll();
    }

    /**
     * Get pages by section type
     */
    public function getPagesBySection($bookId, $sectionType)
    {
        $pageModel = new PageModel();
        return $pageModel
            ->where('book_id', $bookId)
            ->where('section_type', $sectionType)
            ->findAll();
    }

    /**
     * Get book with all pages (eager loading)
     */
    public function getBookWithPages($bookId)
    {
        $book = $this->find($bookId);
        if ($book) {
            $book['pages'] = $this->getPages($bookId);
        }
        return $book;
    }

    /**
     * Get book with pages organized by section
     */
    public function getBookWithPagesBySection($bookId)
    {
        $book = $this->find($bookId);
        if ($book) {
            $sections = ['preface', 'flagstone', 'fullstory', 'knowledge', 'biblelegend', 'leadership'];
            foreach ($sections as $section) {
                $book[$section] = $this->getPagesBySection($bookId, $section);
            }
        }
        return $book;
    }
}
