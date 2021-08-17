<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

$tid = $_SESSION["t_id"];
// Parameter from url
$url_st_roll_no = $_GET['s'];
$url_st_sec = $_GET['se'];
$url_st_class = $_GET['c'];
$url_exam_name = $_GET['e_n'];

$sql_t = "SELECT * FROM `teachers` where t_id = '$tid'";
$result_t = mysqli_query($conn,$sql_t);
$row_t = mysqli_num_rows($result_t);
while($row = mysqli_fetch_assoc($result_t)){
        $t_id = $row['t_id'];
        $name = $row['name'];
        $section = $row['section'];
        $class_t = $row['class'];
        $subject = $row['subject'];
}
$t_class = $class_t."-".$section;

// to check class teacher Status start
$sql_acc = "SELECT * FROM `teachers` WHERE t_id = '$tid' and class_teacher = '$t_class'";
$result_acc = mysqli_query($conn,$sql_acc);
$row_acc = mysqli_num_rows($result_acc);

  if($row_acc == 0){
    header("location:/h_exams/approval/t_class.php");
    }
// to check account approval End

// ------------------------- //
// To check profile_img is uploaded or not
$sql_img = "select user_image from `teachers` where t_id ='$tid' and user_image = '0'";
$conn_img = mysqli_query($conn,$sql_img);
$p_img= mysqli_num_rows($conn_img);


// profile_img data from database
$sqlp_img = "select user_image from `teachers` where t_id ='$tid' and user_image <> '0'";
$pro_img = mysqli_query($conn,$sqlp_img);
$pro_num_img = mysqli_num_rows($pro_img);

while($row = mysqli_fetch_assoc($pro_img)){
  $uimg = $row['user_image'];
}
// End of profile_img
// ------------------------- //
// $re = array("pass"=>"$p", "name"=>"$n", "uname"=>"$u", "exam_id" => "$url_exam_id");
if(isset($_POST['make_result'])){
    $roll_no = $_POST['roll_no'];
    $sec = $_POST['sec'];
    $ar = array("st_roll_no" => "$roll_no", "exam_name"=>"$url_exam_name", "t_id" => "$tid", "t_class" => "$class_t", "st_sec" => "$sec");
    $_SESSION['data'] = $ar;
    header('location:resultscript.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>MarksSheet</title>
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
.result{
  margin-top: 100px;
}
.btn{
    background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 50px;
     width: 150px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     margin-top: 10px;
     padding: 0px;
     border-radius: 80px;
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
  #logo_header{
    width: 60px;
    height: 60px;
  }
  #profileImage{
    width: 60px;
  }
  #sub{
  margin: 8px 12px;
box-sizing: border-box;
outline: none;
padding: 12px 20px;
    margin: 8px 0;
    margin-left: 13px;
    border-width:0px;
    border:none;
    outline-style: 1px solid #eee;
    border-radius: 20px;
  }
  td{
    padding: 8px;
  }
  th{
    padding: 8px;
  }
  #btn{
    background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 40px;
     width: 100px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     border-radius: 20px;
     margin-left: 0px;
     }
     #st_img{
         width: 70px;
         height: 70px;
         border-radius: 50px;
     }
     .main-content{
        padding-top: 30px;
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
      echo  "<img id='profileImage' src='assets/img/teacher.png' class='mobile_profile_image' alt='Please Uploaded Photo'>";
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
            <a href="index.html"> <img alt="image" src="../assets/images/logo.jpg" id="logo_header" class="header-logo" /> <span
                class="logo-name">HAYAT</span>
            </a>
          </div>
          <!-- sidebar -->
<ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="profile_t.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="exam.php" class="nav-link"><i class="fas fa-paperclip"></i><span>Exams</span></a>
            </li>
            <li class="dropdown">
              <a href="profile.php" class="nav-link"><i class="far fa-user"></i><span>Profile</span></a> 
            </li>
            <li class="dropdown">
              <a href="select_exam.php" class="nav-link"><i class="fa fa-book" aria-hidden="true"></i><span>Results</span></a>
            </li>
            <li class="dropdown">
              <a href="checkingsubject.php" class="nav-link"><i class="fas fa-book-medical"></i><span>Checking</span></a>
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
<div class="result">
<?php
// wrong verification
$st_id_sql="SELECT * from students s JOIN marksheet m on m.roll_no = s.roll_no where m.exam_name = '$url_exam_name' and s.class = '$class_t' and s.section = '$section' and m.class = '$class_t' and m.section = '$section' and m.section = '$url_st_sec'   and m.roll_no = '$url_st_roll_no' and m.paper_status = 'Checked';";
$st_id_re = mysqli_query($conn, $st_id_sql);
$st_id_re_num = mysqli_num_rows($st_id_re);


 //----------- calling function to create entry in result for result fetch
function checkresult($conn,$roll_no,$class,$sec){
    $sql = "SELECT * from results where section = '$sec' and class = '$class' and roll_no = '$roll_no'";
    $result = mysqli_query($conn,$sql);
    $result_num = mysqli_num_rows($result);
    return $result_num;
    }
    // call the functions
$re_num = checkresult($conn,$url_st_roll_no,$url_st_class,$url_st_sec);
//END--------- calling function to create entry in result for result fetch


// {{{{{{$st_id_re_num == 1 ================== is shown the no of subjects}}}}}
if($st_id_re_num == 1){
    //----------- calling function to create entry in result for result fetch
    function addresult($conn,$roll_no,$class,$sec,$url_exam_name){
    $sql = "INSERT INTO `results` (`roll_no`, `class`, `section`, `percentage`, `Grade`, `paper_status`,`exam_name`)
    VALUES ('$roll_no', '$class', '$sec', 'pending','pending', 'pending','$url_exam_name');";
    $result = mysqli_query($conn,$sql);
    return true;
    }
    // call the functions in loop
    if($re_num === 0){
    addresult($conn,$url_st_roll_no,$url_st_class,$url_st_sec,$url_exam_name);
    }
    //END--------- calling function to create entry in result for result fetch
$sql_sub = "SELECT * from results where section = '$url_st_sec' and class = '$url_st_class' and exam_name = '$url_exam_name' and roll_no = '$url_st_roll_no'";
// $sql_sub = "SELECT * from results s JOIN students st ON s.roll_no = st.roll_no where st.roll_no = '$st_roll_no'";
$result_sub = mysqli_query($conn,$sql_sub);
$result_sub_num = mysqli_num_rows($result_sub);
while($sub = mysqli_fetch_assoc($result_sub)){
    $class = $sub['class'];
    $roll_no = $sub['roll_no'];
    $sec = $sub['section'];
    $per = $sub['percentage'];
    $grade = $sub['Grade'];
    $status = $sub['paper_status'];

        echo "<div class='result'>".
        "<table>".
        "<thead>".
            "<tr>".
            "<th>Roll No</th>".
            "<th>Class</th>".
            "<th>Section</th>".
            "<th>Percentage</th>".
            "<th>Final Grade</th>".
            "<th>Exam Status</th>".
            "<th>Make Result</th>".
            "</tr>".
        "</thead>".
        "<tbody>".
            "<tr>".
            "<td>"."$roll_no"."</td>".
            "<td>"."$class"."</td>".
            "<td>"."$sec"."</td>".
            "<td>"."$per"."%"."</td>".
            "<td>"."$grade"."</td>".
            "<td>"."$status"."</td>".
            "<td>"."<form method='post'>
            <input type='hidden' value='$sec' name='sec'>
            <input type='hidden' value='$roll_no' name='roll_no'>
            <input type='submit' class='btn' value='Make Result' name='make_result'>
            </form>".
            "</tr>".
            "</tbody>".
            "</table>";
    }
}else{
    echo "<div class='result'>".
    "<table>".
    "<thead>".
        "<tr>".
        "<th>Note</th>".
        "</tr>".
    "</thead>".
    "<tbody>".
        "<tr>".
        "<td>".'<b>Your Class teacher mates do not complete the checking yet</b>'."</td>".
        "</tbody>".
        "</table>";
}
?>
</div>
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
</body>
</html>