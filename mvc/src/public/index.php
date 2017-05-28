<?php

require_once('../../vendor/autoload.php');

use Everwing\View;
use Everwing\Router;

$view = new View(__DIR__.'/../pages');
$router = new Router($_SERVER['REQUEST_METHOD'],  $_SERVER['REQUEST_URI']);

$router->addRoute('GET', '/users', function() use ($view) {
    return $view->render('users', [
        'person' => 'Darick'
    ]);
});
$router->addRoute('GET', '/users/(\d+)', 'Everwing\Controllers\UserController@show');


$router->addRoute('GET', '/cool', 'Everwing\Controllers\CoolController@index');

$router->fire();