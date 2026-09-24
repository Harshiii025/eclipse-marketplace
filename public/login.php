<?php

require_once __DIR__ . '/../app/Controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $controller->login();
}

$registered = isset($_GET['registered']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Eclipse</title>

    <link rel="stylesheet" href="/assets/css/variables.css">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

    <?php require_once __DIR__ . '/partials/navbar.php'; ?>

    <main class="auth-page">

        <section class="auth-container">

            <div class="auth-header">
                <h1>Welcome back</h1>

                <p>
                    Sign in to continue shopping with Eclipse.
                </p>
            </div>

            <?php if ($registered): ?>

                <div class="auth-message success">
                    Account created successfully. Please sign in.
                </div>

            <?php endif; ?>

            <form
                class="auth-form"
                method="POST"
                action=""
            >

                <div class="form-group">
                    <label for="email">Email Address</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Sign In
                </button>

            </form>

            <p class="auth-footer">
                Don't have an account?
                <a href="/register.php">Create an account</a>
            </p>

        </section>

    </main>

    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>
</html>