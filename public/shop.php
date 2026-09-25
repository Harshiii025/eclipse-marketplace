<?php

session_start();

require_once __DIR__ . '/../app/Controllers/ProductController.php';

$controller = new ProductController();

$products = $controller->index();

$pageTitle = "Shop | Eclipse";

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


<main class="shop-page">


    <!-- =========================================
         SHOP HERO
    ========================================== -->

    <section class="shop-hero">

        <div class="shop-hero-content">

            <p class="eyebrow">
                ECLIPSE COLLECTION
            </p>

            <h1>
                Find Your<br>
                Next Essential.
            </h1>

            <p>
                Explore carefully selected pieces designed
                for everyday confidence.
            </p>

        </div>

    </section>



    <!-- =========================================
         SHOP CONTENT
    ========================================== -->

    <section class="shop-content">


        <!-- =====================================
             SIDEBAR / FILTERS
        ====================================== -->

        <aside class="shop-sidebar">

            <div class="shop-filter">

                <h3>
                    Category
                </h3>

                <a
    href="#"
    class="shop-category active"
    data-category="all"
>
    All
</a>

<a
    href="#"
    class="shop-category"
    data-category="t-shirts"
>
    T-Shirts
</a>

<a
    href="#"
    class="shop-category"
    data-category="bottomwear"
>
    Bottomwear
</a>

<a
    href="#"
    class="shop-category"
    data-category="hoodies"
>
    Hoodies
</a>

<a
    href="#"
    class="shop-category"
    data-category="sweatshirts"
>
    Sweatshirts
</a>

            </div>

        </aside>



        <!-- =====================================
             PRODUCTS SECTION
        ====================================== -->

        <div class="shop-products">


            <!-- PRODUCTS HEADER -->

            <div class="shop-products-header">

                <p id="product-count">
                    <?= count($products); ?> Products
                </p>


                <select id="sort-products">

                    <option value="featured">
                        Featured
                    </option>

                    <option value="newest">
                        Newest
                    </option>

                    <option value="price-low">
                        Price: Low to High
                    </option>

                    <option value="price-high">
                        Price: High to Low
                    </option>

                </select>

            </div>



            <!-- =================================
                 PRODUCT GRID
            ================================== -->

            <div
                class="product-grid"
                id="product-grid"
            >


                <?php foreach ($products as $product): ?>


                    <article
                        class="product-card"
                        data-category="<?= htmlspecialchars(
                            strtolower($product['category'] ?? '')
                        ); ?>"
                    >


                        <!-- PRODUCT IMAGE -->

                        <a
                            href="product.php?id=<?= (int) $product['id']; ?>"
                            class="product-image-link"
                        >

                            <div class="product-image">


                                <?php if (!empty($product['image'])): ?>

                                    <img
                                        src="<?= htmlspecialchars($product['image']); ?>"
                                        alt="<?= htmlspecialchars($product['name']); ?>"
                                    >

                                <?php else: ?>

                                    <div class="product-image-placeholder">
                                        IMAGE
                                    </div>

                                <?php endif; ?>


                            </div>

                        </a>



                        <!-- PRODUCT INFORMATION -->

                        <div class="product-info">


                            <h3>

                                <a
                                    href="product.php?id=<?= (int) $product['id']; ?>"
                                >
                                    <?= htmlspecialchars($product['name']); ?>
                                </a>

                            </h3>


                            <p>
                                <?= htmlspecialchars(
                                    $product['category'] ?? ''
                                ); ?>
                            </p>


                            <span class="product-price">

                                ₹<?= number_format(
                                    (float) $product['price']
                                ); ?>

                            </span>



                            <!-- ADD TO CART -->

                            <form
                                action="add-to-cart.php"
                                method="POST"
                            >

                                <input
                                    type="hidden"
                                    name="product_id"
                                    value="<?= (int) $product['id']; ?>"
                                >


                                <button
                                    type="submit"
                                    class="add-to-cart-btn"
                                >
                                    Add to Cart
                                </button>

                            </form>


                        </div>


                    </article>


                <?php endforeach; ?>


            </div>

        </div>

    </section>

</main>



<?php include __DIR__ . '/partials/footer.php'; ?>


<script src="assets/js/shop.js"></script>

</body>

</html>