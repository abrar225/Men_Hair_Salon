<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_SESSION['msmsuid'])) {
    header('location:logout.php');
    exit();
}

// Handle removal
if(isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $uid = $_SESSION['msmsuid'];
    mysqli_query($con, "DELETE FROM tblcart WHERE ID = '$delid' AND UserID = '$uid'");
    header('location:cart.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SalonPro | My Cart</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .cart-container { padding: 50px 0; min-height: 70vh; }
        .cart-card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .total-section { margin-top: 20px; text-align: right; font-size: 20px; font-weight: 600; }
        .btn-checkout { background: #d4a373; color: #fff; border-radius: 25px; padding: 10px 30px; font-weight: 600; border: none; transition: 0.3s; }
        .btn-checkout:hover { background: #c08552; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(212,163,115,0.4); color: #fff; }
    </style>
</head>
<body>
    <?php include_once('includes/header.php');?>
    
    <div class="page-header" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-container">
        <div class="container">
            <div class="cart-card">
                <h3>Selected Services</h3>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $uid = $_SESSION['msmsuid'];
                            $query = mysqli_query($con, "SELECT tblcart.ID as cartid, tblservices.ServiceName, tblservices.Cost FROM tblcart JOIN tblservices ON tblcart.ServiceID = tblservices.ID WHERE tblcart.UserID = '$uid'");
                            $cnt = 1;
                            $total = 0;
                            if(mysqli_num_rows($query) > 0) {
                                while ($row = mysqli_fetch_array($query)) {
                                    $total += $row['Cost'];
                            ?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo $row['ServiceName'];?></td>
                                <td>₹<?php echo $row['Cost'];?></td>
                                <td><a href="cart.php?delid=<?php echo $row['cartid'];?>" class="text-danger" onclick="return confirm('Remove this service?')"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $cnt++; } ?>
                            <tr class="info">
                                <td colspan="2" class="text-right"><strong>Total Amount:</strong></td>
                                <td colspan="2"><strong>₹<?php echo $total; ?></strong></td>
                            </tr>
                            <?php } else { ?>
                            <tr>
                                <td colspan="4" class="text-center">Your cart is empty. <a href="service-list.php">Browse Services</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if($total > 0): ?>
                <div class="total-section">
                    <a href="appointment.php" class="btn btn-checkout">Proceed to Checkout</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
