<?php

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = &$_SESSION['cart'];

$action = $_POST['action'] ?? '';
$index = isset($_POST['index'])
    ? (int) $_POST['index']
    : -1;


/*
|--------------------------------------------------------------------------
| Validate Cart Item
|--------------------------------------------------------------------------
*/

if (!isset($cart[$index])) {
    header("Location: cart.php");
    exit;
}


/*
|--------------------------------------------------------------------------
| Make Sure Quantity Exists
|--------------------------------------------------------------------------
*/

if (!isset($cart[$index]['quantity'])) {
    $cart[$index]['quantity'] = 1;
}


/*
|--------------------------------------------------------------------------
| Cart Actions
|--------------------------------------------------------------------------
*/

switch ($action) {


    /*
    |--------------------------------------------------------------------------
    | Increase Quantity
    |--------------------------------------------------------------------------
    */

    case 'increase':

        $cart[$index]['quantity']++;

        break;


    /*
    |--------------------------------------------------------------------------
    | Decrease Quantity
    |--------------------------------------------------------------------------
    */

    case 'decrease':

        $cart[$index]['quantity']--;

        /*
        | If quantity reaches 0,
        | remove the product completely.
        */

        if ($cart[$index]['quantity'] <= 0) {
            unset($cart[$index]);

            $cart = array_values($cart);
        }

        break;


    /*
    |--------------------------------------------------------------------------
    | Remove Product
    |--------------------------------------------------------------------------
    */

    case 'remove':

        unset($cart[$index]);

        /*
        | Re-index array after removing item.
        */

        $cart = array_values($cart);

        break;
}


/*
|--------------------------------------------------------------------------
| Return To Cart
|--------------------------------------------------------------------------
*/

header("Location: cart.php");
exit;