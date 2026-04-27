<?php
session_start();
include('includes/dbconnection.php');

if(isset($_SESSION['bpmsaid'])) {
    $aid = $_SESSION['bpmsaid'];
    mysqli_query($con, "UPDATE tbladmin SET remember_token = NULL WHERE ID = '$aid'");
}

setcookie("admin_remember_me", "", time() - 3600, "/");
session_unset();
session_destroy();
header('location:index.php');

?>