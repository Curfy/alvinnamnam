<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="recipedetails.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/9a3c6f8e27.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300&display=swap" rel="stylesheet">
        <title>Recipe Page</title>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>

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
    <section>
            <div class="pageOne">
                <header>
                    <button id = "returnBack" class="recipeback" onClick = "returnPage()">Return to Previous Page</button>
                    <div id = "navz">
                        <form id = "editz" action="./form/edit/editrecipe.php" method = "POST">
                        </form>
                    </div>
                </header>
            </div>
            <div class = "row">
                <div id = "recipeInfo" class = "column"></div>
                <div id = "recipeImage" class = "column"></div>
            </div>
            <div class="pageTwo">
                <div class="contentOne">
                    <div class="contentOne_title">Ingredients</div>
                    <ul id = "recipeIngredients">
                    </ul>
                </div>
                
                <div id = "recipeSteps" class = "contentTwo">
                    <div class="contentTwo_title">Instructions</div>
                </div>
                
                <div id = "ratingSection" class="RatingSection">
                </div>
                <div id = "reviewSection" ></div>
                    <div id = "reviewBox" class = "reviewBox">
                    </div>
                </div>
            
        </section>
    </body>
</html>

<script>
    function returnPage(){
        var data = <?php echo json_encode($_POST) ?>;
        window.location.replace(data.previouspage)
    }
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
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

    var recipeId = <?=$_POST['button']?>;
    var user_id = getCookie("id");

    Load();
    loadIngredients(recipeId);
    loadSteps(recipeId);
    loadReviews();
    function Load(){
        $.ajax({
        url: "./getrecipe.php",
        type: "POST",
        success: function(response){
            response.forEach(function (recipe, index){
                    if(recipe.recipe_id == recipeId){
                        var cooktime = recipe.cook_time + ' mins'
                        if (recipe.cook_time > 60){
                            cooktime = ' ' + Math.round(recipe.cook_time/60) + ' hours';
                            if (recipe.cook_time % 60 > 0){
                                cooktime += ' ' + (recipe.cook_time % 60) + ' mins';
                            }
                        }
                        $("#recipeInfo").append('<h1>'+recipe.recipe_name+'</h1> <p>'+recipe.recipe_description+'</p> <div class="time-grid">  <div id = "recipeServings" class="time-square-1"> <div class="time-title-1">Serving</div> <div class="time-alotted">'+recipe.servings+' servings</div></div><div id = "recipeTime" class="time-square-2"><div class="time-title-2">Cook</div><div class="time-alotted">'+cooktime+'</div></div></div>')
                        $("#recipeImage").append('<img class = "testing" src = "./assets/'+recipe.img_name+'"></img>');
                        
                        $('#editz').append('<input type="hidden" name="name" value="'+recipe.recipe_name+'">');
                        $('#editz').append('<input type="hidden" name="description" value="'+recipe.recipe_description+'">');
                        $('#editz').append('<input type="hidden" name="servings" value="'+recipe.servings+'">');
                        $('#editz').append('<input type="hidden" name="cooktime" value="'+recipe.cook_time+'">');
                        $('#editz').append('<input type="hidden" name="recipe_id" value="'+recipe.recipe_id+'">');
                        $('#editz').append('<input type="hidden" name="img_name" value="'+recipe.img_name+'">');
                        $('#editz').append('<input type="hidden" name="category" value="'+recipe.category+'">');

                        if((recipe.firstname).toLowerCase() == (getCookie("user")).toLowerCase()){
                            // $("#editz").append('<button id = "editRecipe" class="recipeback">Edit Recipe</button>');
                            $("#editz").append('<button id = "editRecipe" class="recipeback">Edit Recipe</button>');
                            $("#navz").append('<button id = "deleteRecipe" class="recipe" onClick = "deleteRecipe()">Delete Recipe</button>');
                            
                        }
                    }
                });
            }
        });
    }

    function loadIngredients(id){
        $.ajax({
        url: "./getingredients.php",
        type: "POST",
        data:{
            "id": (id),
        },
        success: function(response){
            for (i = 0; i < response.length; i++){
                $("#recipeIngredients").append('<li>'+response[i].ingredient+'</li>');
            }
            }
        });
    }

    function loadSteps(id){
        $.ajax({
        url: "./getsteps.php",
        type: "POST",
        data:{
            "id": (id),
        },
        success: function(response){
            for (i = 0; i < response.length; i++){
                $("#recipeSteps").append('<div class = "contentTwo_number">'+(i+1)+'</div><div class = "contentTwo_steps">'+response[i].steps+'</div>');
            }
            }
        });
    }


    function deleteRecipe(){
        if(confirm("Are you sure about deleting this recipe?")){
            window.location.replace("./index.php");
            $.ajax({
            url: "./deleterecipe.php",
            type: "POST",
            data: {
                "id": recipeId,
            },
            success: function(response){
                }
            });
        }
    }

    var count = 0;
    function result() {
        var comment = document.getElementById("review").value;

        if(count != 0){
            if(comment != ''){
                if(comment.length < 10){
                    alert("insert at least more than 10 characters")
                }else{
                    insertRating(user_id, count, comment);
                    location.reload();
                }
            }else{
                alert("enter a valid comment");
            }
        }else{
            alert("invalid star ratings");
        }
        
    }

    function startRating(item) {
        count = item.id[0];
        sessionStorage.star = count;
        for (var i = 0; i < 5; i++) {
            if (i < count) {
                document.getElementById((i + 1)).style.color = "#FDCC0D";
            } else {
                document.getElementById((i + 1)).style.color = "black";
            }
        }
    }

    function insertRating(userId, rating, comment){
        $.ajax({
        url: "insertrating.php",
        type: "POST",
        data:{
            "user_id": userId,
            "recipe_id": recipeId,
            "rating": rating,
            "comment": comment,
        },
        success: function(response){
            }
        });
    }

    var checkIfReview = function(callback)
    {
        $.ajax({
        url: "getratings.php",
        type: "POST",
        success: callback
        });
    }

    checkIfReview(function(data){
        var currentUserId = getCookie('id');
        var results = false;
        console.log(recipeId);
        data.forEach(function(rating, index){
            if(rating.recipe_id == recipeId && rating.user_id == currentUserId && rating.rating > 0 ||  rating.recipe_id == recipeId && rating.user_id == currentUserId || currentUserId == ""){
                results = true;
            }
        });
        if(results == false){
            $('#ratingSection').append('<div class="col-md-3"></div>');
            $('#ratingSection').append('<div class="col-md-6 well">');
            $('#ratingSection').append('<h3 class="ratingtext">How much would you rate this recipe?</h3>');
            $('#ratingSection').append('<hr style="border-top:1px solid #fbd691; width: 90vw; margin-left: auto; margin-right: auto;" />');
            $('#ratingSection').append('<div class="col-md-3"></div>');
            $('#ratingSection').append('<div class="col-md-6"></div>');
            $('#ratingSection').append('<h3 class="ratingtext">Rating:</h3>');
            $('#ratingSection').append('<span id="1" style="font-size:45px; cursor:pointer;" class="fa fa-star" onmouseover="startRating(this)" startRating="starmark(this)"></span>');
            $('#ratingSection').append('<span id="2" style="font-size:45px; cursor:pointer;" class="fa fa-star" onmouseover="startRating(this)" startRating="starmark(this)"></span>');
            $('#ratingSection').append('<span id="3" style="font-size:45px; cursor:pointer;" class="fa fa-star" onmouseover="startRating(this)" startRating="starmark(this)"></span>');
            $('#ratingSection').append('<span id="4" style="font-size:45px; cursor:pointer;" class="fa fa-star" onmouseover="startRating(this)" startRating="starmark(this)"></span>');
            $('#ratingSection').append('<span id="5" style="font-size:45px; cursor:pointer;" class="fa fa-star" onmouseover="startRating(this)" startRating="starmark(this)"></span>');
            $('#ratingSection').append('<div class="form-group">');
            $('#ratingSection').append('<h3 class="ratingtext">Feedback:</h3>');
            $('#ratingSection').append('<textarea id="review" class="form-control" style="resize:none; height:100px;"></textarea></div><br>');
            $('#ratingSection').append('<button class="btn btn-success" onclick="result()">SUBMIT</button>');
        }
    });
    
    function loadReviews(){
        $.ajax({
        url: "getratings.php",
        type: "POST",
        success: function(response){
            console.log(response);
            $('#reviewBox').append('<h3 class = "ratingText" >REVIEWS</h3>');
            $('#reviewBox').append('<div class = "borderline"></div>');
                response.forEach(function(rating, index){
                    if(rating.rating != 0){
                        if(rating.recipe_id == recipeId){
                            $('#reviewBox').append('<h5 class = "ratingUsername" >'+atob(rating.firstname)+'');
                            for(let i = 0; i < rating.rating; i++){
                                $('#reviewBox').append('<span class = "fa fa-star" style = "color: #FDCC0D"></span>');
                            }
                            for(let j = 0; j < 5-(rating.rating); j++){
                                $('#reviewBox').append('<span class = "fa fa-star" style = "color: black"></span>');
                            }
                            
                            $('#reviewBox').append('<p class = "ratingComments" >'+rating.comments+'</p>');
                            $('#reviewBox').append('<div class = "borderline"></div>');
                        }
                    }
                });
            }
        });
    }
    var data = <?php echo json_encode($_POST) ?>;
    console.log(data);
</script>
