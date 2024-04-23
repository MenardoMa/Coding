<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller 
{   
    /**
     * Undocumented function
     * 
     * RENDERER DE VUE
     *
     * @param [string] $path le path de vue
     * @param array $params  le donnée
     * @return void
     */
    public function view($path, $params = [])
    {
        $path = str_replace(".", "/", $path);

        $loader = new FilesystemLoader('../views/');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render("$path.twig", $params);
    }
}