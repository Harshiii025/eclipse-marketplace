<?php

require_once __DIR__ . '/../Helpers/Auth.php';

class AdminMiddleware
{
    public static function handle(): void
    {
        Auth::startSession();

        if (!isset($_SESSION['user'])) {
            header('Location: /login.php');
            exit;
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            exit('Access denied.');
        }
    }
}