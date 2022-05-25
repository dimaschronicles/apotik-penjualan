<?php

namespace App\Controllers;

use App\Models\BarangModel;

class Barang extends BaseController
{
    public function __construct()
    {
        $this->barang = new BarangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Barang',
            'validation' => \Config\Services::validation(),
            'barang' => $this->barang->findAll(),
        ];

        return view('barang/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Barang harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/barang')->withInput();
        }

        $this->barang->save([
            'nama_barang' => $this->request->getVar('nama_barang')
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>barang</b> berhasil ditambahkan!</div>');

        return redirect()->to('/barang');
    }

    public function delete($id)
    {
        $this->barang->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>barang</strong> berhasil dihapus!</div>');
        return redirect()->to('/barang');
    }
}
