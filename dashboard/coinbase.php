<?php
    session_start();

    $depositAmount =$_SESSION['totalAmount'];
    if (isset($_COOKIE['unAuthorizedEmail'])) {
        $username = $_COOKIE['unAuthorizedEmail'];
    }
    
    $apiKey = '7469a64e-1f04-46b3-bdfd-d702db3953aa';
    // $api_key = '';
    // $secret_key = '08976c4e-3591-4038-9d28-0104fc94ea05';

    // The rest of your existing code
    // ...

    $url = 'https://api.commerce.coinbase.com/charges';

    $data = [
        'name' => $username, // Replace with the user's username
        'description' => 'the total amount is : $'.$depositAmount, // Replace with the description of the deposit
        'local_price' => [
            'amount' => $depositAmount, // Use the received depositAmount (totalAmount) here
            'currency' => 'USD',
        ],
        'pricing_type' => 'fixed_price',
        'redirect_url' => 'http://localhost:81/website/coinbase/success.html', // Replace with the URL to redirect on successful payment
        'cancel_url' => 'http://localhost:81/website/coinbase/fail.html', // Replace with the URL to redirect on canceled payment
    ];

    $yourjson = json_encode($data);

    $ch = curl_init();
    $header = array();
    $header[] = 'Content-Type: application/json';
    $header[] = 'X-CC-Api-Key: ' . "$apiKey";
    $header[] = 'X-CC-Version: 2018-03-22';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $yourjson);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($result);

    if (@$result->error == '') {
        // Redirect the user to the hosted_url to complete the payment
        header('Location: ' . $result->data->hosted_url);
        exit();
    } else {
        // Handle the error
        echo 'Some Problem Occurred. Try Again';
    }

?>
