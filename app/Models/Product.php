<?php

require_once __DIR__ . '/../../config/database.php';

class Product
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    /*
    |--------------------------------------------------------------------------
    | Customer / Public Queries
    |--------------------------------------------------------------------------
    */

    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT
                p.*,
                c.name AS category_name
             FROM products p
             LEFT JOIN categories c
                ON p.category_id = c.id
             WHERE p.status = 'active'
             ORDER BY p.created_at DESC"
        );

        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT
                p.*,
                c.name AS category_name
             FROM products p
             LEFT JOIN categories c
                ON p.category_id = c.id
             WHERE p.id = :id
             AND p.status = 'active'
             LIMIT 1"
        );

        $stmt->execute([
            'id' => $id
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT
                p.*,
                c.name AS category_name
             FROM products p
             LEFT JOIN categories c
                ON p.category_id = c.id
             WHERE p.slug = :slug
             AND p.status = 'active'
             LIMIT 1"
        );

        $stmt->execute([
            'slug' => $slug
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Queries
    |--------------------------------------------------------------------------
    */

    public function getAllForAdmin(): array
    {
        $stmt = $this->db->query(
            "SELECT
                p.*,
                c.name AS category_name
             FROM products p
             LEFT JOIN categories c
                ON p.category_id = c.id
             ORDER BY p.created_at DESC"
        );

        return $stmt->fetchAll();
    }

    public function findByIdForAdmin(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT
                p.*,
                c.name AS category_name
             FROM products p
             LEFT JOIN categories c
                ON p.category_id = c.id
             WHERE p.id = :id
             LIMIT 1"
        );

        $stmt->execute([
            'id' => $id
        ]);

        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function create(
        string $name,
        string $slug,
        ?string $description,
        float $price,
        ?float $comparePrice,
        ?string $image,
        int $categoryId,
        int $stock,
        string $status = 'active'
    ): int {
        $stmt = $this->db->prepare(
            "INSERT INTO products (
                name,
                slug,
                description,
                price,
                compare_price,
                image,
                category_id,
                stock,
                status
            )
            VALUES (
                :name,
                :slug,
                :description,
                :price,
                :compare_price,
                :image,
                :category_id,
                :stock,
                :status
            )"
        );

        $stmt->execute([
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'price' => $price,
            'compare_price' => $comparePrice,
            'image' => $image,
            'category_id' => $categoryId,
            'stock' => $stock,
            'status' => $status
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update(
        int $id,
        string $name,
        string $slug,
        ?string $description,
        float $price,
        ?float $comparePrice,
        ?string $image,
        int $categoryId,
        int $stock,
        string $status
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE products
             SET
                name = :name,
                slug = :slug,
                description = :description,
                price = :price,
                compare_price = :compare_price,
                image = :image,
                category_id = :category_id,
                stock = :stock,
                status = :status
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'price' => $price,
            'compare_price' => $comparePrice,
            'image' => $image,
            'category_id' => $categoryId,
            'stock' => $stock,
            'status' => $status
        ]);
    }

    public function updateStock(int $id, int $stock): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE products
             SET stock = :stock
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'stock' => $stock
        ]);
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE products
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
            "DELETE FROM products
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id
        ]);
    }
}