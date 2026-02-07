<?php

namespace App\Models;

/**
 * Class CaseModel
 * 
 * The Book Of Your Destiny - Case Model
 * Represents a Book Case/Container entity
 * 
 * A Case holds one or more Books
 */
class CaseModel extends BaseModel
{
    protected $table = 'cases';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id',
        'canonical_id',
        'case_name',
        'case_title',
        'case_description',
        'author',
        'owner_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Callbacks
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Get all books for this case
     */
    public function getBooks($caseId)
    {
        $bookModel = new BookModel();
        return $bookModel->where('case_id', $caseId)->findAll();
    }

    /**
     * Get case with books (eager loading)
     */
    public function getCaseWithBooks($caseId)
    {
        $case = $this->find($caseId);
        if ($case) {
            $case['books'] = $this->getBooks($caseId);
        }
        return $case;
    }
}
