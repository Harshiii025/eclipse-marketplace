<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: shop.php');
    exit;
}


/*
|--------------------------------------------------------------------------
| Get Product ID
|--------------------------------------------------------------------------
*/

$productId = isset($_POST['product_id'])
    ? (int) $_POST['product_id']
    : 0;


/*
|--------------------------------------------------------------------------
| Product List
|--------------------------------------------------------------------------
*/

$products = [

    1 => [
        'name' => 'Essential Oversized Tee',
        'category' => 'MEN / T-SHIRTS',
        'price' => 1499
    ],

    2 => [
        'name' => 'Classic Relaxed Shirt',
        'category' => 'MEN / SHIRTS',
        'price' => 1999
    ],

    3 => [
        'name' => 'Minimal Zip Hoodie',
        'category' => 'MEN / HOODIES',
        'price' => 2499
    ],

    4 => [
        'name' => 'Wide Leg Trousers',
        'category' => 'MEN / PANTS',
        'price' => 2199
    ],

    5 => [
        'name' => 'Oversized Oxford',
        'category' => 'MEN / SHIRTS',
        'price' => 1899
    ],

    6 => [
        'name' => 'Everyday Cargo',
        'category' => 'MEN / PANTS',
        'price' => 2299
    ]

];


/*
|--------------------------------------------------------------------------
| Check Product
|--------------------------------------------------------------------------
*/

if (!isset($products[$productId])) {
    header('Location: shop.php');
    exit;
}


$product = $products[$productId];


/*
|--------------------------------------------------------------------------
| Quantity
|--------------------------------------------------------------------------
*/

$quantity = isset($_POST['quantity'])
    ? (int) $_POST['quantity']
    : 1;

if ($quantity < 1) {
    $quantity = 1;
}


/*
|--------------------------------------------------------------------------
| Size
|--------------------------------------------------------------------------
*/

$size = isset($_POST['size'])
    ? trim($_POST['size'])
    : 'M';

if ($size === '') {
    $size = 'M';
}


/*
|--------------------------------------------------------------------------
| Create Cart
|--------------------------------------------------------------------------
*/

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


/*
|--------------------------------------------------------------------------
| Check if product already exists
|--------------------------------------------------------------------------
*/

$found = false;

foreach ($_SESSION['cart'] as $index => $item) {

    $existingId = isset($item['id'])
        ? (int) $item['id']
        : 0;

    $existingSize = isset($item['size'])
        ? $item['size']
        : 'M';


    if (
        $existingId === $productId &&
        $existingSize === $size
    ) {

        if (!isset($_SESSION['cart'][$index]['quantity'])) {
            $_SESSION['cart'][$index]['quantity'] = 1;
        }

        $_SESSION['cart'][$index]['quantity'] += $quantity;

        $found = true;

        break;
    }
}


/*
|--------------------------------------------------------------------------
| Add New Product
|--------------------------------------------------------------------------
*/

if (!$found) {

    $_SESSION['cart'][] = [

        'id' => $productId,

        'name' => $product['name'],

        'category' => $product['category'],

        'price' => $product['price'],

        'quantity' => $quantity,

        'size' => $size

    ];
}


/*
|--------------------------------------------------------------------------
| Redirect to Cart
|--------------------------------------------------------------------------
*/

header('Location: cart.php');
exit;