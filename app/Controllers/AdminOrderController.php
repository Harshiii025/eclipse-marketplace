<?php

require_once __DIR__ . '/OrderController.php';

class AdminOrderController
{
    private OrderController $order;

    public function __construct()
    {
        $this->order = new OrderController();
    }

    public function index(): array
    {
        return $this->order->index();
    }

    public function show(int $id): ?array
    {
        return $this->order->show($id);
    }

    public function items(int $orderId): array
    {
        return $this->order->items($orderId);
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
}