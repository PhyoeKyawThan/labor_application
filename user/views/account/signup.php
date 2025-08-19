<style>
    .auth-container {
        background: #fff;
        padding: 2rem 2.5rem;
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        margin: auto;
    }

    .auth-container h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }

    .auth-container form {
        display: flex;
        flex-direction: column;
    }

    .auth-container input,
    .auth-container select {
        padding: 10px 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
    }

    .auth-container button {
        padding: 10px;
        background-color: #1d72b8;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .auth-container button:hover {
        background-color: #155d93;
    }
    .auth-container a{
        text-align: center;
        display: block;
        margin: 10px auto;
    }
</style>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = new UserModel();
        $user->table_datas = [
            $_POST['username'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT),
            $_POST['type'],
        ];
        $register = $user->register();
        if($register['success'] ?? null){
            $msg = "Account Created";
            echo "<script>location.window.href = '/labor_application/user/?vr=account&auth=login&msg=Account Successfully created! Login Here'; </script>";
            exit;
        }

        if($register['mail_exists'] ?? null){
            $mail_exists = "Email Already Exists!";
        }
    }
?>
<div class="auth-container">
    <h2>Signup</h2>
    <p style="color: red;"><?= $mail_exists ?? '' ?></p>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />

        <select name="type" required>
            <option value="">Select Type</option>
            <option value="employee">Employee</option>
            <option value="employer">Employer</option>
        </select>

        <button type="submit">Create Account</button>
        <a href="/labor_application/user/?vr=account&auth=login">Already have an account? Login here!</a>
    </form>
</div>