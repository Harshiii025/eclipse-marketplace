<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminProductController.php';

AdminMiddleware::handle();

$id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

$controller = new AdminProductController();

$product = $controller->show($id);

if (!$product) {
    http_response_code(404);
    exit('Product not found.');
}

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

    <title>Edit Product | Eclipse Admin</title>

</head>

<body>

    <h1>Edit Product</h1>

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
            value="update"
        >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $product['id']; ?>"
        >

        <p>

            <label>
                Product Name
            </label>

            <br>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($product['name']); ?>"
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
                value="<?= htmlspecialchars($product['slug']); ?>"
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
                $product['description'] ?? ''
            ); ?></textarea>

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
                value="<?= htmlspecialchars($product['price']); ?>"
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
                value="<?= htmlspecialchars(
                    $product['compare_price'] ?? ''
                ); ?>"
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

                <?php foreach ($categories as $category): ?>

                    <?php if (
                        $category['status'] === 'active' ||
                        (int) $category['id'] ===
                        (int) $product['category_id']
                    ): ?>

                        <option
                            value="<?= (int) $category['id']; ?>"
                            <?= (int) $category['id'] ===
                                (int) $product['category_id']
                                ? 'selected'
                                : ''; ?>
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
                value="<?= htmlspecialchars(
                    $product['image'] ?? ''
                ); ?>"
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
                value="<?= (int) $product['stock']; ?>"
                required
            >

        </p>

        <p>

            <label>
                Status
            </label>

            <br>

            <select name="status">

                <option
                    value="active"
                    <?= $product['status'] === 'active'
                        ? 'selected'
                        : ''; ?>
                >
                    Active
                </option>

                <option
                    value="inactive"
                    <?= $product['status'] === 'inactive'
                        ? 'selected'
                        : ''; ?>
                >
                    Inactive
                </option>

            </select>

        </p>

        <button type="submit">
            Update Product
        </button>

    </form>

</body>

</html>