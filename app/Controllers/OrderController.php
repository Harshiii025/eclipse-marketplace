<?php

require_once __DIR__ . '/../Models/Order.php';

class OrderController
{
    private Order $order;

    public function __construct()
    {
        $this->order = new Order();
    }

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    public function index(): array
    {
        return $this->order->getAllForAdmin();
    }

    public function show(int $id): ?array
    {
        return $this->order->findByIdForAdmin($id);
    }

    public function items(int $orderId): array
    {
        return $this->order->getItems($orderId);
    }

    public function updateStatus(
        int $id,
        string $status
    ): bool {
        return $this->order->updateStatus(
            $id,
            $status
        );
    }

    public function updatePaymentStatus(
        int $id,
        string $status
    ): bool {
        return $this->order->updatePaymentStatus(
            $id,
            $status
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function totalOrders(): int
    {
        return $this->order->getTotalOrders();
    }

    public function totalRevenue(): float
    {
        return $this->order->getTotalRevenue();
    }

    public function pendingOrders(): int
    {
        return $this->order->getPendingOrders();
    }

    public function deliveredOrders(): int
    {
        return $this->order->getDeliveredOrders();
    }

    public function recentOrders(
        int $limit = 5
    ): array {
        return $this->order->getRecentOrders($limit);
    }

    /*
    |--------------------------------------------------------------------------
    | Customer
    |--------------------------------------------------------------------------
    */

    public function customerOrders(
        int $userId
    ): array {
        return $this->order->getByUserId($userId);
    }

    public function customerOrder(
        int $orderId,
        int $userId
    ): ?array {
        return $this->order->findByUserId(
            $orderId,
            $userId
        );
    }
}