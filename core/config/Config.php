<?php

namespace config;

/**
 * FACADE
 */

 class Config
 {
    /**
     * Undocumented variable
     *
     * @var [array]
     */
    protected $_facade;

    /**
     * Undocumented function
     *
     * @param [array] $arguments
     */
    public function __construct($arguments)
    {
        $this->_facade = $arguments;
    }

    /**
     * 
     * UNE FACADE POUR LA CONFIGURATION
     *
     * @param [string] $name le Key
     * @param [array] $arguments les donné
     * @return array
     */
    public static function __CallStatic($name, $arguments)
    {
        $config = new self(require "../app/Config/app.php");
        $key = strtoupper($name);
        return $config->_facade[$key];
    }

 }