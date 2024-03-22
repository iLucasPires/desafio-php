<?php

const ROUTES = [
    '/' => 'home.php',
    '/login' => 'login.php',
    '/404' => 'error.php'
];
define('views', __DIR__ . '/views/');


function getCurrentUri()
{
    $uri = $_SERVER['REQUEST_URI'];
    $uri = strtok($uri, '?');
    return rawurldecode($uri);
}


function routeRequest()
{
    $path = getCurrentUri();

    if (array_key_exists($path, ROUTES)) {
        $file = views . ROUTES[$path];

        if (file_exists($file)) {
            require $file;
            return;
        }
    }

    require views . ROUTES['/404'];
}
