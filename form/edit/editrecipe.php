<?php
    if (!isset($_COOKIE['email'])){
        header('Location: ../home/index.php');
    }
?>

<html>

<head>
    <link rel="stylesheet" href="editrecipe.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Playfair+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tasty Recipe</title>
</head>

<body id = "loadingPage">
    <div id = "editNavbar" class="container">
        <div class="navbar">
            <div class="logo">
                <img width="70px" src="../../assets/All-Tasty.png" alt="">
                <h1>All Tasty</h1>
            </div>

            <div id="navigation" class="navs">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="../../index.php">Recipes</a></li>
                <li><a href="../../about/aboutpage.php">About</a></li>
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

    <div id = "editRecipe" class="addrecipe">
        <p class="title">Edit Recipe</p>
        <!-- <p class="input_box">Share the happiness</p> -->
        <form action="upload.php" enctype="multipart/form-data" method="POST">
            <fieldset id = "editFieldset" class="fieldset">
                <legend>
                </legend>
                
                <div class="input_box" id = "recipeName" >
                    <label class="textLabel" for="recipe_name">Recipe Name:</label>

                    <!-- <input class="input" type="text" id="recipe_name" name="recipe_name"> -->

                </div>

                <div class="input_box" id = "recipeDescription">
                    <label class="textLabel" for="recipe_description">Recipe Description:</label>

                    <!-- <textarea class="textarea" id="recipe_description" id="" cols="50" rows="5" maxlength="280"></textarea> -->

                </div>

                <div class="input_box" id="ingr_box">
                    <span class="textLabel">Ingredients:
                        <button class="ingre_btn" id="subingr" type="button">-</button>
                        <button class="ingre_btn" id="addingr" type="button">+</button>
                    </span>

                    <!-- <input class="input" name="ingredients" id=x0 type="text"> -->

                </div>

                <div class="input_box" id="step_box">
                    <span class="textLabel">Steps:
                        <button class="step_btn" id="substep" type="button">-</button>
                        <button class="step_btn" id="addstep" type="button">+</button>
                    </span>

                    <!-- <textarea class="textarea" name="steps" id=y0 type="text"></textarea> -->

                </div>
            
                <!-- <div class="input_box">
                    <div class = "row" style = "position: relative; bottom: 0;">
                        <div style = "float: right">
                            <img src="/assets/692861418725.png" width="100px">
                        </div>
                        <div style = "float: left">
                            <div style = "">
                                <span class="textLabel">Image: </span>
                                <input type="file" id="file" accept="image/*" style = "display: none;">
                                <label for="file" class = "fileButton" >Upload New Image</label>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="input_box">
                    <form runat="server">
                        <span class="textLabel">Image: </span>
                        <input type='file' id="imgInp" accept="image/*"/>
                        <img id="blah" src="#"/>
                    </form>
                </div>

                <div class="row input_box">
                    <div class="col">
                        <span class="textLabel">Cook Time: </span>
                            <div class="minservings" id = "recipe_cooking">

                                <!-- <input class="input" type="number" id="recipe_cook" name="recipe_cook" min="1"> mins -->

                            </div>
                    </div>
                    <div class="col">
                        <span class="textLabel">Servings</span>
                            <div class="minservings" id = "recipe_servings">
                                <!-- <input class="input" type="number" id="recipe_servings" name="recipe_servings" min="1"> servings -->
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
                    <button id="update" name="update" class="recipesubmit"> Update Recipe </button>
                </div>
            </fieldset>

        </form>
    </div>

    <!-- </div> -->
    <!-- </div> -->
</body>

<script src="editscript.js"></script>

</html>

<script>
    
    var data = <?php echo json_encode($_POST) ?>;

    recipe_category = document.getElementsByName('radioCategory');
    if (data['category'] == 'street'){
        recipe_category[0].checked = true
    }else if (data['category'] == 'dish'){
        recipe_category[1].checked = true
    }else if (data['category'] == 'dessert'){
        recipe_category[2].checked = true
    }

    var blahimg = document.getElementById('blah')
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blahimg.style.height = "350px";
            blahimg.style.width = "100%";
            blah.src = URL.createObjectURL(file)
        }
    }
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

    function deleteRecipe(recipeid){
        $.ajax({
            url: "updaterecipe.php",
            type: "POST",
            data: {
                "id": recipeid,
            },
            success: function(response) {
                uploadFile();
            }
        });
        
    }

    function checkRestriction(recipe_ingredients, recipe_steps, recipe_category){
        if (document.getElementById('recipe_name').value == ""){
            alert("Invalid Recipe Name");
            return false;
        }
        if (document.getElementById('recipe_description').value == ""){
            alert("Invalid Recipe Description");
            return false;
        }
        if (document.getElementById('recipe_cook').value == ""){
            alert("Invalid Cooking Time");
            return false;
        }
        if (document.getElementById('recipe_serving').value == ""){
            alert("Invalid Amount of Servings");
            return false;
        }
        if (document.getElementById('recipe_name').value == ""){
            alert("Invalid Recipe Name");
            return false;
        }
        if (recipe_ingredients.length <= 0 || (recipe_ingredients).length <= 1 && recipe_ingredients[0] == ""){
            alert("Invalid Amount of Ingredients");
            return false;
        }
        if (recipe_steps.length <= 0 || (recipe_steps).length <= 1 && recipe_steps[0] == ""){
            alert("Invalid Amount of Steps");
            return false;
        }

        if (recipe_category == "" || recipe_category.length == 3){
            alert("Invalid Recipe Category");
            return false;
        }
        
        return true;
    }

    var user_id = getCookie("id");
    var recipe_id = '';
    var recipe_name = '';
    var recipe_description = '';
    var recipe_cook = '';
    var recipe_servings = '';
    // var recipe_img = '';
    var recipe_ingredients = [];
    var recipe_steps = [];
    var recipe_category = '';

    $('#update').click(function(e) {
        var updateBtn = document.getElementById('update');
        updateBtn.remove();

        $("#loadingPage").append("<div class = 'loader'></div>");
        window.scrollTo(0, document.body.scrollHeight);

        recipe_id = <?php echo json_encode($_POST['recipe_id']) ?>;
        
        e.preventDefault();

        recipe_name = document.getElementById('recipe_name').value;
        recipe_description = document.getElementById('recipe_description').value;
        recipe_cook = document.getElementById('recipe_cook').value;
        recipe_servings = document.getElementById('recipe_serving').value;
        
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
        if (checkRestriction(recipe_ingredients, recipe_steps, recipe_category)){
            deleteRecipe(recipe_id);
        }


        // console.log(recipe_name);
        // console.log(recipe_description);
        // console.log(recipe_ingredients);
        // console.log(recipe_steps);
        // console.log(recipe_cook);
        // console.log(recipe_servings);
        
        
    });

    function uploadIngredientDatabase(currentIngredient) {
        // console.log("Attempting to Upload Ingredient");
        // console.log("INGREDIENTS_ID: " + recipe_id);

        setTimeout(function() {
            if(currentIngredient != '' && currentIngredient != ' '){
                    $.ajax({
                    url: "../insertingredient.php",
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
        }, 10)
    }

    function uploadStepsDatabase(currentStep) {
        // console.log("Attempting to Upload Steps");  
        // console.log("STEPS_ID: " + recipe_id);
        
        setTimeout(function() {
            if(currentStep != '' && currentStep != ' '){
                    $.ajax({
                    url: "../insertsteps.php",
                    type: "POST",
                    data: {
                        "recipe_id": recipe_id,
                        "steps": currentStep,
                    },
                    async: false,
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
        }, 10)
    }

    function uploadRecipeDatabase(recipe_img) {
        $.ajax({
            url: "../insertdatabase.php",
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
            async: false,
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

    function uploadFile() {
        var editNavbar = document.getElementById("editNavbar");
        var editRecipePage = document.getElementById("editRecipe");
        editNavbar.style.display = "none";
        editRecipePage.style.display = "none";
        console.log("UPLOAD: " + recipe_id);
        var files = document.getElementById("imgInp").files;

        if (files.length > 0) { //checks if there is an img uploaded or not
            var formData = new FormData();
            formData.append("file", files[0]);
            var randomFilename = recipe_id+".png";
            formData.append("file", files[0], randomFilename);

            var xhttp = new XMLHttpRequest();


            xhttp.open("POST", "../uploadimage.php", true);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if (response == 1) {
                        //alert("Upload successfully.");
                        const d = new Date();

                        // uploadRecipeDatabase(randomFilename + "?t=" + d.getTime());

                        // uploadIngredientDatabase();
                        // uploadStepsDatabase();

                        // uploadRatingDatabase();
                        // setTimeout(function() {
                        //     window.location.replace("../../index.php");
                        // }, 5000);


                        // window.location.replace("../../index.php");


                    } else {
                        alert("Creating Recipe Failed.");
                    }
                }
            };
            xhttp.send(formData);
        } else {
            // setTimeout(function() {
            //     //alert("Upload successfully.");
            //     const d = new Date();
            //     // console.log(data['img_name'] + '?t=' + d.getTime())
                
            //     uploadRecipeDatabase(data['img_name']);

            //     uploadIngredientDatabase();
            //     uploadStepsDatabase();
            //     // window.location.replace("../../index.php");
            // }, 1000);

            //alert("Upload successfully.");
            const d = new Date();
            // console.log(data['img_name'] + '?t=' + d.getTime())
            
            uploadRecipeDatabase(data['img_name']);
            
            setTimeout(function(){
                for(let i = 0; i < recipe_ingredients.length; i++){
                    uploadIngredientDatabase(recipe_ingredients[i]);
                }

                for(let j = 0; j < recipe_steps.length; j++){
                    uploadStepsDatabase(recipe_steps[j]);
                }
                window.location.replace("../../index.php");
            }, 3000);
            
        }
    }

    function uploadRatingDatabase() {
        $.ajax({
            url: "../insertrating.php",
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


    function goSignup(signup){
        document.cookie = "page=create; path=/login;";
        window.location.replace("../login/index.php");
    }
    let username = atob(getCookie("user"));
    if (username != "") {
        $("#loginForm").append('<a href="../../profilepage.php"> ' + username + '</a>');
        $("#loginForm").append('<a href="../../home/index.php"><button id = "logoutBtn" class="logout">Log Out</button></a>');
        $("#navigation").append('<li><a href="../../form/addrecipe.php">Create Recipe</a></li>');
        $("#createRecipe").append('<a href="../../form/addrecipe.php">Create a Recipe</a>');

        if(getCookie("perms") == '69'){
            $("#navigation").append('<li><a href="../../user/userlist.php">User List</a></li>');
        }
    } else {
        $("#loginForm").append('<a href = "../../login/index.php">Log In</a>');
        $("#loginForm").append('<button class="signup" onclick = "goSignup()">Sign Up ???</button>');
    }
    $("#logoutBtn").click(function() {
        if (username != "") {
            document.cookie = `id= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `user= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `email= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
        }
    });
    

    var recipeId = data.recipe_id;

    let x = 0;
    let y = 0;
    console.log(data);

    if (data['img_name']){
        blahimg.style.height = "350px";
        blahimg.style.width = "100%";
        blahimg.src = '/assets/' + data['img_name'];
    }
    else{
        console.log("not exists");
    }




    function loadIngredients(){
        $.ajax({
        url: "../../getingredients.php",
        type: "POST",
        data:{
            "id": (recipeId),
        },
        success: function(response){
            response.forEach(function(ingredients, index){
                // console.log(steps.steps);
                // <textarea class="textarea" name="steps" id=y0 type="text"></textarea>
                // $("#step_box").append('<textarea class="textarea" name="steps'+index+'" id=y'+index+' type="text">'+steps.steps+'</textarea>');
                $("#ingr_box").append('<input class="input" name="ingredients'+index+'" id=x'+index+' type="text" value = "'+ingredients.ingredient+'"></input>');
                x = index+1;
            })
        }
        });
    }

    function loadSteps(){
        // localStorage.removeItem("Y");
        $.ajax({
        url: "../../getsteps.php",
        type: "POST",
        data:{
            "id": (recipeId),
        },
        success: function(response){
            response.forEach(function(steps, index){
                // console.log(steps.steps);
                // <textarea class="textarea" name="steps" id=y0 type="text"></textarea>
                $("#step_box").append('<textarea class="textarea" name="steps'+index+'" id=y'+index+' type="text">'+steps.steps+'</textarea>');
                // localStorage.setItem("Y", index);
                // document.cookie = "Y=".concat(index);
                y = index+1;
            })
        }
        });
    }

    loadEditData();
    
    function loadEditData(){
        $("#recipeName").append('<input class="input" type="text" id="recipe_name" name="recipe_name" value = "'+<?php echo json_encode($_POST['name']) ?>+'"> </input>');
        $("#recipeDescription").append('<input class="input" type="text" id="recipe_description" name="recipe_description" value = "'+<?php echo json_encode($_POST['description']) ?>+'"> </input>');

        loadSteps();
        loadIngredients();

        $("#recipe_servings").append('<input class="input" type="number" id="recipe_serving" name="recipe_serving" min="1" value = "'+<?php echo json_encode($_POST['servings']) ?>+'"> servings');
        $("#recipe_cooking").append('<input class="input" type="number" id="recipe_cook" name="recipe_cook" min="1" value = "'+<?php echo json_encode($_POST['cooktime']) ?>+'"> mins');
        
    }
    
</script>