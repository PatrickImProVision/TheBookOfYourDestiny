<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Register extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([
            'ConfirmLink',
            'User',
        ]);
        return view('user/register', $data);
    }
}
