<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminProductController.php';

AdminMiddleware::handle();

$controller = new AdminProductController();

$products = $controller->index();

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

    <title>Products | Eclipse Admin</title>

</head>

<body>

    <h1>Product Management</h1>

    <p>
        <a href="../index.php">
            ← Admin Dashboard
        </a>
    </p>

    <p>
        <a href="create.php">
            + Add Product
        </a>
    </p>

    <hr>

    <?php if (empty($products)): ?>

        <p>No products found.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($products as $product): ?>

                    <tr>

                        <td>
                            <?= (int) $product['id']; ?>
                        </td>

                        <td>

                            <?php if (!empty($product['image'])): ?>

                                <img
                                    src="../../<?= htmlspecialchars($product['image']); ?>"
                                    width="70"
                                    alt=""
                                >

                            <?php else: ?>

                                No image

                            <?php endif; ?>

                        </td>

                        <td>
                            <?= htmlspecialchars($product['name']); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $product['category_name'] ?? 'Uncategorized'
                            ); ?>
                        </td>

                        <td>
                            ₹<?= number_format(
                                (float) $product['price']
                            ); ?>
                        </td>

                        <td>
                            <?= (int) $product['stock']; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($product['status']); ?>
                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?= (int) $product['id']; ?>"
                            >
                                Edit
                            </a>

                            &nbsp; | &nbsp;

                            <form
                                action="action.php"
                                method="POST"
                                style="display:inline;"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="toggle_status"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $product['id']; ?>"
                                >

                                <button type="submit">
                                    <?= $product['status'] === 'active'
                                        ? 'Deactivate'
                                        : 'Activate'; ?>
                                </button>

                            </form>

                            &nbsp; | &nbsp;

                            <form
                                action="action.php"
                                method="POST"
                                style="display:inline;"
                            >

                                <input
                                    type="hidden"
                                    name="action"
                                    value="delete"
                                >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $product['id']; ?>"
                                >

                                <button
                                    type="submit"
                                    onclick="return confirm(
                                        'Delete this product permanently?'
                                    );"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>