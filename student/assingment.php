<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

if(!isset($_SESSION["in"]) || $_SESSION["in"] !== true && $_SESSION["st"] === true){
  header("Location:/h_exams/index.php");
  exit;
}else{
//   $userid = $_SESSION["user_id"];
  $name = $_SESSION["name"];
  $sid = $_SESSION["st_id"];
  //  include("/centut/connection/config.php");

$sql_t = "SELECT * FROM `students` where roll_no = '$sid'";
$result_t = mysqli_query($conn,$sql_t);
      $row_t = mysqli_num_rows($result_t);
      while($row = mysqli_fetch_assoc($result_t)){
        $uname = $row['username'];
        $class = $row['class'];
        $name = $row['name'];
        $email = $row['email'];
        $sec = $row['section'];
      }
}
// ------------------------------------//
// to check account approval Status start
$sql_acc = "SELECT * FROM `students` WHERE roll_no = '$sid' and acc_approval = '0'";
$result_acc = mysqli_query($conn,$sql_acc);
$row_acc = mysqli_num_rows($result_acc);

  if($row_acc == 1){
    header("location:/h_exams/approval/st_notApproval.php");
    exit;
  }
// to check account approval End
// ------------------------------------//
// To check profile_img is uploaded or not
$sql_img = "select user_image from students where roll_no ='$sid' and user_image = '0'";
$conn_img = mysqli_query($conn,$sql_img);
$p_img= mysqli_num_rows($conn_img);


// profile_img data from database
$sqlp_img = "select * from students where roll_no ='$sid' and user_image <> '0'";
$pro_img = mysqli_query($conn,$sqlp_img);
$pro_num_img = mysqli_num_rows($pro_img);

while($row = mysqli_fetch_assoc($pro_img)){
  $uimg = $row['user_image'];
}
// End of profile_img
// ------------------------- //

// profile_img
$sql_img = "select user_image from students where roll_no ='$sid'";
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
  <title>Student Dashboard</title>
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
    width: 60px;
  }
</style>

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
              <!-- <img alt="image" src="assets/img/user.png" class="user-img-radious-style"> -->
<?php
    if($p_img == 1){
      echo  "<img id='profileImage' src='assets/img/pic girls.jpg' class='mobile_profile_image' alt='Please Uploaded Photo'>";
}else{
   echo  "<img id='profileImage' src='$uimg' class='mobile_profile_image' alt='Uploaded Photo'>";
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
            <a href="profile_st.php"> <img alt="image" src="../assets/images/logo.jpg" id="logo_header" class="header-logo" /> <span
                class="logo-name">HAYAT</span>
            </a>
          </div>
          <!-- sidebar -->
         <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="profile_st.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="selectpaper.php" class="nav-link"><i class="fas fa-paperclip"></i><span>Exams</span></a>
            </li>
            <li class="dropdown">
              <a href="profile.php" class="nav-link"><i class="far fa-user"></i><span>Profile</span></a> 
            </li>
            <li class="dropdown">
              <a href="select_exam.php" class="nav-link"><i class="fa fa-book" aria-hidden="true"></i><span>Results</span></a>
            </li>
            <li class="dropdown">
              <a href="face_reg.php" class="nav-link"><i class="fas fa-smile-beam"></i><span>Face Registreation</span></a>
            </li>
            <li class="dropdown">
              <a href="instruction.php" class="nav-link"><i class="fas fa-book-open"></i><span>Instruction</span></a>
            </li>
            <li class="dropdown">
              <a href="assingment.php" class="nav-link"><i class="fa fa-tasks" aria-hidden="true"></i><span>Assingment</span></a>
            </li>
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->


<h1>Available Assingments :</h1>

<?php
$sql_sub = "SELECT * FROM `assingments` WHERE class = '$class' and section = '$sec'";
$result_sub = mysqli_query($conn,$sql_sub);
while($row = mysqli_fetch_assoc($result_sub)){
  $file = $row['file'];
  $title = $row['title'];
  $sub = $row['subject'];
  $date = $row['date'];
        echo" <div class ='pdf'>
        <h5>Title: $title</h5>
            <h5>Subject: $sub</h5>
            <h5>Date: $date</h5>
            <embed src='$file' width='500' height='375' type='application/pdf'>";
    }
    ?>
          </div>
        </section>
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
</body>
</html>