<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(!isset($_SESSION['msmsuid'])) {
    header("Location: login.php");
    exit();
}

// Check if it's an edit request
$edit_mode = false;
$edit_apt_no = "";
if(isset($_GET['edit_apt'])) {
    $edit_mode = true;
    $edit_apt_no = $_GET['edit_apt'];
}

if(isset($_POST['submit']))
  {
    $uid = isset($_SESSION['msmsuid']) ? $_SESSION['msmsuid'] : 0;
    $name=$_POST['name'];
    $email=$_POST['email'];
    $adate=$_POST['adate'];
    $atime=$_POST['atime'];
    $phone=$_POST['phone'];
    
    if($edit_mode) {
        $aptnumber = $edit_apt_no;
        // Update existing appointment
        $stmt = mysqli_prepare($con, "UPDATE tblappointment SET Name=?, Email=?, PhoneNumber=?, AptDate=?, AptTime=?, Status='' WHERE AptNumber=? AND UserID=?");
        mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $phone, $adate, $atime, $aptnumber, $uid);
        if(mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Appointment updated successfully! Pending for admin approval.');</script>";
            echo "<script>window.location.href='dashboard.php'</script>";
        }
    } else {
        $aptnumber = mt_rand(100000000, 999999999);
        
        // Use prepared statements for main appointment
        $stmt = mysqli_prepare($con, "INSERT INTO tblappointment (UserID, AptNumber, Name, Email, PhoneNumber, AptDate, AptTime) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "issssss", $uid, $aptnumber, $name, $email, $phone, $adate, $atime);
        
        if (mysqli_stmt_execute($stmt)) {
            // Move services from cart to tblappointment_services
            $cart_query = mysqli_query($con, "SELECT ServiceID FROM tblcart WHERE UserID='$uid'");
            while($cart_row = mysqli_fetch_array($cart_query)) {
                $sid = $cart_row['ServiceID'];
                mysqli_query($con, "INSERT INTO tblappointment_services (AppointmentNumber, ServiceID) VALUES ('$aptnumber', '$sid')");
            }
            
            // Clear cart
            mysqli_query($con, "DELETE FROM tblcart WHERE UserID='$uid'");
            
            $_SESSION['aptno'] = $aptnumber;
            echo "<script>window.location.href='thank-you.php'</script>";  
        }
        else
        {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>"; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Men Salon Management System || Appointments Form</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include_once('includes/header.php');?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title"><?php echo $edit_mode ? 'Edit Appointment' : 'Book Appointment'; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h1><?php echo $edit_mode ? 'Update Details' : 'Finalize Appointment'; ?></h1>
                            <p> <?php echo $edit_mode ? 'You can change the date and time of your appointment.' : 'Fill in the details to complete your booking.'; ?></p>
<?php
$username = "";
$useremail = "";
$userphone = "";
$adate = "";
$atime = "";

if ($edit_mode) {
    $uid = $_SESSION['msmsuid'];
    $stmt = mysqli_prepare($con, "SELECT Name, Email, PhoneNumber, AptDate, AptTime FROM tblappointment WHERE AptNumber = ? AND UserID = ?");
    mysqli_stmt_bind_param($stmt, "si", $edit_apt_no, $uid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_array($res)) {
        $username = $row['Name'];
        $useremail = $row['Email'];
        $userphone = $row['PhoneNumber'];
        $adate = $row['AptDate'];
        $atime = $row['AptTime'];
    }
} elseif (isset($_SESSION['msmsuid'])) {
    $uid = $_SESSION['msmsuid'];
    $stmt = mysqli_prepare($con, "SELECT Name, Email, MobileNumber FROM tblcustomers WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $uid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_array($res)) {
        $username = $row['Name'];
        $useremail = $row['Email'];
        $userphone = $row['MobileNumber'];
    }
}
?>
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label" for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $username; ?>" required="true">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="phone">phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="<?php echo $userphone; ?>" required="true" maxlength="10" pattern="[0-9]+">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label" for="email">email</label>
                                         <input type="email" class="form-control" id="appointment_email" placeholder="Email" name="email" value="<?php echo $useremail; ?>" required="true">
                                    </div>
                                    
                                    <?php if(!$edit_mode): ?>
                                    <div class="col-md-6">
                                        <label class="control-label">Services Selected</label>
                                        <div class="well well-sm">
                                            <?php
                                            $uid = $_SESSION['msmsuid'];
                                            $s_query = mysqli_query($con, "SELECT tblservices.ServiceName FROM tblcart JOIN tblservices ON tblcart.ServiceID = tblservices.ID WHERE tblcart.UserID = '$uid'");
                                            $services_list = [];
                                            while($s_row = mysqli_fetch_array($s_query)) {
                                                $services_list[] = $s_row['ServiceName'];
                                            }
                                            echo implode(", ", $services_list);
                                            ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="textarea">Appointment Date</label>
                                            <input type="date" class="form-control appointment_date" placeholder="Date" name="adate" id='inputdate' value="<?php echo $adate; ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label" for="textarea">Appointment Time</label>
                                            <input type="time" class="form-control appointment_time" placeholder="Time" name="atime" id='atime' value="<?php echo $atime; ?>" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" id="submit" name="submit" class="btn btn-default"><?php echo $edit_mode ? 'Update Appointment' : 'Confirm Booking'; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
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
    <script type="text/javascript">
$(function(){
    var dtToday = new Date();
 
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate()+1;
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
     day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#inputdate').attr('min', maxDate);
});
</script>
</body>

</html>
