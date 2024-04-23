<?php

namespace App\Exception;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RouteNotFoundException extends Exception
{
    public function __construct(string $message = "", $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Undocumented function
     * 
     * RENDERER DES EXCEPTIONS 
     *
     * @return void
     */
    public function NotFound()
    {
        http_response_code(404);

        $loader = new FilesystemLoader('../views/');
        $twig = new Environment($loader, [
            'cache' => false,
        ]);

        echo $twig->render("Exception/RouteNotFound.twig");
    }
}