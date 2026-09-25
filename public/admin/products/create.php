<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminProductController.php';

AdminMiddleware::handle();

$controller = new AdminProductController();

$categories = $controller->categories();

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

    <title>Add Product | Eclipse Admin</title>

</head>

<body>

    <h1>Add Product</h1>

    <p>
        <a href="index.php">
            ← Back to Products
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
            value="create"
        >

        <p>

            <label>
                Product Name
            </label>

            <br>

            <input
                type="text"
                name="name"
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
            ></textarea>

        </p>

        <p>

            <label>
                Price
            </label>

            <br>

            <input
                type="number"
                name="price"
                step="0.01"
                min="0"
                required
            >

        </p>

        <p>

            <label>
                Compare Price
            </label>

            <br>

            <input
                type="number"
                name="compare_price"
                step="0.01"
                min="0"
            >

        </p>

        <p>

            <label>
                Category
            </label>

            <br>

            <select
                name="category_id"
                required
            >

                <option value="">
                    Select Category
                </option>

                <?php foreach ($categories as $category): ?>

                    <?php if ($category['status'] === 'active'): ?>

                        <option
                            value="<?= (int) $category['id']; ?>"
                        >
                            <?= htmlspecialchars($category['name']); ?>
                        </option>

                    <?php endif; ?>

                <?php endforeach; ?>

            </select>

        </p>

        <p>

            <label>
                Image Path
            </label>

            <br>

            <input
                type="text"
                name="image"
                placeholder="assets/images/products/example.jpg"
            >

        </p>

        <p>

            <label>
                Stock
            </label>

            <br>

            <input
                type="number"
                name="stock"
                min="0"
                value="0"
                required
            >

        </p>

        <p>

            <label>
                Status
            </label>

            <br>

            <select name="status">

                <option value="active">
                    Active
                </option>

                <option value="inactive">
                    Inactive
                </option>

            </select>

        </p>

        <button type="submit">
            Create Product
        </button>

    </form>

</body>

</html>