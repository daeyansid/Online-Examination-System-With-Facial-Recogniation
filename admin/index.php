<!--Start error for login/signin side -->
<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["st"]) && $_SESSION["st"] === true){
  // echo "<script>window.location.href='/forum/welcome.php'; </script>";
  header("location:/h_exams/student/profile_st.php");
exit;
}elseif(isset($_SESSION["t"]) && $_SESSION["t"] === true){
  header("location:/h_exams/teacher/profile_t.php");

}
?>  <!--End error for login/signin side -->



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>
<div class="limiter">
	<div class="container-login100" style="background-image: url('../assets/images/bg-01.jpg');">
	<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
	<?php
	// admin change
		if(isset($_GET['addin']) && $_GET['addin'] == "inme"){
			header("location:admin/index.php");
		}
	// HTTP_REFERER uses to chcek that site is redirected to index or some link
if(isset($_SERVER['HTTP_REFERER'])){
	if(isset($_GET['err']) && $_GET['err'] == "wrongad"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong>Error!</strong> Not a Registered Admin!!!.
                </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "wrongpass"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong>Error!</strong> Wrong Password!!! Dear Admin.
                </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "ru"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong>Error!</strong> Username Not Available Please Choose other Username.
                </div>";
    }
}
	
	
	?>
<!-- form start Students-->
				<form id="student" action="/h_exams/connection/login.php" method="POST" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-53">
						Admin Log In
					</span>
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Username
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<!-- <input class="input100" type="text" name="username" > -->
						<input class="input100" type="text" id="login" name="user" placeholder="Admin Username" required>
						<span class="focus-input100"></span>
					</div>
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>

						<a onclick="forgot()" class="txt2 bo1 m-l-5">
							Forgot?
						</a>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<!-- <input class="input100" type="password" name="pass" > -->
						<input class="input100" type="password" id="password" name="pass" placeholder="Admin password" required>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn m-t-17">
						<button name="a_btn" value="Log In" class="login100-form-btn">
							Sign In
						</button>
					</div>
				</form>
<!-- form end Admin-->
			</div>
		</div>
	</div>
	<script src="../assets/js/script.js"></script>
</body>
</html>