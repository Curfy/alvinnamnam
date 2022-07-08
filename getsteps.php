<?php
header('Content-Type: application/json');
include ("db.php");

$id = (int) $_POST['id'];
$stmt = $db->prepare("SELECT * FROM steps WHERE recipe_id = ?");
$stmt->execute([$id]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

//This method gets the steps of recipes from steps database (there are many steps).
// I use the recipe_id value in steps database and match them with each recipe_id, if it is a match then those are the steps for it
?>