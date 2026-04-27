<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Men Salon Management System || Service List</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
   <?php include_once('includes/header.php');?>
    <div class="page-header"><!-- page header -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Salon Service</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">service list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.page header -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-10 heading-section text-center ftco-animate" style="padding-bottom: 20px;">
           
            <h2 class="mb-4">Our Service Prices</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
<?php
if(isset($_POST['add_to_cart'])) {
    if(!isset($_SESSION['msmsuid'])) {
        echo "<script>window.location.href='login.php'</script>";
        exit();
    }
    $uid = $_SESSION['msmsuid'];
    $sid = $_POST['service_id'];
    
    // Check if already in cart
    $check = mysqli_prepare($con, "SELECT ID FROM tblcart WHERE UserID = ? AND ServiceID = ?");
    mysqli_stmt_bind_param($check, "ii", $uid, $sid);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);
    
    if(mysqli_stmt_num_rows($check) == 0) {
        $stmt = mysqli_prepare($con, "INSERT INTO tblcart (UserID, ServiceID) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ii", $uid, $sid);
        mysqli_stmt_execute($stmt);
        echo "<script>alert('Service added to cart!');</script>";
    } else {
        echo "<script>alert('Service is already in your cart.');</script>";
    }
}
?>
               <table class="table table-bordered"> <thead> <tr> <th>#</th> <th>Service Name</th> <th>Service Price</th> <th>Service Description</th> <th>Action</th> </tr> </thead> <tbody>
<?php
$cache_file = 'cache/services_cache.json';
$cache_time = 3600; // 1 hour

if (file_exists($cache_file) && (time() - filemtime($cache_file) < $cache_time)) {
    $services = json_decode(file_get_contents($cache_file), true);
} else {
    $ret = mysqli_query($con, "select * from tblservices");
    $services = [];
    while ($row = mysqli_fetch_array($ret)) {
        $services[] = $row;
    }
    file_put_contents($cache_file, json_encode($services));
}

$cnt = 1;
foreach ($services as $row) {
?>

             <tr> 
                <th scope="row"><?php echo $cnt;?></th> 
                <td><?php  echo $row['ServiceName'];?></td> 
                <td>₹<?php  echo $row['Cost'];?></td> 
                <td><?php  echo $row['Description'];?></td> 
                <td>
                    <form method="post">
                        <input type="hidden" name="service_id" value="<?php echo $row['ID'];?>">
                        <button type="submit" name="add_to_cart" class="btn btn-primary btn-xs">Add to Cart</button>
                    </form>
                </td>
             </tr>   <?php 
$cnt=$cnt+1;
}?></tbody> </table> 
               
             
            </div>
        </div>
    </div>
    <div class="space-small bg-primary">
        <!-- call to action -->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-7 col-md-8 col-xs-12">
                    <h1 class="cta-title">Book your online appointment</h1>
                    <p class="cta-text"> Call to action button for booking appointment.</p>
                </div>
                <div class="col-lg-4 col-sm-5 col-md-4 col-xs-12">
                    <a href="appointment.php" class="btn btn-white btn-lg mt20">Book Appointment</a>
                </div>
            </div>
        </div>
    </div>
    <?php include_once('includes/footer.php');?>
    <!-- /.footer-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/menumaker.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/sticky-header.js"></script>
</body>

</html>
