<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Check if email already exists
    $check_stmt = mysqli_prepare($con, "SELECT ID FROM tblcustomers WHERE Email = ?");
    mysqli_stmt_bind_param($check_stmt, "s", $email);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);
    
    if(mysqli_stmt_num_rows($check_stmt) > 0) {
        $error = "Email already registered. Please login.";
    } else {
        // Insert new customer
        $stmt = mysqli_prepare($con, "INSERT INTO tblcustomers (Name, Email, MobileNumber, Password) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $mobile, $password);
        
        if(mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Account created successfully. Please login.');</script>";
            echo "<script>window.location.href='login.php'</script>";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalonPro | Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #d4a373;
            --primary-dark: #c08552;
            --secondary: #a98467;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --danger: #dc3545;
            --border-radius: 12px;
            --box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fefae0 0%, #faedcd 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .signup-card {
            background: white;
            width: 100%;
            max-width: 500px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }
        
        .card-header {
            background: var(--primary);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            margin-bottom: 5px;
        }
        
        .card-body {
            padding: 30px 40px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--dark);
            font-size: 14px;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            transition: var(--transition);
        }
        
        .form-control {
            width: 100%;
            padding: 10px 15px 10px 45px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .form-control:focus + i {
            color: var(--primary);
        }
        
        .btn-signup {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
        }
        
        .btn-signup:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
        }
        
        .card-footer {
            padding: 20px 40px 30px;
            text-align: center;
            border-top: 1px solid #eee;
        }
        
        .card-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .error-msg {
            background: #ffe3e3;
            color: #d63031;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            text-align: center;
            border: 1px solid #ffb8b8;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="signup-card">
        <div class="card-header">
            <h2>Join SalonPro</h2>
            <p>Create an account to book and track appointments</p>
        </div>
        <div class="card-body">
            <?php if(isset($error)): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="post">
                <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <div class="input-group">
                        <input type="text" name="mobile" class="form-control" placeholder="9988776655" maxlength="10" pattern="[0-9]{10}" required>
                        <i class="fas fa-phone"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn-signup">Create Account</button>
            </form>
        </div>
        <div class="card-footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
            <p style="margin-top: 10px;"><a href="index.php" style="color: var(--gray); font-size: 14px;"><i class="fas fa-arrow-left"></i> Back to Home</a></p>
        </div>
    </div>
</body>
</html>
