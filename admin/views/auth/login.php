<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $admin_user = 'admin';
    $admin_pass = 'admin123';

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        *{
            box-sizing: border-box;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; background: #f3f4f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin:0;">

    <div style="background: #fff; padding: 40px 30px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 400px; text-align:center;">
        
        <img src="/labor_application/assets/logo.png" alt="Admin Logo" style="width:100px; margin-bottom:20px;">

        <h2 style="color:#111827; margin-bottom:20px;">Welcome Back, Login Here</h2>

        <?php if($error): ?>
            <div style="background-color:#fee2e2; color:#b91c1c; padding:10px; border-radius:5px; margin-bottom:15px; text-align:center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" style="display:flex; flex-direction:column; gap:15px;">
            <div>
                <label for="username" style="font-weight:600; color:#374151;">Username</label>
                <input type="text" name="username" id="username" required
                    style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;">
            </div>
            <div>
                <label for="password" style="font-weight:600; color:#374151;">Password</label>
                <input type="password" name="password" id="password" required
                    style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:6px; font-size:1rem;">
            </div>
            <input type="submit" value="Login"
                style="background-color:#2563eb; color:#fff; font-weight:600; padding:12px 0; border:none; border-radius:8px; cursor:pointer; transition: background-color 0.3s;">
        </form>
    </div>

</body>
</html>
