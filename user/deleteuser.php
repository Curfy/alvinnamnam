<?php
    header('Content-Type: application/json');
    include ("../db.php");
    
    $id = (int) $_POST['user_id'];
    
    $stmt = $db->prepare("DELETE FROM users WHERE users.id = ?;
    DELETE FROM recipe WHERE recipe.user_id = ?;
    DELETE from ratings WHERE recipe.user_id = ?");
    $result = $stmt->execute([$id, $id, $id]);
    
    // Delete Image
    // unlink('../assets/'.$id.'.png');
    
    //This file is the method for deleting a recipe 
?>