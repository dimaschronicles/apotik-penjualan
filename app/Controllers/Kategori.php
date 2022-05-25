<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategori->findAll(),
        ];

        return view('kategori/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kategori harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/kategori')->withInput();
        }

        $this->kategori->save([
            'nama_kategori' => $this->request->getVar('nama_kategori')
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>kategori</b> berhasil ditambahkan!</div>');

        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->kategori->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>kategori</strong> berhasil dihapus!</div>');
        return redirect()->to('/kategori');
    }
}
