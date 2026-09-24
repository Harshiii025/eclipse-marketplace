<?php

require_once __DIR__ . '/../Helpers/Auth.php';

class AuthMiddleware
{
    public static function requireLogin(): void
    {
        if (!Auth::check()) {
            header('Location: /login.php');
            exit;
        }
    }

    public static function requireRole(string $role): void
    {
        self::requireLogin();

        $user = Auth::user();

        if (($user['role'] ?? null) !== $role) {
            http_response_code(403);
            exit('Access denied.');
        }
    }
}