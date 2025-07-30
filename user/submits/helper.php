<?php
function burmeseNumberConverter($number)
{
    $burmese_number = [
        '0' => '၀',
        '1' => '၁',
        '2' => '၂',
        '3' => '၃',
        '4' => '၄',
        '5' => '၅',
        '6' => '၆',
        '7' => '၇',
        '8' => '၈',
        '9' => '၉',
        '10' => '၁၀'
    ];
    $result = '';
    foreach (str_split($number) as $num) {
        $result .= $burmese_number[$num];
    }
    return $result;
}
function upload_multiples($flag = null)
{
    $uploadDir = __DIR__ . '/../../static/uploads/' . $flag . '/';
    $returnPaths = [];
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (isset($_FILES[$flag]) && is_array($_FILES[$flag]['name'])) {
        foreach ($_FILES[$flag]['tmp_name'] as $key => $tmp_name) {
            $name = $_FILES[$flag]['name'][$key];
            $tmp = $_FILES[$flag]['tmp_name'][$key];
            $error = $_FILES[$flag]['error'][$key];

            if ($error === UPLOAD_ERR_OK && is_uploaded_file($tmp)) {
                $uniqueName = uniqid() . '_' . basename($name);
                $destination = $uploadDir . $uniqueName;

                if (move_uploaded_file($tmp, $destination)) {
                    $returnPaths[] = 'static/uploads/' . $flag . '/' . $uniqueName;
                }
            }
        }

        return json_encode($returnPaths);
    } else {
        return false;
    }
}

function upload($flag = null)
{
    $upload_dir = __DIR__ . '/../../static/uploads/' . $flag . '/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $imagePath = null;
    if (isset($_FILES[$flag]) && $_FILES[$flag]['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$flag]['tmp_name'];
        $fileName = basename($_FILES[$flag]['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $upload_dir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = '/static/uploads/' . $flag . '/' . $newFileName;
                return $imagePath;
            } else {
                die("Error moving the uploaded file.");
            }
        } else {
            die("Upload failed. Allowed types: " . implode(", ", $allowedfileExtensions));
        }
    }
}

function serial_number_generator($connection)
{
    $query = mysqli_query($connection, "SELECT * FROM applications ORDER BY id DESC LIMIT 1");
    $latest_application = mysqli_fetch_assoc($query);
    if (isset($latest_application['id'])):
        $latest_application_date = new DateTime($latest_application['registration_date']);
        $latest_application_yr = $latest_application_date->format('Y');
        $current_date = new DateTime();
        $current_year = $current_date->format('Y');

        if ($current_year != $latest_application_yr) {
            return '001';
        } else {
            $latest_app_serial_num = (int) $latest_application['serial_number'] ?? 0;
            if ($latest_app_serial_num > 10) {
                return '0' . $latest_app_serial_num + 1;
            }
            if ($latest_app_serial_num < 10) {
                return '00' . $latest_app_serial_num + 1;
            }
            return (string) $latest_app_serial_num + 1;

        }
    endif;
    return '001';
}


?>