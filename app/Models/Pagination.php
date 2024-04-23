<?php

namespace App\Models;

class Pagination
{
    protected $data;
    protected $page;
    protected $elementPage;
    protected $pageCalc;

    public function __construct(array $data, string $page = null, $elementPage = null)
    {
        $this->data = $data;
        $this->page = $page;
        $this->elementPage = $elementPage;
    }

    /**
     * Undocumented function
     * 
     * COMPTE L'ENSEMBLE DES ELEMENTS SORTANT DU BD
     *
     * @return integer
     */
    public function countElement() : int
    {
        return count($this->data);
    }

    /**
     * Undocumented function
     * 
     * PAGE COURANTE
     *
     * @return int
     */
    public function currentPage() : int
    {
        if(!is_null($this->page)){

           $this->pageCalc = isset($_GET["{$this->page}"]) ? $_GET["{$this->page}"] : 1;
           $this->pageCalc = empty($_GET["{$this->page}"]) ? 1 : $_GET["{$this->page}"];

           if($this->pageCalc > $this->nombrePage()){

                $this->pageCalc = 1;

           }

           return $this->pageCalc;

        }
    }

    /**
     * Undocumented function
     * 
     * NOMBRE DE PAGE AVOIR
     *
     * @return int
     */
    public function nombrePage() : int
    {
        return (int) ceil($this->countElement() / $this->elementPage);
    }

    /**
     * Undocumented function
     *
     * @return integer
     */
    public function elementPage() : int
    {
        return $this->elementPage;
    }

    /**
     * Undocumented function
     * 
     * LA LIMITE
     *
     * @return integer
     */
    public function offset() : int
    {
        return ($this->currentPage() - 1) * $this->elementPage;
    }


}