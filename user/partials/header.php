<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/labor_application/user/static/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <title>User Portal</title>
    <style>
        header div {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 20px;
        }

        header div img {
            width: 100px;
            height: 100px;
            background-color: white;
            border-radius: 50%;
            margin: 10px;
        }

        header nav {
            position: absolute;
            right: 100px
        }
    </style>
</head>

<body>
    <header>
        <div>
            <img src="/labor-register/static/images/output-onlinepngtools.png" alt="" srcset="">
            <h1>အလုပ်သမားဝန်ကြီးဌာန</h1>
            <?php
            require_once __DIR__ . '/nav.php';
            ?>
        </div>
    </header>