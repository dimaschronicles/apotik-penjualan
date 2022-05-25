<?php

namespace App\Controllers;

use App\Models\ObatMasukModel;
use App\Models\ObatModel;
use App\Models\SupplierModel;

class ObatMasuk extends BaseController
{
    public function __construct()
    {
        $this->supplier = new SupplierModel();
        $this->obat = new ObatModel();
        $this->obatMasuk = new ObatMasukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Obat Masuk',
            'obatMasuk' => $this->obatMasuk->getObatMasuk(),
        ];

        return view('obat_masuk/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Obat Masuk',
            'validation' => \Config\Services::validation(),
            'obat' => $this->obat->findAll(),
            'supplier' => $this->supplier->findAll(),
        ];

        return view('obat_masuk/add', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'id_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Obat harus diisi!',
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah harus diisi!',
                    'numeric' => 'Jumlah harus angka!',
                ]
            ],
            'tanggal_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Masuk harus diisi!',
                ]
            ],
            'id_supplier' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Supplier harus diisi!',
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/obatmasuk/add')->withInput();
        }

        $idObat = $this->request->getVar('id_obat');
        $jumlahObat = $this->request->getVar('jumlah');
        $getStok = $this->obat->find($idObat);
        $jumlahStok = intval($jumlahObat) + intval($getStok['stok']);

        $this->obatMasuk->save([
            'id_obat' => $idObat,
            'jumlah_masuk' => $jumlahObat,
            'id_supplier' => $this->request->getVar('id_supplier'),
            'keterangan_masuk' => $this->request->getVar('keterangan'),
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
        ]);

        $this->obat->save([
            'id_obat' => $idObat,
            'stok' => $jumlahStok
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>obat masuk</b> berhasil ditambahkan!</div>');

        return redirect()->to('/obatmasuk');
    }
}
