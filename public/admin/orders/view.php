<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/../../../app/Controllers/AdminOrderController.php';

AdminMiddleware::handle();

$id = isset($_GET['id'])
    ? (int) $_GET['id']
    : 0;

if ($id <= 0) {
    http_response_code(400);
    exit('Invalid order ID.');
}

$controller = new AdminOrderController();

$order = $controller->show($id);

if (!$order) {
    http_response_code(404);
    exit('Order not found.');
}

$items = $controller->items($id);

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

    <title>
        Order <?= htmlspecialchars(
            $order['order_number']
        ); ?> | Eclipse Admin
    </title>

</head>

<body>

    <h1>
        Order
        <?= htmlspecialchars(
            $order['order_number']
        ); ?>
    </h1>

    <p>

        <a href="index.php">
            ← Back to Orders
        </a>

    </p>

    <hr>

    <h2>Customer</h2>

    <p>
        <strong>Name:</strong>

        <?= htmlspecialchars(
            $order['customer_name'] ?? 'Guest'
        ); ?>
    </p>

    <p>
        <strong>Email:</strong>

        <?= htmlspecialchars(
            $order['customer_email'] ?? '—'
        ); ?>
    </p>

    <hr>

    <h2>Shipping Address</h2>

    <p>
        <?= nl2br(
            htmlspecialchars(
                $order['shipping_address'] ?? '—'
            )
        ); ?>
    </p>

    <p>
        <strong>City:</strong>
        <?= htmlspecialchars(
            $order['shipping_city'] ?? '—'
        ); ?>
    </p>

    <p>
        <strong>State:</strong>
        <?= htmlspecialchars(
            $order['shipping_state'] ?? '—'
        ); ?>
    </p>

    <p>
        <strong>Pincode:</strong>
        <?= htmlspecialchars(
            $order['shipping_pincode'] ?? '—'
        ); ?>
    </p>

    <hr>

    <h2>Order Items</h2>

    <?php if (empty($items)): ?>

        <p>No items found.</p>

    <?php else: ?>

        <table border="1" cellpadding="10">

            <thead>

                <tr>

                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($items as $item): ?>

                    <tr>

                        <td>
                            <?= htmlspecialchars(
                                $item['product_name']
                            ); ?>
                        </td>

                        <td>
                            ₹<?= number_format(
                                (float) $item['product_price']
                            ); ?>
                        </td>

                        <td>
                            <?= (int) $item['quantity']; ?>
                        </td>

                        <td>
                            ₹<?= number_format(
                                (float) $item['subtotal']
                            ); ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

    <hr>

    <h2>Payment & Total</h2>

    <p>
        <strong>Subtotal:</strong>
        ₹<?= number_format(
            (float) $order['subtotal']
        ); ?>
    </p>

    <p>
        <strong>Shipping:</strong>
        ₹<?= number_format(
            (float) $order['shipping_fee']
        ); ?>
    </p>

    <p>
        <strong>Discount:</strong>
        ₹<?= number_format(
            (float) $order['discount']
        ); ?>
    </p>

    <p>
        <strong>Total:</strong>
        ₹<?= number_format(
            (float) $order['total']
        ); ?>
    </p>

    <p>
        <strong>Payment Method:</strong>

        <?= htmlspecialchars(
            $order['payment_method'] ?? '—'
        ); ?>
    </p>

    <p>
        <strong>Payment Status:</strong>

        <?= htmlspecialchars(
            $order['payment_status']
        ); ?>
    </p>

    <hr>

    <h2>Update Order</h2>

    <form
        action="action.php"
        method="POST"
    >

        <input
            type="hidden"
            name="action"
            value="update_status"
        >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $order['id']; ?>"
        >

        <label>
            Order Status
        </label>

        <br>

        <select name="status">

            <?php

            $statuses = [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ];

            ?>

            <?php foreach ($statuses as $status): ?>

                <option
                    value="<?= $status; ?>"
                    <?= $order['status'] === $status
                        ? 'selected'
                        : ''; ?>
                >
                    <?= ucfirst($status); ?>
                </option>

            <?php endforeach; ?>

        </select>

        <button type="submit">
            Update Order Status
        </button>

    </form>

    <br>

    <form
        action="action.php"
        method="POST"
    >

        <input
            type="hidden"
            name="action"
            value="update_payment"
        >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $order['id']; ?>"
        >

        <label>
            Payment Status
        </label>

        <br>

        <select name="payment_status">

            <?php

            $paymentStatuses = [
                'pending',
                'paid',
                'failed',
                'refunded'
            ];

            ?>

            <?php foreach ($paymentStatuses as $status): ?>

                <option
                    value="<?= $status; ?>"
                    <?= $order['payment_status'] === $status
                        ? 'selected'
                        : ''; ?>
                >
                    <?= ucfirst($status); ?>
                </option>

            <?php endforeach; ?>

        </select>

        <button type="submit">
            Update Payment Status
        </button>

    </form>

</body>

</html>