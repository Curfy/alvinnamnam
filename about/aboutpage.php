<html>

<head>
    <title>About</title>
    <link rel="stylesheet" href="aboutpage.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Playfair+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
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
    <section>
        <main class="main-grid">
            <div class="main-text">
                <h2 class="section-title">Our Purpose</h2>
                <p>We want the rest of the world to know how delicious Filipino food is. Creating a website is one way for us to spread our recipes around the world and encourage people to try them. Filipino dishes are distinguished by distinct flavors and textures rather than by different courses. Instead of serving courses separately, they are all brought to the table at the same time so that diners can enjoy all flavors and dishes at the same time.</p>
                <img src="bg.png" alt="">
            </div>
        </main>

        <div class="section-heading-block">
            <h4 class="section-title">
                Meet Our Team
            </h4>
        </div>

        <div class="timeline">
            <ul>
                <li>
                    <div class="content">
                        <h2>Maria Gwyneth Bernardez</h2>
                        <p>She is Founder of the All Tasty Recipe. A blogging pioneer, Gwen first created Simply Recipes in early 2021 as a way to keep track of her family’s recipes, and over the months grew it into one of the most popular cooking websites</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Angel Lyka Latoza</h2>
                        <p>Angel is the Associate General Manager of the All Tasty Recipe.  She has over 2 years of experience creating food and cooking content for both web and print and another 1 year within the print publishing industry. She joined the All Tasty team in 2021 as Managing Editor.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Jan Kyle Merin</h2>
                        <p>Jan Kyle is the Senior Editor of the Recipes at All Tasty. He has 2 years of publishing experience working in media across all of its platforms: magazine, newspaper, and digital. He has spent the last 2 years working exclusively in food media where he has worked as a recipe developer, recipe tester, food journalist, essayist, cookbook author, and public speaker.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Alvin Patricio</h2>
                        <p>Alvin has been writing, editing, and developing recipes and content since 2020. He loved working with the same age group as him  because it allowed him to think about food in ways that he could never imagine.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Adrean Andrew Palafox</h2>
                        <p>Adrean is the Senior Vice President of the All Tasty Recipe. He is an avid home cook and lover of all things food-related. Although not professionally trained as a chef, he has taken dozens of recreational cooking classes. His current food obsession is perfecting his sourdough to get that perfect light and airy crumb with a dark and crispy crust.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Kenneth Rada</h2>
                        <p>Kenneth is the Art Director for the All Tasty. He is experienced using visual art to convey story and emotion utilizing photography, illustration, design, and more. He enjoys most anything that involves a good story, and is passionate about creating art in many forms.</p>
                    </div>
                </li>
            </ul>
            <div class="background-design2">
                <footer class="page-footer">
                    <p>&#169; All Tasty. All right reserved.</p>
                </footer>
            </div>
        </div>
    </section>
 
</body>

</html>

<script>
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
        $("#loginForm").append('<a href="../about/aboutpage.php"><button id = "logoutBtn" class="logout">Log Out</button></a>');
        $("#navigation").append('<li><a href="../form/addrecipe.php">Create Recipe</a></li>');
        $("#createRecipe").append('<a href="../form/addrecipe.php">Create a Recipe</a>');

        if(getCookie("perms") >= 1 && getCookie("perms") <= 2){
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