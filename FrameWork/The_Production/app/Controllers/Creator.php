<?php

namespace App\Controllers;

/**
 * Class Creator
 * 
 * The Book Of Your Destiny - Creator Controller
 * Handles new.app routes
 * Create NEW content (Case, Book, Page)
 */
class Creator extends BaseController
{
    public function index()
    {
        $type = $this->request->getGet('type'); // case, book, page, etc.

        $this->data['type'] = $type;
        $this->data['page_title'] = 'Create New - The Book Of Your Destiny';

        return view('creator/index', $this->data);
    }
}
