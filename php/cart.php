<?php
session_start();
require '../php/db.php';

// Function to get the cart total amount
function getCartTotalAmount() {
    // Calculate the total amount for items in the cart (You may adjust this based on your logic)
    $cartItems = $_SESSION['cart_items'];
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $totalAmount += $item['price'] * $item['quantity']*$item['quantity'];
    }
    return $totalAmount;
}



// Add to cart functionality
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productData = json_decode(file_get_contents('php://input'), true);
        $product_id = $productData['productId'];
        $product_name = $productData['productName'];
        $product_price = $productData['totalCost'];
        $quantity = $productData['quantity'];
        $sub = $productData['subscribed'];

        // Create a cart item array
        $cart_item = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity,
            'sub' => $sub
        );

        // Initialize the cart items array if it doesn't exist
        if (isset($_SESSION['unique_id'])) {
            if (!isset($_SESSION['cart_items'])) {
                $_SESSION['cart_items'] = array();
            }

            // Add the cart item to the session cart items array
            $_SESSION['cart_items'][] = $cart_item;
        }
        else{
          
            $cart_items_1 = isset($_COOKIE['cart_items_1_cookie']) ? unserialize($_COOKIE['cart_items_1_cookie']) : array();

            // Add the cart item to the cart_items_1 array
            $cart_items_1[] = $cart_item;
    
            // Set the updated cart_items_1 array as a cookie
            setcookie('cart_items_1_cookie', serialize($cart_items_1), time() + 36000, '/');
           
        }
        
        // Send success response
        $response = array(
            'success' => true,
            'message' => 'Product added to cart successfully.'
        );
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

?>