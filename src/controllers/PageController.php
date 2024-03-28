<?php

const BASE_URL = 'https://rickandmortyapi.com/api/character/';

class PageController
{
    private function filterParameters($parameters)
    {
        $allowedParameters = [
            'name' => '',
            'status' => '',
            'species' => '',
            'type' => '',
            'gender' => '',
            'page' => '1',
        ];
        return array_intersect_key($parameters, $allowedParameters);
    }

    public function index()
    {
        $parametrs = $this->filterParameters($_GET);
        $response = Controller::fetch(BASE_URL . '?' . http_build_query($parametrs));
        $responseData = json_decode($response, true);

        $pages = $responseData['info']['pages'] ?? 1;
        $start = max(1, ($parametrs['page'] ?? 1) - intval(5 / 2));
        $end = min($pages, $start + 5 - 1);

        Controller::render('home', [
            'characters' => $responseData['results'] ?? [],
            'warning' => $responseData['error'] ?? '',
            'searchDTO' => (object) $parametrs,
            'page' => $parametrs['page'] ?? 1,
            'pages' => $pages ?? 1,
            'start' => $start ?? 1,
            'end' => $end ?? 1,
        ]);
    }

    public function character()
    {
        $id = $_GET['id'] ?? null;

        if ($id === null) {
            Controller::redirect('/');
            return;
        }

        $response = Controller::fetch(BASE_URL . $id);
        $responseData = json_decode($response, true);

        Controller::render('character', [
            'character' => $responseData ?? [],
            'warning' => $responseData['error'] ?? '',
        ]);
    }

    public function login()
    {
        Controller::render('form', [
            'title' => 'login',
            'warning' => '',
        ]);
    }

    public function register()
    {
        Controller::render('form', [
            'title' => 'register',
            'warning' => '',
        ]);
    }
}
