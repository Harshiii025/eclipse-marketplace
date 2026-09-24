<?php

require_once __DIR__ . '/../../app/Helpers/Auth.php';

$user = Auth::user();

$cartItemCount = 0;

if (isset($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $item) {

        $cartItemCount += isset($item['quantity'])
            ? (int) $item['quantity']
            : 1;
    }
}

?>

<nav class="navbar">
    <div class="container navbar-inner">

        <!-- Logo -->
        <a href="index.php" class="navbar-logo">
            ECLIPSE
        </a>


        <!-- Main Navigation -->
        <div class="navbar-links">

            <a href="index.php">
                Home
            </a>

            <a href="shop.php">
                Shop
            </a>

            <a href="collections.php">
                Collections
            </a>

            <a href="about.php">
                About
            </a>

        </div>


        <!-- Actions -->
        <div class="navbar-actions">

            <?php if ($user): ?>

                <!-- Logged-in user -->
                <a href="account.php">
                    Account
                </a>

                <a href="logout.php">
                    Logout
                </a>

            <?php else: ?>

                <!-- Guest user -->
                <a href="login.php">
                    Login
                </a>

                <a href="register.php">
                    Register
                </a>

            <?php endif; ?>


            <a href="cart.php">
                Cart <span class="cart-count"><?= $cartItemCount; ?></span>
            </a>

        </div>

    </div>
</nav>