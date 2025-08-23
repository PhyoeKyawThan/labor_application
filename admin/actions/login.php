<?php
session_start();
if(isset($_POST["username"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username == "admin" && $password == "admin123"){
        $_SESSION['admin_auth'] = $username;
        header("Location: ../index.php");
        exit;
    }
    header('Location: ../login.php?err-msg=Incorrect Username or Password!');
}