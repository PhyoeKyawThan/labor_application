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
    $existing = $appModel->getApplication($user_id, $_SESSION['type']);

    if (!$existing) {
        header("Location: /labor_application/user/?vr=applications&msg=Incorrect Rejected Application Submitted!");
        exit;
    }

    $name = $_POST['name'];
    $fatherName = $_POST['father_name'];
    $region = explode("(", explode(")", urldecode($_POST['region']))[0])[1];
    $nrc_str = $_POST['nrc_code'] . '/' . $region . '(' . urldecode($_POST['nrc_type']) . ')' . $_POST['nrc_no'];
    $township = $_POST['township'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $edu_level = $_POST['edu_level'];
    $stable_address = $_POST['stable_address'];
    $update_time = (new DateTime())->format('Y-m-d');

    $BASE_STATIC = __DIR__ . '/../..';
    $new_picture = $existing['picture'];
    $new_images = json_decode($existing['images'], true);


    if ($_FILES['picture']['size'] > 0) {
        @unlink($BASE_STATIC . $existing['picture']);
        $new_picture = upload('picture');
    }

    if ($_FILES['nrc']['size'][0] > 0) {
        if (!$new_images) {
            foreach ($new_images['nrc'] as $n) {
                @unlink($BASE_STATIC . '/' . $n);
            }
        }
        $new_images['nrc'] = upload_multiples('nrc');
    }


    if ($_FILES['certificate']['size'] > 0) {
        @unlink($BASE_STATIC . '/' . $new_images['certificate']);
        $new_images['certificate'] = upload('certificate');
    }


    $appModel->table_datas = [
        "name" => $name,
        "fatherName" => $fatherName,
        "nrc" => $nrc_str,
        "township" => $township,
        "phone" => $phone,
        "email" => $email,
        "birth_date" => $birth_date,
        "gender" => $gender,
        "religion" => $religion,
        "edu_level" => $edu_level,
        "stable_address" => $stable_address,
        "picture" => $new_picture,
        "images" => json_encode($new_images),
        "updated_at" => $update_time,
        "is_resubmit" => true,
        "status" => "Resubmitted",
        "user_id" => $user_id
    ];
    if ($appModel->updateApplication()) {
        $_SESSION['applied'] = true;
        header("Location: /labor_application/user/?vr=applications&msg=Resubmittion Success");
        exit;
    } else {
        die("Failed to save application.");
    }
}
?>