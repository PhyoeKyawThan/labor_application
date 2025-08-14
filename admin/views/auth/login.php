<?php
session_start();
require_once __DIR__.'/../../../commons/Connection.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Connection();
    $mysqli = $db::$connection;
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $mysqli->prepare("SELECT id, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $user, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $user;
            header('Location: /labor_application/admin?vr=dashboard');
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "User not found";
    }
    $stmt->close();
}
// echo password_hash("admin123", PASSWORD_DEFAULT);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

       
        .login-container {
            background: #fff;
            padding: 4rem 3rem; 
            border-radius: 12px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); 
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .login-container h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 0.5rem; 
        }
        
        .login-container p.subtitle {
            color: #6b7280;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

      
        .error-message {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            text-align: left;
            font-size: 0.9rem;
        }

        
        .form-group {
            margin-bottom: 1.25rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem; 
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        
        .login-button {
            width: 100%;
            background-color: #2563eb;
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .login-button:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Welcome Back, Login Here</h1>
        <p class="subtitle">Enter your credentials to access the admin dashboard.</p>

        <?php if ($error): ?>
            <div class="error-message">
                ⚠️ <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
    </div>

</body>
</html>