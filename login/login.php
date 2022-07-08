 <?php
	include("endpoints/db.php");
	$attempts = 0;
	$maxattempts = 3;
	$expireResult = '';
	$message = '';
 	$prevEmail = '';


	// createAccount Variables
 	$createfirstName = '';
 	$createlastName = '';
	$createEmail = '';


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

	
	if (isset($_POST["loginAccount"])) {
		if (!isset($_COOKIE['attempt'])) {
			$_COOKIE['attempt'] = 0;
		}

		if ($_COOKIE['attempt'] >= $maxattempts) {
			// $_SESSION['error'] = 'Attempt limit reach';
			// $message = '<div class="alert alert-danger"> Attempt Limit Reached: (' . ($_SESSION["attempt"] + 1) . "/" . $maxattempts . ')</div>';
			$message = '<div class="alert alert-danger"><span id = "time"> Login Attempt Limit Reached!</span></div>';
		} else {
			$email = $_POST['email'];
			$hashedemail = base64_encode($email);
			$sql = "SELECT * FROM users WHERE email = '$hashedemail'";
			$list = $conn->query($sql);
			if ($list->num_rows > 0) {
				$result = $list->fetch_all(MYSQLI_ASSOC);
				foreach ($result as $row) {
					$hashedpassword = base64_encode($_POST['password']);
					if ($hashedpassword == $row['password']) {
						$datenow = date('Y-m-d');
						$dayspassed = validateDate($datenow, base64_decode($row['date']));
						if ($dayspassed > 30) {
							$message = '<div class="alert alert-danger"> The password for this account has expired! </div>';
						} else {
							//Successful Login
							setcookie("user", $row['firstname'], time() + 3600, '/', NULL, 0);
							setcookie("id", $row['id'], time() + 3600, '/', NULL, 0);
							setcookie("email", $row['email'], time() + 3600, '/', NULL, 0);
							setcookie("perms", $row['permissions'], time() + 3600, '/', NULL, 0);
							setcookie("attempt", 0, time() + 3600);

							$message = '<div class="alert alert-danger"> Login Successful! </div>';
							header("location:../home/index.php");
						}
					} else {
						// Password Incorrect
						$attempts = $_COOKIE['attempt'] + 1;
						setcookie("attempt", $attempts, time() + 3600);
						if ($attempts == $maxattempts) {
							//5*60 = 5mins, 60*60 = 1hour, 2*60*60 = 2hours
							$message = '<div class="alert alert-danger"><span id = "time"> Attempt Limit Reached!</span></div>';
							setcookie("timer", 60 * 5, time() + 3600);
						} else {
							$message = '<div class="alert alert-danger"> Incorrect Login: (' . $attempts . "/" . $maxattempts . ')</div>';
						}
					}
				}
			} else {
				// $attempts = $_COOKIE['attempt'] + 1;
				// setcookie("attempt", $attempts, time() + 3600);
				// $message = '<div class="alert alert-danger"> Incorrect Login: (' . $attempts . "/" . $maxattempts . ')</div>';
				// if ($attempts == $maxattempts) {
				// 	//5*60 = 5mins, 60*60 = 1hour, 2*60*60 = 2hours
				// 	$message = '<div class="alert alert-danger"><span id = "time"> Attempt Limit Reached!</span></div>';
				// 	setcookie("timer", 60 * 5, time() + 3600);
				// }
				$message = '<div class="alert alert-danger"> Account Does not Exist! </div>';
			}
		}
		$prevEmail = $_POST['email'];
	}
	
	
	if (isset($_POST["createAccount"])) {
		$fname = $_POST['createfname'];
		$lname = $_POST['createlname'];
		$email =  base64_encode($_POST['createemail']);
		$password = $_POST['createpassword'];
		$confirmpassword =  $_POST['repeatpassword'];
		$date = date("Y-m-d");
		$result = passwordValidation($fname, $lname, $password, $conn, "create");

		$SecretKey = '6Lf8V5AgAAAAAOA0d1kqociJxA5n8jWhuIVSPM6l';
		$ResponseKey = $_POST['g-recaptcha-response'];
		$userIP = $_SERVER['REMOTE_ADDR'];

		$url = "https://www.google.com/recaptcha/api/siteverify?secret=$SecretKey&response=$ResponseKey&remoteip=$userIP";
		$response = file_get_contents($url);

		if ($fname != "" and $lname != "" and $email != "" and $password != "") {
			if (check_password($password, $confirmpassword)) {
				if ($_POST["g-recaptcha-response"] != '') {
					if (!existingAccount($conn, $email)) {
						if (strlen($result) <= 0) {
							$fname = base64_encode($fname);
							$lname = base64_encode($lname);
							$password = base64_encode($password);
							$date = base64_encode($date);
							$sql = "INSERT INTO users (firstname, lastname, email, password, date) VALUES ('$fname', '$lname', '$email', '$password', '$date');";
							if ($conn->query($sql) === TRUE) {
								setcookie("page", "login", time() + 3600);
								$result = 'Account successfully created!';

								// $passwordSql = "INSERT INTO passwords (email, password1, password2, password3, password4, password5, password6) VALUES ('$email', '$password', ' ', ' ', ' ', ' ', ' ');";
								// if ($conn->query($passwordSql) === TRUE) {
								// }
							} else {
								echo "Error: " . $sql . "<br>" . $conn->error;
							}
							$conn->close();
						}
						$createEmail = $_POST['createemail'];
					} else {
						$result .= "\nEmail Account Address is already being used.";
					}
					$message = '<div class="alert alert-danger">' . $result . '</div>';
				} else {
					$message = '<div class="alert alert-danger"> Please verify captcha. </div>';
				}
			} else {
				$message = '<div class="alert alert-danger"> Passwords do not match </div>';
			}
		} else {
			$message = '<div class="alert alert-danger"> There must be no empty inputs. </div>';
		}

		$createfirstName = $_POST['createfname'];
		$createlastName = $_POST['createlname'];
		$createEmail = $_POST['createemail'];
	}

	if (isset($_POST["resetPassword"])) {
		$email = base64_encode($_POST["hiddenemail"]);
		
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
									$message = '<div class="alert alert-danger"> Account Password Successfully Updated </div>';
								} else {
									echo "Error: " . $sql . "<br>" . $conn->error;
								}
								$conn->close();
							}
						}
					} else {
						$message = '<div class="alert alert-danger"> Please verify captcha. </div>';
					}
				} else {
					$message = '<div class="alert alert-danger"> Account Does Not Exist! </div>';
				}
			} else {
				$message = '<div class="alert alert-danger"> Passwords do not match </div>';
			}
		} else {
			$message = '<div class="alert alert-danger"> There must be no empty inputs. </div>';
		}
	}
	?>
 <html>

 <head>
 	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	 

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
 		$(document).ready(function() {
 			if (getCookie("page") == "login") {
 				$("#loginModule").modal('show');
 			} else if (getCookie("page") == "create") {
 				$("#createModule").modal('show');
 			} else if (getCookie("page") == "forgot") {
 				$("#sendOTPModule").modal('show');
 			}
 		});
 	</script>
 </head>

 <body>
 	<!-- LOGIN MODULE -->
 	<div class="modal fade show" id="loginModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<form action="index.php" method="POST">
				 	<a href = '/home/index.php'>
						<div class="modal-header justify-content-center returnhome" data-toggle="tooltip" title="Home Page">
							<img src="All-Tasty-.png" width="60px" alt="">
						</div>
					 </a>
 					<div class="modal-body">
 						<div class="container">
 							<h4 class="mb-3 fw-bold  text-center">Log In to All Tasty</h4>
 							<span><?php echo $message; ?></span>
 							<label for="email" class="form-label">Email</label>
 							<div class="input-group flex-nowrap mb-3" id = "prevEmail">
 								<input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $prevEmail; ?>">
 							</div>
 							<label for="password" class="form-label">Password</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="password" class="form-control" placeholder="Password" id="password" name="password" value="">
 							</div>
							<div class="buttons">
								<button type="submit" class="btn btnSquare bg-dark" name="loginAccount">Login</button>
								<button type="submit" class="btn-password" name="pageSelect" value="forgot">Forgot Password?</button>
							</div>
 						</div>
 					</div>
 					<div class="modal-footer justify-content-center mx-3 my-2">
						<p>Don't have an account?</p>
 						<button type="submit" class="btn-signup" name="pageSelect" value="create">Sign Up</button>
 					</div>
 				</form>
 				<!-- <form action="index.php" method="POST">
 			</form> -->

 			</div>
 		</div>
 	</div>

 	<!-- CREATE ACCOUNT MODULE -->
 	<div class="modal fade" id="createModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<form action="index.php" method="POST">
					<a href = '/home/index.php'>
						<div class="modal-header justify-content-center returnhome" data-toggle="tooltip" title="Home Page">
							<img src="All-Tasty-.png" width="60px" alt="">
						</div>
					</a>
 					<div class="modal-body">
 						<div class="container">
 							<h4 class="mb-3 fw-bold  text-center">Join All Tasty</h4>
 							<span><?php echo $message; ?></span>

 							<!-- FIRST NAME -->
 							<label for="fname" class="form-label">First Name</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="text" class="form-control" placeholder="First Name" id="createfname" name="createfname" value="<?php echo $createfirstName; ?>">
 							</div>

 							<!-- LAST NAME -->
 							<label for="lname" class="form-label">Last Name</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="text" class="form-control" placeholder="Last Name" id="createlname" name="createlname" value="<?php echo $createlastName; ?>">
 							</div>

 							<!-- EMAIL -->
 							<label for="email" class="form-label">Email</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="email" class="form-control" placeholder="Email" id="createemail" name="createemail" value="<?php echo $createEmail; ?>">
 							</div>

 							<!-- PASSWORD -->
 							<label for="password" class="form-label">Password</label>
 							<div class="input-group flex-nowrap mb-3" id = "passwordBox">
 								<input type="password" class="form-control" placeholder="Password" id="createpassword" name="createpassword" value="" title = "Password must meet the following requirements">
 							</div>
							
							<div class = "alert alert-danger" id = "message" style = "display: none;" >
							<p class = "errorTitle" id = "errorTitle">Password must meet the following requirements:</p>

								<p id="uppercapital" class="invalid">At least <b>one uppercase letter.</b></p>
								<p id="lowercapital" class="invalid">At least <b>one lowercase letter.</b></p>
								<p id="passwordspecial" class="invalid">At least <b>one special character.</b></p>
								<p id="passwordlength" class="invalid">Password minimum of at least <b>10 characters.</b></p>
								<p id="passworddictionary" class="invalid">Must not contain <b>a word in the dictionary.</b></p>
								<p id="passwordfname" class="invalid">Must not contain <b>First name</b></p>
								<p id="passwordlname" class="invalid">Must not contain <b>Last name</b></p>

								<!-- <p id="capital" class="invalid">A capital (uppercase) letter</p>
								<p id="number" class="invalid">A number</p>
								<p id="length" class="invalid">A minimum 8 characters</p> -->
							</div>

 							<!--REPEAT PASSWORD -->
 							<label for="repassword" class="form-label"> Confirm Password</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="password" class="form-control" placeholder="Confirm Password" id="repeatpassword" name="repeatpassword" value="" disabled>
 							</div>

		 					<input style = "margin-bottom: 20px; margin-left: 2px;" type="checkbox" onclick="showPassword()"> Show Passwords </input>

 							<!-- CAPTCHA -->
 							<div class="center">
 								<div class="g-recaptcha" data-sitekey="6Lf8V5AgAAAAAJbPcAnpvBnSUnCG0LggXzuyUVKW"></div>
 							</div>
		 					
							<div class="class-two">
								<button type="submit" class="btn btnSquares bg-dark" id = "createAccount" name="createAccount" disabled>Sign Up</button>
								
							</div>
							
							<p class="policy"> By continuing, you agree to All Tasty's Terms of Service and Privacy Policy. <p>
 						</div>
 					</div>

 					<div class="modal-footer justify-content-center mx-3 my-2">
					 	<p>Already have an account?</p>
 						<button type="submit" class="btn-login " name="pageSelect" value="login">Log In</button>
 					</div>
 				</form>
 			</div>
 		</div>
 	</div>

	 <!-- FORGOT PASSWORD MODULE -->
	<div class="modal fade" id="forgotModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<form action="index.php" method="POST">
 					<div class="modal-header justify-content-center">
 						<h5 class="brand" id="staticBackdropLabel">Forgot Password</h5>
 					</div>
 					<div class="modal-body">
 						<div class="container" id = "forgotContainerModule">
							<!-- <label for="otpforgotemail" class="form-label" style="color: #de0c19">Enter Email Address</label>
							<div class="input-group flex-nowrap mb-3">
								<input type="email" class="form-control" placeholder="Email" id="otpEmail" name="otpEmail" value="">
							</div> -->
							<div id ='forgotnewemail'>
								<label for="repassword" class="form-label"> Email Address</label>
							</div>
 							<label for="password" class="form-label" style="color: red">Enter New Password</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="password" class="form-control" placeholder="Enter New Password" id="newpassword" name="newpassword" value="" required>
 								<label class="input-group-text" id="addon-wrapping" for="newpassword"><i class="fas fa-lock fa-1x p-2"></i></label>
 							</div>

 							<label for="password" class="form-label" style="color: red">Confirm New Password</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="password" class="form-control" placeholder="Confirm New Password" id="connewpassword" name="connewpassword" value="" required>
 								<label class="input-group-text" id="addon-wrapping" for="newpassword"><i class="fas fa-lock fa-1x p-2"></i></label>
 							</div>


 							<div class="center">
 								<div class="g-recaptcha" data-sitekey="6Lf8V5AgAAAAAJbPcAnpvBnSUnCG0LggXzuyUVKW"></div>
 							</div>
 						</div>
 					</div>

 					<div class="modal-footer justify-content-between mx-3 my-2">
 						<button type="submit" class="btn btnSquare bg-dark" name="resetPassword" value = "reset" onClick = "cancel()" required>Reset</button>
 					</div>

 				</form>

 			</div>
 		</div>
 	</div>
	 
 	<!-- SEND EMAIL OTP MODULE -->
 	<div class="modal fade" id="sendOTPModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<form onsubmit = "return false" method="POST">
 					<div class="modal-header justify-content-center">
 						<h5 class="brand" id="staticBackdropLabel">Forgot Password</h5>
 					</div>
 					<div class="modal-body">
 						<div class="container" id = "resetContainer">
							<div id = "sendemailotp"></div>

 							<label for="forgotemail" class="form-label" style="color: #de0c19">Enter Email Address</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="email" class="form-control" placeholder="Email" id="enterEmail" name="enterEmail">
 							</div>
 						</div>
 					</div>

 					<div class="modal-footer justify-content-between mx-3 my-2">
					 	<button type="submit" class="btn btnSquare bg-dark" name="sendEmail" onClick = "sendOTP()">Reset Password</button>
					 	<button type="submit" class="btn-cancel " name="pageSelect" value="login" onClick = "cancel()">Cancel</button>
 					</div>
		 			
 				</form>
 			</div>
 		</div>
 	</div>
	
	<!-- OTP MODULE -->
	<div class="modal fade" id="verifyOTPModule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
 		<div class="modal-dialog modal-dialog-centered">
 			<div class="modal-content">
 				<form onsubmit = "return false" method="POST">
 					<div class="modal-header justify-content-center">
 						<h5 class="brand" id="staticBackdropLabel">Forgot Password</h5>
 					</div>
 					<div class="modal-body">
 						<div class="container" id = "resetContainer">
						 	<div id = "sendemailotp2"></div>
						
 							<label for="forgotemail" class="form-label" style="color: #de0c19">Enter OTP Code Here:</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="text" class="form-control" placeholder="Code" id="otpCode" name="otpCode" value="">
 							</div>

 							<!-- <label for="password" class="form-label" style="color: #de0c19">Enter New Password</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="password" class="form-control" placeholder="Enter New Password" id="newpassword" name="newpassword" value="">
 							</div>

 							<label for="password" class="form-label" style="color: #de0c19">Confirm New Password</label>
 							<div class="input-group flex-nowrap mb-3">
 								<input type="password" class="form-control" placeholder="Confirm New Password" id="connewpassword" name="connewpassword" value="">
 							</div>

 							<div class="center">
 								<div class="g-recaptcha" data-sitekey="6LeQ6qEeAAAAAHoVDImiuHU2_-kC7kkIyPrtbhtU"></div>
 							</div> -->
 						</div>
 					</div>

 					<div class="modal-footer justify-content-between mx-3 my-2">
					 	<button type="submit" class="btn btnSquare bg-dark" name="verifyCode" onClick = "verifyOTP()">Verify Code</button>
 						<button type="submit" class="btn-cancel " name="pageSelect" value="login" onClick = "cancel()">Cancel</button>
 					</div>
		 			
 				</form>
 			</div>
 		</div>
 	</div>
 	<script>
		// <label for="password" class="form-label" style="color: #de0c19">Enter New Password</label>
		// <div class="input-group flex-nowrap mb-3">
		// 	<input type="password" class="form-control" placeholder="Enter New Password" id="newpassword" name="newpassword" value="">
		// </div>

		

		let code = '';
		function cancel(){
			document.cookie="page=login";
			location.href='./index.php';
		}

		function sendEmail(sendemail){
			var digits = '0123456789';
			var codelength = 4;

			for(let i=1; i <= codelength; i++){
				var index = Math.floor(Math.random() * digits.length);
				code = code + digits[index];
			}
			$.ajax({
			url: "sendotp.php",
			type: "POST",
			data:{
				"sender": sendemail,
				"code": code,
			},
			success: function(response){
			}
			});

		}
		function sendOTP(){
			var sender = document.getElementById('enterEmail');

			// var digits = '0123456789';
			// var codelength = 4;

			// for(let i=1; i <= codelength; i++){
			// 	var index = Math.floor(Math.random() * digits.length);
			// 	code = code + digits[index];
			// }
			$.ajax({
			url: "validateemail.php",
			type: "POST",
			data:{
				"sender": (sender.value),
			},
			cache: false,
			success: function(response){
				if(response.code == '201'){
					sendEmail(sender.value);
					$("#sendOTPModule").modal('hide');
					$("#verifyOTPModule").modal('show');
				}
				else{
					$('#sendemailotp').empty();
					$('#sendemailotp').append('<span><div class="alert alert-danger"> Invalid Email Address</div></span>');
				}
			}
			});
		}

		function verifyOTP(){
			var otpCode = document.getElementById("otpCode");
			if(code == otpCode.value){
				$("#verifyOTPModule").modal('hide');
				$("#forgotModule").modal('show');
				$('#forgotContainerModule').append('<input type = "hidden" name = "hiddenemail" value ="'+(document.getElementById('enterEmail').value)+'"</input>');
				$('#forgotnewemail').append('<div class="input-group flex-nowrap mb-3"><input type="email" class="form-control" value="'+(document.getElementById('enterEmail').value)+'" disabled></div>');
				
			}else{
				$('#sendemailotp2').empty();
				$('#sendemailotp2').append('<span><div class="alert alert-danger"> Invalid OTP Code</div></span>');

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

		var passwordInput = document.getElementById("createpassword");
		var uppercapital = document.getElementById("uppercapital");
		var lowercapital = document.getElementById("lowercapital");
		var passwordspecial = document.getElementById("passwordspecial");
		var passwordLength = 10;
		var fname = document.getElementById("createfname");
		var lname = document.getElementById("createlname");
		var passworddictionary = document.getElementById("passworddictionary");
		var valid = [false];
		var repeatpassword = document.getElementById("repeatpassword");

		passwordInput.onfocus = function(){
			 document.getElementById("message").style.display = "block";
			//  document.getElementById("message").classList.remove('alert-danger')
			//  document.getElementById("message").classList.add('alert-success')
		}

		passwordInput.onblur = function(){
			document.getElementById("message").style.display = "none";
			if(valid.includes(false)){
				passwordBox.classList.remove("validBox");
				passwordBox.classList.add("invalidBox");
				repeatpassword.disabled = true;
			}else{
				passwordBox.classList.remove("invalidBox");
				passwordBox.classList.add("validBox");
				repeatpassword.disabled = false;
			}
		}

		repeatpassword.onblur = function(){
			document.getElementById("createAccount").disabled = false;
		}
		
		passwordInput.onkeyup = function(){
			valid = [];

			// Check Lower Case
			var lowerCaseLetters = /[a-z]/g;
			if(passwordInput.value.match(lowerCaseLetters)) {  
				lowercapital.classList.remove("invalid");
				lowercapital.classList.add("valid");
				valid.push(true);
			} else {
				lowercapital.classList.remove("valid");
				lowercapital.classList.add("invalid");
				valid.push(false);
			}

			// Check Upper Case
			var upperCaseLetters = /[A-Z]/g;
			if(passwordInput.value.match(upperCaseLetters)) {  
				uppercapital.classList.remove("invalid");
				uppercapital.classList.add("valid");
				valid.push(true);
			} else {
				uppercapital.classList.remove("valid");
				uppercapital.classList.add("invalid");
				valid.push(false);
			}

			var specialCharacters = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/g;
			if(passwordInput.value.match(specialCharacters)) {  
				passwordspecial.classList.remove("invalid");
				passwordspecial.classList.add("valid");
				valid.push(true);
			} else {
				passwordspecial.classList.remove("valid");
				passwordspecial.classList.add("invalid");
				valid.push(false);
			}

			if(passwordInput.value.length >= passwordLength) {  
				passwordlength.classList.remove("invalid");
				passwordlength.classList.add("valid");
				valid.push(true);
			} else {
				passwordlength.classList.remove("valid");
				passwordlength.classList.add("invalid");
				valid.push(false);
			}

			// console.log(checkDictionary);
			
			if(passwordInput.value.length >= 4){
				var checkDictionary = function(callback)
				{
					$.ajax({
					url: "getdictionary.php",
					type: "POST",
					data:{
						"word": (passwordInput.value),
					},
					success: callback
					});
				}

				checkDictionary(function(data){
					if(data.length > 0){
						passworddictionary.classList.remove("valid");
						passworddictionary.classList.add("invalid");
						valid.push(false);
					}else{
						passworddictionary.classList.remove("invalid");
						passworddictionary.classList.add("valid");
						valid.push(true);
					}
				});
			}
			
			
			if( fname.value.toLowerCase() != "" && passwordInput.value.toLowerCase().includes(fname.value.toLowerCase()) ) {  
				passwordfname.classList.remove("valid");
				passwordfname.classList.add("invalid");
				valid.push(false);
			} else {
				passwordfname.classList.remove("invalid");
				passwordfname.classList.add("valid");
				valid.push(true);
			}

			if( lname.value.toLowerCase() != "" && passwordInput.value.toLowerCase().includes(lname.value.toLowerCase()) ) {  
				passwordlname.classList.remove("valid");
				passwordlname.classList.add("invalid");
				valid.push(false);
			} else {
				passwordlname.classList.remove("invalid");
				passwordlname.classList.add("valid");
				valid.push(true);
			}

		}


		function showPassword(){
			var x = document.getElementById("createpassword");
			var y = document.getElementById("repeatpassword");
			if (x.type === "password") {
				x.type = "text";
				y.type = "text";
			} else {
				x.type = "password";
				y.type = "password";
			}
		}
 		

 		function startTimer(duration, display) {
 			var timer = duration,
 				minutes, seconds;
 			var fullseconds = duration;
 			setInterval(function() {
 				minutes = parseInt(timer / 60, 10);
 				seconds = parseInt(timer % 60, 10);

 				minutes = minutes < 10 ? "0" + minutes : minutes;
 				seconds = seconds < 10 ? "0" + seconds : seconds;

 				display.textContent = "Try again in: " + minutes + ":" + seconds;
 				document.cookie = 'timer=' + --fullseconds;
 				if (--timer < 0) {
 					//timer up!!
 					timer = 0;
 					window.location = window.location.href;
 					document.cookie = 'attempt=' + 0;
 				}
 			}, 1000);
 		}

 		function getTimer() {
 			var timer = getCookie("timer");
 			var attempts = getCookie("attempt");
 			if (timer <= 0) {
 				document.cookie = 'timer=' + 0;
 			}
 			if (attempts >= 3) {
 				var timer = getCookie("timer");
 				display = document.querySelector('#time');
 				startTimer(timer, display);
 			}
 		}
 		getTimer();
 	</script>

 </body>



 </html>