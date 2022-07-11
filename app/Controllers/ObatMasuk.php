<?php

namespace App\Controllers;

use App\Models\ObatMasukModel;
use App\Models\ObatModel;
use App\Models\ObatTransaksiModel;
use App\Models\SatuanModel;
use App\Models\SupplierModel;

class ObatMasuk extends BaseController
{
    public function __construct()
    {
        $this->supplier = new SupplierModel();
        $this->obat = new ObatModel();
        $this->obatMasuk = new ObatMasukModel();
        $this->obatTransaksi = new ObatTransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Obat Masuk',
            'obatMasuk' => $this->obatTransaksi->getObatMasuk(),
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
            'no_batch' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No Batch harus diisi!',
                    'numeric' => 'No Batch harus angka!',
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

        $this->obatTransaksi->save([
            'id_obat' => $idObat,
            'no_batch' => $this->request->getVar('no_batch'),
            'jumlah_masuk' => $jumlahObat,
            'jumlah_sisa' => $jumlahStok,
            'keterangan_transaksi' => $this->request->getVar('keterangan'),
            'status' => 'masuk',
            'tanggal_transaksi' => $this->request->getVar('tanggal_masuk'),
        ]);

        $this->obat->save([
            'id_obat' => $idObat,
            'stok' => $jumlahStok
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>obat masuk</b> berhasil ditambahkan!</div>');

        return redirect()->to('/obatmasuk');
    }
}
