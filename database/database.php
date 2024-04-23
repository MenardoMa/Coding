<?php

namespace Database;

use PDO;
use PDOException;
use config\Config;

class database extends PDO
{
 
    private static $_instance;

    /**
     * Undocumented function
     * 
     * INSTANCIER DU CONSTRUCTEUR DU PDO
     * 
     */
    private function __construct()
    {
        try {
            $dsn = "mysql:dbname=".Config::DB()["DB_NAME"].";host=".Config::DB()["DB_HOST"];
            parent::__construct($dsn, Config::DB()["DB_USER"], Config::DB()["DB_PASS"], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    /**
     * Undocumented function
     * 
     * UNE SINGLETON
     *
     * @return self
     */
    public static function getInstance() : self
    {
        if(is_null(self::$_instance)){
            self::$_instance = new self;
        }
        return self::$_instance;
    }
}