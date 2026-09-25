<?php

require_once __DIR__ . '/OrderController.php';
require_once __DIR__ . '/../Models/Product.php';
require_once __DIR__ . '/../Repositories/UserRepository.php';

class AdminDashboardController
{
    private OrderController $order;
    private Product $product;
    private UserRepository $user;

    public function __construct()
    {
        $this->order = new OrderController();
        $this->product = new Product();
        $this->user = new UserRepository();
    }

    public function statistics(): array
    {
        return [
            'total_orders' => $this->order->totalOrders(),

            'total_revenue' => $this->order->totalRevenue(),

            'pending_orders' => $this->order->pendingOrders(),

            'delivered_orders' =>
                $this->order->deliveredOrders(),

            'recent_orders' =>
                $this->order->recentOrders(5)
        ];
    }
}