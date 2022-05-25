<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function __construct()
    {
        $this->supplier = new SupplierModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Supplier',
            'validation' => \Config\Services::validation(),
            'supplier' => $this->supplier->findAll(),
        ];

        return view('supplier/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Supplier harus diisi!',
                ]
            ],
            'telp_supplier' => [
                'rules' => 'required|numeric|min_length[11]|max_length[13]',
                'errors' => [
                    'required' => 'Nomor HP Supplier harus diisi!',
                    'numeric' => 'Nomor HP Supplier harus angka!',
                    'min_length' => 'Nomor HP Supplier kurang dari 11 digit!',
                    'max_length' => 'Nomor HP Supplier lebih dari 13 digit!',
                ]
            ],
            'alamat_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Supplier harus diisi!',
                ]
            ],
            'keterangan_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan Supplier harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/supplier')->withInput();
        }

        $this->supplier->save([
            'nama_supplier' => $this->request->getVar('nama_supplier'),
            'telp_supplier' => $this->request->getVar('telp_supplier'),
            'alamat_supplier' => $this->request->getVar('alamat_supplier'),
            'keterangan_supplier' => $this->request->getVar('keterangan_supplier'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>supplier</b> berhasil ditambahkan!</div>');

        return redirect()->to('/supplier');
    }

    public function delete($id)
    {
        $this->supplier->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>supplier</strong> berhasil dihapus!</div>');
        return redirect()->to('/supplier');
    }
}
