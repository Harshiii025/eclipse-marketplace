<?php

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Helpers/Auth.php';

Auth::startSession();

$authError = $_SESSION['auth_error'] ?? null;

unset($_SESSION['auth_error']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $controller->register();
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

    <title>Create Account | Eclipse</title>

    <link
        rel="stylesheet"
        href="/assets/css/variables.css"
    >

    <link
        rel="stylesheet"
        href="/assets/css/reset.css"
    >

    <link
        rel="stylesheet"
        href="/assets/css/components.css"
    >

    <link
        rel="stylesheet"
        href="/assets/css/style.css"
    >

</head>

<body>

    <?php require_once __DIR__ . '/partials/navbar.php'; ?>


    <main class="auth-page">

        <section class="auth-container">


            <!-- Authentication Header -->
            <div class="auth-header">

                <h1>
                    Create your Eclipse account
                </h1>

                <p>
                    Join Eclipse and start exploring the collection.
                </p>

            </div>


            <!-- Authentication Error -->
            <?php if ($authError): ?>

                <div class="auth-message error">

                    <?= htmlspecialchars($authError); ?>

                </div>

            <?php endif; ?>


            <!-- Registration Form -->
            <form
                class="auth-form"
                method="POST"
                action=""
            >


                <!-- Full Name -->
                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter your name"
                        required
                    >

                </div>


                <!-- Email -->
                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <!-- Password -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create a password"
                        minlength="8"
                        required
                    >

                </div>


                <!-- Submit -->
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Create Account
                </button>


            </form>


            <!-- Login Link -->
            <p class="auth-footer">

                Already have an account?

                <a href="/login.php">
                    Sign in
                </a>

            </p>


        </section>

    </main>


    <?php require_once __DIR__ . '/partials/footer.php'; ?>

</body>

</html>