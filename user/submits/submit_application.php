<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . '/../models/ApplicationModel.php';
    require_once __DIR__ . '/../helpers/serial_number_generator.php';
    require_once __DIR__ . '/../helpers/upload_multiples.php';

    $appModel = new ApplicationModel();
    $connection = $appModel->get_connection(); 

    $last_query = $connection->query("SELECT id FROM applications ORDER BY id DESC LIMIT 1");
    $last_id = ($last_query && $last_query->num_rows > 0) ? $last_query->fetch_assoc()['id'] : 1;

    $name = $_POST['name'];
    $region = explode("(", explode(")", urldecode($_POST['region']))[0])[1];
    $nrc = $_POST['nrc_code'] . '/' . $region . '(' . urldecode($_POST['nrc_type']) . ')' . $_POST['nrc_no'];
    $township = $_POST['township'];
    $phone = $_POST['phone'];
    $serial_number = serial_number_generator($last_id);
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $edu_level = $_POST['edu_level'];
    $stable_address = $_POST['stable_address'];

    $upload_dir = __DIR__ . '/../static/uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $imagePath = null;
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['picture']['tmp_name'];
        $fileName = basename($_FILES['picture']['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $upload_dir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = '/static/uploads/' . $newFileName;
            } else {
                die("Error moving the uploaded file.");
            }
        } else {
            die("Upload failed. Allowed types: " . implode(", ", $allowedfileExtensions));
        }
    }

    $images = upload_multiples();

    $user_id = (int)($_SESSION['user_id'] ?? 0);
    if (!$user_id) {
        header('Location: login.php');
        exit;
    }

    // Check if the user has applied before and status
    $existing = $appModel->getApplication($user_id);
    if (!$existing || $existing['status'] === "Rejected") {
        $appModel->table_datas = [
            $name,
            $nrc,
            $serial_number,
            $township,
            $phone,
            $email,
            $birth_date,
            $gender,
            $religion,
            $edu_level,
            $stable_address,
            $imagePath,
            $images,
            $user_id
        ];
        if ($appModel->addApplication()) {
            header("Location: labour_application.php?msg=Register Success");
            exit;
        } else {
            die("Failed to save application.");
        }
    } else {
        header("Location: labour_application.php?msg=Already Registered");
        exit;
    }
}
?>
