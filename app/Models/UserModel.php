<?php

namespace App\Models;

use App\Models\Model;

class UserModel extends Model
{
    public function __construct()
    {
        $this->table = 'users';
    }

}