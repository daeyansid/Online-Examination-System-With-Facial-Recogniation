<!--Start error for login/signin side -->
<?php
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_GET['admin']) && $_GET['admin'] == "in"){
  header("location:/centut/profile_admin.php");
}
?>  <!--End error for login/signin side -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/centut/css/main.css">
    <title>Login To TheCentroid</title>
    <style>
    #forgot{
      cursor: pointer;
    }
    </style>
</head>
<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active" id="active" style="cursor: pointer;"> Admin Login </h2>
    <!-- Icon -->
    <div class="fadeIn first">
      <!-- <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" /> -->
      <i class="fas fa-user"></i>
    </div>

    <!-- Login Form for Admin-->
    <form id="student" action="/centut/connection/login.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="user" placeholder="Admin Username">
      <input type="text" id="password" class="fadeIn third" name="pass" placeholder="Admin password">
      <input type="submit" class="fadeIn fourth" name="a_btn" value="Log In">
    </form>

  </div>
</div>
<script src="js/script.js"></script>
</body>
</html>