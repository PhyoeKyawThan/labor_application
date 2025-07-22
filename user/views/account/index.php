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
        $model = new ApplicationModel();
        $application = $model->getApplication($_SESSION['user_id']);
    ?>

    <style>
        * {
            box-sizing: border-box;
        }

        main {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 20px;
            background: #f8fafc;
            min-height: 100vh;
        }

        .card {
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            padding: 24px 30px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .card h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }

        .card div {
            font-size: 1rem;
            color: #374151;
        }

        .card div b {
            font-weight: 600;
            color: #1f2937;
            background-color: #f1f5f9;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .card .status {
            font-weight: 600;
            color: white;
            background-color: #3b82f6;
            padding: 6px 12px;
            border-radius: 999px;
            display: inline-block;
        }

        .card .status.Approved {
            background-color: #22c55e;
        }

        .card .status.Pending {
            background-color: #f59e0b;
        }

        .card .status.Rejected {
            background-color: #ef4444;
        }

        .card p {
            margin-top: 6px;
            padding: 8px 12px;
            background-color: #f9fafb;
            border-left: 3px solid #cbd5e1;
            border-radius: 6px;
            color: #475569;
        }
    </style>

    <div class="card" id="account-details">
        <h1>Account Details</h1>
        <div>Name: <b><?= $_SESSION['username'] ?></b></div>
        <div>Email: <b><?= $_SESSION['email'] ?></b></div>
        <div>Account Type: <b><?= ucfirst($_SESSION['type']) ?></b></div>
    </div>

    <?php if ($application['id'] ?? null): ?>
        <div class="card" id="application-status">
            <h1>Application Status</h1>
            <div>Serial Number: <b><?= $application['serial_number'] ?></b></div>
            <div>Name: <b><?= $application['name'] ?></b></div>
            <div>Status: <span class="status <?= $application['status'] ?>"><?= $application['status'] ?></span></div>
            <?php if (!empty($application['message'])): ?>
                <div>Remark:<p><?= nl2br(htmlspecialchars($application['message'])) ?></p></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>
