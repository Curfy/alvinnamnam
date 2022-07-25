<?php
/*Create API*/
header('Content-Type: application/json');

include("../db.php");

$user_id = (int)$_POST['user_id'];
$recipe_id = (int)$_POST['recipe_id'];
$recipe_name = $_POST['recipe_name'];
$recipe_description = $_POST['recipe_description'];
$servings = (int) $_POST['recipe_servings'];
$cook_time = (int) $_POST['recipe_cook'];
$img_name = $_POST['recipe_img'];
$category = $_POST['recipe_category'];
$date = date('Y-m-d');
$stmt = $db->prepare("INSERT into recipe (user_id, recipe_id, recipe_name, recipe_description, servings, cook_time, img_name, category, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$result = $stmt->execute([$user_id, $recipe_id, $recipe_name, $recipe_description, $servings, $cook_time, $img_name, $category, $date]);

if($result){
    echo json_encode([
    'code' => '201'
    ]);
}else{
    echo json_encode([
        'code' => '400'
        ]);
}


?>