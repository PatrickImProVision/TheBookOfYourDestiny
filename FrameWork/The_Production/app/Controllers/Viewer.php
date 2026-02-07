<?php

namespace App\Controllers;

/**
 * Class Viewer
 * 
 * The Book Of Your Destiny - Viewer Controller
 * Handles view.app?CaseID=_ID_&BookID=_ID_&PageID=_ID_ routes
 * Display READ-ONLY content
 */
class Viewer extends BaseController
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
        $this->data['page_title'] = 'View Content - The Book Of Your Destiny';

        return view('viewer/index', $this->data);
    }
}
