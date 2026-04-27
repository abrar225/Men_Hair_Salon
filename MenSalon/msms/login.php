<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $stmt = mysqli_prepare($con, "SELECT ID, Name, Password FROM tblcustomers WHERE Email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_array($result)) {
        if(password_verify($password, $row['Password'])) {
            $_SESSION['msmsuid'] = $row['ID'];
            $_SESSION['msmsname'] = $row['Name'];

            if(isset($_POST['remember'])) {
                $token = bin2hex(random_bytes(16));
                $update_token = mysqli_prepare($con, "UPDATE tblcustomers SET remember_token = ? WHERE ID = ?");
                mysqli_stmt_bind_param($update_token, "si", $token, $row['ID']);
                mysqli_stmt_execute($update_token);
                setcookie("remember_me", $token, time() + (30 * 24 * 60 * 60), "/"); // 30 days
            }

            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalonPro | Login</title>
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
        
        .login-card {
            background: white;
            width: 100%;
            max-width: 450px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }
        
        .card-header {
            background: var(--primary);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        
        .card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .card-body {
            padding: 40px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
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
            padding: 12px 15px 12px 45px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-size: 15px;
            transition: var(--transition);
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }
        
        .form-control:focus + i {
            color: var(--primary);
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
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
        
        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 163, 115, 0.4);
        }
        
        .card-footer {
            padding: 20px 40px 40px;
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
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
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
    <div class="login-card">
        <div class="card-header">
            <h2>Welcome Back</h2>
            <p>Login to manage your appointments</p>
        </div>
        <div class="card-body">
            <?php if(isset($error)): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="post">
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <div class="form-group" style="display: flex; align-items: center; gap: 10px;">
                    <input type="checkbox" name="remember" id="remember" style="width: 18px; height: 18px;">
                    <label for="remember" style="margin-bottom: 0;">Remember Me</label>
                </div>
                <button type="submit" name="login" class="btn-login">Sign In</button>
            </form>
        </div>
        <div class="card-footer">
            <p>Don't have an account? <a href="signup.php">Create Account</a></p>
            <p style="margin-top: 15px;"><a href="index.php" style="color: var(--gray); font-size: 14px;"><i class="fas fa-arrow-left"></i> Back to Home</a></p>
        </div>
    </div>
</body>
</html>
