<?php

namespace App\Models;

use App\Models\Model;

class CategorieModel extends Model
{

    public function __construct()
    {
        $this->table = "categories";
    }

    /**
     * Undocumented function
     * 
     * Cette Methode Renvoie l'ensemble de tags liee a un categorie
     *
     * @return array
     */
    public function getCatChild() : array
    {
        return $this->requet(
            "SELECT t.* FROM tags t
             INNER JOIN categories ct ON ct.id = id_cats
             WHERE ct.id = ?
            ", [$this->id]
        )->fetchAll();
    }

}