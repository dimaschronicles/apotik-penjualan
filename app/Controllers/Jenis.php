<?php

namespace App\Controllers;

use App\Models\JenisModel;

class Jenis extends BaseController
{
    public function __construct()
    {
        $this->jenis = new JenisModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Jenis',
            'validation' => \Config\Services::validation(),
            'jenis' => $this->jenis->findAll(),
        ];

        return view('jenis/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_jenis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Jenis harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/jenis')->withInput();
        }

        $this->jenis->save([
            'nama_jenis' => $this->request->getVar('nama_jenis')
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>jenis</b> berhasil ditambahkan!</div>');

        return redirect()->to('/jenis');
    }

    public function delete($id)
    {
        $this->jenis->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>jenis</strong> berhasil dihapus!</div>');
        return redirect()->to('/jenis');
    }
}
