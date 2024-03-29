<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'nama', 'email', 'no_hp', 'role', 'date_created'];

    public function getLogin($username)
    {
        return $this->db->table($this->table)->getWhere(['username' => $username])->getRowArray();
    }
}
