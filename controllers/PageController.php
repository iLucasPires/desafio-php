
<?php

const BASE_URL = 'https://rickandmortyapi.com/api/character/';

class PageController
{
    private function filterParameters($parameters)
    {
        $allowedParameters = [
            'name' => '', 'status' => '',
            'species' => '', 'type' => '',
            'gender' => '',
        ];

        return array_intersect_key($parameters, $allowedParameters);
    }

    public function index()
    {
        $parametrs = http_build_query($this->filterParameters($_GET));
        $response = Controller::fetch(BASE_URL . '?' . $parametrs);
        $responseData = json_decode($response, true);

        if (!$responseData) {
            Controller::render('home', [
                'title' => 'home',
                'warning' => 'No characters found',
                'characters' => [],
            ]);
            return;
        }

        Controller::render('home', [
            'title' => 'home',
            'warning' => '',
            'characters' => $responseData['results'],
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

        if (!$responseData) {
            Controller::render('character', [
                'title' => 'character',
                'warning' => 'Character not found',
                
            ]);
            return;
        }

        Controller::render('character', [
            'title' => 'character',
            'warning' => '',
            
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