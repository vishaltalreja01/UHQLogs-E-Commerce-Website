<?php
    session_start();
    include '../php/db.php';
    $unique_id = $_SESSION['unique_id'];
    $email = $_SESSION['email'];
    if(empty($unique_id))
    {
        header ("Location: ../auth/login.php");
    }
    setcookie('cart_items_1_cookie', '', time() - 36000, '/');
        // You can set more cookies for deletion here if needed 
    $qry = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
    if(mysqli_num_rows($qry) > 0){
        $row = mysqli_fetch_assoc($qry);
        if($row){
            $_SESSION['Role'] = $row['Role'];
            if($row['verification_status'] != 'Verified'){
                header ("Location: ../verify.php");
            }
        }
    }
    


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Email = $_POST['email'];
        $Password = $_POST['pass'];
    
    
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$Email}' AND password = '{$Password}'");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
                if ($row) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['otp'] = $row['otp'];
                    header("Location: index.php"); // Redirect to the dashboard page
                    exit;
                }
            } else {
                $_SESSION['login_error'] = "Email or Password is Incorrect!";

            }
        
    }

    $c_shopping1 = mysqli_query($conn,"SELECT * FROM products");
    $c_shopping12 = mysqli_fetch_all($c_shopping1,MYSQLI_ASSOC);
    $_SESSION['c_shopping12'] = $c_shopping12;
    if(!isset($_SESSION['c_shopping12'])){
    }
    $p_shopping = $_SESSION['c_shopping12'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | UHQLogs</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../static/img/png.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../static/img/png.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../static/img/png.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
  
    <style>
        body.modal-open {
    overflow: hidden;
}

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
       
    .hidden {
        display: none;
    }

    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../static/css/main.css">


</head>

<body class="bg-darkNew container-md" onload="counting()">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent rounded-2 p-2">
        <a class="navbar-brand" href=".">
            <img src="../static/img/png.png" alt="UHQ LOGS" />
        </a>
        <button class="navbar-toggler" data-bs-target="#headerCollapse" data-bs-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse centered" id="headerCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="setting.php">Setting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="support.php">Support</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                    <span style="color: #006698; cursor: pointer; text-decoration: underline;">
                        <?php echo $email;?>
                    </span>
                </li>
                <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
                <li><a href="../php/logout.php?logout_id=<?php echo $unique_id?>"><button class="btn btn-success ">Log
                            Out</button></a></li>
                </li>
                <li class="nav-item">
                    <a class="nav-link position-relative cart-count  text-success" href="cart.php">
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
            <div class="hero-section mt-2 mb-2">
                <h1 class="text-center fw-bold text-white text-uppercase">UHQ LOGS</h1>
                <p class="text-center text-white-50 m-0">The Most Reliable Store on the Internet</p>
            </div>

            <div class="collapse show mb-5" id="searchFilterCollapse">

                <div class="products-title-category">

                    <div class="input-group mt-3">
                        <input name="title" class="form-control searchable-input" placeholder="Visa,Target,..."
                            id="searchQuery" onkeyup="search_items()" type="text" />
                        <span class="text-capitalize input-group-text">product title</span>
                    </div>
                    <div class="input-group mt-3">
                        <select id="categories" class="form-select searchable-input" onchange="filterByCategory()">
                            <option value="all">All</option>

                            <?php
                            $count = 0;
                      $sql1 = "SELECT DISTINCT category FROM products";
                      $categories = mysqli_query($conn, $sql1);

                      while($row1 = mysqli_fetch_assoc($categories)){
                        ?>
                            <option value="<?php echo $row1['category'] ?>">
                                <?php echo $row1['category'] ?>
                            </option>

                            <?php
                    }
                  $count+=1;
                    ?>
                        </select>
                        <span class="text-capitalize input-group-text">category</span>
                    </div>
                </div>



                <div class="products-area mt-2">

                    <div id="hot-products">
                        <h5 class="text-center text-white mt-2 mb-3">Products</h5>

                        <div class="items">
                            <?php
                                if (isset($_SESSION['c_shopping12']) && is_array($_SESSION['c_shopping12'])) {
                                    for($i=0 ; $i<count($c_shopping12); $i++){

                                    ?>
                            <div class="card all category shopping"data-category="<?php echo $c_shopping12[$i]['category']; ?>">
                                <div class="card-img-top">
                                    <img alt="productImage" src="../static/img/<?php echo  $c_shopping12[$i]['image'] ?>">
                                   
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo  $c_shopping12[$i]['pname'] ?>
                                    </h5>
                                                    
                            <button class="btn btn btn-gradient w-100 btn-show-payment" data-bs-toggle="modal" data-bs-target="#paymentModal" data-product-id="<?php echo $c_shopping12[$i]['product_id']; ?>" 
                            data-product-name="<?php echo $c_shopping12[$i]['pname']; ?>" 
                            data-product-cost="<?php echo $c_shopping12[$i]['cost']; ?>"
                            data-product-desc="<?php echo $c_shopping12[$i]['p_description']; ?>"
                            >Payment | $<?php echo $c_shopping12[$i]['cost']; ?>
                            </button>

                                </div>
                            </div>
                            <?php
                                    }
                                }
                                ?>



                            </div>
                        </div>

                        <h5 class="text-center text-white mb-2">Total Items: <span id="searchBarFound"
                                class="fw-bold">0</span>
                        </h5>

                    </div>
                </div>
            </div>
        </div>
        


        <div class="social-media-buttons">

            <button type="button" class="btn btn-secondary btn-sm position-sticky" id="btn-back-to-top">
                Back to top
            </button>
        </div>
       <!-- add to cart popup -->
       <div class="modal fade" id="paymentModal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-darkNew text-white">
            <div class="modal-header">
                <h6 class="modal-title">Add to cart</h6>
            </div>
            <button type="button" class="btn-close text-white" style="position: absolute; right:0" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body pt-3 pb-2 bg-darkNew loadable-content loaded" style="max-height: 510px;">

                            <div class="loading text-white" style="display:none;">
                                <div class="d-flex align-items-center mb-2">
                                    <div aria-hidden="true" class="spinner-border m-auto" role="status"></div>
                                </div>
                                <h6 class="text-center">Loading product information, please be patient</h6>
                            </div>

                            <div class="main-content" style="display: block;">
                                <input type="hidden" name="productSlug" value="18807a77-d888-4000-8fa1-3ba0c9fed3e0">
                                <input type="hidden" name="hash" value="ecca4ff3cb39d823402421e3c13e8c91df8db9e1">
                                <h5 class="text-center mb-3 fw-semibold un_product_name">
                                   
                                </h5>
                                <label class="mt-4 mb-2 d-flex">About product</label>
                                
                                <p class="un_product_desc"></p>
                                <label class="mt-4 mb-2 d-flex">Tags</label>
                                <div class="product-tags mb-2">

                                    <span class="badge">Food</span>
                                    <span class="badge">Hot</span>
                                </div>
                                <label class="mt-4 mb-2 d-flex">Price</label><!--updated here -->
                                <p class = "un_product_cost"></p>

                                    <div id="optionsDiv">
                                        <!-- Add your options code here -->
                                        <label class="mt-4 mb-2 d-flex">Available Options</label>
                                        <div class="input-group mb-4">
                                            <select id="option" class="form-select">
                                                <option selected="1" value="1" selected="">1 Month</option>
                                                <option value="3">3 Months</option>
                                                <option value="12">1 Year</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                        </div>
                                    </div>
                                        
                                    <div id="AmountDiv">
                                        <!-- Add your amount code here -->
                                        <label class="mt-4 mb-2 d-flex">Amount to add</label>
                                        <div class="input-group mb-4">
                                            <input id="totalQuantity" placeholder="amount" type="number" value="1" min="1" max="15321" class="form-control">
                                            <span class="input-group-text">$</span>
                                            <span id="totalAmount" class="input-group-text">1.00</span>
                                        </div>
                                    </div>
                              
                                <div id="successMessage" class="alert alert-success mt-3" style="display: none;">
                                    Product added to cart successfully.
                                </div>
                                <button
                                    id="btnAddModal"
                                    type="button"
                                    class="btn btn-success w-100 mb-2 btn-add-to-cart "
                                    data-product-name1="<?php echo $c_shopping12[$i]['pname']; ?>"
                                    data-product-cost1="<?php echo $c_shopping12[$i]['cost']; ?>"
                                    data-product-desc1="<?php echo $c_shopping12[$i]['p_description']; ?>"
                                    data-product-id1="<?php echo $c_shopping12[$i]['product_id']; ?>"
                                    >
                                    Add to cart
                                </button>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
 // Add event listener to the close button
document.querySelector('#paymentModal .btn-close').addEventListener('click', function() {
    // Close the modal
    $('#paymentModal').modal('hide');
    // Remove the fade effect manually after a short delay (adjust the delay time as needed)
    setTimeout(function() {
        $('.modal-backdrop').remove();
    }, 300);
});

// Function to disable scrolling when the modal is open
function disableScrolling() {
    document.body.classList.add('modal-open');
    document.body.style.overflow = 'hidden';
}

// Function to enable scrolling after closing the modal
function enableScrolling() {
    document.body.classList.remove('modal-open');
    document.body.style.overflow = 'auto';
}

// Add event listener to the modal hidden event
const paymentModal = document.getElementById('paymentModal');
paymentModal.addEventListener('hidden.bs.modal', function (event) {
    enableScrolling();
});

// Add event listener to the modal show event
paymentModal.addEventListener('show.bs.modal', function (event) {
    disableScrolling();
});

</script>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- JavaScript Filter Code -->
        <script>
            $('#categories').on('change', function (e) {
                $('.card')
              
                    .filter('.' + e.target.value)
                  
            });

            function counting() {
                const countInDiv = document.querySelectorAll('#hot-products .card').length;
                document.getElementById("searchBarFound").innerHTML = countInDiv;
            }
        </script>
<script>
    // Function to filter products based on the selected category
    function filterByCategory() {
        // Get the selected category value
        const selectedCategory = $("#categories").val();

        // Get all the product cards (items)
        const productCards = $(".category.shopping");

        // Loop through each product card
        productCards.each(function() {
            // Get the product category from the card's data attribute
            const productCategory = $(this).data("category");

            // Check if the selected category is "all" or if it matches the product's category
            if (selectedCategory === "all" || selectedCategory === productCategory) {
                // If it matches, show the product card
                $(this).show();
            } else {
                // Otherwise, hide the product card
                $(this).hide();
            }
        });
    }
    
    // Wait for the DOM to fully load
    $(document).ready(function() {
        // Show all products initially by calling the filterByCategory() function
        filterByCategory();
        
        // Bind the filterByCategory() function to the change event of the categories dropdown
        $("#categories").change(filterByCategory);
    });
    filterByCategory();

            // JavaScript Loader Code
            var loader = document.getElementById("loader");
            var mainContent = document.getElementById("mainContent");
            window.addEventListener("load", function () {
                loader.style.display = "none";
                mainContent.style.display = "block";
            })


            // JavaScript Search Items code
            function search_items() {
                let input = document.getElementById('searchQuery').value
                input = input.toLowerCase();
                let x = document.getElementsByClassName('card-title');
                let y = document.getElementsByClassName('card');

                for (i = 0; i < x.length; i++) {
                    if (!x[i].innerHTML.toLowerCase().includes(input)) {
                        y[i].style.display = "none";
                    }
                    else {
                        y[i].style.display = "flex";
                    }
                }
            }
            // Back to top button
            var btn = $('#btn-back-to-top');
            $(window).scroll(function () {
                if ($(window).scrollTop() > 300) {
                    btn.addClass('show');
                } else {
                    btn.removeClass('show');
                }
            });
            btn.on('click', function (e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, '300');
            });

            
        </script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const paymentButtons = document.querySelectorAll(".btn-show-payment");

    paymentButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Get the product data from the button's data attributes
            const productId = button.dataset.productId;
            const productName = button.dataset.productName;
            const productDesc = button.dataset.productDesc;
            const productCost = button.dataset.productCost;
            const selectElement = document.getElementById("option");
            const selectedIndex = selectElement.selectedIndex;
            const selectedOption = selectElement.options[selectedIndex];
         

            // Set the data in the corresponding modal
            const modalTarget = document.getElementById("paymentModal");
            const productNameElement = modalTarget.querySelector(".un_product_name");
            const productDescElement = modalTarget.querySelector(".un_product_desc");
            const productCostElement = modalTarget.querySelector(".un_product_cost");
            const quantityInput = modalTarget.querySelector("#totalQuantity");
            const totalAmountElement = modalTarget.querySelector("#totalAmount");
            const addToCartButton = modalTarget.querySelector(".btn-add-to-cart");
            const successMessage = modalTarget.querySelector("#successMessage");
            const errorMessage = modalTarget.querySelector("#errorMessage");

            productNameElement.textContent = productName;
            productDescElement.textContent = productDesc;
            productCostElement.textContent = productCost;
            totalAmountElement.textContent = productCost; // Initial value set to product cost

        
            
            // Handle "Add to cart" button click
            addToCartButton.addEventListener("click", function () {
                // Get the updated quantity and total cost
                const selectElement = document.getElementById("option");
                const subscribed = parseFloat(selectElement.value);
                const quantity = parseFloat(quantityInput.value);
                const totalCost = parseFloat(productCost) ;

                // Create a JSON object with the product data
                const productData = {
                    productId: productId,
                    productName: productName,
                    productDesc: productDesc,
                    quantity: quantity,
                    totalCost: totalCost,
                    subscribed: subscribed,
                };

                // Send the product data to cart.php using Fetch API
                fetch("../php/cart.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(productData),
                })
                .then((response) => response.json())
                .then((data) => {
                    // Handle the response from cart.php (e.g., display success or failure message)
                    if (data.success) {
                        // If the response indicates success, show the success message
                        successMessage.textContent = data.message;
                        successMessage.style.display = "block"; // Show the success message element
                        setTimeout(function () {
                            successMessage.style.display = "none";
                            window.location.href = 'cart.php';
                        }, 2000);
                        errorMessage.style.display = "none"; // Hide the error message element
                      
                    } else {
                        // If the response indicates an error, show the error message
                        errorMessage.textContent = data.message;
                        errorMessage.style.display = "block"; // Show the error message element
                        successMessage.style.display = "none"; // Hide the success message element
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
            });

            // Show the modal
            const bootstrapModal = new bootstrap.Modal(modalTarget);
            bootstrapModal.show();
        });
    });
});


</script>
<script>

// Function to update the total amount based on the selected subscription period and quantity
function updateTotalAmount() {
    const productCost = parseFloat(document.querySelector(".un_product_cost").textContent);
    const quantityInput = document.getElementById("totalQuantity");
    const quantity = parseFloat(quantityInput.value);
    const selectElement = document.getElementById("option");
    const subscribed = parseFloat(selectElement.value);

    const totalCost = productCost * quantity * subscribed;
    document.getElementById("totalAmount").textContent = totalCost.toFixed(2);
}

// Add event listeners to update the total amount whenever the subscription option or quantity changes
document.getElementById("option").addEventListener("change", updateTotalAmount);
document.getElementById("totalQuantity").addEventListener("input", updateTotalAmount);

// Call the function to set the initial total amount during the page load
updateTotalAmount();

    // Get the cart items count and total amount from the session
    function updateCartItemsCountAndTotal() {
    // Get the cart items count and total amount from the session
    $.ajax({
        type: 'GET',
        url: 'get_cart_items.php',
        success: function (cartItems) {
            var cartItemsCount = cartItems.length;
            document.getElementById("cartItemsCount").innerHTML = cartItemsCount;
        }});
   
}


updateCartItemsCountAndTotal();
    </script>

</body>

</html>