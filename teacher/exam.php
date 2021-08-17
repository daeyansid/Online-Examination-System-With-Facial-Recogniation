<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

$tid = $_SESSION["t_id"];

$sql_t = "SELECT * FROM `teachers` where t_id = '$tid'";
$result_t = mysqli_query($conn,$sql_t);
$row_t = mysqli_num_rows($result_t);
while($row = mysqli_fetch_assoc($result_t)){
        $t_id = $row['t_id'];
        $name = $row['name'];
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
if(isset($_POST['open_exam'])){
    $exam_id = $_POST['id'];
    $exam_name = $_POST['ex_n'];
    header('location:../teacher/question_paper.php?i='.$tid.'&e_i='.$exam_id.'&ex_n='.$exam_name.'');
}

if(isset($_POST['active_exam'])){
    $exam_id = $_POST['id'];
    $sql = "UPDATE `exam_data` SET `status` = 'active' WHERE `exam_data`.`exam_id` = $exam_id;";
            $resul = mysqli_query($conn,$sql);
            if($resul){
                header('location:../teacher/exam.php?err=ad');
            }else{
                header('location:../teacher/exam.php?err=af');
            }
}
if(isset($_POST['done_exam'])){
    $exam_id = $_POST['id'];
    $sql = "UPDATE `exam_data` SET `status` = 'Done' WHERE `exam_data`.`exam_id` = $exam_id;";
            $resul = mysqli_query($conn,$sql);
            if($resul){
                header('location:../teacher/exam.php?err=sd');
            }else{
                header('location:../teacher/exam.php?err=sf');
            }
}
if(isset($_POST['enter_exam'])){
    $exam_name = $_POST['exam'];
    $sub = $_POST['sub'];
    $sec = $_POST['section'];
    $class = $_POST['class'];
    $time = $_POST['time'];

    $sql = "INSERT INTO `exam_data` (`exam_name`, `subject`, `t_id`, `status`, `created`,`section`,`class`,`time`)
    VALUES ('$exam_name', '$sub', '$tid', 'unactive',now(),'$sec','$class','$time')";
    $resul = mysqli_query($conn,$sql);
    if($resul){
        header('location:../teacher/exam.php?err=ed');
    }else{
        header('location:../teacher/exam.php?err=ef');
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Exam Dashboard</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <!-- custom favicon -->
  <link rel="shortcut icon" href="../assets/images/logo.jpg" type="image/x-icon">
  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
     width: 120px;
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
  .btn_a{
    background: #54ca68;
     color: white;
     border-style: outset;
     border-color: #54ca68;
     height: 40px;
     width: 120px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     border-radius: 20px;
     margin-left: 0px;
     }
  .btn_b{
    background: red;
     color: white;
     border-style: outset;
     border-color: red;
     height: 40px;
     width: 100px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     border-radius: 20px;
     margin-left: 0px;
     }
  .btn{
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
#table_exam_wrapper{
  margin-top: 40px;
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
<?php
    if(isset($_SERVER['HTTP_REFERER'])){
    if(isset($_GET['err']) && $_GET['err'] == "ed"){
        // echo  "<div class='alert alert-danger' role='alert'> Profile Update Succesfull! </div>";
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-check'></i></div>
        <strong>Success!</strong>  Exam Create succesfully 
        </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "ef"){
        // echo  "<div class='alert alert-danger' role='alert'> Profile Update UnSuccesfull, Please contact Admin</div>";
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> Exam Create UnSuccesfull, Contact Admin
        </div>";}
    if(isset($_GET['err']) && $_GET['err'] == "ad"){
        // echo  "<div class='alert alert-danger' role='alert'> Password update succesfully, Please Login Again</div>";
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  Active Exam Succesfull
                </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "af"){
        // echo  "<div class='alert alert-danger' role='alert'> Wrong Password!!!, Contact Admin For recovery</div>";
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong>Error!</strong> Active Exam UnSuccesfull, Contact Admin
                </div>";
    }
    if(isset($_GET['err']) && $_GET['err'] == "sd"){
        // echo  "<div class='alert alert-danger' role='alert'> Password update succesfully, Please Login Again</div>";
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  Exam Done Updated Succesfull
                </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "sf"){
        // echo  "<div class='alert alert-danger' role='alert'> Wrong Password!!!, Contact Admin For recovery</div>";
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong>Error!</strong> Exam Done Updated UnSuccesfull, Contact Admin
                </div>";
    }
}
?>

<div class="createxam">
<form action="" method="post">
<h1>Create Exam:</h1><br>
Exam Name <span id="req">*</span><br>
<input class="data_st" type="text" name="exam" placeholder="Exam Name"><br>
Subject <span id="req">*</span><br>
<input class="data_st" type="text" name="sub" placeholder="Subject"><br>
Section <span id="req">*</span><br>
<input class="data_st" type="text" name="section" placeholder="Section"><br>
Class <span id="req">*</span><br>
<input class="data_st" type="text" name="class" placeholder="Class"><br>
Time in Minutes<span id="req">*</span><br>
<input class="data_st" type="text" name="time" placeholder="Time For Exam"><br>
<input class="btn" type="submit" value="submit" name="enter_exam">
</form>
</div>
<div class="createdexam">

<!-- to check exam is created or not -->
<table id="table_exam" >
  <thead>
    <tr>
    <th>#</th>
    <th>Exam Name</th>
    <th>Subject</th>
    <th>Section</th>
    <th>Class</th>
    <th>Date Created</th>
    <th>Time For Exam</th>
    <th>Exam Status</th>
    <th>Open Exam</th>
    <th>Active Exam</th>
    <th>Stop Exam</th>
    </tr>
   </thead>
   <?php
$sql_created_exam = "SELECT * FROM `exam_data` where t_id = '$tid'";
// $sql_created_exam = "SELECT * FROM `exam_data` where t_id = '5'";
$result_e = mysqli_query($conn,$sql_created_exam);
$result_num_exam = mysqli_num_rows($result_e);
$i =1;
if($result_num_exam >= 1){
while($exam_created = mysqli_fetch_assoc($result_e)){

    $exam_name = $exam_created['exam_name'];
    $created = $exam_created['created'];
    $subject = $exam_created['subject'];
    $status = $exam_created['status'];
    $exam_id = $exam_created['exam_id'];
    $section = $exam_created['section'];
    $class = $exam_created['class'];
    $time = $exam_created['time'];
            echo  "<tbody>".
            "<tr>".
            "<th scope='row'>$i</th>".
            "<td>"."$exam_name"."</td>".
            "<td>"."$subject"."</td>".
            "<td>"."$section"."</td>".
            "<td>"."$class"."</td>".
            "<td>"."$created"."</td>".
            "<td>"."$time"." Mins"."</td>".
            "<td id='status-$i' >"."$status"."</td>".
            "<td>"."<form method='post'>
            <input type='hidden' name='id' value='"."$exam_id"."'>
            <input type='hidden' name='ex_n' value='"."$exam_name"."'>
            <input type='submit' class='btn' value='Open Here' name='open_exam'>
            </form>"."</td>".
            "<td>"."<form method='post'>
            <input type='hidden' name='id' value='"."$exam_id"."'>
            <input type='submit' id='btn_a-$i' class='btn_a' value='Active Exam' name='active_exam'>
            </form>"."</td>".
            "<td>"."<form method='post'>
            <input type='hidden' name='id' value='"."$exam_id"."'>
            <input type='submit' id='btn_b-$i' class='btn_b' value='Stop Exam' name='done_exam'>
            </form>"."</td>".
            "</tr>";
            $i =$i +1;
    }
    echo "</tbody>".
     "</table>";
}
else{
    echo "<tbody>".
        "<tr>".
    "<td>"."No Exam Created Yet"."</td>".
    "<td>".""."</td>".
    "<td>".""."</td>".
    "<td>".""."</td>".
    "<td>".""."</td>".
    "</tr>".
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
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script>
$(document).ready( function () {
    $('#table_exam').DataTable();
} );
</script>
<script>
var btn_a = 'btn_a-';
var btn_b = 'btn_b-';
var status = 'status-';
var x = <?php echo json_encode($i); ?>-1;
for(let i=1; i<=x; i++){
  var btn_a_id = btn_a+i;
  var btn_b_id = btn_b+i;
  var status_id = status+i;
  var btn_a_load = document.getElementById(btn_a_id);
  var btn_b_load = document.getElementById(btn_b_id);
  var status_load = document.getElementById(status_id).innerHTML;
if(status_load === 'active'){
    btn_a_load.style.display = 'none';
}
if(status_load === 'Done'){
    btn_b_load.style.display = 'none';
}
}
</script>
</body>
</html>