<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatKeluarModel extends Model
{
    protected $table      = 'obat_keluar';
    protected $primaryKey = 'id_obat_keluar';
    protected $allowedFields = ['id_obat', 'stok_awal', 'jumlah_keluar', 'sisa', 'keterangan_keluar', 'tanggal_keluar'];

    public function getObatKeluar()
    {
        return $this->db->table('obat_keluar')->select('*')
            ->join('obat', 'obat.id_obat = obat_keluar.id_obat')
            ->get()->getResultArray();
    }

    public function filterObatKeluar($dari_tanggal, $sampai_tanggal)
    {
        return $this->db->table('obat_keluar')->select('*')
            ->where(['tanggal_keluar >=' => $dari_tanggal, 'tanggal_keluar <=' => $sampai_tanggal])
            ->join('obat', 'obat.id_obat = obat_keluar.id_obat')
            ->get()->getResultArray();
    }
}
