<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/labor_application/user/static/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>User Portal</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header {
            background-color: #1e3a8a;
            color: white;
            padding: 10px 20px;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-left img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: white;
        }

        .header-left h1 {
            font-size: 1.2rem;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Nav styling */
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        nav ul li a:hover {
            color: #facc15;
        }

        /* Hamburger icon */
        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
            background: none;
            border: none;
            color: white;
        }

        /* Mobile styles */
        @media (max-width: 768px) {
            nav {
                position: absolute;
                top: 70px;
                left: 0;
                width: 100%;
                background-color: #1e3a8a;
                display: none;
                flex-direction: column;
                padding: 10px 0;
                animation: slideDown 0.3s ease;
            }

            nav.show {
                display: flex;
            }

            nav ul {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }

            .menu-toggle {
                display: block;
            }
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
<header>
    <div class="header-container">
        <div class="header-left">
            <img src="/labor_application/static/images/output-onlinepngtools.png" alt="">
            <h1>အလုပ်သမားဝန်ကြီးဌာန</h1>
        </div>
        <button class="menu-toggle" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>
        <?php require_once __DIR__ . '/nav.php'; ?>
    </div>
</header>

<script>
    function toggleMenu() {
        document.querySelector('nav').classList.toggle('show');
    }
</script>
