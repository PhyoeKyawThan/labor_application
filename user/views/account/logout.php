<?php
session_start();
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['type']);
        unset($_SESSION['applied']);
        header("Location: /labor_application/user/?vr=account");
        exit;
    }
?>