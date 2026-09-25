<?php

require_once __DIR__ . '/../../../app/Middleware/AdminMiddleware.php';

AdminMiddleware::handle();

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

    <title>Add Category | Eclipse Admin</title>

</head>

<body>

    <h1>Add Category</h1>

    <p>
        <a href="index.php">
            ← Back to Categories
        </a>
    </p>

    <hr>

    <form
        action="action.php"
        method="POST"
    >

        <input
            type="hidden"
            name="action"
            value="create"
        >

        <p>

            <label>
                Category Name
            </label>

            <br>

            <input
                type="text"
                name="name"
                required
            >

        </p>

        <p>

            <label>
                Slug
            </label>

            <br>

            <input
                type="text"
                name="slug"
                placeholder="example-category"
                required
            >

        </p>

        <p>

            <label>
                Description
            </label>

            <br>

            <textarea
                name="description"
                rows="5"
            ></textarea>

        </p>

        <button type="submit">
            Create Category
        </button>

    </form>

</body>

</html>