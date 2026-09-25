<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminCategoryController.php';

AdminMiddleware::handle();

$id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

$controller = new AdminCategoryController();

$category = $controller->show($id);

if (!$category) {
    http_response_code(404);
    exit('Category not found.');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="/assets/css/admin.css">
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Category | Eclipse Admin</title>

</head>

<body>

    <h1>Edit Category</h1>

    <p>
        <a href="index.php">
            ← Back to Categories
        </a>
    </p>

    <hr>

    <form
        action="action.php"
        method="POST"
    >

        <input
            type="hidden"
            name="action"
            value="update"
        >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $category['id']; ?>"
        >

        <p>

            <label>
                Category Name
            </label>

            <br>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars(
                    $category['name']
                ); ?>"
                required
            >

        </p>

        <p>

            <label>
                Slug
            </label>

            <br>

            <input
                type="text"
                name="slug"
                value="<?= htmlspecialchars(
                    $category['slug']
                ); ?>"
                required
            >

        </p>

        <p>

            <label>
                Description
            </label>

            <br>

            <textarea
                name="description"
                rows="5"
            ><?= htmlspecialchars(
                $category['description'] ?? ''
            ); ?></textarea>

        </p>

        <p>

            <label>
                Status
            </label>

            <br>

            <select name="status">

                <option
                    value="active"
                    <?= $category['status'] === 'active'
                        ? 'selected'
                        : ''; ?>
                >
                    Active
                </option>

                <option
                    value="inactive"
                    <?= $category['status'] === 'inactive'
                        ? 'selected'
                        : ''; ?>
                >
                    Inactive
                </option>

            </select>

        </p>

        <button type="submit">
            Update Category
        </button>

    </form>

</body>

</html>