<?php 

$conn = new mysqli('localhost','544092','sampSAMP123','544092');
if(!$conn.mysqli_connect_error())
{
    echo "Connection Denied";
}
?>