<?php
session_start();
include_once "db.php";

$username = $_POST['uname'];
$email = $_POST['email'];
$password = ($_POST['pass']);
$cpassword = ($_POST['cpass']);
$Role = 'user';
$verification_status = '0';

// checking fields are not empty
if (!empty($username) && !empty($email) && !empty($password) && !empty($cpassword)) {
    //if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //checking email already exists
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - Already Exists!";
        } else {
            if ($password == $cpassword) {
                $time = time();
                $random_id = rand(time(), 10000000);
                $otp =  mt_rand(1111, 9999);
                // let's start insert data into table

                $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, username, email, password, otp, verification_status, Role)
                VALUES ({$random_id},'{$username}','{$email}','{$password}','{$otp}','{$verification_status}','{$Role}')");
                if ($sql2) {
                    $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                    if (mysqli_num_rows($sql3) > 0) {
                        $row = mysqli_fetch_assoc($sql3);
                        $_SESSION['unique_id'] = $row['unique_id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['otp'] = $row['otp'];

                        //mail function
                        if ($otp) {
                            $receiver = $email;
                            $subject = "From: $username <$email>";
                            $body = "Name " . " $username  \n Email" . " $email \nOtp" . " $otp";
                            $sender = "From: omnipexonline@gmail.com";

                            if (mail($receiver, $subject, $body, $sender)) {
                                header("Location: ../verify.php");
                                exit;
                            } else {
                                echo "Email Problem!" . mysqli_error($conn);
                            }
                        }
                        // mail function end
                    }
                } else {
                    echo "Somethings went wrong! " . mysqli_error($conn);
                }
            } else {
                echo "Confirm Password Don't Match!";
            }
        }
    } else {
        echo "$email ~ This is not a valid Email!";
    }
} else {
    echo "All Input Fields are Required!";
}
?>
