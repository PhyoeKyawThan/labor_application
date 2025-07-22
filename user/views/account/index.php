<main>
    <?php 
        if(isset($_GET['auth'])){
            $_GET['auth'] == 'signup' ? require_once __DIR__.'/signup.php' : require_once __DIR__.'/login.php';
            exit;
        }
        if(!isset($_SESSION['user_id'])){
            header("Location: $current_path&auth=login");
            exit;
        }
    ?>
    <style>
        #account-details, #application-status{
            width: 60%;
            margin: 10px auto;
            padding: 20px;
            box-shadow: 0 0 10px 5px #0057b32c;
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-radius: 8px;
        }
    </style>
    <div id="account-details">
        <h1>Account Details</h1>
        <div>Name: <b><?= $_SESSION['username'] ?></b></div>
        <div>Email: <b><?= $_SESSION['email'] ?></b></div>
        <div>Account Type: <b><?= $_SESSION['type'] ?></b></div>
    </div>
    <div id="application-status">
        <h1>Applied Application Status</h1>
        <div class="item-card">
            <div>Serial number - 12345</div>
            <div>Name - DomAK</div>
        </div>
    </div>
</main>