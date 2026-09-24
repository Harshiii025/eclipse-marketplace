<?php

require_once __DIR__ . '/../Repositories/UserRepository.php';

class AuthService
{
    private UserRepository $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function register(
        string $name,
        string $email,
        string $password
    ): int {
        $name = trim($name);
        $email = strtolower(trim($email));

        if ($name === '') {
            throw new Exception('Name is required.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Please enter a valid email address.');
        }

        if (strlen($password) < 8) {
            throw new Exception(
                'Password must be at least 8 characters.'
            );
        }

        if ($this->users->findByEmail($email)) {
            throw new Exception('An account with this email already exists.');
        }

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        return $this->users->create(
            $name,
            $email,
            $hashedPassword
        );
    }

    public function login(
        string $email,
        string $password
    ): ?array {
        $email = strtolower(trim($email));

        $user = $this->users->findByEmail($email);

        if (!$user) {
            return null;
        }

        if (!password_verify($password, $user['password'])) {
            return null;
        }

        unset($user['password']);

        return $user;
    }
}