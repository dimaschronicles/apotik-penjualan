<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model
{
    protected $table      = 'user_token';
    protected $primaryKey = 'id_user_token';
    protected $allowedFields = ['email', 'token'];
}
