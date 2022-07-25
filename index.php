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

            <div class="dropdown">
                <div class = 'sortBy'>
                    <button id = 'selectedSort' onclick="myFunction()" id = 'btnLabel' class="dropbtn">Sort By: All <span id = 'dropdownArrow' class="fa fa-angle-down" aria-hidden="true"></span></button>
                </div>
                <div id="myDropdown" class="dropdown-content">
                    <div><button onclick = 'Load("all")' id = 'btnAll' class = 'buttonList active' value = 'Sort By: All '>All</button></div>
                    <div><button onclick = 'Load("mostRating")' id = 'btnMost' class = 'buttonList' value = 'Sort By: Most Rating '>Most Rating</button></div>
                    <div><button onclick = 'Load("leastRating")' id = 'btnLeast' class = 'buttonList' value = 'Sort By: Least Rating '>Least Rating</button></div>
                    <div><button onclick = 'Load("noRating")' id = 'btnNo' class = 'buttonList' value = 'Sort By: No Rating '>No Rating</button></div>
                    <div><button onclick = 'Load("mostNewest")' id = 'btnNewest' class = 'buttonList' value = 'Sort By: Newest '>Newest</button></div>
                    <div><button onclick = 'Load("leastNewest")' id = 'btnOldest' class = 'buttonList' value = 'Sort By: Oldest '>Oldest</button></div>
                </div>
                
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

