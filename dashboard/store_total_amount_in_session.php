<?php
// Start the session if it's not already started
session_start();
$totalAmount =0;
$cartItemsCount =0;
// Retrieve the totalAmount from AJAX request
$totalAmount = $_POST['totalAmount'];
$cartItemsCount = $_POST['cartItemsCount'];

// Store the totalAmount in a session variable
$_SESSION['totalAmount'] = $totalAmount;
$_SESSION['cartItemsCount'] = $cartItemsCount;

// Respond with a success message (optional)
echo "Total amount stored in session successfully.";

?>
<a href="coinbase.php">buy</a>