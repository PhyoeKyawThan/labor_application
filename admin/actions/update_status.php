<?php

require_once __DIR__ . '/../../db.php';


$response = [];
if (isset($_POST['status'], $_POST['id'], $_POST['message'])) {
    try {
        $query = $connection->prepare('UPDATE labor SET status = ?, message = ? WHERE id = ?');
        $query->bind_param('ssi', $_POST['status'], $_POST['message'], $_POST['id']);

    } catch (Exception $e) {
        die('' . $e->getMessage());
    }
    if ($query->execute()) {
        $response = [
            'success' => true,
            'message' => 'Status updated successfully.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Database execution failed.'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid input.'
    ];
}
header("Location: ../view_labor.php?id=" . $_POST['id'] . "?msg=" . json_encode($response));
exit;
