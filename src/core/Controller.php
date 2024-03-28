<?php

class Controller
{
    public static function verifyVariavel($variavel): string | bool
    {
        return isset($variavel) ? $variavel : false;
    }

    public static function render($view, $data = [])
    {
        $file = __DIR__ . "/../views/$view.php";

        if (file_exists($file)) {
            extract($data, EXTR_SKIP);
            require $file;
            return;
        }
    }

    public static function fetch($url)
    {
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response ?: null;
    }

    public static function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}
