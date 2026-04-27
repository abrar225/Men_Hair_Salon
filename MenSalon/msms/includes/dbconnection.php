<?php
$con=mysqli_connect("localhost", "root", "", "msmsdb");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

// Auto-login from cookie
if(!isset($_SESSION['msmsuid']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];
    $stmt = mysqli_prepare($con, "SELECT ID, Name FROM tblcustomers WHERE remember_token = ?");
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_array($result)) {
        $_SESSION['msmsuid'] = $row['ID'];
        $_SESSION['msmsname'] = $row['Name'];
    }
}
?>
