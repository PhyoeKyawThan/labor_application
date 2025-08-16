<?php
require_once __DIR__.'/../../commons/Connection.php';

$db = new Connection();
$connection = $db::$connection;

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

try{
    $query = $connection->prepare('INSERT INTO contact_msg(name, email, subject, message) VALUES(?, ?, ?, ?)');
    $query->bind_param('ssss', $name, $email, $subject, $message);
    $query->execute();
    header('Location: /labor_application/user/?vr=contact&msg=Message Sent');
}catch(Exception $e){
    die(''.$e->getMessage());
}