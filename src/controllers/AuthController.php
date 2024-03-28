<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private static function generateToken($email)
    {
        return md5($email . $_SERVER['REMOTE_ADDR']);
    }

    private static function validateToken($email, $token)
    {
        return $token === self::generateToken($email);
    }

    public function login()
    {
        try {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                throw new Exception("Both email and password are required.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Invalid email format.");
            }

            $model = new UserModel(Database::getConnection());
            $user = $model->findByEmail($email);

            if ($user === null) {
                throw new Exception("User not found.");
            }

            if (!password_verify($password, $user['hashed_password'])) {
                throw new Exception("Invalid password.");
            }

            $_SESSION['user'] = [
                'email' => $email,
                'secret_key' => self::generateToken($email),
            ];

            Controller::redirect('/');

        }
        catch (Exception $e) {
            Controller::render('form', [
                'title' => 'login',
                'warning' => 'failed to login: ' . $e->getMessage(),
            ]);
        }
    }

    public function register()
    {
        try {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm'] ?? '';

            if (empty($email) || empty($password) || empty($confirmPassword)) {
                throw new Exception('All fields are required');
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email format');
            }

            if ($password !== $confirmPassword) {
                throw new Exception('Password does not match');
            }

            $model = new UserModel(Database::getConnection());

            if ($model->findByEmail($email)) {
                throw new Exception('Email already exists');
            }

            if (!$model->create($email, $password)) {
                throw new Exception('Failed to create user');
            }

            $_SESSION['user'] = [
                'email' => $email,
                'secret_key' => self::generateToken($email),
            ];

            Controller::redirect('/');
        }
        catch (Exception $e) {
            Controller::render('form', [
                'title' => 'register',
                'warning' => 'failed to create user: ' . $e->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        session_destroy();
        Controller::redirect('/');
    }

    public static function isLoggedin($uri)
    {
        $user = $_SESSION['user'] ?? null;
        $inForm = in_array($uri, ['/login', '/register']);

        if ($user) {
            $email = $user['email'] ?? null;
            $secret_key = $user['secret_key'] ?? null;

            $isVerified = self::validateToken($email, $secret_key);

            if ($isVerified && $inForm) {
                Controller::redirect('/');
                return;
            }

            if (!$isVerified && !$inForm) {
                Controller::redirect('/login');
                return;
            }
        }

        if (!$user && !$inForm) {
            Controller::redirect('/login');
            return;
        }
    }
}
