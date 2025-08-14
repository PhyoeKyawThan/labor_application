<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $serial_number = $_POST['serial_number'] ?? null;
    if(!$serial_number){
        echo json_encode([
            "status" => false,
            "msg" => "Require Serial Number"
        ]);
        exit;
    }

    require_once __DIR__.'/../models/ApplicationModel.php';
    $applicationModel = new ApplicationModel();
    $is_exist = $applicationModel->check_serial($serial_number);
    if(!$is_exist){
        echo json_encode([
            "status" => false,
            "msg" => "Sorry employee with this serial number not found or already employed!",
        ]);
        exit;
    }

    echo json_encode(
        [
            "status" => true,
            "msg" => "Employee Exists"
        ]
        );
        exit;
}
?>