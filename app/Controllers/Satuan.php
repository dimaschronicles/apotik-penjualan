<?php

namespace App\Controllers;

use App\Models\SatuanModel;

class Satuan extends BaseController
{
    public function __construct()
    {
        $this->satuan = new SatuanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Satuan',
            'validation' => \Config\Services::validation(),
            'satuan' => $this->satuan->findAll(),
        ];

        return view('satuan/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Satuan harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/satuan')->withInput();
        }

        $this->satuan->save([
            'nama_satuan' => $this->request->getVar('nama_satuan')
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>satuan</b> berhasil ditambahkan!</div>');

        return redirect()->to('/satuan');
    }

    public function delete($id)
    {
        $this->satuan->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>satuan</strong> berhasil dihapus!</div>');
        return redirect()->to('/satuan');
    }
}
