<?php
session_start();
if (isset($_SESSION['cart_items'])) {
    // Clear the cart_items session variable
    unset($_SESSION['cart_items']);
}

if (isset($_COOKIE['cart_items_1_cookie'])) {
    // Clear the cart_items_1_cookie
    setcookie('cart_items_1_cookie', '', time() - 3600, '/');
}

// Redirect back to the current page (the cart page)
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>
