<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login | Apotek Buaran'
        ];

        return view('login/index', $data);
    }
}
