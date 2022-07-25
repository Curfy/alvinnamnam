<?php
    header('Content-Type: application/json');
    include ("../db.php");
    
    $id = (int) $_POST['recipe_id'];
    
    $stmt = $db->prepare("DELETE recipe, ingredients, ratings, steps
    FROM recipe
    INNER JOIN ingredients ON ingredients.recipe_id = recipe.recipe_id
    INNER JOIN ratings ON ratings.recipe_id = recipe.recipe_id
    INNER JOIN steps ON steps.recipe_id = recipe.recipe_id
    WHERE recipe.recipe_id = ?;");
    $result = $stmt->execute([$id]);
    
    // Delete Image
    unlink('../assets/'.$id.'.png');
    
    //This file is the method for deleting a recipe 
?>