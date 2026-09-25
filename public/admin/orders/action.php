<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminOrderController.php';

AdminMiddleware::handle();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$controller = new AdminOrderController();

$action = $_POST['action'] ?? '';

$id = (int) ($_POST['id'] ?? 0);

if ($id <= 0) {
    http_response_code(400);
    exit('Invalid order ID.');
}

switch ($action) {

    case 'update_status':

        $status = $_POST['status'] ?? '';

        $controller->updateStatus(
            $id,
            $status
        );

        header(
            'Location: view.php?id=' . $id
        );

        exit;

    case 'update_payment':

        $paymentStatus =
            $_POST['payment_status'] ?? '';

        $controller->updatePaymentStatus(
            $id,
            $paymentStatus
        );

        header(
            'Location: view.php?id=' . $id
        );

        exit;

    default:

        http_response_code(400);
        exit('Invalid action.');
}