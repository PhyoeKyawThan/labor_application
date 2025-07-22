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
<div class="auth-container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <a href="/labor_application/user/?vr=account&auth=signup">Create Account</a>
    </form>
</div>