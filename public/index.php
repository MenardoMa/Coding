<?php

use Routes\Router;
use App\http\HttpRequest;


require dirname(__DIR__).'/vendor/autoload.php';


$routes = new Router(new HttpRequest());

$routes->get('/', 'App\http\Controllers\PostController@index');
$routes->get('/forum', 'App\http\Controllers\ForumController@index');
$routes->get('/forum/:id', 'App\http\Controllers\ForumController@show')->with('id', '[0-9]+');
$routes->get('/tags/:slug-:id', 'App\http\Controllers\ForumController@tags')
        
        ->with('slug', '[a-z\-0-9]+')
        ->with('id', '[0-9]+');

$routes->get('/forum/search', 'App\http\Controllers\ForumController@search');
// $routes->post('/search', 'App\http\Controllers\ForumController@search');


(new App($routes))->bind();


