<?php
require_once __DIR__ . '/../../commons/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Connection();
    $connection = $db::$connection;
    $google_map = trim($_POST['google_map'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');

    if ($google_map && $phone && $email && $address) {
        $checkQuery = "SELECT id FROM contact ORDER BY id DESC LIMIT 1";
        $result = $connection->query($checkQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];

            $updateQuery = "UPDATE contact SET google_map=?, phone=?, email=?, address = ? WHERE id=?";
            $stmt = $connection->prepare($updateQuery);
            $stmt->bind_param("ssssi", $google_map, $phone, $email, $address, $id);
            $stmt->execute();
        } else {
            $insertQuery = "INSERT INTO contact (google_map, phone, email, address) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($insertQuery);
            $stmt->bind_param("ssss", $google_map, $phone, $email, $address);
            $stmt->execute();
        }
        header("Location: /labor_application/admin/?vr=contact&msg=Contact details updated successfully");
        exit;
    } else {
        header("Location: /labor_application/admin/?vr=contact&error=Please fill in all fields.");
        exit;
    }
}
?>
