<?php
$con=mysqli_connect("localhost", "root", "", "msmsdb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

// Auto-login from cookie
if(!isset($_SESSION['bpmsaid']) && isset($_COOKIE['admin_remember_me'])) {
    $token = $_COOKIE['admin_remember_me'];
    $stmt = mysqli_prepare($con, "SELECT ID FROM tbladmin WHERE remember_token = ?");
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_array($result)) {
        $_SESSION['bpmsaid'] = $row['ID'];
    }
}
?>
