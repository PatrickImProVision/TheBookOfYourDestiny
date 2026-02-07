<?php

namespace App\Controllers;

/**
 * Class Home
 * 
 * The Book Of Your Destiny - Home Controller
 * Entry point for the application
 */
class Home extends BaseController
{
    public function index()
    {
        $this->data['content'] = 'Welcome to The Book Of Your Destiny';
        
        return view('home/index', $this->data);
    }

    public function dashboard()
    {
        return view('dashboard/index', $this->data);
    }
}
