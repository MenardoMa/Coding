<?php

namespace Routes;

class Route
{
    protected $path;
    protected $action;
    protected $matches;
    protected $params = [];

    /**
     * Undocumented function
     *
     * @param string $path
     * @param string $action
     */
    public function __construct(string $path, string $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }


    /**
     * Undocumented function
     *
     * @param string $url
     * @return bool
     */
    public function match(string $url) : bool
    {
        $url = trim($url, '/');
        $regex = preg_replace_callback("#:([\w]+)#", [$this, "paramMatch"], $this->path);
        $pathTomatch = "#^$regex$#i";

        if(!preg_match($pathTomatch, $url, $matches)){

            return false;

        }

        array_shift($matches);
        $this->matches = $matches;
        return true;

    }

    /**
     * Undocumented function
     *
     * @param [type] $param parametre passer 
     * @param [type] $regex et l'expression a executer
     * @return self
     */
    public function with($param, $regex) : self
    {
        $this->params[$param] = $regex;
        return $this;
    }

    /**
     * 
     * MATCHERS FOR FUNCTION
     *
     * @param [type] $match
     * @return void
     */
    public function paramMatch($match)
    {
        if(isset($this->params[$match[1]])){

            return '('.$this->params[$match[1]].')';

        }
        return "([^/]+)";
    }

    /**
     * Undocumented function
     * 
     * Execute un callable
     *
     * @return callable
     */
    public function execute()
    {
        if(is_string($this->action)){

            $params = explode("@", $this->action);
            $controller = new $params[0]();
            $method = $params[1];

            return isset($this->matches[0]) ? 
            call_user_func_array([$controller, $method], $this->matches) : 
            $controller->$method();

        }

        if(is_callable($this->action)){
            
            return call_user_func_array($this->action);

        }
    }
}