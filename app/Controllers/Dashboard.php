<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\ObatTransaksiModel;
use App\Models\SupplierModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->obat = new ObatModel();
        $this->supplier = new SupplierModel();
        $this->transaksi = new ObatTransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'jumlahObat' => $this->obat->countAllResults(),
            'jumlahSupplier' => $this->supplier->countAllResults(),
            'jumlahTransaksi' => $this->transaksi->countAllResults(),
            'jumlahTotalStok' => $this->db->table('obat')->selectSum('stok')->get()->getRowArray(),
        ];

        return view('dashboard/index', $data);
    }
}
