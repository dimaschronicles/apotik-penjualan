<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\ObatKeluarModel;

class ObatKeluar extends BaseController
{
    public function __construct()
    {
        $this->obat = new ObatModel();
        $this->obatKeluar = new ObatKeluarModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Obat Keluar',
            'obatKeluar' => $this->obatKeluar->getObatKeluar(),
        ];

        return view('obat_keluar/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Obat Keluar',
            'validation' => \Config\Services::validation(),
            'obat' => $this->obat->getObat(),
        ];

        return view('obat_keluar/add', $data);
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
            'tanggal_keluar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi!',
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan harus diisi!',
                ]
            ],
        ])) {
            return redirect()->to('/obatkeluar/add')->withInput();
        }

        $idObat = $this->request->getVar('id_obat');
        $jumlahObat = $this->request->getVar('jumlah');
        $getStok = $this->obat->find($idObat);
        $jumlahStok = intval($getStok['stok']) - intval($jumlahObat);

        $this->obatKeluar->save([
            'id_obat' => $idObat,
            'jumlah_keluar' => $jumlahObat,
            'keterangan_keluar' => $this->request->getVar('keterangan'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
        ]);

        $this->obat->save([
            'id_obat' => $idObat,
            'stok' => $jumlahStok
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <b>obat keluar</b> berhasil ditambahkan!</div>');

        return redirect()->to('/obatkeluar');
    }
}
