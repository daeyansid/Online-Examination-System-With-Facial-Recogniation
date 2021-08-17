<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

// take data from url
$url_t_id = $_GET['i'];
$url_exam_id = $_GET['e_i'];
$tid = $_SESSION["t_id"];
$url_exam_name = $_GET["ex_n"];

$sql_t = "SELECT * FROM `teachers` where t_id = '$url_t_id'";
// $sql_t = "SELECT * FROM `teachers` where t_id = '5'";
$result_t = mysqli_query($conn,$sql_t);
$row_t = mysqli_num_rows($result_t);
while($row = mysqli_fetch_assoc($result_t)){
        $t_id = $row['t_id'];
        $name = $row['name'];
}
// to check exam is created or not
$sql_e = "SELECT * FROM `exam_data` where t_id = '$url_t_id' and exam_id = '$url_exam_id' and subject <> ''";
$result_e = mysqli_query($conn,$sql_e);
$exam_num = mysqli_num_rows($result_e);
// to check exam is created or not

// ------------------------- //
// To check profile_img is uploaded or not
$sql_img = "select user_image from `teachers` where t_id ='$tid' and user_image = '0'";
$conn_img = mysqli_query($conn,$sql_img);
$p_img= mysqli_num_rows($conn_img);


// profile_img data from database
$sqlp_img = "select user_image from `teachers` where t_id ='$tid' and user_image <> '0'";
$pro_img = mysqli_query($conn,$sqlp_img);
$pro_num_img = mysqli_num_rows($pro_img);

// End of profile_img
// ------------------------- //
while($row = mysqli_fetch_assoc($pro_img)){
  $uimg = $row['user_image'];
}
if(isset($_POST['submit_mcq'])){
    $title = $_POST['title'];
    $option_1 = $_POST['option_1'];
    $option_2 = $_POST['option_2'];
    $option_3 = $_POST['option_3'];
    $option_4 = $_POST['option_4'];
    $marks = $_POST['marks_mcq'];
    $sec = $_POST['section'];
    $class = $_POST['class'];
    $sql = "INSERT INTO `mcq` (`title`, `option_1`, `option_2`, `option_3`, `option_4`, `marks`, `t_id`, `exam_id`,`name`,`section`,`class`,`exam_name`)
            VALUES ('$title', '$option_1', '$option_2', '$option_3', '$option_4', '$marks', '$url_t_id', '$url_exam_id','$name','$sec','$class','$url_exam_name');";
    $resul = mysqli_query($conn,$sql);
    if($resul){
        header('location:../teacher/question_paper.php?err=mcqd&i='.$url_t_id.'&e_i='.$url_exam_id.'&ex_n='.$url_exam_name.'');
    }else{
        header('location:../teacher/question_paper.php?err=mcqf&i='.$url_t_id.'&e_i='.$url_exam_id.'&ex_n='.$url_exam_name.'');
    }

}
if(isset($_POST['submit_que'])){
  $que = $_POST['que'];
  $marks = $_POST['marks'];
  $sec = $_POST['section'];
  $class = $_POST['class'];
  $sql = "INSERT INTO `questions` (`question`, `t_id`, `name`, `exam_id`,`marks`,`class`,`section`,`exam_name`) VALUES ('$que', '$url_t_id', '$name', '$url_exam_id','$marks','$class','$sec', '$url_exam_name');";
  $resul = mysqli_query($conn,$sql);
  if($resul){
      header('location:../teacher/question_paper.php?err=qd&i='.$url_t_id.'&e_i='.$url_exam_id.'&ex_n='.$url_exam_name.'');
  }else{
      header('location:../teacher/question_paper.php?err=qf&i='.$url_t_id.'&e_i='.$url_exam_id.'&ex_n='.$url_exam_name.'');
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Question Paper</title>
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
    #exam_name{
        font-size: 30px;
    }
    #err{
        font-size: 25px;
        font-weight: 25px;
    }
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #f6f6f6;
    font-size: 14px;
    font-weight: 400;
    font-family: "Nunito", "Segoe UI", arial;
    color: #6c757d;
}

.container {
    background-color: #555;
    color: #ddd;
    border-radius: 10px;
    padding: 20px;
    font-family: 'Montserrat', sans-serif;
    max-width: 700px;
    margin-bottom: 15px;
    margin-top: 15px;
}
.question_form {
    background-color: #555;
    color: #ddd;
    border-radius: 10px;
    padding: 20px;
    font-family: 'Montserrat', sans-serif;
    max-width: 700px;
    margin-bottom: 15px;
    margin-top: 15px;
}

.container>p {
    font-size: 32px
}

.question {
    width: 75%
}

.options {
    position: relative;
    padding-left: 40px
}

#options label {
    display: block;
    margin-bottom: 15px;
    font-size: 14px;
    cursor: pointer
}

.options input {
    opacity: 0
}

.checkmark {
    position: absolute;
    top: -1px;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #555;
    border: 1px solid #ddd;
    border-radius: 50%
}

.options input:checked~.checkmark:after {
    display: block
}

.options .checkmark:after {
    content: "";
    width: 10px;
    height: 10px;
    display: block;
    background: white;
    position: absolute;
    top: 50%;
    left: 50%;
    border-radius: 50%;
    transform: translate(-50%, -50%) scale(0);
    transition: 300ms ease-in-out 0s
}
#q-a{
    margin-left: 470px;
}
.options input[type="radio"]:checked~.checkmark {
    background: #21bf73;
    transition: 300ms ease-in-out 0s
}

.options input[type="radio"]:checked~.checkmark:after {
    transform: translate(-50%, -50%) scale(1)
}

.btn-primary {
    background-color: #555;
    color: #ddd;
    border: 1px solid #ddd
}

.btn-primary:hover {
    background-color: #0066A2;
    border: 1px solid #0066A2;
}

.btn {
    background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 40px;
     width: 100px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     border-radius: 20px;
}
.btn-submit {
    padding: 10px 0;
    margin: 10px 0;
}
.btn_q {
    background: #0066A2;
     color: white;
     border-style: outset;
     border-color: #0066A2;
     height: 40px;
     width: 100px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     border-radius: 20px;
     width: 124px;
}

@media(max-width:576px) {
    .question {
        width: 100%;
        word-spacing: 2px;
    }
}
#heading{
    margin-bottom: 15px;
}
#marks{
    margin-bottom: 10px;
}
.question{
    margin-top: 20px;
}
.question_form{
    margin-top: 20px;
}
p{
    padding: 8px 0;
}
h2{
    padding: 8px 0;
}
h1{
    text-align: center;
}
#countdown{
    font-size: 45px;
    color: Green;
}
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
    if(isset($_GET['err']) && $_GET['err'] == "mcqd"){
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-check'></i></div>
        <strong>Success!</strong> MCQ Added Succesfull!
        </div>";
    }
    if (isset($_GET['err']) && $_GET['err'] == "mcqf"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> MCQ Added UnSuccesfull, Please contact Admin
        </div>";
    }
    if(isset($_GET['err']) && $_GET['err'] == "qd"){
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  Question Added succesfully
                </div>";
    }
    if (isset($_GET['err']) && $_GET['err'] == "qf"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> Question Added UnSuccesfull, Contact Admin
        </div>";
    }
    if(isset($_GET['err']) && $_GET['err'] == "es"){
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  Exam Created succesfully
                </div>";
    }
    if (isset($_GET['err']) && $_GET['err'] == "ef"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> Exam Created UnSuccesfull, Contact Admin
        </div>";
    }
}
?>
<div class="quetion">
    <!-- que start -->
    <h1>Questions Section</h1>
<?php
if($exam_num >= 1){
    echo '<form method="post">'.
    'Add Question:<br>'.
    '<input type="text" class="data_st" required name="que" placeholder = "Add Question"><br>'.
    'Add Marks:<br>'.
    '<input type="text" class="data_st" required name="marks" placeholder = "Add Marks"> <br>'.
    "Class<br>".
    "<input type='input' class='data_st' required name='class' placeholder='Class'><br>".
    "Section<br>".
    "<input type='input' class='data_st' required name='section' placeholder='section'><br>".
    '<input type="submit" class="btn" value="Add Question" name="submit_que">'.
    '</form>';
}else{
    echo "Create Exam First";
}
echo "<h1>Questions-------------------------------</h1>";
    $que_fetch = "SELECT * from questions WHERE t_id = '$url_t_id' and exam_id = '$url_exam_id'";
    $exam_que_fetch = mysqli_query($conn,$que_fetch);
    $question_num_fetch = mysqli_num_rows($exam_que_fetch);
    $q_no = 1;
    if($question_num_fetch >= 1){
    while($question_fetch = mysqli_fetch_assoc($exam_que_fetch)){
    
        $q_id = $question_fetch['q_id'];
        $question = $question_fetch['question'];
        $marks = $question_fetch['marks'];
        $q_name = $question_fetch['name'];
        $sec = $question_fetch['section'];
        $class = $question_fetch['class'];

        echo "<form class='question_form' method='post'>
        <div id='marks'> marks: $marks </div>
            <h2>Question $q_no:</h2>
            <p>$question</p>
            <h4>Answer Here:</h4>
            <input type='text' class='data_st' placeholder='Answer Here' disabled>
            <br>
            <input type='submit' class='btn_q' value='Submit Quetion' disabled>
        </form>";
    $q_no = $q_no+1;
    }
    }
    echo "</tbody>".
    "</table>";
    if($question_num_fetch == 0){
        echo "<b>NO QUESTION ADDED</b>";
    }
?>
</div>
<!-- que end -->
<!-- mcq start -->
<div class="mcq">
<h1>MCQS Section</h1>
<?php
if($exam_num >= 1){
        echo "<div class='question1'>".
        "<label>Add Question</label>".
        "<form method ='POST'>".
        "Title <br>".
            "<input class='data_st' type='input' required name='title' placeholder='Enter Queston here'><br>".
            "option - 1 <br>".
            "<input class='data_st' type='input' required name='option_1' placeholder='Enter option-1'><br>".
            "option - 2 <br>".
            "<input class='data_st' type='input' required name='option_2' placeholder='Enter option-2'><br>".
            "option - 3 <br>".
            "<input class='data_st' type='input' required name='option_3' placeholder='Enter option-3'><br>".
            "option - 4 <br>".
            "<input class='data_st' type='input' required name='option_4' placeholder='Enter option-4'><br>".
            "Marks<br>".
            "<input class='data_st' type='input' required name='marks_mcq' placeholder='Enter Marks'><br>".
            "Class<br>".
            "<input class='data_st' type='input' required name='class' placeholder='Class'><br>".
            "Section<br>".
            "<input class='data_st' type='input' required name='section' placeholder='section'><br>".
            "submit<br>".
            "<input type='submit' class='btn' value='submit' name='submit_mcq'>".
            "</form>".
            "</div>";
        }
echo "<h1>MCQS-------------------------------</h1>";
$mcq_fetch = "SELECT * from mcq WHERE t_id = '$url_t_id' and exam_id = '$url_exam_id'";
$result_fetch = mysqli_query($conn,$mcq_fetch);
$mcq_num = mysqli_num_rows($result_fetch);
$js_id=1;
if($mcq_num >= 1){
while($mcq_fetch = mysqli_fetch_assoc($result_fetch)){

    $m_mcq_id = $mcq_fetch['mcq_id'];
    $m_title = $mcq_fetch['title'];
    $m_option_1 = $mcq_fetch['option_1'];
    $m_option_2 = $mcq_fetch['option_2'];
    $m_option_3 = $mcq_fetch['option_3'];
    $m_option_4 = $mcq_fetch['option_4'];
    $m_marks = $mcq_fetch['marks'];
    $sec = $mcq_fetch['section'];
    $class = $mcq_fetch['class'];
        echo "<div class='container mt-sm-5 my-1'>
        <div id='marks'> marks: $m_marks </div>
        <div class='question ml-sm-5 pl-sm-5 pt-2'>
            <div id='heading' class='py-2 h5'><b>MCQ $js_id:- $m_title</b></div>
            <form id='mcq_form' method='post'>
            <div class='ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3' id='options'> 
            <input type='hidden' name='id' value='"."$m_mcq_id"."'>
            <label class='options'>$m_option_1 <input type='radio'> <span class='checkmark'></span> </label>
            <label class='options'>$m_option_2 <input type='radio'> <span class='checkmark'></span> </label>
            <label class='options'>J$m_option_3 <input type='radio'> <span class='checkmark'></span> </label>
            <label class='options'>$m_option_4 <input type='radio'> <span class='checkmark'></span> </label> </div>
            </div>
        <div class='d-flex align-items-center pt-3'>
            <div class='ml-auto mr-sm-5'>
            <input id='mcq-$js_id' type='submit' class='btn' value='Submit MCQ' disabled>
            </div>
        </div>
        </form>
    </div>";
    $js_id = $js_id+1;



}
}
    echo "</tbody>".
    "</table>";
echo "
<h4>After Completion Go back Quetions And MCQS Automatically Added To Your Exam</h4>";
if($mcq_num == 0){
echo '<b>NO MCQS ADDED</b>';
}

?>
</div>
<!-- mcq div end -->
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
</body>
</html>