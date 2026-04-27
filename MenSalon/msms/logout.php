<?php
session_start();
include('includes/dbconnection.php');

if(isset($_SESSION['msmsuid'])) {
    $uid = $_SESSION['msmsuid'];
    mysqli_query($con, "UPDATE tblcustomers SET remember_token = NULL WHERE ID = '$uid'");
}

setcookie("remember_me", "", time() - 3600, "/");
session_unset();
session_destroy();
header('location:index.php');
?>
