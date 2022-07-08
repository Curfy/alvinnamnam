<?php
header('Content-Type: application/json');
include ("../db.php");


$db = new PDO("mysql:host={$db_server};dbname={$db_name};charset=utf8", $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$word = $_POST['word'];
$stmt = $db->prepare("SELECT * FROM entries WHERE word = ?");
$stmt->execute([$word]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

// if($result){
//     echo json_encode([
//         'code' => '201'
//     ]);
// }else{
//     echo json_encode([
//         'code' => '400'
//     ]);
// }

?>