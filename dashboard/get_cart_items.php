<?php

session_start();

// Function to get the cart items from the session
function getCartItems() {
    if (isset($_SESSION['cart_items'])) {
        return $_SESSION['cart_items'];
    } else if (isset($_COOKIE['cart_items_1_cookie'])) {

        $cart_items_serialized = $_COOKIE['cart_items_1_cookie'];
        $cartitems = unserialize($cart_items_serialized);
        return $cartitems;
      }
      else {
        return array(); // Return an empty array if cart_items is not set in the session
    }
}

// Get the cart items and return them as a JSON response
$cartItems = getCartItems();
header('Content-Type: application/json');
echo json_encode($cartItems);
exit;
?>
