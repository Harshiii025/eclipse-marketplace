<?php

require_once __DIR__ . '/../../app/Middleware/AdminMiddleware.php';

AdminMiddleware::handle();

$user = $_SESSION['user'];

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

    <title>Admin Dashboard | Eclipse</title>

</head>

<body>

    <h1>Eclipse Admin Dashboard</h1>

    <p>
        Welcome,
        <?= htmlspecialchars($user['name']); ?>
    </p>

    <p>
        Role:
        <?= htmlspecialchars($user['role']); ?>
    </p>

    <hr>

    <h2>Management</h2>

    <ul>

        <li>
            <a href="products/">
                Products
            </a>
        </li>

        <li>
            <a href="categories/">
    Categories
</a>
        </li>

        <li>
            <a href="#">
                Inventory
            </a>
        </li>

        <li>
            <a href="orders/">
    Orders
</a>
        </li>

        <li>
            <a href="#">
                Customers
            </a>
        </li>

        <li>
            <a href="#">
                Sellers
            </a>
        </li>

    </ul>

    <hr>

    <h2>Quick Actions</h2>

    <ul>

        <li>
            <a href="products/create.php">
                Add New Product
            </a>
        </li>

        <li>
            <a href="products/">
                Manage Products
            </a>
        </li>

    </ul>

    <hr>

    <p>
        <a href="../index.php">
            ← Back to Marketplace
        </a>
    </p>

</body>

</html>