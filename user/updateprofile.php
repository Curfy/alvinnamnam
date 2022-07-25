<?php
header('Content-Type: application/json');
include ("../db.php");

$userid = (int) $_POST['userid'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$useremail = $_POST['email'];
$userabout = $_POST['about'];
$permission = (int) $_POST['permission'];
$password = $_POST['password'];
$image = $_POST['image'];

if($image == NULL){
    if($password == NULL){
        $statement = "UPDATE users SET firstname='$fname', lastname='$lname', email='$useremail', description='$userabout', users.permissions='$permission' WHERE id='$userid'";
    }else{
        $statement = "UPDATE users SET firstname='$fname', lastname='$lname', email='$useremail', description='$userabout', password='$password', users.permissions='$permission' WHERE id='$userid'";
    }
}else{
    $statement = "UPDATE users SET firstname='$fname', lastname='$lname', email='$useremail', description='$userabout', password='$password', users.permissions='$permission', image='$image' WHERE id='$userid'";
}

$stmt = $db->prepare($statement);
$stmt->execute([]);


?>