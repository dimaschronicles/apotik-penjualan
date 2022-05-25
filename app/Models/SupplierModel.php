<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $allowedFields = ['nama_supplier', 'telp_supplier', 'alamat_supplier', 'keterangan_supplier'];
}
