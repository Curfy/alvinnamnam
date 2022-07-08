<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="maximum-scale=1.0, width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Playfair+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/9a3c6f8e27.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>
    
    <title>Recipes</title>

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
                <img width="70px" src="./assets/All-Tasty.png" alt="">
                <h1>All Tasty</h1>
            </div>

            <div id="navigation" class="navs">
                <li><a href="./home/index.php">Home</a></li>
                <li><a href="./index.php">Recipes</a></li>
                <li><a href="./about/aboutpage.php">About</a></li>
            </div>

            <div id="loginForm" class="test">
            </div>
        </div>
    </div>

    <section class="page">
        <nav class="search">
            <form action="searchresults.php" method="POST">
                <input name="search" type="text" placeholder="Search...">
                <button><span class="fas fa-search"></span></button>
            </form>
        </nav>

        <div class="recipes_container active">
            <div class="btn_container">
                <button class="btn active" data-target="#streetDishes">Street Foods</button>
                <button class="btn" data-target="#dishDishes">Dish</button>
                <button class="btn" data-target="#dessertDishes">Dessert</button>
            </div>

            <form action="recipedetail.php" method="POST">
                <div id="streetDishes" class="recipe_list active">
                </div>
            </form>
            <form action="recipedetail.php" method="POST">
                <div id="dishDishes" class="recipe_list">
                </div>
            </form>

            <form action="recipedetail.php" method="POST">
                <div id="dessertDishes" class="recipe_list">
                </div>
            </form>

        </div>
        </div>
    </section>
    <!--Footer-->
    <div class="background-design2">
        <footer class="page-footer">
            <p>&#169; All Tasty. All right reserved.</p>
        </footer>
    </div>
    <!--End of Footer-->
    <script src="script.js"></script>

</body>

</html>

<script>
    Load();

    function Load() {
        $.ajax({
            url: "./getrecipe.php",
            type: "POST",
            success: function(response) {
                response.forEach(function(recipe, index) {
                    var cooktime = recipe.cook_time + ' mins';
                    if (recipe.cook_time > 60) {
                        cooktime = ' ' + Math.round(recipe.cook_time / 60) + ' hours';
                        if (recipe.cook_time % 60 > 0) {
                            cooktime += ' ' + (recipe.cook_time % 60) + ' mins';
                        }
                    }
                    
                    if (recipe.category == "street") {
                        $("#streetDishes").append('<div class = "recipe"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                        $('#streetDishes').append('<input type="hidden" name="previouspage" value="./index.php">');
                    } else if (recipe.category == "dish") {
                        $("#dishDishes").append('<div class = "recipe"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                        $('#dishDishes').append('<input type="hidden" name="previouspage" value="./index.php">');
                    } else {
                        $("#dessertDishes").append('<div class = "recipe"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                        $('#dessertDishes').append('<input type="hidden" name="previouspage" value="./index.php">');
                    }

                });
                for (let i = 0; i < response.length; i++) {
                    average = response[i].average;
                    if (average == null) {
                        $('#' + i + '').append('<p2 class = "average" >0.0</p2>');
                    } else {
                        $('#' + i + '').append('<p2 class = "average" > ' + parseFloat(average).toFixed(1) + '</p2>');
                    }

                    for (let j = 0; j < Math.trunc(average); j++) {
                        $('#rateStar' + i + '').append('<span class = "fa fa-star" style = "color: #ff0038"></span>');
                    }
                    for (let k = 0; k < (5 - Math.trunc(average)); k++) {
                        $('#rateStar' + i + '').append('<span class = "fa fa-star" style = "color: black"></span>');
                    }

                    
                }

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
        $("#loginForm").append('<a href="../index.php"><button id = "logoutBtn" class="logout">Log Out</button></a>');
        $("#navigation").append('<li><a href="../form/addrecipe.php">Create Recipe</a></li>');
        $("#createRecipe").append('<a href="../form/addrecipe.php">Create a Recipe</a>');

        if(getCookie("perms") == '69'){
            $("#navigation").append('<li><a href="../user/userlist.php">User List</a></li>');
        }
    } else {
        $("#loginForm").append('<a href = "../login/index.php">Log In</a>');
        $("#loginForm").append('<button class="signup" onclick = "goSignup()">Sign Up →</button>');
    }
    $("#logoutBtn").click(function() {
        if (username != "") {
            document.cookie = `id= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `user= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
            document.cookie = `email= ;expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/`;
        }
    });
</script>