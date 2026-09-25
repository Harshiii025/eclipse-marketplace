<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminCategoryController.php';

AdminMiddleware::handle();

$controller = new AdminCategoryController();

$categories = $controller->index();

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

    <title>Categories | Eclipse Admin</title>

</head>

<body>

    <h1>Category Management</h1>

    <p>
        <a href="../index.php">
            ← Admin Dashboard
        </a>
    </p>

    <p>
        <a href="create.php">
            + Add Category
        </a>
    </p>

    <hr>

    <?php if (empty($categories)): ?>

        <p>No categories found.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($categories as $category): ?>

                    <tr>

                        <td>
                            <?= (int) $category['id']; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $category['name']
                            ); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $category['slug']
                            ); ?>
                        </td>

                        <td>
                            <?= (int) $category['product_count']; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $category['status']
                            ); ?>
                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?= (int) $category['id']; ?>"
                            >
                                Edit
                            </a>

                            |

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
                                    value="<?= (int) $category['id']; ?>"
                                >

                                <button type="submit">

                                    <?= $category['status'] === 'active'
                                        ? 'Deactivate'
                                        : 'Activate'; ?>

                                </button>

                            </form>

                            |

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
                                    value="<?= (int) $category['id']; ?>"
                                >

                                <button
                                    type="submit"
                                    onclick="return confirm(
                                        'Delete this category?'
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