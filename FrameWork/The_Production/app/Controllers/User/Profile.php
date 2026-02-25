<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([
            'New',
            'View',
            'Edit',
        ]);
        return view('user/profile', $data);
    }
}
