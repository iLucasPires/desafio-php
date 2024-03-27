<?php

class Controller
{
    public static function render($view, $data = [])
    {
        require_once 'views/partials/head.php';
        require_once 'views/' . $view . '.php';
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }
}
