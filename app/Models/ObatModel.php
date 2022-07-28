<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $table      = 'obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['nama_obat', 'jenis', 'kategori', 'stok', 'harga', 'id_supplier', 'keterangan', 'time_created'];

    public function getObat($id = false)
    {
        if ($id == false) {
            return $this->db->table('obat')->select('*')
                ->join('supplier', 'supplier.id_supplier = obat.id_supplier')
                ->get()->getResultArray();
        }

        return $this->db->table('obat')->select('*')
            ->where('id_obat', $id)
            ->join('supplier', 'supplier.id_supplier = obat.id_supplier')
            ->get()->getRowArray();
    }

    public function findAllObat()
    {
        return $this->db->table('obat')->select('*')
            ->where('stok !=', null)->orderBy('stok', 'asc')
            ->get()->getResultArray();
    }
}
