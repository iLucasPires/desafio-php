<?php

require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Database.php';

session_start([
    'cookie_lifetime' => 86400,
    'cookie_secure' => true,
    'cookie_samesite' => 'Strict',
    'cookie_httponly' => true,
]);

$router = new Router();

require_once __DIR__ . '/controllers/PageController.php';
require_once __DIR__ . '/controllers/AuthController.php';

AuthController::isLoggedin($router->uri);

$router->get('/', 'PageController@index');
$router->get('/login', 'PageController@login');
$router->get('/register', 'PageController@register');

$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');
