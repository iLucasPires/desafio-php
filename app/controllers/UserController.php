<?php

require_once 'models/UserModel.php';
const BASE_URL = 'https://rickandmortyapi.com/api/character/';

UserModel::createTable();

class UserController
{
    static public function index()
    {
        $name = isset($_GET['name']) ? $_GET['name'] : '';
        $species = isset($_GET['species']) ? $_GET['species'] : '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $gender = isset($_GET['gender']) ? $_GET['gender'] : '';
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        $apiUrl =  BASE_URL . '?' . http_build_query([
            'name' => $name,
            'species' => $species,
            'type' => $type,
            'status' => $status,
            'gender' => $gender,
            'page' => $page
        ]);

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        if ($response) {
            $data = json_decode($response, true);
            $characters = $data['results'];
            $pages = $data['info']['pages'];

            $start = max(1, $page - intval(5 / 2));
            $end = min($pages, $start + 5 - 1);

            require_once 'views/index.php';
        } else {
            $message = 'Failed to fetch data';
            require_once 'views/index.php';
        }
    }

    static public function character()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $curl = curl_init(BASE_URL . $id);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);

            if ($response) {
                $character = json_decode($response, true);
                require_once 'views/character.php';
            }
        }
    }

    static public function logout()
    {
        session_destroy();
        header('Location: /login');
    }

    static public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new UserModel(Database::getConnection());
            $user = $user->getUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = $email;
                header('Location: /');
            } else {
                $message = 'Invalid email or password';
                require_once 'views/login.php';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once 'views/login.php';
        }
    }


    static public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (!$email || empty($password) || empty($confirmPassword)) {
                echo 'Invalid input data';
                return;
            }

            if ($password !== $confirmPassword) {
                echo 'Passwords do not match';
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if (UserModel::getUserByEmail($email)) {
                echo '';
                return;
            }

            $userCreateDTO = new UserCreateDTO($email, $hashedPassword);

            if (UserModel::createUser($userCreateDTO)) {
                $_SESSION['user'] = $email;
                header('Location: /');
                return;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            require_once 'views/register.php';
        }
    }
}
