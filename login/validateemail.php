<?php

header('Content-Type: application/json');

include ("../db.php");

$email = $_POST['sender'];
// $email = "zenocyfox@gmail.com";
$emailencoded = base64_encode($email);


$stmt = $db->prepare("SELECT email from users where email = '$emailencoded'");
$result = $stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result[0]){
    echo json_encode([
        'code' => '201'
        ]);
}else{
    echo json_encode([
        'code' => '400'
        ]);
}
?>