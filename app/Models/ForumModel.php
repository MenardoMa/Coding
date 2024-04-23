<?php

namespace App\Models;

use App\Models\Model;

class ForumModel extends Model
{

    public function __construct()
    {
        $this->table = "topics";
    }
    
    /**
     * Undocumented function
     * 
     * RENVOIE LES TAGS ASSOCIER A UN TOPIC
     *
     * @return array
     */
    public function getTags() : array
    {
        return $this->requet(
            "SELECT t.* FROM tags t
             INNER JOIN topic_tag tt ON tt.tag_id = t.id
             WHERE tt.topic_id = ?
            ", [$this->id]
        )->fetchAll();
    }

    /**
     * Undocumented function
     * 
     * RETOUR L'AUTEUR DU TOPIC
     *
     * @return void
     */
    public function getAuteur()
    {
        return (new UserModel())->findBy(['id' => $this->id_auteur]);
    }

    /**
     * Undocumented function
     * 
     * COMPTEUR DES COMMENTAIRE POUR CHAQUE TOPIC
     *
     * @return void
     */
    public function getCountComments() : int
    {
        $topic_compte = $this->requet(
            "SELECT cm.* FROM comments cm
             INNER JOIN topics tp ON tp.id = cm.topic_id
             WHERE tp.id = ?
            ", [$this->id]
            )->fetchAll();

        return count($topic_compte);
    }

    /**
     * Undocumented function
     * 
     * COMPTEUR DES COMMENTAIRE POUR CHAQUE TOPIC
     *
     * @return array
     */
    public function getFavorable_reply() : array
    {
        $favorable = $this->requet(
            "SELECT cm.* FROM comments cm
             INNER JOIN topics tp ON tp.id = cm.topic_id
             WHERE tp.id = ?
            ", [$this->id]
            )->fetchAll();

            // var_dump();

        return $favorable;
    }

    public function getDate()
    {
        return (new \DateTime($this->create_at))->format('d M Y');
    }

}