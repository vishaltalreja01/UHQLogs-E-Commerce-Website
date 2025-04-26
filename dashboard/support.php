<?php 
  session_start();
  include '../php/db.php';
  $unique_id = $_SESSION['unique_id'];
  $email = $_SESSION['email'];
  if(empty($unique_id))
  {
    header ("Location: ../auth/login.php");
  } 
  $qry = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'");
  if(mysqli_num_rows($qry) > 0){
    $row = mysqli_fetch_assoc($qry);
    if($row){
      $_SESSION['Role'] = $row['Role'];
      if($row['verification_status'] != 'Verified')
      {
        header ("Location: ../verify.php");
      } 
  }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content
    name="CHEAPEST MONEY LOGS! DOESN'T MATTER IF PAYPAL, CRYPTO, METHODS, WE GOT A BIG VARIETY TO FIT YOUR INTERESTS & MAKE MONEY OUT OF IT!" />
  <title>Support | UHQLogs</title>
  <link rel="stylesheet" href="../static/css/main.css">
  <link rel="apple-touch-icon" sizes="180x180" href="../static/img/png.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../static/img/png.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../static/img/png.png">
  <script src="https://embed.sellpass.io/embed.js"></script>
  <script src="//code.tidio.co/cttbx4ogxuruloavswsuzhntu2q4v7ab.js" async></script>
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
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="setting.php">Setting</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Support</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
          <span style="color: #006698; cursor: pointer; text-decoration: underline;">
            <?php echo $email;?>
          </span>
        </li>
        <li class="nav-item me-0 me-lg-2 mb-2 mb-lg-0">
        <li><a href="../php/logout.php?logout_id=<?php echo $unique_id?>"><button class="btn btn-success">Log
              Out</button></a></li>
        </li>
        <li class="nav-item">
          <a class="nav-link position-relative cart-count  text-success" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewbox="0 0 24 24" width="30px" fill="#8c8c8c">
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

  <div class="products lg">
    <div class="main-content gap-0 mb-3" style="color: rgba(255, 255, 255, 0.6);">
      <nav class="mb-3">
        <div class="nav nav-tabs width-max-content m-auto flex-wrap align-items-center justify-content-center"
          id="nav-tab" role="tablist">
          <button class="nav-link active" id="tabSubmitNewLabel" data-bs-toggle="tab" data-bs-target="#tabSubmitNew"
            type="button" role="tab" aria-selected="true">Submit Ticket
          </button>
          <button class="nav-link" id="tabHistoryLabel" data-bs-toggle="tab" data-bs-target="#tabHistory" type="button"
            role="tab" aria-selected="false" tabindex="-1">History
          </button>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade loadable-content" id="tabHistory" role="tabpanel" aria-labelledby="tabHistoryLabel">

          <div class="loading text-white">
            <div class="d-flex align-items-center mb-2">
              <div aria-hidden="true" class="spinner-border m-auto" role="status"></div>
            </div>
            <h6 class="text-center">You dont have any tickets at this moment</h6>
          </div>
          <div class="main-content loadable-content">

            <div class="collapse show mb-2" id="searchFilterCollapse">

              <input type="hidden" id="searchQuery" value="">
              <div class="row">
                <div class="col-md-8">

                  <div class="input-group mt-3">
                    <input name="ticketId" class="form-control searchable-input"
                      placeholder="ticket-id1,ticket-id2,ticket-id3,..." type="text" value="">
                    <span class="text-capitalize input-group-text">ticket id</span>
                  </div>
                </div>
                <div class="col-md-4">

                  <div class="input-group mt-3">
                    <select name="status" type="select" class="form-select searchable-input">
                      <option>all</option>
                      <option>unresolved</option>
                      <option>resolved</option>
                      <option>denied</option>
                    </select>
                    <span class="text-capitalize input-group-text">status</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="orders-area mt-3">

              <div class="table-responsive" id="tableTicketItems">
                <table class="table table-hover table-dark table-sm">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Option</th>
                      <th>Count</th>
                      <th>Comment</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>

            <input id="pageNumber" type="hidden" value="1">

            <nav id="paginationContainer" class="mt-2">
              <ul class="pagination justify-content-center m-auto rounded">


                <li class="page-item">
                  <button class="btn btn-success">1</button>
                </li>

              </ul>
            </nav>
          </div>
        </div>
        <div class="tab-pane fade show active loadable-content loaded" id="tabSubmitNew" role="tabpanel"
          aria-labelledby="tabSubmitNewLabel">

          <div class="loading" id="loader">
            <div class="d-flex align-items-center mb-2">
              <div aria-hidden="true" class="spinner-border m-auto" role="status"></div>
            </div>
            <h6 class="text-center">Loading assets</h6>
          </div>
          <div class="main-content" id="mainContent">

            <form action="javascript:void(0);" id="formSubmitTicket">

              <div class="setting-hint mb-2">
                <h4 class="fw-bold text-white mt-1">How to perform new ticket ?</h4>
                <p>Follow these steps to perform new ticket to get responded as quickly as possible.</p>
                <ul class="mb-0">
                  <li>
                    Copy order id from <a href="dashboard/orders" class="text-decoration-none text-success">Orders</a>
                    page
                    into your clipboard.
                  </li>
                  <li>
                    (you can't submit support tickets for <b>Charge</b> orders)
                  </li>
                  <li>
                    Paste your order id and Click <b>Submit</b> button to Insert your order id.
                  </li>
                  <li>
                    Select product in your order which you want replacement for.
                  </li>
                  <li>
                    Select reason why you want replacement for selected product.
                  </li>
                  <li>
                    Provide full message of why you should get replacement.
                  </li>
                  <li>
                    use <a href="https://imgur.com/" class="text-decoration-none text-success">imgur</a>
                    images and
                    include in your message by inserting them in related input and click <b>Add</b>
                    button.
                  </li>
                  <li>
                    Submit order and wait for our staff to review your request.
                  </li>
                </ul>
                <div
                  class="w-100 d-flex flex-row-reverse justify-content-center align-items-center mt-3 user-select-none">
                  <label for="iUnderestandCheckBox" class="ms-2">I've Read Instructions and I Fully
                    Underestand</label>
                  <input id="iUnderestandCheckBox" type="checkbox" class="form-chek" required="">
                </div>
              </div>

              <div class="d-flex flex-column mb-2 pe-5 ps-5 m-auto mt-3">

                <label class="text-white fw-bold text-uppercase" for="order-id-input">Order ID</label>
                <div class="input-group mt-2 mb-3">
                  <input type="text" class="form-control " placeholder="click button to paste here" id="order-id-input"
                    maxlength="36" minlength="36" required="">
                  <span id="btnPasteOrderId" class="text-primary input-group-text cursor-pointer">Submit</span>
                </div>

                <label class="text-white fw-bold text-uppercase" for="products-select">Product</label>
                <select id="products-select" class="form-select mt-2 mb-3" required="" disabled="">
                </select>

                <input id="issuesSource" type="hidden"
                  value="W3sidGl0bGUiOiJJbnZhbGlkIENyZWRlbnRpYWxzIn0seyJ0aXRsZSI6Ik5vIFBheW1lbnQgTWV0aG9kIn0seyJ0aXRsZSI6IjJmYSBvbiBsb2dpbiJ9LHsidGl0bGUiOiJPdGhlciJ9XQ==">
                <label class="text-white fw-bold text-uppercase" for="issue-select">Issue</label>
                <select id="issue-select" class="form-select mt-2 mb-3" required="" disabled="">
                  <option></option>

                  <option>Invalid Credentials</option>

                  <option>No Payment Method</option>

                  <option>2fa on login</option>

                  <option>Other</option>
                </select>

                <label class="text-white fw-bold text-uppercase" for="replacementsCount">Replacements
                  Count</label>
                <input id="replacementsCount" class="form-control mt-2 mb-3" min="1"
                  placeholder="number of replacements" required="" disabled="">

                <label class="text-white fw-bold text-uppercase">Proof Images (only <a href="https://imgur.com/"
                    class="text-decoration-none text-primary">imgur</a>
                  images accepted and will be
                  reviewed)</label>
                <div class="input-group mt-2 mb-3">
                  <input type="text" class="form-control " placeholder="imgur image here ..." id="newImageProofInput"
                    disabled="">
                  <button type="button" id="btnAddImageProof"
                    class="text-primary input-group-text cursor-pointer border-0" disabled="">Add
                  </button>
                </div>
                <div id="proofImages" class="w-100 d-flex flex-column justify-content-center align-content-center">
                </div>

                <label class="text-white fw-bold text-uppercase">Message</label>
                <textarea id="message" class="form-control mt-2 mb-3" required="" disabled=""></textarea>
                <button class="btn btn-primary mt-2" type="submit">Submit</button>
              </div>
            </form>
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
    window.addEventListener("load", function () {
      loader.style.display = "none";
      mainContent.style.display = "block";
    }, )

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
        updateCartItemsCountAndTotal();
  </script>
</body>

</html>