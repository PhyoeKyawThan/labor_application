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
    foreach(str_split($number) as $num){
        $result .= $burmese_number[$num];
    }
    return $result;
}
function upload_multiples()
{
    $uploadDir = __DIR__ . '/static/uploads/';
    $returnPaths = [];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $name = $_FILES['images']['name'][$key];
            $tmp = $_FILES['images']['tmp_name'][$key];
            $error = $_FILES['images']['error'][$key];

            if ($error === UPLOAD_ERR_OK && is_uploaded_file($tmp)) {
                $uniqueName = uniqid() . '_' . basename($name);
                $destination = $uploadDir . $uniqueName;

                if (move_uploaded_file($tmp, $destination)) {
                    $returnPaths[] = 'static/uploads/' . $uniqueName;
                }
            }
        }

        return json_encode($returnPaths);
    } else {
        return false;
    }
}

function serial_number_generator($id)
{
    if ($id > 10) {
        return '0' . $id;
    }
    if ($id < 10) {
        return '00' . $id;
    }
    return (string) $id;
}

?>