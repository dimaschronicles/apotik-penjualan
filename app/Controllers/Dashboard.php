<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dasbor'
        ];

        return view('dashboard/index', $data);
    }
}
