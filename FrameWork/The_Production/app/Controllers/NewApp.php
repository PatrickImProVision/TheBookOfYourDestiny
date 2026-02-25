<?php

namespace App\Controllers;

class NewApp extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([]);
        return view('app/new', $data);
    }
}
