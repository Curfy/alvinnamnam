<?php
    if (!isset($_COOKIE['email'])){
        header('Location: ../home/index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"> </script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="profilepagestyle.css">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>


	<title>Profile Page</title>

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

	<?php
	include("./login/endpoints/db.php");

	$attempts = 0;
	$maxattempts = 3;
	$expireResult = "";
	$message = '';

	if (!isset($_COOKIE['page'])) {
		setcookie("page", "login", time() + 3600);
	}
	if (!isset($_COOKIE['attempt'])) {
		setcookie("attempt", 0, time() + 3600);
	}

	// PAGE SELECT MODULE
	if (isset($_POST["pageSelect"])) {
		if ($_POST['pageSelect'] == 'create') {
			setcookie("page", "create", time() + 3600);
		} elseif ($_POST['pageSelect'] == 'login') {
			setcookie("page", "login", time() + 3600);
		} elseif ($_POST['pageSelect'] == 'forgot') {
			setcookie("page", "forgot", time() + 3600);
		}
	}

	// ERROR MESSAGE
	if (isset($_COOKIE['attempt'])) {
		if ($_COOKIE['attempt'] < $maxattempts) {
			if ($_COOKIE['attempt'] > 0) {
				$message = '<div class="alert alert-danger"> Incorrect Login: (' . $_COOKIE["attempt"] . "/" . $maxattempts . ')</div>';
			}
		} else {
			$message = '<div class="alert alert-danger"><span id = "time"> Login Attempt Limit Reached!</span></div>';
		}
	}


	function checkUpper($array)
	{
		foreach ($array as $letter) {
			if (ctype_upper($letter)) {
				return true;
			}
		}
		return false;
	}

	function checkLower($array)
	{
		foreach ($array as $letter) {
			if (ctype_lower($letter)) {
				return true;
			}
		}
		return false;
	}

	function checkSpecial($array)
	{
		foreach ($array as $letter) {
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $letter)) {
				return true;
			}
		}
		return false;
	}

	function checkContain($password, $string)
	{
		if (strpos(strtolower($password), strtolower($string)) !== false) {
			return true;
		} else {
			return false;
		}
	}

	function checkDictionary($password, $conn)
	{
		$sql = "SELECT word from entries";
		$list = $conn->query($sql);
		if ($list->num_rows > 0) {
			$result = $list->fetch_all(MYSQLI_ASSOC);
			foreach ($result as $row) {
				if (strlen($row['word']) >= 4) {
					if (checkContain($password, $row['word'])) {
						return $row['word'];
					}
				}
			}
			return false;
		} else {
			return false;
		}
	}

	function passwordValidation($firstname, $lastname, $password, $conn, $type)
	{
		$result = '';
		$array = str_split($password);
		if (strlen($password) < 10) {
			$result .= "Password length must be atleast 10 characters.<br>";
		}
		if (!checkUpper($array)) {
			$result .= "Password must contain atleast 1 uppercase letter.<br>";
		}
		if (!checkLower($array)) {
			$result .= "Password must contain atleast 1 lowercase letter.<br>";
		}
		if (!checkSpecial($array)) {
			$result .= "Password must contain atleast 1 special character.<br>";
		}
		if (checkContain($password, $firstname)) {
			$result .= "Password must not be containing your first name.<br>";
		}
		if (checkContain($password, $lastname)) {
			$result .= "Password must not be containing your last name.<br>";
		}

		$dictionary = checkDictionary($password, $conn);
		setcookie("word", $dictionary, time() + 3600);
		if ($dictionary) {
			$result .= "Password must not contain a word from the dictionary.<br>" . "$dictionary";
		}
		
		if($type == "reset"){
		}else{
			if (checkSpecial(str_split($firstname))){
				$result .= "First name must not contain any special characters. <br>";
			}
			if (checkSpecial(str_split($lastname))){
				$result .= "Last name must not contain any special characters. <br>";
			}
		}
		
		return $result;
	}

	function existingAccount($conn, $checkEmail)
	{
		$sql = "SELECT * FROM users WHERE email = '$checkEmail'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}

	function validateDate($datenow, $sqldate)
	{
		$days = 0;
		$datenow = strtotime($datenow);
		$sqldate = strtotime($sqldate);

		$datediff = $sqldate - $datenow;

		$days = abs(round($datediff / (60 * 60 * 24)));

		return $days;
	}

	function getDays($now, $sqldate)
	{

		$datediff = $sqldate - $now;

		$days = abs(round($datediff / (60 * 60 * 24)));

		echo $days . " days";
	}


	function check_password($pass, $conpass)
	{
		if ($pass == $conpass) {
			return true;
		} else
			return false;
	}

	$message = '<strong>Welcome ' . strtoupper(base64_decode($_COOKIE['user'])) . '</strong>';

	// RESET PASSWORD
	if (isset($_POST["resetPassword"])) {
		$email = base64_encode($_POST["forgotemail"]);
		$newpassword = $_POST["newpassword"];
		$connewpassword = $_POST["connewpassword"];

		// checkPasswords($email, $conn);

		$sql = "SELECT * FROM users WHERE email = '$email'";
		$list = $conn->query($sql);
		if ($email != "" and $newpassword != "") {
			if (check_password($newpassword, $connewpassword)) {
				if ($list->num_rows > 0) {
					if ($_POST["g-recaptcha-response"] != '') {
						$result = $list->fetch_all(MYSQLI_ASSOC);
						foreach ($result as $row) {
							$result = passwordValidation($row["firstname"], $row["lastname"], $newpassword, $conn, "reset");
							$message = '<div class="alert alert-danger">' . $result . '</div>';
							if (strlen($result) <= 0) {
								$newpassword = base64_encode($newpassword);
								$sqlpassword = "UPDATE users SET password='$newpassword' WHERE email='$email'";
								if ($conn->query($sqlpassword) === TRUE) {
									// updateTime($row["id"], $conn);
									$message =  'Account Password Successfully Updated';
								} else {
									echo "Error: " . $sql . "<br>" . $conn->error;
								}
								$conn->close();
							}
						}
					} else {
						$message = 'Please verify captcha.';
					}
				} else {
					$message = 'Account Does Not Exist!';
				}
			} else {
				$message = 'Passwords do not match';
			}
		} else {
			$message = 'There must be no empty inputs.';
		}
	}
	?>
	<!-- Nav -->
	<div class="mycontainer">
		<div class="mynavbar">
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
	<!-- End of Nav -->

	<!--Profile card-->
	<div class="text-center">
		<div class="container">
			<div class="my-card">
				<div class="row g-0 justify-content-center">
					<div class="col-lg align-self-center" id = "profileImage">
						<!-- <img src="./about/default.jpg" class="mx-auto d-block img-circle" alt="profile picture"> -->
					</div>
					<div class="col-lg-5">
						<div class="" id=profile></div>
					</div>
					<div class="col-lg align-self-center">
						<div class="profile2">
							<p>Keep your account secure by regulary changing your password</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End of profile card-->

	<!-- Toast -->

	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
		<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
			<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
		</symbol>
	</svg>
	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
		<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<strong class="me-auto">New Notification</strong>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body alert-info">
				<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
					<use xlink:href="#exclamation-triangle-fill" />
				</svg>
				<?php echo $message; ?>
				<strong></strong>
			</div>
		</div>
	</div>
	<!-- End of Toast -->

	<!-- USER UPDATE MODULE -->
	<div class="modal fade" id="modalUpdateUser" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content" id ='usersModal'>
                
				<div class="container" style="padding: 0">
	
					<!-- Whole Card Including Card Header/Informations -->
					<div class="card">
					<!-- Card Header -->
					<div class="card-header" style = "background-color: #fbd691">Edit Profile</div>
					<!-- Card Informations -->
					<div class="card-body">
						<div class="e-profile">
						<!-- First Tab -->
						<div class="row toprow">
							<div class="col">
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
							<div class="row toprow">
								<div class="text-center text-sm-left mb-2 mb-sm-0">
									<h4 id = 'displayfullname' class="pt-sm-2 pb-1 mb-0 text-nowrap"></h4>
									<label for = 'imgInp' class = 'btn btn-primary updatePhotoLabel'><i class="fa fa-fw fa-camera"></i> Update Photo <input type='file' id="imgInp" accept="image/*"></input></label>
									<p id = 'displayname' class="mb-0">@Zenocy</p>
									<div class="text-muted" style = "margin-bottom: 20px"><small id = 'displayjoin'>Joined 09 Dec 2017</small></div>
								</div>
							</div>
						</div>
						
						<!-- Settings Tab -->   
						<ul class="nav nav-tabs"></ul>
	
						<!-- Middle Tab -->
						<div class="tab-content pt-3 botrow">
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
	</div>

	<!-- FORGOT MODULE -->
	<div class="modal fade" id="modalResetPass" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form action="" method="POST">
					<div class="modal-header justify-content-center">
						<h5 class="brand" id="staticBackdropLabel">Enter your new Password</h5>
					</div>
					<div class="modal-body">
						<div class="container">
							<!-- <span><?php echo $message; ?></span> -->

							<label for="forgotemail" class="form-label" style="color: #DE0C19">Email Address</label>
							<div class="input-group flex-nowrap mb-3">
								<input type="email" class="form-control" placeholder="Email" id="forgotemail" name="forgotemail" value="<?php echo base64_decode($_COOKIE['email']) ?>" readonly>
							</div>
							<!--NEW PASSWORD -->
							<label for="password" class="form-label" style="color: #DE0C19">Enter New Password</label>
							<div class="input-group flex-nowrap mb-3">
								<input type="password" class="form-control" placeholder="Enter New Password" id="newpassword" name="newpassword" value="">
							</div>

							<!--REPEAT PASSWORD -->
							<label for="repassword" class="form-label" style="color: #DE0C19"> Confirm Password</label>
							<div class="input-group flex-nowrap mb-3">
								<input type="password" class="form-control" placeholder="Confirm Password" id="connewpassword" name="connewpassword" value="">
							</div>

							<div class="center">
								<div class="g-recaptcha" data-sitekey="6Lf8V5AgAAAAAJbPcAnpvBnSUnCG0LggXzuyUVKW"></div>
							</div>
						</div>
					</div>

					<div class="modal-footer center">
						<button type="submit" class="btn btn-dark" name="resetPassword">Reset</button>
						<button type="submit" class="btn btn-dark" name="cancel">Cancel</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	</div>
	<!--End Posted Recipes-->

	<!--Kenneth Recipes-->
	<div class="recipes_container active">
		<h5 class="fw-bold">Created Recipes</h5>
		<!-- <div class="btn_container">
			<button class="my-btn active" data-target="#streetDishes">Street Foods</button>
			<button class="my-btn" data-target="#dishDishes">Dish</button>
			<button class="my-btn" data-target="#dessertDishes">Dessert</button>
		</div> -->

		<!-- <form action="recipedetail.php" method="POST">
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
		</form> -->
		<form action = "recipedetail.php" method = "POST">
			<div id="profileDishes" class="recipe_list active">
			</div>
		</form>
	</div>
	<!--End of Kenneth Recipes-->

	<!--Footer-->
	<div class="background-design2">
		<footer class="page-footer">
			<p>&#169; All Tasty. All right reserved.</p>
		</footer>
	</div>
	<!--End of Footer-->

	</div>
</body>

</html>

<script>
	/* kenneth scripts */
	Load('all');
	var fname = document.getElementById('displayfirst');
	var lname = document.getElementById('displaylast');
	var demail = document.getElementById('displayemail');
	var dabout = document.getElementById('displayabout');

	var blahimg = document.getElementById('profileId')
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blahimg.style.height = "150px";
            blahimg.style.width = "150px";
			blahimg.style.borderradius = '50%';
            blahimg.src = URL.createObjectURL(file)
        }
    }

	var randomFilename = '';
    function saveChanges(){
        // Upload Picture
		var files = document.getElementById("imgInp").files;
		if (files.length > 0) { //checks if there is an img uploaded or not
			document.getElementById('usersModal').style.display = 'none';
			document.getElementById('modalUpdateUser').style.pointerEvents = 'none';
			var formData = new FormData();
			formData.append("file", files[0]);
			var image_id = Math.floor(Math.random() * 1000000000);
			randomFilename = (fname.value)+image_id+".png";
			formData.append("file", files[0], randomFilename);

			var xhttp = new XMLHttpRequest();


			xhttp.open("POST", "./user/uploadprofileimg.php", true);

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
			url: "./updateuser.php",
			type: "POST",
			data: {
				"userid": getCookie('id'),
				"firstname": btoa(fname.value),
				"lastname": btoa(lname.value),
				"email": btoa(demail.value),
				"about": btoa(dabout.value),
				"image": randomFilename,
			},
			success: function(response) {
				if(response){
					if(randomFilename == ''){
						location.reload();
					}
				}
			}
		});
    }

	function Load(searchmethod) {
        $.ajax({
            url: "./getrecipe.php",
            type: "POST",
			data:{
				"search": searchmethod,
			},
            success: function(response) {
                response.forEach(function(recipe, index) {
					if (recipe.user_id == getCookie("id")){
						var cooktime = recipe.cook_time + ' mins';
						if (recipe.cook_time > 60) {
							cooktime = ' ' + Math.round(recipe.cook_time / 60) + ' hours';
							if (recipe.cook_time % 60 > 0) {
								cooktime += ' ' + (recipe.cook_time % 60) + ' mins';
							}
						}

						$("#profileDishes").append('<div class = "recipe"><button class = "recipeButton" name = "button" value = "'+ recipe.recipe_id +'" ><img src="./assets/' + recipe.img_name + '" class="img recipe-img"><div class = "recipename">'+recipe.recipe_name+'</div><div class = "descrip-cook"> <i class="fa fa-clock-o"></i>'+cooktime+'</div> <div class = "descrip-serve"> <i class="fa fa-cutlery"></i> '+recipe.servings+' people</div> <hr/> <div class = "flexStar" id = "'+index+'"> <div class = "rateStar" id = "rateStar'+index+'"> </div> </div></button></div>');
						$('#profileDishes').append('<input type="hidden" name="previouspage" value="./profilepage.php">');
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
	
	var toastTrigger = document.getElementById('liveToastBtn')
	var toastLiveExample = document.getElementById('liveToast')
	var toast = new bootstrap.Toast(toastLiveExample)
	toast.show()

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

	function loadProfile(id) {
		$.ajax({
			url: "./loadprofile.php",
			type: "POST",
			data: {
				"id": (id),
			},
			success: function(response) {
				var firstname = atob(response[0].firstname);
				var lastname = atob(response[0].lastname);
				var about = atob(response[0].description);
				var email = atob(response[0].email);
				var profileImg = './assets/'+response[0].image;

				if(profileImage == ''){
					profileImage = './about/default.jpg';
				}
				$("#profile").append('<p class="profile-name underline">' + firstname + ' ' + lastname + '</p>');
				$("#profileImage").append('<img src="'+profileImg+'" class="img-circle" alt="profile picture">');
				// $("#profile").append('<p class="profile-info">Life is awesome! Make your life tasty with All Tasty.</p>');
				$("#profile").append('<p class="profile-info">'+about+'</p>');
				$(".profile2").append('<p class="underline"> Email: ' + email + '</p>');
				$(".profile2").append('<a class="logout" data-bs-toggle="modal" data-bs-target="#modalUpdateUser" style = "font-size: 15px"> Update Account </a>');
				$(".profile2").append('<a class="logout" data-bs-toggle="modal" data-bs-target="#modalResetPass" style = "font-size: 15px"> Reset Password </a>');

				// Load Previous Data
				blahimg.style.height = "140px";
				blahimg.style.width = "140px";
				blahimg.src = profileImg;

				fname.value = firstname;
				lname.value = lastname;
				demail.value = email;
				dabout.value = about;
				
			}
		});
	}

	loadProfile(getCookie('id'));
</script>