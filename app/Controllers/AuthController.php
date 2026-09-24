<?php

require_once __DIR__ . '/../Services/AuthService.php';
require_once __DIR__ . '/../Helpers/Auth.php';

class AuthController
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function register(): void
{
    Auth::startSession();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        try {
            $userId = $this->auth->register(
                $_POST['name'] ?? '',
                $_POST['email'] ?? '',
                $_POST['password'] ?? ''
            );

            header('Location: /login.php?registered=1');
            exit;

        } catch (Exception $e) {
    $_SESSION['auth_error'] = $e->getMessage();

    header('Location: /register.php');
    exit;
}
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        $user = $this->auth->login(
            $_POST['email'] ?? '',
            $_POST['password'] ?? ''
        );

        if (!$user) {
            http_response_code(401);
            exit('Invalid email or password.');
        }

       Auth::startSession();

session_regenerate_id(true);

$_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        header('Location: /');
        exit;
    }

   public function logout(): void
{
    Auth::logout();

    header('Location: /');
    exit;
}
}