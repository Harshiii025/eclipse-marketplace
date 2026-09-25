<?php

require_once __DIR__ . '/../../config/database.php';

class Order
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Orders
    |--------------------------------------------------------------------------
    */

    public function getAllForAdmin(): array
    {
        $stmt = $this->db->query(
            "SELECT
                o.*,
                u.name AS customer_name,
                u.email AS customer_email
             FROM orders o
             LEFT JOIN users u
                ON o.user_id = u.id
             ORDER BY o.created_at DESC"
        );

        return $stmt->fetchAll();
    }

    public function findByIdForAdmin(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT
                o.*,
                u.name AS customer_name,
                u.email AS customer_email
             FROM orders o
             LEFT JOIN users u
                ON o.user_id = u.id
             WHERE o.id = :id
             LIMIT 1"
        );

        $stmt->execute([
            'id' => $id
        ]);

        $order = $stmt->fetch();

        return $order ?: null;
    }

    public function getItems(int $orderId): array
    {
        $stmt = $this->db->prepare(
            "SELECT
                oi.*,
                p.image AS product_image
             FROM order_items oi
             LEFT JOIN products p
                ON oi.product_id = p.id
             WHERE oi.order_id = :order_id
             ORDER BY oi.id ASC"
        );

        $stmt->execute([
            'order_id' => $orderId
        ]);

        return $stmt->fetchAll();
    }

    public function updateStatus(
        int $id,
        string $status
    ): bool {
        $allowedStatuses = [
            'pending',
            'confirmed',
            'processing',
            'shipped',
            'delivered',
            'cancelled'
        ];

        if (!in_array($status, $allowedStatuses, true)) {
            return false;
        }

        $stmt = $this->db->prepare(
            "UPDATE orders
             SET status = :status
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function updatePaymentStatus(
        int $id,
        string $paymentStatus
    ): bool {
        $allowedStatuses = [
            'pending',
            'paid',
            'failed',
            'refunded'
        ];

        if (!in_array($paymentStatus, $allowedStatuses, true)) {
            return false;
        }

        $stmt = $this->db->prepare(
            "UPDATE orders
             SET payment_status = :payment_status
             WHERE id = :id"
        );

        return $stmt->execute([
            'id' => $id,
            'payment_status' => $paymentStatus
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard Statistics
    |--------------------------------------------------------------------------
    */

    public function getTotalOrders(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(*) FROM orders"
        );

        return (int) $stmt->fetchColumn();
    }

    public function getTotalRevenue(): float
    {
        $stmt = $this->db->query(
            "SELECT COALESCE(SUM(total), 0)
             FROM orders
             WHERE payment_status = 'paid'
             AND status != 'cancelled'"
        );

        return (float) $stmt->fetchColumn();
    }

    public function getPendingOrders(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(*)
             FROM orders
             WHERE status IN (
                'pending',
                'confirmed',
                'processing'
             )"
        );

        return (int) $stmt->fetchColumn();
    }

    public function getDeliveredOrders(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(*)
             FROM orders
             WHERE status = 'delivered'"
        );

        return (int) $stmt->fetchColumn();
    }

    public function getRecentOrders(
        int $limit = 5
    ): array {
        $limit = max(1, min($limit, 20));

        $stmt = $this->db->query(
            "SELECT
                o.id,
                o.order_number,
                o.total,
                o.status,
                o.payment_status,
                o.created_at,
                u.name AS customer_name
             FROM orders o
             LEFT JOIN users u
                ON o.user_id = u.id
             ORDER BY o.created_at DESC
             LIMIT {$limit}"
        );

        return $stmt->fetchAll();
    }

    /*
    |--------------------------------------------------------------------------
    | Customer Orders
    |--------------------------------------------------------------------------
    */

    public function getByUserId(
        int $userId
    ): array {
        $stmt = $this->db->prepare(
            "SELECT *
             FROM orders
             WHERE user_id = :user_id
             ORDER BY created_at DESC"
        );

        $stmt->execute([
            'user_id' => $userId
        ]);

        return $stmt->fetchAll();
    }

    public function findByUserId(
        int $orderId,
        int $userId
    ): ?array {
        $stmt = $this->db->prepare(
            "SELECT *
             FROM orders
             WHERE id = :id
             AND user_id = :user_id
             LIMIT 1"
        );

        $stmt->execute([
            'id' => $orderId,
            'user_id' => $userId
        ]);

        $order = $stmt->fetch();

        return $order ?: null;
    }
}