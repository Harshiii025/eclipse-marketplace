<?php

session_start();

$cart = $_SESSION['cart'] ?? [];

$pageTitle = "Cart | Eclipse";

/*
|--------------------------------------------------------------------------
| Cart Calculations
|--------------------------------------------------------------------------
*/

$subtotal = 0;
$totalItems = 0;

foreach ($cart as $item) {

    $quantity = isset($item['quantity'])
        ? max(1, (int) $item['quantity'])
        : 1;

    $price = isset($item['price'])
        ? (float) $item['price']
        : 0;

    $subtotal += $price * $quantity;
    $totalItems += $quantity;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title><?= htmlspecialchars($pageTitle); ?></title>

    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php include __DIR__ . '/partials/navbar.php'; ?>


<main class="cart-page">

    <section class="cart-container">

        <div class="cart-header">

            <p class="eyebrow">
                YOUR SELECTION
            </p>

            <h1>
                Shopping Cart
            </h1>

            <?php if (!empty($cart)): ?>

                <p class="cart-item-count">
                    <?= $totalItems; ?>
                    <?= $totalItems === 1 ? 'item' : 'items'; ?>
                </p>

            <?php endif; ?>

        </div>


        <?php if (empty($cart)): ?>

            <div class="cart-empty">

                <h2>
                    Your cart is empty.
                </h2>

                <p>
                    Discover something you will want to wear.
                </p>

                <a
                    href="shop.php"
                    class="cart-continue-btn"
                >
                    Continue Shopping
                </a>

            </div>


        <?php else: ?>

            <div class="cart-content">


                <!-- =====================================================
                     CART ITEMS
                     ===================================================== -->

                <div class="cart-items">

                    <?php foreach ($cart as $index => $item): ?>

                        <?php

                        $quantity = isset($item['quantity'])
                            ? max(1, (int) $item['quantity'])
                            : 1;

                        $price = isset($item['price'])
                            ? (float) $item['price']
                            : 0;

                        $itemSubtotal = $price * $quantity;

                        ?>

                        <article class="cart-item">


                            <!-- PRODUCT IMAGE -->

                            <div class="cart-item-image">

                                IMAGE

                            </div>


                            <!-- PRODUCT INFORMATION -->

                            <div class="cart-item-info">

                                <p class="cart-item-category">
                                    <?= htmlspecialchars($item['category'] ?? 'ECLIPSE'); ?>
                                </p>

                                <h3>
                                    <?= htmlspecialchars($item['name'] ?? 'Product'); ?>
                                </h3>

                                <span class="cart-item-price">
                                    ₹<?= number_format($price); ?>
                                </span>


                                <!-- QUANTITY + / - -->

                                <div class="cart-item-bottom">

                                    <div class="cart-quantity">

                                        <form
                                            action="cart-action.php"
                                            method="POST"
                                        >

                                            <input
                                                type="hidden"
                                                name="action"
                                                value="decrease"
                                            >

                                            <input
                                                type="hidden"
                                                name="index"
                                                value="<?= $index; ?>"
                                            >

                                            <button
                                                type="submit"
                                                class="quantity-btn"
                                                aria-label="Decrease quantity"
                                            >
                                                −
                                            </button>

                                        </form>


                                        <span class="quantity-value">
                                            <?= $quantity; ?>
                                        </span>


                                        <form
                                            action="cart-action.php"
                                            method="POST"
                                        >

                                            <input
                                                type="hidden"
                                                name="action"
                                                value="increase"
                                            >

                                            <input
                                                type="hidden"
                                                name="index"
                                                value="<?= $index; ?>"
                                            >

                                            <button
                                                type="submit"
                                                class="quantity-btn"
                                                aria-label="Increase quantity"
                                            >
                                                +
                                            </button>

                                        </form>

                                    </div>


                                    <!-- REMOVE -->

                                    <form
                                        action="cart-action.php"
                                        method="POST"
                                    >

                                        <input
                                            type="hidden"
                                            name="action"
                                            value="remove"
                                        >

                                        <input
                                            type="hidden"
                                            name="index"
                                            value="<?= $index; ?>"
                                        >

                                        <button
                                            type="submit"
                                            class="cart-remove-btn"
                                        >
                                            Remove
                                        </button>

                                    </form>

                                </div>

                            </div>


                            <!-- ITEM SUBTOTAL -->

                            <div class="cart-item-total">

                                ₹<?= number_format($itemSubtotal); ?>

                            </div>

                        </article>

                    <?php endforeach; ?>

                </div>


                <!-- =====================================================
                     ORDER SUMMARY
                     ===================================================== -->

                <aside class="cart-summary">

                    <p class="eyebrow">
                        SUMMARY
                    </p>

                    <h2>
                        Order Summary
                    </h2>


                    <div class="cart-summary-row">

                        <span>
                            Items
                        </span>

                        <span>
                            <?= $totalItems; ?>
                        </span>

                    </div>


                    <div class="cart-summary-row">

                        <span>
                            Subtotal
                        </span>

                        <strong>
                            ₹<?= number_format($subtotal); ?>
                        </strong>

                    </div>


                    <div class="cart-summary-row">

                        <span>
                            Shipping
                        </span>

                        <span>
                            Calculated at checkout
                        </span>

                    </div>


                    <div class="cart-summary-divider"></div>


                    <div class="cart-summary-total">

                        <span>
                            Total
                        </span>

                        <strong>
                            ₹<?= number_format($subtotal); ?>
                        </strong>

                    </div>


                    <button
                        type="button"
                        class="cart-checkout-btn"
                    >
                        Checkout
                    </button>


                    <a
                        href="shop.php"
                        class="cart-continue-link"
                    >
                        Continue Shopping
                    </a>

                </aside>

            </div>

        <?php endif; ?>

    </section>

</main>


<?php include __DIR__ . '/partials/footer.php'; ?>

</body>

</html>