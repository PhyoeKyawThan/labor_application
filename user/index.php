<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__.'/models/UserModel.php';
require_once __DIR__.'/models/ApplicationModel.php';

define('BASE_VIEW_PATH', __DIR__ . '/views');
$current_path = $_SERVER['REQUEST_URI'];
$view = isset($_GET['vr']) ? $_GET['vr'] : 'home';

$views = ['home', 'applications', 'about', 'contact', 'account', 'about'];

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
