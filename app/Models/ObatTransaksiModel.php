<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatTransaksiModel extends Model
{
    protected $table      = 'obat_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_obat', 'no_batch', 'nama_satuan', 'jumlah_masuk', 'jumlah_keluar', 'jumlah_sisa', 'id_supplier', 'keterangan_transaksi', 'status',  'tanggal_transaksi'];

    public function getObatMasuk()
    {
        return $this->db->table('obat_transaksi')->select('*')
            ->join('obat', 'obat.id_obat = obat_transaksi.id_obat')
            ->where('status', 'masuk')
            ->get()->getResultArray();
    }

    public function getObatKeluar()
    {
        return $this->db->table('obat_transaksi')->select('*')
            ->join('obat', 'obat.id_obat = obat_transaksi.id_obat')
            ->where('status', 'keluar')
            ->get()->getResultArray();
    }

    public function filterObat($id_obat, $dari_tanggal, $sampai_tanggal)
    {
        return $this->db->table('obat_transaksi')->select('*')
            ->where(['obat_transaksi.id_obat' => $id_obat, 'tanggal_transaksi >=' => $dari_tanggal, 'tanggal_transaksi <=' => $sampai_tanggal])
            ->join('obat', 'obat.id_obat = obat_transaksi.id_obat')
            ->get()->getResultArray();
    }
}
