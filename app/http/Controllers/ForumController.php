<?php

namespace App\http\Controllers;

use Controller;
use App\Models\TagsModel;
use App\Models\ForumModel;
use App\Models\Pagination;
use App\Models\CategorieModel;

class ForumController extends Controller
{   
    /**
     * Undocumented function
     * 
     * RENVOIE TOUS LES TOPICS
     *
     * @return void
     */
    public function index()
    {
        $post = (new ForumModel())->findAll();

        $paginate = new Pagination($post, "p", 9);

        $courentPage      = $paginate->currentPage();
        $nombrePaginate   = $paginate->nombrePage();
        $elementPage      = $paginate->elementPage();
        $offset           = $paginate->offset();

        $post = (new ForumModel())->findAll($elementPage, $offset);

        $categories = (new CategorieModel())->findAll();

        return $this->view("forum.index", compact("post", "courentPage", "nombrePaginate", "categories"));
    }

    /**w
     * Undocumented function
     * 
     * RENVOIE UN TOPIC PAR RAPPORT A UN ID
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        return $this->view("forum.show", compact("id")); 
    }

    /**
     * Undocumented function
     * 
     * TAGS
     *
     * @param string $slug
     * @param integer $id
     * @return void
     */
    public function tags(string $slug, int $id)
    {   
        $tag = (new TagsModel)->find($id);

        if($tag){

            $topicAssoc_tag = $tag->getTopic_ForTag();

            $paginate = new Pagination($topicAssoc_tag, "p", 4);

            $courentPage      = $paginate->currentPage();
            $nombrePaginate   = $paginate->nombrePage();
            $elementPage      = $paginate->elementPage();
            $offset           = $paginate->offset();

            return $this->view("forum.tags", compact("tag", "topicAssoc_tag", "courentPage", "nombrePaginate"));
        }

        /**
         * ASSOCIER CET LOCATION AVEC UN MESSAGE
         */

        header("location: /forum");

    }

    public function search()
    {
        $post = (new ForumModel)->search($_POST);

    }
}