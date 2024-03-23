<?php

require_once 'utils/Util.php';
require_once 'models/UserModel.php';

class UserController
{
    static public function index()
    {
        $curl = curl_init("https://rickandmortyapi.com/api/character");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        if ($response === false) {
            echo 'Failed to fetch data';
            return;
        }

        $characters = json_decode($response, true)['results'];
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
                echo 'Invalid email or password';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

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
            $user = new UserModel(Database::getConnection());

            if ($user->getUserByEmail($email)) {
                echo 'User already exists';
                return;
            }

            $userCreateDTO = new UserCreateDTO($email, $hashedPassword);

            if ($user->createUser($userCreateDTO)) {
                $_SESSION['user'] = $email;
                header('Location: /');
                return;
            } else {
                echo 'Failed to register user';
                return;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  
        }
    }
}
