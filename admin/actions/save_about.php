<?php
require_once __DIR__ . '/../../commons/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connectionModel = new Connection();
    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');
    $connection = $connectionModel::$connection;
    if ($title && $body) {
        $checkQuery = "SELECT id FROM about ORDER BY id DESC LIMIT 1";
        $result = $connection->query($checkQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];

            $updateQuery = "UPDATE about SET title=?, body=? WHERE id=?";
            $stmt = $connection->prepare($updateQuery);
            $stmt->bind_param("ssi", $title, $body, $id);
            $stmt->execute();
        } else {
            $insertQuery = "INSERT INTO about (title, body) VALUES (?, ?)";
            $stmt = $connection->prepare($insertQuery);
            $stmt->bind_param("ss", $title, $body);
            $stmt->execute();
        }

        header("Location: /labor_application/admin/?vr=about&msg=About page updated successfully");
        exit;
    } else {
        header("Location: /labor_application/admin/?vr=about&error=Please fill in all fields.");
        exit;
    }
} else {
    header("Location: /labor_application/admin/?vr=about&");
    exit;
}
?>
