<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data = $this->buildQueryViewData([
            'E-Mail',
            'E-PassWord',
            'ReMemberMe',
            'AutoLogin',
        ]);
        return view('user/login', $data);
    }
}
