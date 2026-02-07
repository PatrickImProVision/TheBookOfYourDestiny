<?php

namespace App\Controllers;

/**
 * Class Editor
 * 
 * The Book Of Your Destiny - Editor Controller
 * Handles edit.app?CaseID=_ID_&BookID=_ID_&PageID=_ID_ routes
 * WYSIWYG Editor for content editing
 */
class Editor extends BaseController
{
    public function index()
    {
        $caseId = $this->request->getGet('CaseID');
        $bookId = $this->request->getGet('BookID');
        $pageId = $this->request->getGet('PageID');
        $sectionId = $this->request->getGet('SectionID');

        $this->data['caseId'] = $caseId;
        $this->data['bookId'] = $bookId;
        $this->data['pageId'] = $pageId;
        $this->data['sectionId'] = $sectionId;
        $this->data['page_title'] = 'Edit Content - The Book Of Your Destiny';

        return view('editor/index', $this->data);
    }
}
