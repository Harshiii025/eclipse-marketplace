<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminCategoryController.php';

AdminMiddleware::handle();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

$controller = new AdminCategoryController();

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
            exit('Invalid category ID.');
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
            exit('Invalid category ID.');
        }

        $category = $controller->show($id);

        if (!$category) {
            http_response_code(404);
            exit('Category not found.');
        }

        $newStatus =
            $category['status'] === 'active'
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
            exit('Invalid category ID.');
        }

        $controller->delete($id);

        header('Location: index.php');
        exit;

    default:

        http_response_code(400);
        exit('Invalid action.');
}