<?php
session_start();

$products = [
    1 => [
        'name' => 'Essential Oversized Tee',
        'category' => 'MEN / T-SHIRTS',
        'price' => 1499,
        'description' => 'A clean oversized essential designed for everyday comfort and effortless style.',
        'material' => 'Heavyweight Cotton',
        'fit' => 'Oversized',
        'collection' => 'Core Essentials'
    ],

    2 => [
        'name' => 'Classic Relaxed Shirt',
        'category' => 'MEN / SHIRTS',
        'price' => 1999,
        'description' => 'A relaxed premium cotton shirt built for a clean everyday wardrobe.',
        'material' => 'Premium Cotton',
        'fit' => 'Relaxed',
        'collection' => 'Core Essentials'
    ],

    3 => [
        'name' => 'Minimal Zip Hoodie',
        'category' => 'MEN / HOODIES',
        'price' => 2499,
        'description' => 'A minimal French Terry hoodie with a comfortable relaxed silhouette.',
        'material' => 'French Terry',
        'fit' => 'Relaxed',
        'collection' => 'Eclipse Essentials'
    ],

    4 => [
        'name' => 'Wide Leg Trousers',
        'category' => 'MEN / PANTS',
        'price' => 2199,
        'description' => 'Structured wide-leg trousers designed for a modern relaxed silhouette.',
        'material' => 'Structured Cotton',
        'fit' => 'Wide Leg',
        'collection' => 'Eclipse Essentials'
    ],

    5 => [
        'name' => 'Oversized Oxford',
        'category' => 'MEN / SHIRTS',
        'price' => 1899,
        'description' => 'A modern oversized Oxford shirt made for effortless everyday layering.',
        'material' => 'Organic Cotton',
        'fit' => 'Oversized',
        'collection' => 'New Arrivals'
    ],

    6 => [
        'name' => 'Everyday Cargo',
        'category' => 'MEN / PANTS',
        'price' => 2299,
        'description' => 'A practical utility-inspired cargo with a clean contemporary finish.',
        'material' => 'Utility Cotton',
        'fit' => 'Relaxed',
        'collection' => 'Eclipse Essentials'
    ]
];


$productId = isset($_GET['id'])
    ? (int) $_GET['id']
    : 1;


if (!isset($products[$productId])) {
    $productId = 1;
}


$product = $products[$productId];

$pageTitle = $product['name'] . " | Eclipse";

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

            <span>
                IMAGE
            </span>

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

                ₹<?= number_format($product['price']); ?>

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
    data-product-id="<?= $productId; ?>"
    data-product-name="<?= htmlspecialchars($product['name']); ?>"
    data-product-category="<?= htmlspecialchars($product['category']); ?>"
    data-product-price="<?= $product['price']; ?>"
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
                        <?= htmlspecialchars($product['material']); ?>
                    </span>

                </div>


                <div class="meta-row">

                    <span>
                        Fit
                    </span>

                    <span>
                        <?= htmlspecialchars($product['fit']); ?>
                    </span>

                </div>


                <div class="meta-row">

                    <span>
                        Collection
                    </span>

                    <span>
                        <?= htmlspecialchars($product['collection']); ?>
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