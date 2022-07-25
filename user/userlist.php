<?php
    if (!isset($_COOKIE['email'])){
        header('Location: ../home/index.php');
    }
?>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Lato|Playfair+Display:400,500,600,700,800,900|Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="userlist.css">

    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>

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
    <div class="containerz">
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

            <div id="loginForm" class="test"></div>
        </div>
    </div>

        <div class="container-xl">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h2><b>User List</b></h2>
                            </div>
                            <div class="col-sm-7">
                                <!-- <a href="#" class="btn btn-secondary"><i class="material-icons"><span class="material-symbols-outlined">book</span></i> <span>Recipe List</span></a>	 -->
                                <!-- <a href="#" class="btn btn-secondary"><i class="material-icons"><span class="material-symbols-outlined">person</span></i> <span>User List</span></a>					 -->
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>	
                                <th>Email</th>		
                                <th>Role</th>			
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id = "userdata">
                            <!-- <tr>
                                <td>1</td>
                                <td>
                                    <a href=""><img src="../about/default.jpg" class="avatar" alt="Avatar">Zenovain</a>
                                </td>
                                <td>zenocyfox@gmail.com</td>
                                <td>Admin</td>
                                <td>2022-02-22</td>
                                <td>
                                    <button class = "settings" title="Settings" data-toggle="tooltip" id = "btnSettings" onclick = "onSettings()"><i class="material-icons">&#xE8B8;</i></button>
                                    <button class = "delete" title="Delete" data-toggle="tooltip" id = "btnDelete" onclick = "deleteUser()"><i class="material-icons">&#xE5C9;</i></button>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td>2</td>
                                <td><a href="#"><img src="../about/default.jpg" class="avatar" alt="Avatar"> Paula Wilson</a></td>
                                <td>zenocyfox@gmail.com</td>
                                <td>Publisher</td>
                                <td>02/11/2018</td>                        
                                <td>
                                    <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                    <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><a href="#"><img src="../about/default.jpg" class="avatar" alt="Avatar"> Kenneth Rada</a></td>
                                <td>kennethrada93@gmail.com</td>
                                <td>User</td>
                                <td>01/10/2020</td>                        
                                <td>
                                    <a href="#" class="settings" title="Settings" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                    <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                    <!-- <div class="clearfix">
                        <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                        <ul class="pagination">
                            <li class="page-item disabled"><a href="#">Previous</a></li>
                            <li class="page-item"><a href="#" class="page-link">1</a></li>
                            <li class="page-item"><a href="#" class="page-link">2</a></li>
                            <li class="page-item active"><a href="#" class="page-link">3</a></li>
                            <li class="page-item"><a href="#" class="page-link">4</a></li>
                            <li class="page-item"><a href="#" class="page-link">5</a></li>
                            <li class="page-item"><a href="#" class="page-link">Next</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Users Modal -->
        <div id="userModal" class="modal">
            <div class="modal-content">
                
            <div class="container" style="padding: 0">

                <!-- Whole Card Including Card Header/Informations -->
                <div class="card">
                <!-- Card Header -->
                <div class="card-header">Edit Profile</div>
                <!-- Card Informations -->
                <div class="card-body">
                    <div class="e-profile">

                    <!-- First Tab -->
                    <div class="row">
                        <div class="col-12 col-sm-auto mb-3">
                        <div class="mx-auto" style="width: 140px;">
                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: #00000000;">

                            <div>
                                <form runat="server">
                                    <img id = "profileId" src = "../about/default.jpg" style = "color: rgb(166, 168, 170); font: bold 8pt Arial; width: 140px; height: 140px; border-radius: 10px;"></img>
                                </form>
                            </div>
                            
                            </div>
                        </div>
                        </div>
                        <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                            <h4 id = 'displayfullname' class="pt-sm-2 pb-1 mb-0 text-nowrap"></h4>
                            <p id = 'displayname' class="mb-0">@Zenocy</p>
                            <div class="mt-2">
                            <button class="btn btn-primary" type="button" style = "width: 280px">
                                <i class="fa fa-fw fa-camera"></i>
                                <!-- <span onclick = "changePhoto()">Change Photo</span> -->
                                <input type='file' id="imgInp" accept="image/*"></input>
                            </button>
                            </div>
                        </div>
                        <div class="text-center text-sm-right">
                            <span id = 'displayrank' class="badge">Administrator</span>
                            <div class="text-muted"><small id = 'displayjoin'>Joined 09 Dec 2017</small></div>
                        </div>
                        </div>
                    </div>
                    
                    <!-- Settings Tab -->   
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><button class = "btn nav-link tabs active" data-target="#tabSettings">Settings</button></li>
                        <li class="nav-item"><button class = "btn nav-link tabs" data-target="#tabRecipes">Recipes</button></li>
                    </ul>

                    <!-- Middle Tab -->
                    <div class="tab-content pt-3">
                        <div id = 'tabSettings' class="tab-pane active">
                            <form class="form" method = "">
                                <div class="row">
                                <div class="col">

                                    <!-- First Middle -->
                                    <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                        <label>First Name</label>
                                        <input class="form-control" type="text" id = 'displayfirst' name="fname" placeholder="First Name" value="">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" type="text" id = 'displaylast' name="lname" placeholder="Last Name" value="">
                                        </div>
                                    </div>
                                    </div>

                                    <!-- Second Middle -->
                                    <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                        <label>Email</label>
                                        <input id = 'displayemail' class="form-control" type="email" placeholder="user@example.com">
                                        </div>
                                    </div>
                                    </div>

                                    <!-- Third Middle -->
                                    <div class="row">
                                    <div class="col mb-3">
                                        <div class="form-group">
                                        <label>About</label>
                                        <textarea id = 'displayabout' class="form-control" rows="4" placeholder="My Bio" value = ""></textarea>
                                        </div>
                                    </div>
                                    </div>


                                </div>
                                </div>

                                <!-- Middle Bottom Row -->
                                <div class="row">

                                <!-- Password Tab -->
                                <div class="col-12 col-sm-6 mb-3">
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group password">
                                            <label class>New Password</label>
                                            <input id = 'displaynewpassword' class="form-control" type="password" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group password">
                                            <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                            <input id = 'displayconfirmpassword' class="form-control" type="password" placeholder=""></div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Permissions Tab-->
                                <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                    <label style = "margin-left: -5px;">Actions</label>
                                    <div class="row">
                                        <div class="col">
                                        <div class="custom-controls-stacked px-2">
                                            <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                            <label class="custom-control-label" for="notifications-blog">Administrator</label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                </div>

                                <!-- Save Button Tab-->
                                <!-- <div class="row">
                                    <div class="col d-flex justify-content-end">
                                        <button class="btn btn-primary" style = "margin-left: 10px;"type="submit" confirm="Are you sure?">Save Changes</button>
                                        <button class="btn btn-primary" style = "margin-left: 10px;">Cancel</button>
                                    </div>
                                </div> -->
                            </form>
                                <div class="row">
                                    <div class="col d-flex justify-content-end" id = 'updateButtons'>
                                        <button class="btn btn-primary" style = "margin-left: 10px;" onclick = "saveChanges()">Save Changes</button>
                                        <button class="btn btn-primary" style = "margin-left: 10px;" onclick = "location.reload()">Cancel</button>
                                    </div>
                                </div>
                                

                            
                        </div>

                        <div id = 'tabRecipes' class="tab-pane">
                            <div class = "container" id = "recipeCards">
                                <!-- <div onclick = "confirmDeleteRecipe(111)" style = "cursor: pointer;" class = "row recipecard">
                                    <div class = "col-md-auto">
                                        <img src = "../about/merin.png" class = "recipeimg"></img>
                                    </div>
                                    <div class = "col-md-auto" style = "padding-left: 10px;">
                                        <div class = "row">
                                            <h5>Homemade Pizza Recipe<small class="text-muted" style = "padding-left: 10px"><i>Posted on January 10, 2021</i></small></h5>
                                        </div>
                                        
                                        <div class = "row">
                                            <div class = "recipedescription"></div>
                                        </div>
                                    </div>
                                    </label>
                                </div> -->
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
                
                </div>

                </div>
            </div>
        </div>
    
        <!-- Confirm Delete Modal -->
        <!-- Modal HTML -->
        <div id="deleteModal" class="modal">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header flex-column" id = "closeIcon">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>						
                        <h4 class="modal-title w-100">Are you sure?</h4>	
                        
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer justify-content-center" id = "confirmationButtons">
                        <!-- <button type="button" class="btn btn-danger" onclick = "deleteUser()">Delete</button>
                        <button type="button" class="btn btn-secondary" onclick = "closeModals()">Cancel</button> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>


</html>

<script>
    // Headers Tab
    var profilepicture = document.getElementById('profileId');
    var fullname = document.getElementById('displayfullname');
    var displayname = document.getElementById('displayname');
    var rank = document.getElementById('displayrank');
    var joindate = document.getElementById('displayjoin');

    // Information Tab
    var firstname = document.getElementById('displayfirst');
    var lastname = document.getElementById('displaylast');
    var email = document.getElementById('displayemail');
    var aboutbio = document.getElementById('displayabout');

    //Password Tab
    var newpassword = document.getElementById('displaynewpassword');
    var confirmpassword = document.getElementById('displayconfirmpassword');

    // Permissions Tab
    var isAdmin = document.getElementById('notifications-blog');

    
    var usersModal = document.getElementById("userModal");
    var deleteModal = document.getElementById("deleteModal");

    var recipeContainer = document.getElementById('recipeCards');

    var profileImage = document.getElementById('profileId');
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            profileImage.style.height = "140px";
            profileImage.style.width = "140px";
            profileId.src = URL.createObjectURL(file)
        }
    }
    
    function saveChanges(){
        console.log(firstname.value);
        console.log(lastname.value);
        console.log(email.value);
        console.log(aboutbio.value);
        console.log(btoa(newpassword.value));
        console.log(btoa(confirmpassword.value));
        var permission = 0;
        if(isAdmin.checked){
            permission = 1;
        }else{
            permission = 0;
        }
        

        // if(newpassword.value != confirmpassword.value){
        //     alert("Passwords did not match");
        // }else{
        //     if(confirmpassword.value == ''){
        //         alert("Passwords must not be empty");
        //     }
        //     else{
                
        //     }
        // }

        if(confirmpassword.value.length > 0 && confirmpassword.value.length < 10){
            alert("Passwords must have a minimum length of 10");
        }else{
            if(newpassword.value != confirmpassword.value){
                alert("Passwords did not match");
            }else{
                // Upload Picture
                var files = document.getElementById("imgInp").files;
                if (files.length > 0) { //checks if there is an img uploaded or not
                    var formData = new FormData();
                    formData.append("file", files[0]);
                    var image_id = Math.floor(Math.random() * 1000000000);
                    var randomFilename = (firstname.value)+image_id+".png";
                    formData.append("file", files[0], randomFilename);

                    var xhttp = new XMLHttpRequest();


                    xhttp.open("POST", "./uploadprofileimg.php", true);

                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var response = this.responseText;
                            if (response == 1) {
                                location.reload();
                            } else {
                                alert("Uploading Photo Failed.");
                            }
                        }
                    };
                    xhttp.send(formData);
                }
            
                // Update Profile
                $.ajax({
                    url: "./updateprofile.php",
                    type: "POST",
                    data: {
                        "userid": localStorage.getItem('idSelected'),
                        "firstname": btoa(firstname.value),
                        "lastname": btoa(lastname.value),
                        "email": btoa(email.value),
                        "about": btoa(aboutbio.value),
                        "permission": permission,
                        "password": btoa(newpassword.value),
                        "image": randomFilename,
                    },
                    async: false,
                    success: function() {
                        alert("Updated Successfully");
                    }
                });
                }
            }
        
        usersModal.style.display = "none";
    }

    function getRank(num){
        if (num == 0){
            return 'User';
        }else if(num == 1){
            return 'Administrator';
        }else if(num == 2){
            return 'Founder';
        }else{
            return 'Invalid Rank';
        }
    }

    

    function Load(searchMethod){
        $.ajax({
            url: "getusers.php",
            type: "POST",
            data: {
                "search": searchMethod,
            },
            success: function(response) {
                recipeContainer.textContent = '';
                response.forEach(function(users, index){
                    if(searchMethod == 'all'){
                        var userimage = users.image;
                        if(users.image == ''){
                            userimage = '../about/default.jpg';
                        }
                        $('#userdata').append('<tr><td>'+(index+1)+'</td><td><a href=""><img src="../assets/'+userimage+'" class="avatar" alt="Avatar">'+(atob(users.firstname))+'</a></td><td>'+atob(users.email)+'</td><td>'+(getRank(users.permissions))+'</td><td>'+atob(users.date)+'</td><td><button class = "settings" title="Settings" data-toggle="tooltip" id = "btnSettings" onclick = "Load('+users.id+')"><i class="material-icons">&#xE8B8;</i></button><button class = "delete" title="Delete" data-toggle="tooltip" id = '+users.id+' onclick = "confirmDeleteUser('+users.id+')"><i class="material-icons">&#xE5C9;</i></button></td></tr>');
                        
                    }else{
                        var data_firstname = atob(users.firstname);
                        var data_lastname = atob(users.lastname);
                        var data_email = atob(users.email);
                        var data_rank = getRank(users.permissions);
                        var data_joindate = atob(users.joindate)
                        var data_recipedate = users.recipedate;
                        var data_about = atob(users.description);
                        var data_image = '../assets/'+users.image;
                        if(users.image == ''){
                            data_image = '../about/default.jpg';
                        }
                        if(data_rank == 'Administrator'){
                            rank.innerHTML = 'Administrator';
                            rank.style.backgroundColor = "#ffdfa2";
                            isAdmin.checked = true;
                            isAdmin.disabled = true;
                        }else if(data_rank == 'Founder'){
                            rank.innerHTML = 'Founder';
                            rank.style.backgroundColor = "rgb(186 225 255)";
                            isAdmin.checked = true;
                            isAdmin.disabled = true;
                        }else{
                            rank.innerHTML = 'User';
                            rank.style.backgroundColor = "rgb(205 205 205 / 64%)";
                            isAdmin.checked = false;
                        }
                        fullname.innerHTML = data_firstname + '  ' + data_lastname;
                        displayname.innerHTML = '@' + data_firstname; 
                        rank.innerHTML = data_rank;

                        firstname.value = data_firstname;
                        lastname.value = data_lastname;
                        email.value = data_email;
                        aboutbio.value = data_about;
                        profilepicture.src = data_image;
                        
                        joindate.innerHTML = 'Joined ' + data_joindate;

                        usersModal.style.display = "block";

                        console.log(searchMethod);
                        localStorage.setItem("idSelected", searchMethod);

                        if(users.user_id == searchMethod){
                            $('#recipeCards').append('<div onclick = "confirmDeleteRecipe('+users.recipe_id+', '+users.user_id+')" style = "cursor: pointer;" class = "row recipecard"><div class = "col-md-auto"><img src = "../assets/'+users.img_name+'" class = "recipeimg"></img></div><div class = "col-md-auto" style = "padding-left: 10px;"><div class = "row"><h5>'+users.recipe_name+'<small class="text-muted" style = "padding-left: 10px"><i>Posted on '+data_recipedate+'</i></small></h5></div><div class = "row"><div class = "recipedescription">'+users.recipe_description+'</div></div></div></div>');
                        }
                    }
                })
            }
        });
    }

    Load('all');

    
    function confirmDeleteRecipe(recipeid, userid){
        const confirmButtons = document.getElementById('confirmationButtons');
        confirmButtons.textContent = '';
        $("#closeIcon").append('<button type="button" class="close" aria-hidden="true" onclick = "minimizeDeleteModal()">&times;</button>');
        $("#confirmationButtons").append('<button type="button" class="btn btn-danger" onclick = "deleteRecipe('+recipeid+', '+userid+')">Delete</button>');
        $("#confirmationButtons").append('<button type="button" class="btn btn-secondary" onclick = "minimizeDeleteModal()">Cancel</button>');
        deleteModal.style.display = "block";
    }

    function deleteRecipe(recipeid, userid){
        // Delete The Recipe
        $.ajax({
            url: "./deleteitem.php",
            type: "POST",
            data: {
                "recipe_id": recipeid,
            },
            success: function() {
            }
        });
        Load(userid);
        minimizeDeleteModal();
    }

    function confirmDeleteUser(id){
        const confirmButtons = document.getElementById('confirmationButtons');
        confirmButtons.textContent = '';
        $("#closeIcon").append('<button type="button" class="close" aria-hidden="true" onclick = "minimizeDeleteModal()">&times;</button>');
        $("#confirmationButtons").append('<button type="button" class="btn btn-danger" onclick = "deleteUser('+id+')">Delete</button>');
        $("#confirmationButtons").append('<button type="button" class="btn btn-secondary" onclick = "minimizeDeleteModal()">Cancel</button>');
        deleteModal.style.display = "block";
    }

    function deleteUser(userid){
        $.ajax({
            url: "./deleteuser.php",
            type: "POST",
            data: {
                "user_id": userid,
            },
            success: function() {
            }
        });
        location.reload();
    }

    function minimizeDeleteModal(){
        deleteModal.style.display = "none";
    }

    function changePhoto(){
        
    }
    
    // Navigation Tab Between Settings and Recipe
    var btnTabs = document.querySelectorAll('.tabs');
    const lists = document.querySelectorAll('.tab-pane');

    btnTabs.forEach(btn => {
        btn.addEventListener("click", () => {
            btnTabs.forEach(btn => btn.classList.remove("active"));
            lists.forEach(recipe_list => recipe_list.classList.remove("active"));

            btn.classList.add("active");
            document.querySelector(btn.dataset.target).classList.add("active");
        })
    })

    window.onclick = function(event) {
        if (event.target == usersModal) {
            location.reload();
        }else if(event.target == deleteModal){
            location.reload();
        }
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