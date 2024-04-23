<?php

namespace App\Models;

use App\Models\Model;

class CommentsModel extends Model
{

    public function __construct()
    {
        $this->table = "comments";
    }

}