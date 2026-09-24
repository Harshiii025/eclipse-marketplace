<?php

require_once __DIR__ . '/../../config/database.php';

class UserRepository
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function create(
        string $name,
        string $email,
        string $password,
        string $role = 'customer'
    ): int {
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role)
             VALUES (:name, :email, :password, :role)"
        );

        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);

        return (int) $this->db->lastInsertId();
    }
}