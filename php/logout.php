<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include "db.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){
                session_unset();
                session_destroy();
                // Clear cookies
        setcookie('cart_items_1_cookie', '', time() - 36000, '/');
        // You can set more cookies for deletion here if needed
                header("location: ../index.php");
        }
        else{
            header("location: ../index.php");
        }
    }   
    else{
        header("location: ../auth/login.php");
    }

?>