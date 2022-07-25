<?php
header('Content-Type: application/json');
include ("db.php");

$search = $_POST['search'];
$statement = '';
if($search != ''){
    if ($search == 'all'){
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        ON users.id = recipe.user_id
        JOIN ratings
        WHERE recipe.recipe_id = ratings.recipe_id
        GROUP BY recipe.recipe_id";
    }
    else if ($search == 'mostRating'){
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        ON users.id = recipe.user_id
        JOIN ratings
        WHERE recipe.recipe_id = ratings.recipe_id
        GROUP BY recipe.recipe_id
        ORDER BY average DESC";
    }
    else if ($search == 'leastRating'){
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        ON users.id = recipe.user_id
        JOIN ratings
        WHERE recipe.recipe_id = ratings.recipe_id
        GROUP BY recipe.recipe_id
        ORDER BY average ASC";
    }
    else if ($search == 'noRating'){
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        ON users.id = recipe.user_id
        JOIN ratings
        WHERE recipe.recipe_id = ratings.recipe_id
        GROUP BY recipe.recipe_id";
    }
    else if ($search == 'mostNewest'){
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        ON users.id = recipe.user_id
        JOIN ratings
        WHERE recipe.recipe_id = ratings.recipe_id
        GROUP BY recipe.recipe_id
        ORDER BY recipe.id DESC";
    }
    else if ($search == 'leastNewest'){
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        ON users.id = recipe.user_id
        JOIN ratings
        WHERE recipe.recipe_id = ratings.recipe_id
        GROUP BY recipe.recipe_id
        ORDER BY recipe.id ASC";
    }
    else{
        $statement = "SELECT *, COUNT(ratings.rating) as ratingcount, AVG(NULLIF(ratings.rating,0)) as average
        FROM users
        JOIN recipe
        JOIN ingredients 
        JOIN ratings
        ON users.id = recipe.user_id
        WHERE recipe.recipe_id = ratings.recipe_id
        AND (recipe.recipe_id = ingredients.recipe_id)
        AND (recipe.recipe_name LIKE '%".$search."%' OR ingredients.ingredient LIKE '%".$search."%') 
        GROUP BY ingredients.recipe_id
        ORDER BY average DESC;";
    }
}else{
    $statement = "";
}


$stmt = $db->prepare($statement);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



echo json_encode($result);

//This file is the method for getting the datasets of a recipe (This basically loads the recipes in the flashcards on recipe page)
?>