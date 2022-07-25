<?php
header('Content-Type: application/json');
include ("../db.php");

$search = $_POST['search'];
$statement = '';
if($search == 'all'){
    $statement = "SELECT * FROM users ORDER by users.permissions DESC, users.id ASC";
}else{
    $statement = "SELECT *, recipe.date AS recipedate, users.date AS joindate
    FROM users
    LEFT JOIN recipe
    ON users.id = recipe.user_id
    WHERE users.id = '$search'
    GROUP BY recipe.recipe_id
	ORDER BY recipedate DESC";
}
$stmt = $db->prepare($statement);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);

?>