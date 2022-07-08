<?php
header('Content-Type: application/json');
include ("db.php");

$stmt = $db->prepare("SELECT users.firstname, ratings.user_id, ratings.recipe_id, ratings.rating, ratings.comments FROM users INNER JOIN ratings ON users.id = ratings.user_id");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

//This file is the method for fetching all the recipe data's such as 
// -recipe name (string format)
// -recipe id (i use this to connect each ratings and comments to a specific recipe) (int format)
// -recipe ratings (5 stars example) (int format)
// -recipe comments (string format)
?>