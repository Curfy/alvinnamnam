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
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur ratione alias necessitatibus repellat aut provident? Cum nihil a explicabo qui natus placeat, beatae illo, at tenetur laudantium rem dolorem iusto.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Angel Lyka Latoza</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur ratione alias necessitatibus repellat aut provident? Cum nihil a explicabo qui natus placeat, beatae illo, at tenetur laudantium rem dolorem iusto.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Jan Kyle Merin</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur ratione alias necessitatibus repellat aut provident? Cum nihil a explicabo qui natus placeat, beatae illo, at tenetur laudantium rem dolorem iusto.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Alvin Patricio</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur ratione alias necessitatibus repellat aut provident? Cum nihil a explicabo qui natus placeat, beatae illo, at tenetur laudantium rem dolorem iusto.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Adrean Andrew Palafox</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur ratione alias necessitatibus repellat aut provident? Cum nihil a explicabo qui natus placeat, beatae illo, at tenetur laudantium rem dolorem iusto.</p>
                    </div>
                </li>
                <li>
                    <div class="content">
                        <h2>Kenneth Rada</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur ratione alias necessitatibus repellat aut provident? Cum nihil a explicabo qui natus placeat, beatae illo, at tenetur laudantium rem dolorem iusto.</p>
                    </div>
                </li>
            </ul>
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