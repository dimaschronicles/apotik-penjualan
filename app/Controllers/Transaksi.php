<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\TransaksiModel;
use Config\Services;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->obat = new ObatModel();
        $this->transaksi = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Transaksi Obat',
            'validation' => Services::validation(),
            'obat' => $this->obat->where('stok !=', null)->findAll(),
            'cart' => $this->transaksi->findTransaksiCart(),
            'total' => $this->transaksi->getTotalCart(),
        ];

        return view('transaksi/index', $data);
    }

    public function addCart()
    {
        if (!$this->validate([
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Obat harus diisi!',
                ]
            ],
            'nama_pembeli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pembeli harus diisi!',
                ]
            ],
            'jumlah_beli' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah harus diisi!',
                    'numeric' => 'Jumlah harus angka!',
                ]
            ],
        ])) {
            return redirect()->to('/transaksi')->withInput();
        }

        $id_obat = $this->request->getVar('nama_obat');
        $jumlah = $this->request->getVar('jumlah_beli');
        $obat = $this->obat->where('id_obat', $id_obat)->findAll();
        $sub_total = intval($obat[0]['harga']) * intval($jumlah);

        $this->transaksi->save([
            'id_user' => session('id_user'),
            'id_obat' => $id_obat,
            'nama_pembeli' => $this->request->getVar('nama_pembeli'),
            'jumlah_keluar' => $jumlah,
            'sub_total' => $sub_total,
            'status' => 'cart',
            'tanggal_keluar' => date('Y-m-d h:i:s'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>obat</strong> berhasil ditambahkan!</div>');
        return redirect()->to('/transaksi');
    }

    public function deleteCart($id = null)
    {
        $this->transaksi->delete($id);
        session()->setFlashdata('message', '<div class="alert alert-success">Data <strong>obat</strong> berhasil dihapus!</div>');
        return redirect()->to('/transaksi');
    }

    public function saveCart()
    {
        $nama_pembeli = $this->request->getVar('nama_pembeli');

        $data = [
            'status' => 'sell',
        ];

        $this->db->table('transaksi')->where('nama_pembeli', $nama_pembeli)->update($data);
        session()->setFlashdata('message', '<div class="alert alert-success"><strong>Obat</strong> berhasil dijual!</div>');
        return redirect()->to('/transaksi');
    }
}
