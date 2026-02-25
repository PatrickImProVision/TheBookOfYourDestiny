<?php

namespace App\Controllers;

class Index extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([]);
        return view('app/index', $data);
    }
}
