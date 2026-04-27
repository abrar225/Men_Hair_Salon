<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_SESSION['msmsuid'])) {
    header('location:logout.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SalonPro | My Appointments</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i%7cMontserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .dashboard-container { padding: 50px 0; min-height: 80vh; }
        .table-card { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-pending { background: #fff4e6; color: #f08c00; }
        .status-accepted { background: #ebfbee; color: #37b24d; }
        .status-rejected { background: #fff5f5; color: #f03e3e; }
    </style>
</head>
<body>
    <?php include_once('includes/header.php');?>
    
    <div class="page-header" style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-caption">
                        <h2 class="page-title">My Appointments</h2>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="active">Appointments</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="container">
            <div class="table-card">
                <h3>Appointment History</h3>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Appointment No.</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $uid = $_SESSION['msmsuid'];
                            $query = mysqli_query($con, "SELECT * FROM tblappointment WHERE UserID='$uid' ORDER BY ID DESC");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $cnt;?></td>
                                <td><?php echo $row['AptNumber'];?></td>
                                <td><?php 
                                    $aptno = $row['AptNumber'];
                                    $s_query = mysqli_query($con, "SELECT tblservices.ServiceName FROM tblappointment_services JOIN tblservices ON tblappointment_services.ServiceID = tblservices.ID WHERE tblappointment_services.AppointmentNumber = '$aptno'");
                                    $s_list = [];
                                    while($s_row = mysqli_fetch_array($s_query)) {
                                        $s_list[] = $s_row['ServiceName'];
                                    }
                                    echo implode(", ", $s_list);
                                ?></td>
                                <td><?php echo $row['AptDate'];?></td>
                                <td><?php echo $row['AptTime'];?></td>
                                <td>
                                    <?php 
                                    if($row['Status'] == "") {
                                        echo '<span class="status-badge status-pending">Pending</span>';
                                    } elseif($row['Status'] == "1") {
                                        echo '<span class="status-badge status-accepted">Accepted</span>';
                                    } elseif($row['Status'] == "2") {
                                        echo '<span class="status-badge status-rejected">Rejected</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="appointment-detail.php?aptno=<?php echo $row['AptNumber'];?>" class="btn btn-primary btn-xs">View</a>
                                    <?php if($row['Status'] == ""): ?>
                                        <a href="appointment.php?edit_apt=<?php echo $row['AptNumber'];?>" class="btn btn-warning btn-xs">Edit</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $cnt = $cnt + 1; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php');?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
