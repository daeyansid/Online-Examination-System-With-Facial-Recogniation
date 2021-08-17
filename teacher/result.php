<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

$tid = $_SESSION["t_id"];
// parameter from url
$url_e_id = $_GET['e'];
$url_sub = $_GET['s'];
$url_sec = $_GET['sec'];
$url_exam_name = $_GET['ex_n'];

$sql_t = "SELECT * FROM `teachers` where t_id = '$tid'";
$result_t = mysqli_query($conn,$sql_t);
$row_t = mysqli_num_rows($result_t);
while($row = mysqli_fetch_assoc($result_t)){
        $t_id = $row['t_id'];
        $name = $row['name'];
        $section = $row['section'];
        $class = $row['class'];
        $subject = $row['subject'];
}
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
if(isset($_POST['open_paper'])){
    $exam_id = $_POST['id'];
    $st_id = $_POST['st_id'];
    
    header('location:../teacher/checking.php?s='.$st_id.'&e='.$exam_id.'&t='.$t_id.'&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Submitted Exams</title>
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
  .btn{
    background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 40px;
     width: 120px;
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
     #st_pic{
       height: 80px;
       width: 80px;
       border-radius: 50px;
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
<div class="student">
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>IMG</th>
      <th>Student Name</th>
      <th>Section</th>
      <th>Class</th>
      <th>Subject</th>
      <th>Exam Status</th>
      <th>Marks Obtained</th>
      <th>Date and Time Completed Exam</th>
      <th>Open Paper</th>
    </tr>
   </thead>

   <?php
// to fetch Students--------------
$sql_student = "SELECT * from students s RIGHT join marksheet a on a.roll_no = s.roll_no WHERE a.section = '$url_sec' and a.class = '$class' and s.section = '$url_sec' and s.class = '$class' and a.exam_id='$url_e_id' and a.subject = '$url_sub';";
$result_st = mysqli_query($conn,$sql_student);
$result_num_student = mysqli_num_rows($result_st);
$i = 1;
while($exam_created = mysqli_fetch_assoc($result_st)){
    $st_id = $exam_created['roll_no'];
    $st_name = $exam_created['name'];
    $st_class = $exam_created['class'];
    $time_complete = $exam_created['exam_time_complete'];
    $exam_id = $exam_created['exam_id'];
    $paper_status = $exam_created['paper_status'];
    $pic = $exam_created['user_image'];
    $marks_obtained = $exam_created['total_marks_obtained'];
    echo  "<tbody>".
    "<tr>".
    "<td>".$i."</td>".
    "<td>"."<img src='$pic' id='st_pic' alt='student Picture'>"."</td>".
    "<td>"."$st_name"."</td>".
    "<td>"."$st_class"."</td>".
    "<td>"."$class"."</td>".
    "<td>"."$url_sub"."</td>".
    "<td id='status-$i' >"."$paper_status"."</td>".
    "<td>"."$marks_obtained"."</td>".
    "<td>"."$time_complete"."</td>".
    "<td>"."<form method='post'>
    <input type='hidden' name='st_id' value='"."$st_id"."'>
    <input type='hidden' name='id' value='"."$exam_id"."'>
    <input type='submit' id='btn-$i' class='btn' value='Open Here' name='open_paper'>
    </form>".
    "</tr>";
            $i++;
    }
    echo "</tbody>".
     "</table>";
if($result_num_student == 0){
        echo "<tbody>".
            "<tr>".
        "<td>"."No Student Alloted Yet"."</td>".
        "<td>".""."</td>".
        "<td>".""."</td>".
        "<td>".""."</td>".
        "<td>".""."</td>".
        "</tr>".
    "</tbody>".
    "</table>";
    }
// End of Fetch of Student
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
  <script>
var btn = 'btn-';
var status = 'status-';
var x = <?php echo json_encode($i); ?>-1;
for(let i=1; i<=x; i++){
  var btn_id = btn+i;
  var status_id = status+i;
  var status_load = document.getElementById(status_id).innerHTML;
  var btn_load = document.getElementById(btn_id);
if(status_load === 'Checked'){
    btn_load.style.display = 'none';
}
}
</script>
</body>
</html>