<?php
    if (!isset($_COOKIE['email'])){
        header('Location: ../home/index.php');
    }
?>
<html>

<head>
    <link rel="stylesheet" href="addrecipe.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Playfair+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>

    <meta name="title" content="All-Tasty">
    <meta name="description" content="At All-Tasty, we have our best masterchef, Alvin Patricio managing this website and sharing his own masterchef recipes.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="alvinnamnam.online, alltasty, alltaste, all tasty alvinnamnam, all-tasty alvinnamnam, alvinamnamnam, all-tasty, all, tasty, all tasty, all taste, tasty foods, recipe, recipe website, website, all tasty recipe website, recipe websites, food website, how to, how, create recipe">
    <meta name="author" content="Jaru#4328">
    <meta name="generator" content="Jaru#4328">
    <link rel = "icon" href = "http://alvinnamnam.online/assets/All-Tasty.png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://alvinnamnam.online/">
    <meta property="og:title" content="All-Tasty">
    <meta property="og:description" content="At All-Tasty, we have our best masterchef, Alvin Patricio managing this website and sharing his own masterchef recipes.">
    <meta property="og:image" content="http://alvinnamnam.online/assets/All-Tasty.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://alvinnamnam.online/">
    <meta property="twitter:title" content="All-Tasty">
    <meta property="twitter:description" content="At All-Tasty, we have our best masterchef, Alvin Patricio managing this website and sharing his own masterchef recipes.">
    <meta property="twitter:image" content="http://alvinnamnam.online/assets/All-Tasty.png">
</head>

<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img width="70px" src="../assets/All-Tasty.png" alt="">
                <h1>All Tasty</h1>
            </div>

            <div id="navigation" class="navs">
                <li><a href="../home/index.php">Home</a></li>
                <li><a href="../index.php">Recipes</a></li>
                <li><a href="../about/aboutpage.php">About</a></li>
            </div>

            <div id="loginForm" class="test">
            </div>
        </div>
    </div>

    <!-- <div class="mycontainer">
        <div class="hero">
            <img class="clipart" src="clipart.png" />
        </div>
    </div> -->

    <div class="addrecipe">
        <p class="title">Add Recipe</p>
        <!-- <p class="input_box">Share the happiness</p> -->
        <form action="upload.php" enctype="multipart/form-data" method="POST">
            <fieldset class="fieldset">
                <legend>
                </legend>

                <div class="input_box">
                    <label class="textLabel" for="recipe_name">Recipe Name:</label>
                    <input class="input" type="text" id="recipe_name" name="recipe_name">
                </div>

                <div class="input_box">
                    <label class="textLabel" for="recipe_description">Recipe Description:</label>
                    <textarea class="textarea" id="recipe_description" id="" cols="50" rows="5" maxlength="280"></textarea>
                </div>

                <div class="input_box" id="ingr_box">
                    <span class="textLabel">Ingredients:
                        <button class="ingre_btn" id="subingr" type="button">-</button>
                        <button class="ingre_btn" id="addingr" type="button">+</button>
                    </span>
                    <input class="input" name="ingredients" id=x0 type="text">
                </div>

                <div class="input_box" id="step_box">
                    <span class="textLabel">Steps:
                        <button class="step_btn" id="substep" type="button">-</button>
                        <button class="step_btn" id="addstep" type="button">+</button>
                    </span>
                    <textarea class="textarea" name="steps" id=y0 type="text"></textarea>
                </div>

                <div class="input_box">
                    <span class="textLabel">Image: </span>
                    <input type="file" id="file" accept=".png">
                </div>
                <div class="row input_box">
                    <div class="col">
                        <span class="textLabel">Cook Time: </span>
                            <div class="minservings">
                                <input class="input" type="number" id="recipe_cook" name="recipe_cook" min="1"> mins
                            </div>
                    </div>
                    <div class="col">
                        <span class="textLabel">Servings</span>
                            <div class="minservings">
                                <input class="input" type="number" id="recipe_servings" name="recipe_servings" min="1"> servings
                            </div>
                    </div>
                </div>
                <div class="categ_box">
                    <span class="textLabel">Category: </span>
                    <div class="radio-toolbar">
                        <input type="radio" id="radioStreet" name="radioCategory" value="street">
                        <label for="radioStreet">Street Foods</label>

                        <input type="radio" id="radioDishes" name="radioCategory" value="dish">
                        <label for="radioDishes">Dishes</label>

                        <input type="radio" id="radioDesserts" name="radioCategory" value="dessert">
                        <label for="radioDesserts">Desserts</label>
                    </div>
                </div>


                <div class="submitbtn">
                    <button id="submit" name="submit" class="recipesubmit"> Publish Recipe </button>
                </div>
            </fieldset>

        </form>
    </div>
    <br>
    <br>
    <!-- </div> -->
    <!-- </div> -->
</body>

<script src="script.js"></script>

</html>

<script>
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    var user_id = getCookie("id");
    var recipe_id = '';
    var recipe_name = '';
    var recipe_description = '';
    var recipe_servings = '';
    var recipe_cook = '';
    // var recipe_img = '';
    var recipe_ingredients = [];
    var recipe_steps = [];
    var recipe_category = '';

    $('#submit').click(function(e) {
        e.preventDefault();
        recipe_owner = getCookie("user");
        recipe_id = Math.round((Date.now() * Math.random()));
        recipe_name = document.getElementById('recipe_name').value;
        recipe_description = document.getElementById('recipe_description').value;
        recipe_servings = '';
        recipe_cook = '';
        // recipe_img = '';
        recipe_ingredients = [];
        recipe_steps = [];
        recipe_category = '';
        for (let i = 0; i < x; i++) {
            if (document.getElementById('x' + i) != "") {
                recipe_ingredients[i] = document.getElementById("x" + i).value;
            }
        }
        for (let i = 0; i < y; i++) {
            if (document.getElementById('y' + i) != "") {
                recipe_steps[i] = document.getElementById("y" + i).value;
            }
        }

        recipe_category = document.getElementsByName('radioCategory');
        for (let i = 0; i < recipe_category.length; i++) {
            if (recipe_category[i].checked) {
                recipe_category = recipe_category[i].value;
            }
        }
        recipe_cook = document.getElementById('recipe_cook').value;

        recipe_servings = document.getElementById('recipe_servings').value;

        // console.log(recipe_name);
        // console.log(recipe_description);
        // console.log(recipe_ingredients);
        // console.log(recipe_steps);
        // console.log(recipe_cook);
        // console.log(recipe_servings);
        uploadFile();
    });

    var counter = 0;

    function uploadIngredientDatabase() {
        console.log("Attempting to Upload Ingredient");
        console.log("INGREDIENTS: " + recipe_id);
        setTimeout(function() {

            if (counter < recipe_ingredients.length) {
                if (recipe_ingredients[counter] != "") {
                    var currentIngredient = recipe_ingredients[counter];
                    $.ajax({
                        url: "./insertingredient.php",
                        type: "POST",
                        data: {
                            "recipe_id": recipe_id,
                            "ingredient": currentIngredient,
                        },
                        success: function(response) {
                            if (response.code == '201') {
                                console.log('Created Successfully');
                            }
                            if (response.code == '400') {
                                console.log('Error');
                            }
                        }
                    });
                }
                uploadIngredientDatabase();
                counter++;
            }
        }, 10)
    }

    var stepCounter = 0;

    function uploadStepsDatabase() {
        console.log("STEPS: " + recipe_id);
        setTimeout(function() {
            if (stepCounter < recipe_steps.length) {
                if (recipe_steps[stepCounter] != "") {
                    var currentStep = recipe_steps[stepCounter];
                    $.ajax({
                        url: "./insertsteps.php",
                        type: "POST",
                        data: {
                            "recipe_id": recipe_id,
                            "steps": currentStep,
                        },
                        success: function(response) {
                            if (response.code == '201') {
                                console.log('Created Successfully');
                            }
                            if (response.code == '400') {
                                console.log('Error');
                            }
                        }
                    });
                }
                uploadStepsDatabase();
                stepCounter++;
            }
        }, 10)
    }

    function uploadFile() {
        console.log("UPLOAD: " + recipe_id);
        var files = document.getElementById("file").files;

        if (files.length > 0) {

            var formData = new FormData();
            formData.append("file", files[0]);
            var randomFilename = recipe_id+".png";
            formData.append("file", files[0], randomFilename);
            // formData.append("fileName", recipe_name);

            // var randomFilename = Math.round((Date.now() * Math.random()));
            // formData.append("file", 'kenneth.png');

            // recipe_img = files[0].name;
            var xhttp = new XMLHttpRequest();


            xhttp.open("POST", "uploadimage.php", true);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if (response == 1) {
                        //alert("Upload successfully.");
                        uploadRecipeDatabase(randomFilename);
                        uploadIngredientDatabase();
                        uploadStepsDatabase();
                        uploadRatingDatabase();
                        setTimeout(function() {
                            window.location.replace("../index.php");
                        }, 1000);
                    } else {
                        alert("Creating Recipe Failed.");
                    }
                }
            };
            xhttp.send(formData);
        } else {
            alert("Please select a file");
        }
    }

    function uploadRecipeDatabase(recipe_img) {
        $.ajax({
            url: "./insertdatabase.php",
            type: "POST",
            data: {
                "user_id": user_id,
                "recipe_id": recipe_id,
                "recipe_name": recipe_name,
                "recipe_description": recipe_description,
                "recipe_servings": recipe_servings,
                "recipe_cook": recipe_cook,
                "recipe_img": recipe_img,
                "recipe_category": recipe_category,
            },
            success: function(response) {
                if (response.code == '201') {
                    console.log('Created Successfully');
                    //uploadIngredientDatabase();
                }
                if (response.code == '400') {
                    console.log('Error');
                }
            }
        });
    }

    function uploadRatingDatabase() {
        $.ajax({
            url: "./insertrating.php",
            type: "POST",
            data: {
                "userId": user_id,
                "recipeId": recipe_id,
                "rating": 0,
                "comment": "",
            },
            success: function(response) {

            }
        });
    }


    document.cookie = "page=login; path=/login;";
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function goSignup(signup){
        document.cookie = "page=create; path=/login;";
        window.location.replace("../login/index.php");
    }
    let username = atob(getCookie("user"));
    if (username != "") {
        $("#loginForm").append('<a href="../profilepage.php"> ' + username + '</a>');
        $("#loginForm").append('<a href="../home/index.php"><button id = "logoutBtn" class="logout">Log Out</button></a>');
        $("#navigation").append('<li><a href="../form/addrecipe.php">Create Recipe</a></li>');
        $("#createRecipe").append('<a href="../form/addrecipe.php">Create a Recipe</a>');

        if(getCookie("perms") == '69'){
            $("#navigation").append('<li><a href="../user/userlist.php">User List</a></li>');
        }
    } else {
        $("#loginForm").append('<a href = "../login/index.php">Log In</a>');
        $("#loginForm").append('<button class="signup" onclick = "goSignup()">Sign Up ???</button>');
    }
    $("#logoutBtn").click(function() {
        if (username != "") {
            document.cookie = `id= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `user= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `email= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
        }
    });
</script>