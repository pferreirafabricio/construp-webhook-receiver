<?php

require_once './vendor/autoload.php';
require_once './source/Core/Headers.php';

use CoffeeCode\Router\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router(env('BASE_URL'), '@');

$router->get('/', function () {
    echo response([
        'message' => 'Welcome to the API',
        'version' => '1.0.0'
    ])->json();
});

$router->namespace('Source\Controllers');
$router->get('/list', 'WebhookController@list');
$router->post('/receive', 'WebhookController@save');

$router->dispatch();

/*
 * Redirect all errors
 */
if ($router->error()) {
    echo response([
        'error' => $router->error()
    ])->json();
}
