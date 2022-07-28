<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatMasukModel extends Model
{
    protected $table      = 'obat_masuk';
    protected $primaryKey = 'id_obat_masuk';
    protected $allowedFields = ['id_obat', 'no_batch', 'id_supplier', 'jumlah_masuk', 'jumlah_sisa', 'keterangan_masuk', 'tanggal_masuk'];

    public function getObatMasuk()
    {
        return $this->db->table('obat_masuk')->select('*')
            ->join('obat', 'obat.id_obat = obat_masuk.id_obat')
            ->get()->getResultArray();
    }

    public function filterObatMasuk($dari_tanggal, $sampai_tanggal)
    {
        return $this->db->table('obat_masuk')->select('*')
            ->where(['tanggal_masuk >=' => $dari_tanggal, 'tanggal_masuk <=' => $sampai_tanggal])
            ->join('supplier', 'supplier.id_supplier = obat_masuk.id_supplier')
            ->join('obat', 'obat.id_obat = obat_masuk.id_obat')
            ->get()->getResultArray();
    }
}
