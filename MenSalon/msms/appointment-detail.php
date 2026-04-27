<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_SESSION['msmsuid'])) {
    header('location:logout.php');
    exit();
}

$aptno = $_GET['aptno'];
$uid = $_SESSION['msmsuid'];
$query = mysqli_query($con, "SELECT * FROM tblappointment WHERE AptNumber='$aptno' AND UserID='$uid'");
$row = mysqli_fetch_array($query);

if(!$row) {
    echo "Invalid Request";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SalonPro | Appointment Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .detail-container { padding: 50px 0; min-height: 70vh; }
        .detail-card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .status-badge { padding: 8px 15px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .status-pending { background: #fff4e6; color: #f08c00; }
        .status-accepted { background: #ebfbee; color: #37b24d; }
        .status-rejected { background: #fff5f5; color: #f03e3e; }
        .info-row { margin-bottom: 15px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px; }
        .info-label { font-weight: 600; color: #555; width: 150px; display: inline-block; }
    </style>
</head>
<body>
    <?php include_once('includes/header.php');?>
    
    <div class="page-header" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">Appointment Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="detail-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="detail-card">
                        <div class="pull-right">
                            <?php 
                            if($row['Status'] == "") {
                                echo '<span class="status-badge status-pending">Pending Approval</span>';
                            } elseif($row['Status'] == "1") {
                                echo '<span class="status-badge status-accepted">Appointment Accepted</span>';
                            } elseif($row['Status'] == "2") {
                                echo '<span class="status-badge status-rejected">Appointment Rejected</span>';
                            }
                            ?>
                        </div>
                        <h3>Booking #<?php echo $row['AptNumber']; ?></h3>
                        <hr>
                        
                        <div class="info-row">
                            <span class="info-label">Customer Name:</span>
                            <span><?php echo $row['Name']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email Address:</span>
                            <span><?php echo $row['Email']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Phone Number:</span>
                            <span><?php echo $row['PhoneNumber']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Appointment Date:</span>
                            <span><?php echo date("d M Y", strtotime($row['AptDate'])); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Appointment Time:</span>
                            <span><?php echo $row['AptTime']; ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Booking Date:</span>
                            <span><?php echo $row['ApplyDate']; ?></span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Services:</span>
                            <div style="margin-left: 150px; margin-top: -20px;">
                                <ul class="list-unstyled">
                                    <?php 
                                    $s_query = mysqli_query($con, "SELECT tblservices.ServiceName, tblservices.Cost FROM tblappointment_services JOIN tblservices ON tblappointment_services.ServiceID = tblservices.ID WHERE tblappointment_services.AppointmentNumber = '$aptno'");
                                    $total_cost = 0;
                                    while($s_row = mysqli_fetch_array($s_query)) {
                                        $total_cost += $s_row['Cost'];
                                        echo "<li><i class='fa fa-check-circle text-success'></i> {$s_row['ServiceName']} (₹{$s_row['Cost']})</li>";
                                    }
                                    ?>
                                </ul>
                                <strong>Total: ₹<?php echo $total_cost; ?></strong>
                            </div>
                        </div>

                        <?php if($row['Remark']): ?>
                        <div class="well" style="margin-top: 20px;">
                            <strong>Admin Remark:</strong>
                            <p><?php echo $row['Remark']; ?></p>
                            <small class="text-muted">Updated on: <?php echo $row['RemarkDate']; ?></small>
                        </div>
                        <?php endif; ?>

                        <div class="text-center" style="margin-top: 30px;">
                            <a href="dashboard.php" class="btn btn-default">Back to Dashboard</a>
                            <?php if($row['Status'] == ""): ?>
                                <a href="appointment.php?edit_apt=<?php echo $row['AptNumber']; ?>" class="btn btn-warning">Edit Appointment</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
