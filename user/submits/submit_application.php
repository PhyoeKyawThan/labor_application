<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = (int) ($_SESSION['user_id'] ?? 0);
    if (!$user_id) {
        header('Location: login.php');
        exit;
    }
    require_once __DIR__ . '/../models/ApplicationModel.php';
    require_once __DIR__ . '/helper.php';

    $appModel = new ApplicationModel();
    $connection = $appModel->get_connection();

    $name = $_POST['name'];
    $fatherName = $_POST['father_name'];
    $region = explode("(", explode(")", urldecode($_POST['region']))[0])[1];
    $nrc_str = $_POST['nrc_code'] . '/' . $region . '(' . urldecode($_POST['nrc_type']) . ')' . $_POST['nrc_no'];
    $township = $_POST['township'];
    $phone = $_POST['phone'];
    $serial_number = serial_number_generator($connection);
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $edu_level = $_POST['edu_level'];
    $stable_address = $_POST['stable_address'];
    $age = $_POST['age'];

    $picture = upload($flag = 'picture');

    $nrc = upload_multiples($flag = 'nrc');

    $certificate = upload($flag = 'certificate');
    // Check if the user has applied before and status
    $existing = $appModel->getApplication($user_id, $_SESSION['type']);
    if (!$existing || $existing['status'] === "Rejected") {
        $appModel->table_datas = [
            $name,
            $fatherName,
            $age,
            $nrc_str,
            $serial_number,
            $township,
            $phone,
            $email,
            $birth_date,
            $gender,
            $religion,
            $edu_level,
            $stable_address,
            $picture,
            json_encode(
                [
                    'nrc' => $nrc,
                    'certificate' => $certificate
                ]
            ),
            $user_id
        ];
        // ssssssssssssi'
        if ($appModel->addApplication()) {
            $_SESSION['applied'] = true;

            header("Location: /labor_application/user/?vr=applications&msg=Register Success");
            exit;
        } else {
            die("Failed to save application.");
        }
    } else {
        header("Location: /labor_application/user/?vr=applications&msg=Already Registered");
        exit;
    }
}
?>