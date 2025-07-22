<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('BASE_VIEW_PATH', __DIR__ . '/views');

$view = isset($_GET['vr']) ? $_GET['vr'] : 'home';

$views = ['home', 'applications', 'about', 'contact', 'account'];

if (in_array($view, $views)) {
    $target = BASE_VIEW_PATH . "/$view/index.php";
    if (file_exists($target)) {
        include 'partials/header.php';
        include $target;
        include 'partials/footer.php';
        exit;
    } else {
        echo "View file not found.";
        exit;
    }
}

echo "Not Found";
exit;
?>
