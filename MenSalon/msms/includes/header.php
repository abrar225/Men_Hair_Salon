<?php
session_start();
?>
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SalonPro</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="service-list.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="appointment.php">Book Appointment</a></li>
                <?php if (isset($_SESSION['msmsuid'])): 
                    $uid = $_SESSION['msmsuid'];
                    $cart_count_query = mysqli_query($con, "SELECT COUNT(ID) as total FROM tblcart WHERE UserID = '$uid'");
                    $cart_count_data = mysqli_fetch_array($cart_count_query);
                    $cart_count = $cart_count_data['total'];
                ?>
                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> <span class="badge"><?php echo $cart_count; ?></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> <?php echo explode(' ', $_SESSION['msmsname'])[0]; ?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="dashboard.php">My Appointments</a></li>
                            <li><a href="profile.php">My Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li><a href="login.php" class="btn-login-nav">Login</a></li>
                    <li><a href="signup.php" class="btn-signup-nav">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<style>
    .badge {
        background-color: #d4a373;
        color: white;
        font-size: 10px;
        position: relative;
        top: -10px;
        left: -5px;
    }
    .navbar-default {
        background-color: #fff;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 10px 0;
    }
    .navbar-brand {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 24px;
        color: #d4a373 !important;
    }
    .nav-login-nav {
        color: #d4a373 !important;
        font-weight: 600;
    }
    .btn-signup-nav {
        background: #d4a373;
        color: #fff !important;
        border-radius: 20px;
        margin-top: 10px;
        padding: 5px 15px !important;
        margin-left: 10px;
        transition: 0.3s;
    }
    .btn-signup-nav:hover {
        background: #c08552;
    }
    @media (max-width: 767px) {
        .btn-signup-nav {
            margin-left: 0;
            display: inline-block;
        }
    }
</style>