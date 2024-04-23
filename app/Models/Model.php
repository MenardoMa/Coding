<?php

namespace App\Models;

use PDO;
use Database\database;

class Model extends database
{
    protected $table;
    protected $db;

    /**
     * Undocumented function
     * 
     * RETOUR L'ENSEMBLE DES DONNEE
     *
     * @return array
     */
    public function findAll(int $limt = null, int $offset = 0) : array
    {
        if(!is_null($limt)){
    
            return $this->requet("SELECT * FROM {$this->table} ORDER BY create_at DESC LIMIT {$limt} OFFSET {$offset}")->fetchAll();

        }
        return $this->requet("SELECT * FROM {$this->table} ORDER BY create_at DESC")->fetchAll();
    }

    /**
     * Undocumented function
     * 
     * RENVOIE AUTANT DE DONNER PAR RAPPORT A DIVERS CRITEUR
     *
     * @param integer $id
     * @return array
     */
    public function findBy(array $tabs)
    {
        $key = [];
        $values = [];

        foreach ($tabs as $k => $v) {
            
            $key[] = "$k = ?";
            $values[] = $v;

        }

        $listParams = implode(" AND ", $key);
        return $this->requet("SELECT * FROM {$this->table} WHERE {$listParams}", $values)->fetchAll();
    }

    /**
     * Undocumented function
     * 
     * RENVOIE QU'UN SEUL ELMENT PAR RAPPORT A ID
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->requet("SELECT * FROM {$this->table} WHERE id = ?", [$id])->fetch();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function search(array $POST)
    {
        if(isset($POST['input'])){

            $input = $POST['input'];
            $req = $this->requet("SELECT * FROM {$this->table} WHERE title LIKE '%{$input}%' ")->fetchAll();

            var_dump($req);

        }
    }

    /**
     * Undocumented function
     * 
     * MODELS PRINCIPAL
     *
     * @return void
     */
    protected function requet(string $sql, array|int $arguments = null)
    {
        $this->db = self::getInstance();

        if(!is_null($arguments)){

            $query = $this->db->prepare($sql);
            $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
            $query->execute($arguments);
            return $query;

        }

        $query = $this->db->query($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, get_class($this), [$this->db]);
        return $query;
        
    }
}