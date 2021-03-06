<?php
header('Content-Type: application/json');
include ("db.php");

$id = (int) $_POST['id'];

$stmt = $db->prepare("DELETE FROM recipe WHERE recipe_id = ?; DELETE FROM ingredients WHERE recipe_id = ?; DELETE from steps WHERE recipe_id = ?; DELETE from ratings where recipe_id = ?");
$result = $stmt->execute([$id, $id, $id, $id]);

// Delete Image
unlink('./assets/'.$id.'.png');

if($result){
    echo json_encode([
    'code' => '201'
    ]);
}else{
    echo json_encode([
        'code' => '400'
        ]);
}

//This file is the method for deleting a recipe
?>
