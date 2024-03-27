<?php

require_once 'models/UserModel.php';
require_once 'core/Controller.php';

const BASE_URL = 'https://rickandmortyapi.com/api/character/';

class SearchDTO
{
    public readonly string $name;
    public readonly string $species;
    public readonly string $type;
    public readonly string $status;
    public readonly string $gender;
    public readonly int $page;

    public function __construct(array $params)
    {
        $this->name = $params['name'] ?? '';
        $this->species = $params['species'] ?? '';
        $this->type = $params['type'] ?? '';
        $this->status = $params['status'] ?? '';
        $this->gender = $params['gender'] ?? '';
        $this->page = $params['page'] ?? 1;
    }
}

class UserController extends Controller
{
    public static function index()
    {
        $searchDTO = new SearchDTO($_GET);

        $curl = curl_init(BASE_URL . '?' . http_build_query([
            'name' => $searchDTO->name,
            'species' => $searchDTO->species,
            'type' => $searchDTO->type,
            'status' => $searchDTO->status,
        ]));

        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($response) {
            $data = json_decode($response, true);
            $characters = $data['results'] ?? [];
            $pages = $data['info']['pages'] ?? 0;

            Controller::render('index', [
                'characters' => $characters,
                'searchDTO' => $searchDTO,
                'pages' => $pages,
            ], 'All characters');
        }

        Controller::render('index', [], 'Error loading characters');
    }

    public static function character()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $curl = curl_init(BASE_URL . $id);
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            ]);

            $response = curl_exec($curl);
            curl_close($curl);

            if ($response) {
                $character = json_decode($response, true);
                Controller::render('character', ['character' => $character], 'Character');
            }
        }

        header('Location: /');
    }

    public static function logout()
    {
        session_destroy();
        header('Location: /login');
    }

    public static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $instance = new UserModel(Database::getConnection());
            $user = $instance->getUserByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user'] = $email;
                header('Location: /');
                return;
            }
            Controller::render('login', [], 'Invalid credentials');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            Controller::render('login', [], 'Login');
        }
    }

    public static function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (!$email || empty($password) || empty($confirmPassword)) {
                Controller::render('register', [], 'Invalid input');
                return;
            }

            if ($password !== $confirmPassword) {
                Controller::render('register', [], 'Passwords do not match');
                return;
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $instance = new UserModel(Database::getConnection());

            if ($instance->getUserByEmail($email)) {
                Controller::render('register', [], 'User already exists');
                return;
            }

            $userCreateDTO = new UserCreateDTO($email, $hashedPassword);

            if ($instance->createUser($userCreateDTO)) {
                $_SESSION['user'] = $email;
                header('Location: /');
                return;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            Controller::render('register', [], 'Register');
        }
    }
}
