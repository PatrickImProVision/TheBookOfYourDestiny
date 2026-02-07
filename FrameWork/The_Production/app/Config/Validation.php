<?php

namespace Config;

use CodeIgniter\Validation\Validation as ValidationClass;

class Validation extends \CodeIgniter\Config\BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    // The rule sets that are available to use. You can add your own
    // class containing rules to this list. For example: \App\Validation\MyRules::class,
    public $ruleSets = [
        \CodeIgniter\Validation\Rules::class,
        \CodeIgniter\Validation\FormatRules::class,
        \CodeIgniter\Validation\FileRules::class,
        \CodeIgniter\Validation\CreditCardRules::class,
        \App\Validation\Rules::class,
    ];

    //--------------------------------------------------------------------
    // Custom validation messages
    //--------------------------------------------------------------------
    public $templates = [
        'list'   => 'CodeIgniter\\Validation\\Views\\list',
        'single' => 'CodeIgniter\\Validation\\Views\\single'
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $signup = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|strong_password',
    ];
}
