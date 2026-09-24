<?php
session_start();
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

    <title><?= $pageTitle; ?></title>

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
                    class="active"
                >
                    All
                </a>

                <a href="#">
                    Men
                </a>

                <a href="#">
                    Women
                </a>

                <a href="#">
                    T-Shirts
                </a>

                <a href="#">
                    Shirts
                </a>

                <a href="#">
                    Hoodies
                </a>

                <a href="#">
                    Pants
                </a>

                <a href="#">
                    Jackets
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
                    6 Products
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



                <!-- =================================
                     PRODUCT 1
                ================================== -->

                <article
                    class="product-card"
                    data-category="t-shirts"
                >

                    <a
                        href="product.php?id=1"
                        class="product-image-link"
                    >

                        <div class="product-image">

                            <div class="product-image-placeholder">
                                IMAGE
                            </div>

                            <span class="product-badge">
                                NEW
                            </span>

                        </div>

                    </a>


                    <div class="product-info">

                        <h3>

                            <a href="product.php?id=1">
                                Essential Oversized Tee
                            </a>

                        </h3>

                        <p>
                            Heavyweight Cotton
                        </p>

                        <span class="product-price">
                            ₹1,499
                        </span>


                        <!-- ADD TO CART -->

                        <form
                            action="add-to-cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="product_id"
                                value="1"
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



                <!-- =================================
                     PRODUCT 2
                ================================== -->

                <article
                    class="product-card"
                    data-category="shirts"
                >

                    <a
                        href="product.php?id=2"
                        class="product-image-link"
                    >

                        <div class="product-image">

                            <div class="product-image-placeholder">
                                IMAGE
                            </div>

                            <span class="product-badge">
                                BESTSELLER
                            </span>

                        </div>

                    </a>


                    <div class="product-info">

                        <h3>

                            <a href="product.php?id=2">
                                Classic Relaxed Shirt
                            </a>

                        </h3>

                        <p>
                            Premium Cotton
                        </p>

                        <span class="product-price">
                            ₹1,999
                        </span>


                        <!-- ADD TO CART -->

                        <form
                            action="add-to-cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="product_id"
                                value="2"
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



                <!-- =================================
                     PRODUCT 3
                ================================== -->

                <article
                    class="product-card"
                    data-category="hoodies"
                >

                    <a
                        href="product.php?id=3"
                        class="product-image-link"
                    >

                        <div class="product-image">

                            <div class="product-image-placeholder">
                                IMAGE
                            </div>

                        </div>

                    </a>


                    <div class="product-info">

                        <h3>

                            <a href="product.php?id=3">
                                Minimal Zip Hoodie
                            </a>

                        </h3>

                        <p>
                            French Terry
                        </p>

                        <span class="product-price">
                            ₹2,499
                        </span>


                        <!-- ADD TO CART -->

                        <form
                            action="add-to-cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="product_id"
                                value="3"
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



                <!-- =================================
                     PRODUCT 4
                ================================== -->

                <article
                    class="product-card"
                    data-category="pants"
                >

                    <a
                        href="product.php?id=4"
                        class="product-image-link"
                    >

                        <div class="product-image">

                            <div class="product-image-placeholder">
                                IMAGE
                            </div>

                        </div>

                    </a>


                    <div class="product-info">

                        <h3>

                            <a href="product.php?id=4">
                                Wide Leg Trousers
                            </a>

                        </h3>

                        <p>
                            Structured Cotton
                        </p>

                        <span class="product-price">
                            ₹2,199
                        </span>


                        <!-- ADD TO CART -->

                        <form
                            action="add-to-cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="product_id"
                                value="4"
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



                <!-- =================================
                     PRODUCT 5
                ================================== -->

                <article
                    class="product-card"
                    data-category="shirts"
                >

                    <a
                        href="product.php?id=5"
                        class="product-image-link"
                    >

                        <div class="product-image">

                            <div class="product-image-placeholder">
                                IMAGE
                            </div>

                            <span class="product-badge">
                                NEW
                            </span>

                        </div>

                    </a>


                    <div class="product-info">

                        <h3>

                            <a href="product.php?id=5">
                                Oversized Oxford
                            </a>

                        </h3>

                        <p>
                            Organic Cotton
                        </p>

                        <span class="product-price">
                            ₹1,899
                        </span>


                        <!-- ADD TO CART -->

                        <form
                            action="add-to-cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="product_id"
                                value="5"
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



                <!-- =================================
                     PRODUCT 6
                ================================== -->

                <article
                    class="product-card"
                    data-category="pants"
                >

                    <a
                        href="product.php?id=6"
                        class="product-image-link"
                    >

                        <div class="product-image">

                            <div class="product-image-placeholder">
                                IMAGE
                            </div>

                        </div>

                    </a>


                    <div class="product-info">

                        <h3>

                            <a href="product.php?id=6">
                                Everyday Cargo
                            </a>

                        </h3>

                        <p>
                            Utility Cotton
                        </p>

                        <span class="product-price">
                            ₹2,299
                        </span>


                        <!-- ADD TO CART -->

                        <form
                            action="add-to-cart.php"
                            method="POST"
                        >

                            <input
                                type="hidden"
                                name="product_id"
                                value="6"
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


            </div>

        </div>

    </section>

</main>


<?php include __DIR__ . '/partials/footer.php'; ?>


<script src="assets/js/shop.js"></script>

</body>

</html>