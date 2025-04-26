<?php 
    session_start();
    include 'db.php'; 
    $Email = $_POST['hiddenemail'];
    $Password = $_POST['pass'];

    if(!empty($Password)){
        $row = mysqli_query($conn, "UPDATE users SET password = md5('{$Password}') WHERE email = '{$Email}'");
        if($row){
        echo "Password Updated";
        }
    }
    else{
        echo "All Fields are Required!";
    }
?>