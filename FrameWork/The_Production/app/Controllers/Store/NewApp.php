<?php

namespace App\Controllers\Store;

use App\Controllers\BaseController;

class NewApp extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([
            'CaseID',
        ]);
        return view('store/new', $data);
    }
}
