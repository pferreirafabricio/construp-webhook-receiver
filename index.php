<?php

require_once './vendor/autoload.php';
require_once './source/Core/Headers.php';

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * ROUTE CONFIG
 */
$router = new Router(env('BASE_URL'), '@');

/**
 * ROUTES
 */
$router->get('/', function () {
    echo response([
        'message' => 'Welcome to the API',
        'version' => '1.0.0'
    ])->json();
});

$router->namespace('Source\Controllers');
$router->get('/user', 'UserController@index');

$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    echo response([
        'error' => $router->error()
    ])->json();
}
