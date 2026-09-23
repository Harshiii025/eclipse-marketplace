<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Eclipse | Premium Fashion Marketplace</title>

    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

   <?php include __DIR__ . '/partials/navbar.php'; ?>

<main>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">

            <p class="hero-eyebrow">ECLIPSE / NEW SEASON</p>

            <h1 class="hero-title">
                CLOTHING<br>
                BEYOND<br>
                ORDINARY.
            </h1>

            <p class="hero-description">
                Discover contemporary fashion from independent brands
                and stores, brought together in one marketplace.
            </p>

            <div class="hero-actions">
                <a href="shop.php" class="btn btn-primary">
                    Shop Collection
                </a>

                <a href="collections.php" class="btn btn-secondary">
                    Explore Collections
                </a>
            </div>

        </div>
    </section>

    <!-- New Arrivals -->
<section class="section new-arrivals">
    <div class="container">

        <div class="section-heading">
            <p class="hero-eyebrow">ECLIPSE / NEW ARRIVALS</p>

            <h2 class="section-title">
                Fresh pieces.
            </h2>

            <p class="section-subtitle">
                Latest styles selected for the Eclipse collection.
            </p>
        </div>

        <div class="product-grid">

            <article class="product-card">
                <div class="product-card-media">
                    <span>ECLIPSE / 01</span>
                </div>

                <div class="product-card-content">
                    <h3 class="product-card-name">Oversized Essential Tee</h3>
                    <p class="product-card-price">₹1,499</p>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card-media">
                    <span>ECLIPSE / 02</span>
                </div>

                <div class="product-card-content">
                    <h3 class="product-card-name">Heavyweight Hoodie</h3>
                    <p class="product-card-price">₹2,999</p>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card-media">
                    <span>ECLIPSE / 03</span>
                </div>

                <div class="product-card-content">
                    <h3 class="product-card-name">Relaxed Cargo Pants</h3>
                    <p class="product-card-price">₹2,499</p>
                </div>
            </article>

            <article class="product-card">
                <div class="product-card-media">
                    <span>ECLIPSE / 04</span>
                </div>

                <div class="product-card-content">
                    <h3 class="product-card-name">Minimal Overshirt</h3>
                    <p class="product-card-price">₹2,199</p>
                </div>
            </article>

        </div>

        <div class="section-action">
            <a href="shop.php" class="btn btn-secondary">
                View All Products
            </a>
        </div>

    </div>
</section>
<!-- Featured Collection -->
<section class="section featured-collection">
    <div class="container">

        <div class="featured-collection-card">

            <div class="featured-collection-content">
                <p class="hero-eyebrow">ECLIPSE / FEATURED</p>

                <h2>
                    THE
                    EVERYDAY
                    COLLECTION
                </h2>

                <p>
                    Refined essentials designed for everyday movement,
                    built around comfort, simplicity and individuality.
                </p>

                <a href="collections.php" class="btn btn-primary">
                    Explore Collection
                </a>
            </div>

            <div class="featured-collection-visual">
                <span>ECLIPSE / 2026</span>
            </div>

        </div>

    </div>
</section>

<!-- Categories -->
<section class="section categories-section">
    <div class="container">

        <div class="section-heading">
            <p class="hero-eyebrow">ECLIPSE / CATEGORIES</p>

            <h2 class="section-title">
                Find your essentials.
            </h2>
        </div>

        <div class="category-grid">

            <a href="shop.php?category=t-shirts" class="category-card">
                <span>T-SHIRTS</span>
                <small>Explore</small>
            </a>

            <a href="shop.php?category=hoodies" class="category-card">
                <span>HOODIES</span>
                <small>Explore</small>
            </a>

            <a href="shop.php?category=pants" class="category-card">
                <span>PANTS</span>
                <small>Explore</small>
            </a>

            <a href="shop.php?category=outerwear" class="category-card">
                <span>OUTERWEAR</span>
                <small>Explore</small>
            </a>

        </div>

    </div>
</section>
<!-- Brand Story -->
<section class="section brand-story">
    <div class="container">

        <div class="brand-story-grid">

            <div class="brand-story-label">
                <p class="hero-eyebrow">ECLIPSE / OUR WORLD</p>
            </div>

            <div class="brand-story-content">
                <h2>
                    Fashion should feel
                    <span>personal.</span>
                </h2>

                <p>
                    Eclipse brings independent fashion brands and local
                    clothing stores together in one modern marketplace.
                    Discover pieces with character, made for people who
                    choose their own style.
                </p>

                <a href="about.php" class="btn btn-secondary">
                    Discover Eclipse
                </a>
            </div>

        </div>

    </div>
</section>
<!-- Newsletter CTA -->
<section class="section newsletter-section">
    <div class="container newsletter-content">

        <p class="hero-eyebrow">ECLIPSE / STAY IN THE LOOP</p>

        <h2>
            Be the first to
            <span>discover what’s next.</span>
        </h2>

        <form class="newsletter-form" onsubmit="return false;">
            <input
                type="email"
                placeholder="Enter your email address"
                aria-label="Email address"
                required
            >

            <button type="submit" class="btn btn-primary">
                Subscribe
            </button>
        </form>

        <p class="newsletter-note">
            New releases, collections and Eclipse updates. No spam.
        </p>

    </div>
</section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>

</body>
</html>