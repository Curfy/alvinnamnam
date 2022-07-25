const btns = document.querySelectorAll('.btn')
const lists = document.querySelectorAll('.recipe_list')

btns.forEach(btn => {
    btn.addEventListener("click", () => {
        btns.forEach(btn => btn.classList.remove("active"));
        lists.forEach(recipe_list => recipe_list.classList.remove("active"));

        btn.classList.add("active");
        document.querySelector(btn.dataset.target).classList.add("active");
    })
})

function myFunction(){
    document.getElementById("myDropdown").classList.toggle("show");
    document.getElementById("dropdownArrow").classList.toggle("fa-angle-up");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
        document.getElementById("dropdownArrow").classList.toggle("fa-angle-up");
        }
    }
    }
}

function clearRecipes(){
    const recipeCategories = document.querySelectorAll(".recipeCategories");
    const selectedButton = document.getElementById('selectedSort').firstChild;

    const btnSorts = document.querySelectorAll('.buttonList');
    btnSorts.forEach(btn => {
        btn.addEventListener("click", () => {
            btnSorts.forEach(btn => btn.classList.remove("active"));
    
            btn.classList.add("active");
            selectedButton.textContent = btn.value;
        })
    })

    for (let i = 0; i < recipeCategories.length; i++) {
        recipeCategories[i].remove();
    }
}

function Load(searchmethod) {
    clearRecipes();
    $.ajax({
        url: "./getrecipe.php",
        type: "POST",
        data:{
            'search': searchmethod,
        },
        success: function(response) {
            response.forEach(function(recipe, index) {
                if(searchmethod == 'noRating'){
                    if(recipe.ratingcount < 2){
                        var cooktime = recipe.cook_time + ' mins';
                        if (recipe.cook_time > 60) {
                            cooktime = ' ' + Math.round(recipe.cook_time / 60) + ' hours';
                            if (recipe.cook_time % 60 > 0) {
                                cooktime += ' ' + (recipe.cook_time % 60) + ' mins';
                            }
                        }
                        
                        if (recipe.category == "street") {
                            $("#streetDishes").append('<div class = "recipe recipeCategories"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                            $('#streetDishes').append('<input type="hidden" name="previouspage" class = "recipeCategories" value="./index.php">');
                        } else if (recipe.category == "dish") {
                            $("#dishDishes").append('<div class = "recipe recipeCategories"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                            $('#dishDishes').append('<input type="hidden" name="previouspage" class = "recipeCategories" value="./index.php">');
                        } else {
                            $("#dessertDishes").append('<div class = "recipe recipeCategories"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                            $('#dessertDishes').append('<input type="hidden" name="previouspage" class = "recipeCategories" value="./index.php">');
                        }
                    }
                }else{
                    var cooktime = recipe.cook_time + ' mins';
                    if (recipe.cook_time > 60) {
                        cooktime = ' ' + Math.round(recipe.cook_time / 60) + ' hours';
                        if (recipe.cook_time % 60 > 0) {
                            cooktime += ' ' + (recipe.cook_time % 60) + ' mins';
                        }
                    }
                    
                    if (recipe.category == "street") {
                        $("#streetDishes").append('<div class = "recipe recipeCategories"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                        $('#streetDishes').append('<input type="hidden" name="previouspage" class = "recipeCategories" value="./index.php">');
                    } else if (recipe.category == "dish") {
                        $("#dishDishes").append('<div class = "recipe recipeCategories"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                        $('#dishDishes').append('<input type="hidden" name="previouspage" class = "recipeCategories" value="./index.php">');
                    } else {
                        $("#dessertDishes").append('<div class = "recipe recipeCategories"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
                        $('#dessertDishes').append('<input type="hidden" name="previouspage" class = "recipeCategories" value="./index.php">');
                    }
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

Load('all');