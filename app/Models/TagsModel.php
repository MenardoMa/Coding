<?php

namespace App\Models;

use App\Models\Model;

class TagsModel extends Model
{
    public function __construct()
    {
        $this->table = 'tags';
    }

    /**
     * Undocumented function
     * 
     * RENVOIE L'ENSEMBLE DE TOPICS LIER A UN TAG
     *
     * @return void
     */
    public function getTopic_ForTag()
    {
        return $this->requet(
            "SELECT t.* FROM topics t
            INNER JOIN topic_tag tt ON tt.topic_id = t.id
            WHERE tt.tag_id = ?", [$this->id]
        )->fetchAll();
    }

    /**
     * Undocumented function
     * 
     * GET TAG FOR TOPIC ASSOC TAG
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
    public function getCountComments()
    {
        $topic_compte = $this->requet(
            "SELECT cm.* FROM comments cm
             INNER JOIN topics tp ON tp.id = cm.topic_id
             WHERE tp.id = ?
            ", [$this->id]
            )->fetchAll();

        return count($topic_compte);
    }
}