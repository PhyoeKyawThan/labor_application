<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require __DIR__.'/../commons/Connection.php';
define('BASE_VIEW_PATH', __DIR__ . '/views');
define("BASE_URL", '/labor_application/admin');
$current_path = $_SERVER['REQUEST_URI'];
$view = isset($_GET['vr']) ? $_GET['vr'] : 'dashboard';

$views = ['dashboard', 'labors', 'messages', 'report', 'users', 'employer','about', 'contact', 'account'];

if (in_array($view, $views)) {
    $target = BASE_VIEW_PATH . "/$view/index.php";
    if (file_exists($target)) {
        include 'partials/start.php';
        include $target;
        include 'partials/end.php';
        exit;
    } else {
        echo "View file not found.";
        exit;
    }
}

echo "Not Found";
exit;
?>