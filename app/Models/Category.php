<?php

require_once __DIR__ . '/../../config/database.php';

class Category
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT *
             FROM categories
             WHERE status = 'active'
             ORDER BY name ASC"
        );

        return $stmt->fetchAll();
    }

    public function getAllForAdmin(): array
    {
        $stmt = $this->db->query(
            "SELECT
                c.*,
                COUNT(p.id) AS product_count
             FROM categories c
             LEFT JOIN products p
                ON p.category_id = c.id
             GROUP BY c.id
             ORDER BY c.name ASC"
        );

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT *
             FROM categories
             WHERE id = :id
             LIMIT 1"
        );

        $stmt->execute([
            'id' => $id
        ]);

        $category = $stmt->fetch();

        return $category ?: null;
    }

    public function create(
        string $name,
        string $slug,
        ?string $description = null
    ): int {
        $stmt = $this->db->prepare(
            "INSERT INTO categories (
                name,
                slug,
                description
            )
            VALUES (
                :name,
                :slug,
                :description
            )"
        );

        $stmt->execute([
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(
        int $id,
        string $name,
        string $slug,
        ?string $description,
        string $status
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE categories
             SET
                name = :name,
                slug = :slug,
                description = :description,
                status = :status
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'status' => $status
        ]);
    }

    public function updateStatus(
        int $id,
        string $status
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE categories
             SET status = :status
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM categories
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id
        ]);
    }
}