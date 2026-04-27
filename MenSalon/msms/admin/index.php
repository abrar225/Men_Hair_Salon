<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $adminuser = $_POST['username'];
    $password = $_POST['password'];
    
    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($con, "SELECT ID, Password FROM tbladmin WHERE UserName = ?");
    mysqli_stmt_bind_param($stmt, "s", $adminuser);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_array($result)) {
        // Verify hashed password
        if(password_verify($password, $row['Password'])) {
            $_SESSION['bpmsaid'] = $row['ID'];

            if(isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(16));
                $update_token = mysqli_prepare($con, "UPDATE tbladmin SET remember_token = ? WHERE ID = ?");
                mysqli_stmt_bind_param($update_token, "si", $token, $row['ID']);
                mysqli_stmt_execute($update_token);
                setcookie("admin_remember_me", $token, time() + (30 * 24 * 60 * 60), "/"); // 30 days
            }

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalonPro | Admin Login</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
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
            --border-radius: 8px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fefae0;
            color: var(--dark);
            line-height: 1.6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://images.unsplash.com/photo-1600334129128-685c5582fd35?q=80&w=1000');
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
            background-color: rgba(254, 250, 224, 0.9);
        }
        
        .login-container {
            display: flex;
            max-width: 1000px;
            width: 90%;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .login-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-illustration::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .login-illustration::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .salon-tools {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }
        
        .salon-tool {
            background: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .salon-tool i {
            font-size: 24px;
            color: var(--primary);
        }
        
        .login-illustration h2 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            margin-bottom: 15px;
            text-align: center;
            z-index: 1;
            font-weight: 600;
        }
        
        .login-illustration p {
            text-align: center;
            opacity: 0.9;
            z-index: 1;
            max-width: 80%;
        }
        
        .login-form {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-header {
            margin-bottom: 40px;
            text-align: center;
        }
        
        .login-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: var(--gray);
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(212, 163, 115, 0.2);
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            text-align: center;
        }
        
        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 163, 115, 0.3);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .login-footer {
            margin-top: 30px;
            text-align: center;
        }
        
        .login-footer a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: var(--danger);
            text-align: center;
            margin-bottom: 20px;
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-15px);
            }
            100% {
                transform: translateY(0px);
            }
        }
        
        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }
            20%, 60% {
                transform: translateX(-5px);
            }
            40%, 80% {
                transform: translateX(5px);
            }
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 95%;
            }
            
            .login-illustration {
                padding: 30px 20px;
            }
            
            .login-form {
                padding: 40px 30px;
            }
            
            .login-illustration::before,
            .login-illustration::after {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-illustration">
            <div class="salon-tools">
                <div class="salon-tool"><i class="fas fa-scissors"></i></div>
                <div class="salon-tool"><i class="fas fa-air-freshener"></i></div>
                <div class="salon-tool"><i class="fas fa-cut"></i></div>
                <div class="salon-tool"><i class="fas fa-spa"></i></div>
            </div>
            <h2>SalonPro Admin</h2>
            <p>Manage your salon appointments, staff, and services with our professional tools</p>
        </div>
        
        <div class="login-form">
            <div class="login-header">
                <h1>Welcome Back</h1>
                <p>Please enter your credentials to access the salon dashboard</p>
            </div>
            
            <?php if(isset($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
                
                <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: -15px;">
                    <input type="checkbox" name="remember" id="remember" style="width: 18px; height: 18px;">
                    <label for="remember" style="margin-bottom: 0;">Remember Me</label>
                </div>
                
                <button type="submit" name="login" class="btn">Sign In</button>
                
                <div class="login-footer">
                    <p>
                        <a href="forgot-password.php">Forgot password?</a> | 
                        <a href="../index.php">Back to Home</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Add focus effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#d4a373';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#6c757d';
            });
        });
    </script>
</body>
</html>