<?php

session_start();

require_once __DIR__ . '/../app/Controllers/ProductController.php';

$controller = new ProductController();

$productId = isset($_GET['id'])
    ? (int) $_GET['id']
    : 1;

$product = $controller->show($productId);

if (!$product) {
    http_response_code(404);
    exit('Product not found.');
}

$pageTitle = $product['name'] . ' | Eclipse';

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


<main class="product-page">

    <section class="product-details">


        <!-- =====================================================
             PRODUCT IMAGE
             ===================================================== -->

        <div class="product-main-image">

    <img
        src="<?= htmlspecialchars($product['image']); ?>"
        alt="<?= htmlspecialchars($product['name']); ?>"
    >

</div>


        <!-- =====================================================
             PRODUCT INFORMATION
             ===================================================== -->

        <div class="product-information">


            <p class="product-category">

                <?= htmlspecialchars($product['category']); ?>

            </p>


            <h1>

                <?= htmlspecialchars($product['name']); ?>

            </h1>


            <p class="product-detail-price">

                ₹<?= number_format((float) $product['price']); ?>

            </p>


            <p class="product-description">

                <?= htmlspecialchars($product['description']); ?>

            </p>


            <!-- =================================================
                 SIZE
                 ================================================= -->

            <div class="product-option">

                <div class="option-header">

                    <span>
                        Size
                    </span>

                    <a href="#">
                        Size Guide
                    </a>

                </div>


                <div class="size-options">

                    <button type="button">
                        S
                    </button>

                    <button type="button">
                        M
                    </button>

                    <button type="button">
                        L
                    </button>

                    <button type="button">
                        XL
                    </button>

                </div>

            </div>


            <!-- =================================================
                 QUANTITY
                 ================================================= -->

            <div class="product-option">

                <div class="option-header">

                    <span>
                        Quantity
                    </span>

                </div>


                <div class="quantity-selector">

                    <button
                        type="button"
                        id="quantity-minus"
                    >
                        −
                    </button>


                    <span id="quantity">
                        1
                    </span>


                    <button
                        type="button"
                        id="quantity-plus"
                    >
                        +
                    </button>

                </div>

            </div>


            <!-- =================================================
                 ADD TO CART
                 ================================================= -->

            <button
                type="button"
                class="product-add-to-cart"
                id="product-add-to-cart"
                data-product-id="<?= (int) $product['id']; ?>"
                data-product-name="<?= htmlspecialchars($product['name']); ?>"
                data-product-category="<?= htmlspecialchars($product['category']); ?>"
                data-product-price="<?= (float) $product['price']; ?>"
            >
                Add to Cart
            </button>


            <!-- =================================================
                 PRODUCT METADATA
                 ================================================= -->

            <div class="product-meta">


                <div class="meta-row">

                    <span>
                        Material
                    </span>

                    <span>
                        —
                    </span>

                </div>


                <div class="meta-row">

                    <span>
                        Fit
                    </span>

                    <span>
                        —
                    </span>

                </div>


                <div class="meta-row">

                    <span>
                        Collection
                    </span>

                    <span>
                        —
                    </span>

                </div>


            </div>

        </div>

    </section>

</main>


<?php include __DIR__ . '/partials/footer.php'; ?>


<script src="assets/js/product.js"></script>

</body>

</html>