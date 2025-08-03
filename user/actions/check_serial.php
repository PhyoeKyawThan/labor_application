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
    $application = $applicationModel->check_serial($serial_number);
    if(!isset($application['id'])){
        echo json_encode([
            "status" => false,
            "msg" => "Sorry employee with this serial number not found!",
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