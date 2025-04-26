<?php
session_start();
include_once "db.php";

$email = $_POST['email'];

$data = "SELECT * FROM users WHERE email = '{$email}'";
$result = mysqli_query($conn, $data);
if($row1 = mysqli_fetch_assoc($result)){
    $username = $row1['username'];
    $password = $row1['password'];

// checking fields are not empty
if (!empty($email)) {
    //if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //checking email already exists
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
        
            $receiver = $email;
            $subject = "From: $username <$email>";
            
            $body = "Name " . " $username  \n Email" . " $email \nPassword" . " $password";
            $sender = "From: omnipexonline@gmail.com";
            if (mail($receiver, $subject, $body, $sender)) {
                echo '<script>alert("Password has been sent to your email.");</script>';
                    // Redirect to login page after 1 second
                echo '<script>setTimeout(function(){ window.location.href = "../auth/login.php"; }, 1000);</script>';
                // header("Location: ../auth/login.php");
                exit;
            } else {
                "Email Problem!" . mysqli_error($conn);
            }
        } 
        else {
            echo "$email ~ This email is not registered";
        }
    } else {
        echo "$email ~ This is not a valid Email!";
    }
} else {
    echo "All Input Fields are Required!";
}
}
?>