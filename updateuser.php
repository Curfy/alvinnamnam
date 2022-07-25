<?php
header('Content-Type: application/json');
include ("db.php");

$userid = (int) $_POST['userid'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$useremail = $_POST['email'];
$userabout = $_POST['about'];
$image = $_POST['image'];

if($image == NULL){
    $statement = "UPDATE users SET firstname='$fname', lastname='$lname', email='$useremail', description='$userabout' WHERE id='$userid'";
}else{
    $statement = "UPDATE users SET firstname='$fname', lastname='$lname', email='$useremail', description='$userabout', image='$image' WHERE id='$userid'";
}

$stmt = $db->prepare($statement);
$stmt->execute([]);

echo json_encode(['code' => 'success']);
?>