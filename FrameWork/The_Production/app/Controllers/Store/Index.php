<?php

namespace App\Controllers\Store;

use App\Controllers\BaseController;

class Index extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([
            'CaseID',
        ]);
        return view('store/index', $data);
    }
}
