<?php

use Automattic\WooCommerce\Blocks\BlockTypes\ProductCategory;

session_start();
require '../php/db.php';
global $cartItems;
global $email;
// Function to get the cart total amount
if (isset($_SESSION['unique_id'])){

function getCartTotalAmount() {
    // Calculate the total amount for items in the cart (You may adjust this based on your logic)
    $cartItems = $_SESSION['cart_items'];
    $totalAmount = 0;
    foreach ($cartItems as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }
    return $totalAmount;
}

    // Check if unique_id exists in the session
    $unique_id = isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : '';
    
    // Check if email exists in the session
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    if(empty($unique_id))
    {
        // header ("Location: ../auth/login.php");
    } 

$qry = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
if (mysqli_num_rows($qry) > 0) {
    $row = mysqli_fetch_assoc($qry);
    if ($row) {
        $_SESSION['Role'] = $row['Role'];
        if ($row['verification_status'] != 'Verified') {
            header("Location: ../verify.php");
            exit; // Exit to stop further execution
        }
    }
}
}
else{

  $unique_id = 0;
  $email = null;
  if (isset($_COOKIE['cart_items_1_cookie'])) {
    $cart_items_serialized = $_COOKIE['cart_items_1_cookie'];
    $cartItems = unserialize($cart_items_serialized);
 
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart  | UHQLogs</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../static/img/png.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../static/img/png.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../static/img/png.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        button.logout_btn {
            padding: 9px 25px;
            background-color: #006692;
            border-radius: 8px;
            border: 1px solid #00b3ff;
            cursor: pointer;
            transition: all 0.3s ease 0s;
            color: #f2f3f7;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
        }
    </style>
    <link rel="stylesheet" href="../static/css/main.css">

</head>

<body class="bg-darkNew container-md">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent rounded-2 p-2">
        <a class="navbar-brand" href=".">
            <img src="../static/img/png.png" alt="UHQ LOGS" />
        </a>
        <button class="navbar-toggler" data-bs-target="#headerCollapse" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse centered" id="headerCollapse">
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['unique_id'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php } else{?>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item d-flex flex-row align-items-center me-lg-2">
                    <a class="nav-link me-lg-0 me-1" href="https://t.me/uhqservice">Reviews</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewbox="0 0 15 15" fill="none">
                        <circle cx="7.5" cy="7.5" r="7.5" fill="#8c8c8c" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.81536 10.2821L9.81561 10.2815L9.82182 10.266L10.8928 4.86629V4.84875C10.8928 4.71421 10.8431 4.59676 10.7349 4.52631C10.6403 4.46465 10.5314 4.46026 10.4551 4.46605C10.3744 4.47218 10.2983 4.49233 10.2456 4.5091C10.2185 4.51773 10.1958 4.52604 10.1795 4.53233C10.1714 4.53548 10.1648 4.53816 10.16 4.54016L10.1553 4.54214L4.18392 6.88462L4.18227 6.88521C4.17905 6.88638 4.17478 6.88797 4.16963 6.88998C4.15936 6.89398 4.14538 6.8997 4.12896 6.90714C4.09672 6.92175 4.05217 6.9443 4.00699 6.97524C3.93026 7.02779 3.78414 7.15219 3.80882 7.34941C3.82925 7.51277 3.94186 7.61652 4.01778 7.67024C4.05847 7.69903 4.09741 7.7198 4.12592 7.73337C4.14036 7.74025 4.15263 7.74552 4.16177 7.74924C4.16635 7.7511 4.17018 7.75259 4.17315 7.75372L4.17694 7.75513L4.17937 7.75604L5.2241 8.10775C5.22057 8.1733 5.22707 8.24013 5.24446 8.30607L5.76777 10.2912C5.82982 10.5266 6.04276 10.6906 6.28618 10.6904C6.50437 10.6902 6.69788 10.5582 6.78009 10.3613L7.59711 9.48769L9.00032 10.5635L9.02027 10.5722C9.14776 10.6278 9.26687 10.6455 9.37577 10.6306C9.48452 10.6157 9.57094 10.5701 9.63585 10.5182C9.69973 10.4671 9.74351 10.4094 9.77104 10.366C9.78503 10.3439 9.79546 10.3245 9.80269 10.3099C9.80632 10.3026 9.80919 10.2964 9.81133 10.2916L9.81402 10.2853L9.81498 10.283L9.81536 10.2821ZM5.76246 8.16951C5.75056 8.12439 5.76923 8.07677 5.80862 8.05175L9.3522 5.80143C9.3522 5.80143 9.56062 5.67489 9.55317 5.80143C9.55317 5.80143 9.59037 5.82377 9.47869 5.92796C9.37275 6.02692 6.95309 8.36301 6.70825 8.5994C6.69412 8.61304 6.68568 8.6287 6.6807 8.6477L6.28577 10.1547L5.76246 8.16951Z"
                            fill="white" />
                    </svg>
                </li>
                <?php } ?>


                <?php if (isset($_SESSION['unique_id'])){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="setting.php">Setting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="support.php">Support</a>
                </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['unique_id'])){ ?>
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                    <span style="color: #006698; cursor: pointer; text-decoration: underline;">
                        <?php echo $email;?>
                    </span>
                </li>
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                    <a href="../php/logout.php?logout_id=<?php echo $unique_id?>">
                        <button class="btn btn-success">Log Out</button>
                    </a>
                </li>
                <?php } else { ?>
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                    <a class="nav-link btn btn-primary " href="../auth/login.php">login</a>
                </li>
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                    <span class="text-white">or</span>
                </li>
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                    <a class="nav-link btn btn-gradient " href="../auth/signup.php">create account</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link position-relative cart-count  text-success" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewbox="0 0 24 24" width="30px"
                            fill="#8c8c8c">
                            <path d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" />
                        </svg>
                        <span class="badge rounded-5" id="cartItemsCount">
                            0
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="products full loadable-content">

        <div class="loading text-white" id="loader">
            <div class="d-flex align-items-center mb-2 justify-content-center">
                <div class="circles">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <h6 class="text-center">Loading assets, please be patient</h6>
        </div>

        <div class="main-content overflow-hidden" id="mainContent">
            <h5 class="text-white">Your Cart</h5>
            <div style="overflow-x: auto;">
                <!-- Loop through cart_items and display product details -->
                <?php

                if($cartItems != null || isset($_SESSION['cart_items']))
                {
                    if($cartItems == null){
                        $cartItems = $_SESSION['cart_items'];
                    }
                    foreach ($cartItems as $item) {
                    $productId = $item['product_id'];
                    $productName = $item['product_name'];
                    $productPrice = $item['price'];
                    $productQuantity = $item['quantity'];
                    $productSub = $item['sub'];
                    $query = "SELECT * FROM products WHERE product_id = $productId";
                   
                    $result = $conn->query($query);

                    
                    $row = $result->fetch_assoc();
                    $productCategory = $row['category'];
                    

                    $product_img;
                    if ($result && $result->num_rows > 0) {
                        // Assuming product_id is unique and there's only one image for each product_id
                        $product_img = $row['image'];
                        $result->free();
                    }

                ?>
                <div style="display:inline-flex; flex-wrap:wrap;">
                    <div class="carts-area mb-3" style="margin: 0.5vw;">
                        <div class="item">
                            <div class="w-100 d-flex justify-content-start align-items-center mt-1">
                                <!-- Replace the demo image with the actual image URL -->
                                <img class="img me-2 ms-1" src="../static/img/<?php echo $product_img ?>"
                                    alt="<?php echo $productName; ?>">
                                <div class="d-flex flex-column justify-content-center align-items-baseline w-100">
                                    <div class="d-flex justify-content-between w-100">
                                        <h6 class="mb-0 me-2 text-white">
                                            <?php echo $productName; ?>
                                        </h6>
                                        <!-- Add data-action and data-orderkey attributes here if needed -->
                                        <button data-action="deleteOrder" data-orderkey="<?php echo $productId; ?>"
                                            class="btn remove-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="16"
                                                viewBox="0 0 15 16" fill="none">
                                                <!-- ... (SVG path for delete icon) ... -->
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- For example, "<label><?php echo $productQuantity; ?> items</label>" -->
                                </div>
                            </div>
                            <div class="w-100 d-flex justify-content-between mt-2">
                                <div class="d-flex justify-content-start">
                                    <label class="fw-lighter me-3">
                                        <label class="text-white fw-semibold" style="margin:1vw;">Price 
                                            <?php echo '($) '.$productPrice; ?>
                                        </label>
                                    </label>
                                    <label class="text-white" style="margin:1vw;">QTY <label
                                            class="text-white fw-semibold">
                                            <?php echo $productQuantity;?>
                                            
                                        </label></label>
                            
                                <label class="text-white" style="margin:1vw;">Subscription <label
                                        class="text-white fw-semibold">
                                        <?php echo $productSub.'Months'; ?>
                                    </label>
                                    </label>
                                </div>
                                <!-- Add any other calculations and display the total price here -->
                                <!-- For example, "<label class="fw-lighter ms-2">Total : <label class="text-white fw-semibold">$<?php echo $productPrice * $productQuantity; ?></label></label>" -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                }
                else{
                    echo '<br></br><h1 style="color: white;">Your Cart Is Empty<h1>';
                }
                ?>

            </div>
            <hr class="w-100 mb-3 text-white">
            
            <div class="row d-flex w-100 flex-lg-row flex-column-reverse align-items-baseline justify-content-between overflow-hidden m-0">
                <div class="d-flex flex-column col-lg-8">
                    <h6 class="mb-2 fw-bold text-white">Select payment processor
                    </h6>
                    <div class="paymentProcessors mb-3 overflow-auto" id="paymentProcessors">
                        <!-- <div class="paymentProcessor me-2" data-title="Crypto + Balance"
                            data-paymentprocessor="cryptoCoinBaseBalance">
                            <img src="../static/img/coinbase-icon.png" alt="img" width="30" height="30" class="ms-2 me-3">
                            Crypto + Balance
                        </div> -->

                        <div class="paymentProcessor me-2" data-title="Crypto" data-paymentprocessor="cryptoCoinBase">
                            <img src="../static/img/coinbase-icon.png" alt="img" width="30" height="30" class="ms-2 me-3">
                            Crypto
                        </div>
                    </div>
                    <h6 class="mb-2 fw-bold text-white">Email Address - For
                        Product Delivery
                    </h6>
                    <input type="email" class="form-control mb-3" style="width:60%;" id="unAuthorizedEmailAddress"
                        placeholder="test@gmail.com.." required>
                </div>

                <div class="d-flex flex-column justify-content-center align-items-center col-lg-4 p-0">
                    <div
                        class="bordered-box mb-3 p-3 d-flex flex-column justify-content-center align-items-center w-100">

                    </div>
                    <button class="btn btn-danger mb-5 w-100" style="margin-bottom: 10%;" id="btnEmptyCart">Empty
                        Cart</button>
                    <button class="btn btn-success mb-5 w-100" style="margin-top: 6%;" id="btnCartPurchase"
                        onclick="storeEmailAsCookie()" disabled>Purchase</button>

                </div>

            </div>
            <div class="bordered-box mb-3 p-3 d-flex flex-column justify-content-center align-items-center w-100">
                <h5 class="text-white fw-semibold w-100 mb-2">Order Details</h5>
                <div class="d-flex flex-row flex-wrap justify-content-between align-items-center w-100">
                    <p class=" text-white m-0">Subtotal : </p>
                    <p class="text-white text-white m-0 me-2"><span id="subTotalAmount">$1.00</span></p>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-between align-items-center w-100">
                    <p class="text-white m-0">Discount : </p>
                    <p class="text-white m-0 me-2"><span id="discountAmount">$0</span></p>
                </div>
                <div class="d-flex flex-row flex-wrap justify-content-between align-items-center w-100 mt-2">
                    <p class=" text-white m-0 fw-bold">Total : </p>
                    <p class="text-white m-0 me-2 fw-bold"><span id="totalAmount">$1.00</span></p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="social-media-buttons">

        <button type="button" class="btn btn-secondary btn-sm position-sticky" id="btn-back-to-top">
            Back to top
        </button>
    </div>


    <footer class="bg-transparent p-4 mt-3 d-flex justify-content-center align-items-center flex-column">
        <hr class="w-75">
        <nav class="navbar navbar-expand navbar-dark bg-transparent p-2 mb-0">
            <ul class="navbar-nav">
                <li class="nav-item d-flex flex-row align-items-center me-lg-2">
                    <a class="nav-link me-lg-0 me-1" href="https://t.me/uhqservice">Reviews</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewbox="0 0 15 15" fill="none">
                        <circle cx="7.5" cy="7.5" r="7.5" fill="#8c8c8c" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M9.81536 10.2821L9.81561 10.2815L9.82182 10.266L10.8928 4.86629V4.84875C10.8928 4.71421 10.8431 4.59676 10.7349 4.52631C10.6403 4.46465 10.5314 4.46026 10.4551 4.46605C10.3744 4.47218 10.2983 4.49233 10.2456 4.5091C10.2185 4.51773 10.1958 4.52604 10.1795 4.53233C10.1714 4.53548 10.1648 4.53816 10.16 4.54016L10.1553 4.54214L4.18392 6.88462L4.18227 6.88521C4.17905 6.88638 4.17478 6.88797 4.16963 6.88998C4.15936 6.89398 4.14538 6.8997 4.12896 6.90714C4.09672 6.92175 4.05217 6.9443 4.00699 6.97524C3.93026 7.02779 3.78414 7.15219 3.80882 7.34941C3.82925 7.51277 3.94186 7.61652 4.01778 7.67024C4.05847 7.69903 4.09741 7.7198 4.12592 7.73337C4.14036 7.74025 4.15263 7.74552 4.16177 7.74924C4.16635 7.7511 4.17018 7.75259 4.17315 7.75372L4.17694 7.75513L4.17937 7.75604L5.2241 8.10775C5.22057 8.1733 5.22707 8.24013 5.24446 8.30607L5.76777 10.2912C5.82982 10.5266 6.04276 10.6906 6.28618 10.6904C6.50437 10.6902 6.69788 10.5582 6.78009 10.3613L7.59711 9.48769L9.00032 10.5635L9.02027 10.5722C9.14776 10.6278 9.26687 10.6455 9.37577 10.6306C9.48452 10.6157 9.57094 10.5701 9.63585 10.5182C9.69973 10.4671 9.74351 10.4094 9.77104 10.366C9.78503 10.3439 9.79546 10.3245 9.80269 10.3099C9.80632 10.3026 9.80919 10.2964 9.81133 10.2916L9.81402 10.2853L9.81498 10.283L9.81536 10.2821ZM5.76246 8.16951C5.75056 8.12439 5.76923 8.07677 5.80862 8.05175L9.3522 5.80143C9.3522 5.80143 9.56062 5.67489 9.55317 5.80143C9.55317 5.80143 9.59037 5.82377 9.47869 5.92796C9.37275 6.02692 6.95309 8.36301 6.70825 8.5994C6.69412 8.61304 6.68568 8.6287 6.6807 8.6477L6.28577 10.1547L5.76246 8.16951Z"
                            fill="white" />
                    </svg>
                </li>
            </ul>
        </nav>
        <p class="m-auto text-center mt-2 text-white-50">© 2023 UHQ LOGS. All rights reserved</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>


        // JavaScript Loader Code
        var loader = document.getElementById("loader");
        var mainContent = document.getElementById("mainContent");
        window.addEventListener("load", setTimeout(function () {
            loader.style.display = "none";
            mainContent.style.display = "block";
        }, 800))


    </script>

    <script>
        // Function to update cart items count and total amount

        // Get the cart items count and total amount from the session
        function updateCartItemsCountAndTotal() {
            // Get the cart items count and total amount from the session
            $.ajax({
                type: 'GET',
                url: 'get_cart_items.php',
                success: function (cartItems) {
                    var cartItemsCount = cartItems.length;
                    var totalAmount = 0;
                    for (var i = 0; i < cartItems.length; i++) {
                        totalAmount += cartItems[i]['price'] * cartItems[i]['quantity'] * cartItems[i]['sub'];
                    }

                    // Update cart items count in the badge
                    document.getElementById("cartItemsCount").innerHTML = cartItemsCount;

                    // Update the total amount in the order details section
                    document.getElementById("subTotalAmount").innerHTML = "$" + (totalAmount).toFixed(2);
                    document.getElementById("totalAmount").innerHTML = "$" + (totalAmount).toFixed(2);

                    // Send the totalAmount to store it in session variable
                    $.ajax({
                        type: 'POST', // You can use POST or GET based on your requirement
                        url: 'store_total_amount_in_session.php',
                        data: { totalAmount: totalAmount }, // Send totalAmount as a parameter
                        success: function (response) {
                            // Handle the response if needed
                            console.log('Total amount stored in session successfully.');
                            // Redirect to coinbase.php after storing the totalAmount
                            // window.location.href = 'coinbase.php';
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            // Handle the error if needed
                            alert("Failed to store the total amount in session.");
                        }
                    });

                },
                error: function (xhr, textStatus, errorThrown) {
                    // Display error message or handle as needed
                    alert("Failed to retrieve cart items.");
                }
            });
        }
        function validateEmail(email) {
            // Regular expression for email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Function to enable or disable the purchase button based on email input
        function updatePurchaseButtonState() {
            const emailInput = document.getElementById('unAuthorizedEmailAddress');
            const purchaseButton = document.getElementById('btnCartPurchase');

            // Check if the email input is valid and not empty
            if (emailInput.value && validateEmail(emailInput.value)) {
                purchaseButton.disabled = false;
            } else {
                purchaseButton.disabled = true;
            }
        }

        // Add event listener to the email input to update the button state on input change
        document.getElementById('unAuthorizedEmailAddress').addEventListener('input', updatePurchaseButtonState);

        // Function to store email as a cookie
        function storeEmailAsCookie() {
            // Get the email address entered by the user
            var email = document.getElementById('unAuthorizedEmailAddress').value;

            // Validate the email before proceeding
            if (!email || !validateEmail(email)) {
                alert("Please enter a valid email address.");
                return;
            }

            // Set the cookie with the email address, which will expire in 1 hour (you can adjust the expiry time as needed)
            document.cookie = "unAuthorizedEmail=" + encodeURIComponent(email) + "; expires=" + getCookieExpirationTime(1) + "; path=/";
            redirectToURL(); // Redirect to the payment page after storing the email
        }


        function getCookieExpirationTime(hours) {
            var date = new Date();
            date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
            return date.toUTCString();
        }

        function redirectToURL() {
            // Replace 'YOUR_REDIRECT_URL' with the actual URL where you want to redirect the user
            window.location.href = 'coinbase.php';
        }

        // Add a click event listener to the button
        document.getElementById('btnCartPurchase').addEventListener('click', redirectToURL);

        // Bind the "Purchase" button click event
        document.getElementById("btnCartPurchase").addEventListener("click", function () {
            purchase();
        });

        // Update cart items count and total amount when the page loads
        updateCartItemsCountAndTotal();
    </script>

    <!-- ... (your existing HTML code) ... -->

    <script>
        // Function to handle the click event of the "Empty Cart" button
        function emptyCart() {
            $.ajax({
                type: 'POST',
                url: 'clear_cart.php', // Change to the correct path of your clear_cart.php file
                success: function (response) {
                    // On success, reload the page to update the cart display
                    location.reload();
                },
                error: function (xhr, textStatus, errorThrown) {
                    // Handle the error if needed
                    alert('Failed to empty the cart. Please try again later.');
                }
            });
        }

        // Add a click event listener to the "Empty Cart" button
        document.getElementById('btnEmptyCart').addEventListener('click', emptyCart);
    </script>

</body>

</html>