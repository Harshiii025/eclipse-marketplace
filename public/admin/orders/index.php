<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminOrderController.php';

AdminMiddleware::handle();

$controller = new AdminOrderController();

$orders = $controller->index();

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

    <title>Orders | Eclipse Admin</title>

</head>

<body>

    <h1>Order Management</h1>

    <p>
        <a href="../index.php">
            ← Admin Dashboard
        </a>
    </p>

    <hr>

    <?php if (empty($orders)): ?>

        <p>
            No orders found yet.
        </p>

        <p>
            This is expected because the customer checkout
            system has not been built yet.
        </p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Order Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($orders as $order): ?>

                    <tr>

                        <td>
                            <?= (int) $order['id']; ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $order['order_number']
                            ); ?>
                        </td>

                        <td>

                            <?= htmlspecialchars(
                                $order['customer_name']
                                ?? 'Guest'
                            ); ?>

                            <br>

                            <small>
                                <?= htmlspecialchars(
                                    $order['customer_email']
                                    ?? ''
                                ); ?>
                            </small>

                        </td>

                        <td>
                            ₹<?= number_format(
                                (float) $order['total']
                            ); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $order['status']
                            ); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $order['payment_status']
                            ); ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $order['created_at']
                            ); ?>
                        </td>

                        <td>

                            <a
                                href="view.php?id=<?= (int) $order['id']; ?>"
                            >
                                View
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</body>

</html>