<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #6b7280;
        --text-color: #1f2937;
        --background-color: #f9fafb;
        --card-bg-color: #ffffff;
        --border-color: #e5e7eb;
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --border-radius: 0.75rem;
    }
    #account-details {
        position: relative;
        /* max-width: 500px; */
        width: 90%;
        /* padding: 2rem; */
        background-color: var(--card-bg-color);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    #account-details h1 {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 2rem;
        color: var(--primary-color);
    }

    .logout-link {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        text-decoration: none;
        color: var(--secondary-color);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s ease-in-out;
    }

    .logout-link:hover {
        color: #ef4444;
    }

    .field-group {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }

    .field-group .icon {
        color: var(--secondary-color);
        font-size: 1.1rem;
        min-width: 1.5rem; /* Ensures icons are aligned */
        text-align: center;
    }

    .field-group label {
        flex-grow: 1;
        font-size: 1rem;
        font-weight: 500;
        color: var(--secondary-color);
        white-space: nowrap;
    }

    .field-group input {
        flex-grow: 2;
        padding: 0.5rem;
        font-size: 1rem;
        background-color: transparent;
        border: none;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-color);
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    
    .field-group input:focus {
        outline: none;
        border-bottom-color: var(--primary-color);
        box-shadow: 0 1px 0 0 var(--primary-color);
    }

    .actions {
        margin-top: 2rem;
        text-align: center;
    }

    .actions input[type="submit"] {
        padding: 0.75rem 1.5rem;
        background-color: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: background-color 0.2s ease-in-out;
    }

    .actions input[type="submit"]:hover {
        background-color: #316ceb;
    }
</style>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $userModel = new UserModel();
    $userModel->table_datas = [
        $_POST['username'] ?? $_SESSION['username'],
        $_POST['email'] ?? $_SESSION['email'],
        $_SESSION['user_id'] ?? die("Sorry you can't update unless login")
    ];
    if($userModel->updateUserDetail()){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $msg = "User information Updated!";
    }
}

?>
<form class="card" id="account-details" action="" method="post">
    <a href="<?= BASE_URL ?>/views/account/logout.php" class="logout-link">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
    <h1><i class="fas fa-user-circle"></i> Account Details</h1>
     <?= isset($msg) && $msg ? "<p style='color: green;'>$msg</p>" : '' ?>
    <div class="field-group">
        <i class="fas fa-user icon"></i>
        <label for="username">Name:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($_SESSION['username']) ?>">
    </div>

    <div class="field-group">
        <i class="fas fa-envelope icon"></i>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_SESSION['email']) ?>">
    </div>

    <div class="field-group">
        <i class="fas fa-id-badge icon"></i>
        <label for="account-type">Account Type:</label>
        <input type="text" id="account-type" value="<?= htmlspecialchars(ucfirst($_SESSION['type'])) ?>" readonly>
    </div>

    <div class="actions">
        <input type="submit" value="Save">
    </div>
</form>