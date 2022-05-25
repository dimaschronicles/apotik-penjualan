<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table      = 'obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['no_batch', 'nama_obat', 'jenis', 'kategori', 'satuan', 'stok', 'keterangan', 'time_created'];

    public function getObat()
    {
        return $this->db->table('obat')->select('*')
            ->where('stok != 0')
            ->get()->getResultArray();
    }
}
