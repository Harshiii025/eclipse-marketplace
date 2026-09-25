<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminProductController.php';

AdminMiddleware::handle();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$controller = new AdminProductController();

$action = $_POST['action'] ?? '';

switch ($action) {

    case 'create':

        $controller->create($_POST);

        header('Location: index.php');
        exit;

    case 'update':

        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            exit('Invalid product ID.');
        }

        $controller->update(
            $id,
            $_POST
        );

        header('Location: index.php');
        exit;

    case 'toggle_status':

        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            exit('Invalid product ID.');
        }

        $product = $controller->show($id);

        if (!$product) {
            http_response_code(404);
            exit('Product not found.');
        }

        $newStatus =
            $product['status'] === 'active'
                ? 'inactive'
                : 'active';

        $controller->updateStatus(
            $id,
            $newStatus
        );

        header('Location: index.php');
        exit;

    case 'delete':

        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0) {
            http_response_code(400);
            exit('Invalid product ID.');
        }

        $controller->delete($id);

        header('Location: index.php');
        exit;

    default:

        http_response_code(400);
        exit('Invalid action.');
}