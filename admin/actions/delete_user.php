<?php
require_once __DIR__.'/../../db.php';

$id = $_GET['id'];
$stmt = $connection->prepare("DELETE FROM user WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: ../users.php?msg=Deleted!");
?>
