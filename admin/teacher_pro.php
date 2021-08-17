<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

$id = $_SESSION["id"];
$tid = $_GET['t'];

$sql = "SELECT * FROM `teachers` where t_id = '$tid'";
$result = mysqli_query($conn,$sql);
$row = mysqli_num_rows($result);
while($row = mysqli_fetch_assoc($result)){
        $s_no = $row['t_id'];
        $name = $row['name'];
        $email = $row['email'];
        $cnic =  $row['t_cnic'];
        $phone =  $row['t_phone'];
        $address =  $row['address'];
        $paddress =  $row['p_address'];
        $paddress =  $row['p_address'];
        $user_image =  $row['user_image'];
        //registration info
        $username =  $row['username'];
        $password =  $row['password'];
}
// to check account approval End
// ------------------------------------//
// To check profile_img is uploaded or not
$sql_img = "select user_image from admin where s_no ='$id' and user_image = '0'";
$conn_img = mysqli_query($conn,$sql_img);
$p_img= mysqli_num_rows($conn_img);


// profile_img data from database
$sqlp_img = "select * from admin where s_no ='$id' and user_image <> '0'";
$pro_img = mysqli_query($conn,$sqlp_img);
$pro_num_img = mysqli_num_rows($pro_img);

while($row = mysqli_fetch_assoc($pro_img)){
  $uimg = $row['user_image'];
}
// End of profile_img
// ------------------------- //

// profile_img
$sql_img = "select user_image from admin where s_no ='$id'";
$conn_img = mysqli_query($conn,$sql_img);
while($row = mysqli_fetch_assoc($conn_img)){
  $uimg = $row['user_image'];
}
// End of profile_img
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Profile</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <!-- custom favicon -->
  <link rel="shortcut icon" href="../assets/images/logo.jpg" type="image/x-icon">

<style>
  #logo_header{
    width: 60px;
    height: 60px;
  }
  #profileImage{
    width: 50px;
    height: 50px;
    border-radius: 30px;
  }
    #req{
        color: red;
    }
    .data_st{
    width: 40%;
    padding: 12px 20px;
    margin: 8px 0;
    margin-left: 13px;
    border-width:0px;
    border:none;
    outline-style: 1px solid #eee;
    border-radius: 20px;
    }
    .info{
        width: 100vw;
        padding: 25px;
    }
    .data_st:focus {
    border: 2px solid #e5e6e7;
    outline: none;
    }
@media only screen and (max-width: 600px) {
    .data_st {
	width: 65%;
  }
}
.btn{
    background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 50px;
     width: 100px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     margin-top: 10px;
     margin-left: 500px;
     }
    .img_p{
         height: 250px;
         width: 250px;
     }
     .profile_pic{
         width: 100vw;
         padding-left: 27%;
     }
     #profile_image{
      width: 150px;
      height: 150px;
      border-radius: 130px;
     }
     .btn_p{
        background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 50px;
     width: 100px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     margin-top: 10px;
     }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
<?php
    if($p_img == 1){
      echo  "<img id='profileImage' src='assets/img/admin.png' alt='Please Uploaded Photo'>";
}else{
   echo  "<img id='profileImage' src='$uimg' class='user-img-radious-style' alt='Uploaded Photo'>";
}
?>
      <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $name;?></div>
              <a href="profile.php" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="/h_exams/connection/logout.php" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="profile.php"> <img alt="image" src="../assets/images/logo.jpg" id="logo_header" class="header-logo" /> <span
                class="logo-name">HAYAT</span>
            </a>
          </div>
          <!-- sidebar -->
         <ul class="sidebar-menu">
         <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="dashboard.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="profile.php" class="nav-link"><i class="far fa-user"></i><span>Profile</span></a> 
            </li>
            <li class="dropdown">
              <a href="teacher.php" class="nav-link"><i class="fas fa-chalkboard-teacher"></i><span>Teachers</span></a>
            </li>
            <li class="dropdown">
              <a href="st.php" class="nav-link"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span>Students</span></a>
            </li>
            <li class="dropdown">
              <a href="instruction.php" class="nav-link"><i class="fas fa-book-open"></i><span>Instruction</span></a>
            </li>
            <li class="dropdown">
              <a href="exam.php" class="nav-link"><i class="fa fa-book" aria-hidden="true"></i><span>Exams</span></a>
            </li>
            <li class="dropdown">
              <a href="result.php" class="nav-link"><i class="fas fa-award"></i></i><span>Results</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->



      <div class="main-content">
        <section class="section">
          <div class="section-body">
          <!--  content Strat here -->

    <div class="info">
    <div class="profile_pic">
<?php

   echo  "<img src='$user_image' id='profile_image' alt='Uploaded Photo'>";
?>
</div>
    
    
    <div class="info">
    <label>
    G-R number
    </label>
    <input type="text"  id="" class="data_st" value=" <?php echo $s_no;?>" placeholder="Enter Roll NO" readonly> <br>
    <label>
    Name
    <span id="req">*</span>
    </label>
    <input type="text"  id="" class="data_st" value="<?php echo $name;?>" placeholder="Enter Name" readonly> <br>
    Email
    <span id="req">*</span>
    </label>
    <input type="text"  id="" class="data_st" value="<?php echo $email;?>" placeholder="Enter Email"> <br>
    <label>
    CNIC Number
    <span id="req">*</span>
    </label>
    <input type="text"  id="" class="data_st" value="<?php echo $cnic;?>" placeholder="Enter Student CNIC"> <br>
    <label>
    Phone Number
    <span id="req">*</span>
    </label>
    <input type="text"  id="" class="data_st" value="<?php echo $phone;?>" placeholder="Enter Student Phone Number"> <br>
    <label>
    Current Address
    <span id="req">*</span>
    </label>
    <textarea id="address" class="data_st"  rows="6" cols="50">
    <?php echo $address;?>
    </textarea>
    <br>
    <label>
    Permement Address
    <span id="req">*</span>
    </label>
    <textarea id="address" class="data_st"  rows="6" cols="50">
    <?php echo $paddress;?>
    </textarea>
    <br>
    </div>
</div>
<!-- username login details -->
<h1>Username / Password Fieldset</h1>
<div class="registration">
Username <br>
<input type="" class="data_st" id="" value="<?php echo $username; ?>" readonly> <br>
Password <br>
<input type="password" class="data_st" id="" value="<?php echo $password; ?>" readonly> <br>
</div>

<!--  content End here -->
          </div>
        </section>
        <!-- side theme  setting -->
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script src="../assets/js/script.js"></script>
  <script>
$('textarea').val($('textarea').val().trim())
  </script>
</body>
</html>