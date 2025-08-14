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

    .auth-container a {
        text-align: center;
        display: block;
        margin: 10px auto;
    }
</style>
<?php
$msg = $_GET['msg'] ?? null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new UserModel();
    $user->table_datas = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
    ];
    $login = $user->login();
    if ($login['success'] ?? null) {
        $_SESSION['user_id'] = $login['user']['id'];
        $_SESSION['username'] = $login['user']['username'];
        $_SESSION['email'] = $login['user']['email'];
        $_SESSION['type'] = $login['user']['type'];
        $user->user_id = $_SESSION['user_id'];
        if (isset($user->get_registered_application($_SESSION['type'])['id'])) {
            $_SESSION['applied'] = true;
        }else{
            $_SESSION['applied'] = false;
        }
        

        echo "<script>window.location.href = '/labor_application/user/?vr=account&msg=Login Success!'</script>";
        exit;
    }

    if (!$login['success'] ?? null) {
        $err = "Incorrect email or password!";
    }
}
?>
<div class="auth-container">
    <h2>Welcome Back, Login Here</h2>
    <?= $err ?? '' ?>
    <b style="display: block; 
    text-align: center; 
    margin: 8px 0;
    background-color: #1d72b88e; 
    color: white; 
    border-radius: 8px;
    ">
    <?= $msg ?? '' ?></b>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <a href="/labor_application/user/?vr=account&auth=signup">Create Account</a>
    </form>
</div>