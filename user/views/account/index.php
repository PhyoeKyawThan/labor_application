<?php
if (isset($_GET['auth'])) {
    $_GET['auth'] == 'signup' ? require_once __DIR__ . '/signup.php' : require_once __DIR__ . '/login.php';
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href = '$current_path&auth=login'</script>";
    exit;
}
$model = new ApplicationModel();
$application = $model->getApplication($_SESSION['user_id'], $_SESSION['type']);

?>


<main>
    <?php
        if(isset($_GET['a'])){
            require 'applications.php';
        }else{
            require 'profile.php';
        }
    ?>
</main>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f9fafb;
        color: #1f2937;
    }

    main {
        padding: 40px 20px;
        max-height: 100vh;
        overflow: scroll;
    }

    .card {
        max-width: 750px;
        margin: 20px auto;
        background-color: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        padding: 28px;
        display: flex;
        flex-direction: column;
        gap: 18px;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .card h1 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #111827;
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .card div {
        font-size: 1rem;
        color: #374151;
    }

    .card div b {
        font-weight: 600;
        color: #1f2937;
        background-color: #f3f4f6;
        padding: 4px 10px;
        border-radius: 6px;
    }

    /* Status badges */
    .status {
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
    }

    .status.Pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status.Approved {
        background-color: #dcfce7;
        color: #166534;
    }

    .status.Rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .status["Department Approvel"] {
        background-color: #e0f2fe;
        color: #075985;
    }

    /* Remarks */
    .card p {
        margin-top: 6px;
        padding: 10px 14px;
        background-color: #f9fafb;
        border-left: 4px solid #d1d5db;
        border-radius: 6px;
        color: #475569;
        font-size: 0.95rem;
    }

    /* Links */
    a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    /* Top right logout */
    #account-details a {
        align-self: flex-end;
        font-size: 0.9rem;
        background: #f1f5f9;
        padding: 6px 12px;
        border-radius: 6px;
        transition: background 0.2s ease;
    }

    #account-details a:hover {
        background: #e2e8f0;
    }
</style>