<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_user',
        'id_obat',
        'nama_pembeli',
        'jumlah_keluar',
        'sub_total',
        'status',
        'tanggal_keluar',
    ];

    public function findTransaksiObat()
    {
        return $this->db->table('transaksi')->select('*')
            ->join('user', 'user.id_user = transaksi.id_user')
            ->join('obat', 'obat.id_obat = transaksi.id_obat')
            ->get()->getResultArray();
    }

    public function findTransaksiCart()
    {
        return $this->db->table('transaksi')->select('*')
            ->join('user', 'user.id_user = transaksi.id_user')
            ->join('obat', 'obat.id_obat = transaksi.id_obat')
            ->where('status', 'cart')
            ->get()->getResultArray();
    }

    public function findTransaksiSell()
    {
        return $this->db->table('transaksi')->select('*')
            ->join('user', 'user.id_user = transaksi.id_user')
            ->join('obat', 'obat.id_obat = transaksi.id_obat')
            ->where('status', 'sell')
            ->get()->getResultArray();
    }

    public function getTotalCart()
    {
        return $this->db->table('transaksi')->select('*')
            ->where(['id_user' =>  session('id_user'), 'status' => 'cart'])
            ->selectSum('sub_total')->get()->getRowArray();
    }
}
