<?php

namespace App\Controllers;

class Dasbor extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dasbor'
        ];

        return view('dasbor/index', $data);
    }
}
