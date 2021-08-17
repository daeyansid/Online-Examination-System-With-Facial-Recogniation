<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

$tid = $_SESSION["t_id"];

// take data from url
$url_roll_no = $_GET['s'];
$url_exam_id = $_GET['e'];
$url_t_id = $_GET['t'];
$url_sub = $_GET['sub'];
$url_exam_name = $_GET['ex_n'];

$sql_t = "SELECT * FROM `teachers` where t_id = '$tid'";
$result_t = mysqli_query($conn, $sql_t);
$row_t = mysqli_num_rows($result_t);
while ($row = mysqli_fetch_assoc($result_t)) {
    $t_id = $row['t_id'];
    $name = $row['name'];
    $section = $row['section'];
    $class = $row['class'];
}

// ------------------------------------//
// To check profile_img is uploaded or not
$sql_img = "select user_image from teachers where t_id ='$tid' and user_image = '0'";
$conn_img = mysqli_query($conn,$sql_img);
$p_img= mysqli_num_rows($conn_img);


// profile_img data from database
$sqlp_img = "select * from teachers where t_id ='$tid' and user_image <> '0'";
$pro_img = mysqli_query($conn,$sqlp_img);
$pro_num_img = mysqli_num_rows($pro_img);

while($row = mysqli_fetch_assoc($pro_img)){
  $uimg = $row['user_image'];
}
// End of profile_img
// ------------------------- //

// profile_img
$sql_img = "select user_image from teachers where t_id ='$tid'";
$conn_img = mysqli_query($conn,$sql_img);
while($row = mysqli_fetch_assoc($conn_img)){
  $uimg = $row['user_image'];
}
// End of profile_img


// to check result available or not---------
$resulcheck = submitCheck($conn, $url_roll_no, $url_sub);

function submitCheck($conn, $url_roll_no, $url_sub)
{

    $sql_t = "SELECT * FROM students s RIGHT JOIN marksheet m on  m.roll_no = s.roll_no where s.roll_no = '$url_roll_no' and m.roll_no = '$url_roll_no' and  m.subject = '$url_sub' and m.paper_status <> 'Un-Checked Yet'";
    $result_t = mysqli_query($conn, $sql_t);
    $row_result = mysqli_num_rows($result_t);
    return $row_result;
}
// to check result available or not END-----------
            // insert into database logics-----mcqs
            if (isset($_POST['submit_que_result'])) {
                $marks = $_POST['marks'];
                $que_id = $_POST['id'];
                $sql = "UPDATE `answers` SET `marks_obtained` = '$marks' WHERE `answers`.`ans_id` = $que_id;";
                $resul = mysqli_query($conn, $sql);
                if ($resul) {
                    header('location:../teacher/checking.php?err=md&s=' . $url_roll_no . '&e=' . $url_exam_id . '&t=' . $t_id . '&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
                } else {
                    header('location:../teacher/checking.php?err=mf&s=' . $url_roll_no . '&e=' . $url_exam_id . '&t=' . $t_id . '&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
                }
            }

            // insert into database logics--- submit results-----------------------------
            if (isset($_POST['submit_result'])) {

                // // Obtained total marks
                $sql = "SELECT sum(marks_obtained) as Total_Marks, roll_no, st_name FROM answers WHERE roll_no = '$url_roll_no' and exam_id = '$url_exam_id' group by roll_no, st_name;";
                $result = mysqli_query($conn, $sql);
                $result_num = mysqli_num_rows($result);
                while ($row_re = mysqli_fetch_assoc($result)) {
                    $obtain_marks = $row_re['Total_Marks'];
                    $st_name = $row_re['st_name'];
                    $roll_no = $row_re['roll_no'];
                }
                // // question total marks
                // $sql_que = "SELECT sum(marks) as que_marks, exam_id,class,section from questions WHERE exam_id = '$url_exam_id' and class = '$class'";
                // $result_que = mysqli_query($conn, $sql_que);
                // $result_num_que = mysqli_num_rows($result_que);
                // while ($row_que = mysqli_fetch_assoc($result_que)) {
                //     $t_marks_que = $row_que['que_marks'];
                // }
                // // MCQ total marks
                // $sql_ans = "SELECT sum(marks) as mcq_marks, exam_id,class,section from mcq WHERE exam_id = '$url_exam_id' and class = '$class'";
                // $result_ans = mysqli_query($conn, $sql_ans);
                // $result_num_ans = mysqli_num_rows($result_ans);
                // while ($row_ans = mysqli_fetch_assoc($result_ans)) {
                //     $t_marks_mcq = $row_ans['mcq_marks'];
                // }

                // $total_marks = $t_marks_que + $t_marks_mcq;
                // $total_percentage = $obtain_marks / $total_marks * 100;



                // if ($total_percentage >= 0 && $total_percentage <= 49) {
                //     $grade = "Fail";
                // } else if ($total_percentage >= 50 && $total_percentage <= 59) {
                //     $grade = "C";
                // } else if ($total_percentage >= 60 && $total_percentage <= 69) {
                //     $grade = "B";
                // } else if ($total_percentage >= 70 && $total_percentage <= 79) {
                //     $grade = "A";
                // } else if ($total_percentage >= 80 && $total_percentage <= 100) {
                //     $grade = "A-1";
                // }


                $sql_u = "UPDATE marksheet
                SET total_marks_obtained = '$obtain_marks', paper_status = 'Checked' WHERE roll_no = '$url_roll_no' and exam_id = '$url_exam_id' and subject = '$url_sub';";
                $resul = mysqli_query($conn, $sql_u);
                if ($resul) {
                    header('location:../teacher/checking.php?err=ru&s=' . $url_roll_no . '&e=' . $url_exam_id . '&t=' . $t_id . '&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
                } else {
                    header('location:../teacher/checking.php?err=ruf&s=' . $url_roll_no . '&e=' . $url_exam_id . '&t=' . $t_id . '&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
                }
            }
if (isset($_POST['submit_mcq_result'])) {
                $marks = $_POST['marks'];
                $mcq_id = $_POST['id'];
                $sql = "UPDATE `answers` SET `marks_obtained` = '$marks' WHERE `answers`.`ans_id` = $mcq_id;";
                $resul = mysqli_query($conn, $sql);
                if ($resul) {
                    header('location:../teacher/checking.php?err=md&s=' . $url_roll_no . '&e=' . $url_exam_id . '&t=' . $t_id . '&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
                } else {
                    header('location:../teacher/checking.php?err=mf&s=' . $url_roll_no . '&e=' . $url_exam_id . '&t=' . $t_id . '&sub='.$url_sub.'&ex_n='.$url_exam_name.'');
                }
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Checking...</title>
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
    margin-top: 150px;
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
    .data_st_text{
    width: 100%;
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
     width: 180px;
     font: bold 15px arial, sans-serif;
     text-shadow:none;
     margin-top: 10px;
     border-radius: 40px;
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
.btn-submit {
    padding: 10px 0;
    margin: 10px 0;
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
#mes-qd{
    display: none;
}
#mes-qf{
    display: none;
}
#mes-md{
    display: none;
}
#mes-mf{
    display: none;
}
#mes-ef{
    display: none;
}
#mes-ed{
    display: none;
}
#mcq_check{
    padding-top: 30px;
}
.checkingque{
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
    if(isset($_GET['err']) && $_GET['err'] == "md"){
        // echo  "<div class='alert alert-danger' role='alert'> Profile Update Succesfull! </div>";
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-check'></i></div>
        <strong>Success!</strong>   Marks Added succesfully
        </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "mf"){
        // echo  "<div class='alert alert-danger' role='alert'> Profile Update UnSuccesfull, Please contact Admin</div>";
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> Marks Added UnSuccesfull, Contact Admin
        </div>";
    if(isset($_GET['err']) && $_GET['err'] == "ru"){
        // echo  "<div class='alert alert-danger' role='alert'> Password update succesfully, Please Login Again</div>";
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  Result Update Succesfull
                </div>";
    }else if (isset($_GET['err']) && $_GET['err'] == "ruf"){
        // echo  "<div class='alert alert-danger' role='alert'> Wrong Password!!!, Contact Admin For recovery</div>";
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-times-circle'></i></div>
                <strong>Error!</strong> Result Update UnSuccesfull, Contact Admin
                </div>";
    }
}
}
?>
<div class="checkingmcq">
                <h1>MCQ Section</h1>
            <?php
            // $mcq_fetch = "SELECT a.exam_id, a.marks_obtained , a.ans, a.ans_id, a.roll_no ,a.type, m.marks ,m.t_id, m.exam_id, m.title FROM answers a CROSS JOIN mcq m WHERE a.roll_no = '$url_roll_no'and a.exam_id = '$url_exam_id' and m.exam_id = '$url_exam_id' and a.subject = '$url_sub' and m.t_id = '$t_id' and a.type = 'MCQ' GROUP BY a.ans_id;";
            $mcq_fetch = "SELECT DISTINCT m.title, a.exam_id, a.marks_obtained , a.ans, a.ans_id, a.roll_no ,a.type, m.marks ,m.t_id, m.exam_id 
            FROM answers a JOIN mcq m
            on m.mcq_id = a.mcq_id
            WHERE a.roll_no = '$url_roll_no' and a.exam_id = '$url_exam_id' and m.exam_id = '$url_exam_id' and a.subject = '$url_sub' and m.t_id = '$t_id' and a.type = 'MCQ';";
            // $mcq_fetch = "SELECT a.exam_id, a.marks_obtained , a.ans, a.ans_id, a.roll_no ,a.type, m.marks ,m.t_id, m.exam_id, m.title FROM answers a JOIN mcq m on a.exam_id = m.exam_id WHERE a.roll_no = '$url_roll_no'and a.exam_id = '$url_exam_id' and m.exam_id = '$url_exam_id' and m.t_id = '$url_t_id' and a.type = 'mcq';";
            $result_fetch = mysqli_query($conn, $mcq_fetch);
            $mcq_num = mysqli_num_rows($result_fetch);
            $js_id = 1;
            if ($resulcheck == 0) {
                if ($mcq_num >= 1) {
                    while ($mcq_fetch = mysqli_fetch_assoc($result_fetch)) {
                        $exam_id = $mcq_fetch['exam_id'];
                        $ans_id = $mcq_fetch['ans_id'];
                        $m_title = $mcq_fetch['title'];
                        $marks_mcq = $mcq_fetch['marks'];
                        $m_ans = $mcq_fetch['ans'];
                        $marks_obtained = $mcq_fetch['marks_obtained'];
                        // echo  "<tbody>" .
                        //     "<tr>" .
                        //     "<td>" . "MCQ QUESTION => " . "$m_title" . "</td>" .-----------
                        //     "<td>" . "MCQ Answer => " . "$m_ans" . "</td>" .----------------
                        //     "<td>" . "MArks Of question => " . "$marks_mcq" . "</td>" .-----------
                        //     "<td>" . "MArks Obtained => " . "$marks_obtained" . "</td>" .
                        //     "<td>" . "<form method='post'>
                        //     <input type='text' name='id' value='" . "$ans_id" . "'>
                        //     <input type='text' name='marks' placeholder='Enter Marks'>
                        //     <input type='submit' value='Submit Marks' name='submit_mcq_result'>
                        //     </form>" . "</td>" .
                        //     "</tr>";

                        echo "<div class='container mt-sm-5 my-1' id='mcq_check'>
                            <div id='marks'><h5> marks: $marks_mcq</h5> </div>
                            <div class='question ml-sm-5 pl-sm-5 pt-2'>
                                <div id='heading' class='py-2 h5'><h4>Q;$js_id:- $m_title</h4></div>
                                <form id='mcq_form' method='post'>
                                <div class='ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3' id='options'> 
                                <label class='options'> Answer</label>
                                <input class='data_st' type='text' name='' id='' value='$m_ans' readonly>
                                <label> Obtained Marks</label>
                                <input class='data_st' type='text' name='' id='' value='$marks_obtained' readonly>
                            
                            <form method='post'>
                            <input class='data_st' type='hidden' name='id' value='" . "$ans_id" . "'>
                            <input class='data_st' type='text' name='marks' placeholder='Enter Marks'>
                            <input class='btn' type='submit' value='Submit Marks' name='submit_mcq_result'>
                            </form>
                            </div>
                        </div>";
                        $js_id++;
                    }
                }
            } else {
                echo '<b>Marks Has Been submitted <br>
                OR <br>
                Student Is Still Doing Paper <br>
                </b>';
            }
            echo "</tbody>" .
                "</table>";
            if ($mcq_num == 0) {
                echo '<b>NO Result Available Please Check your Your TimeTable For Exam</b>';
            }
            ?>
    </div>

    <div class="checkingque">
        ---------------------------------------------------------------------------------------------------------------------------------------------
       <h1>Question / Answer Section</h1>
            <?php
            $que_fetch = "SELECT a.exam_id, a.marks_obtained , a.ans, a.ans_id, a.roll_no ,a.type, m.marks,m.t_id, m.exam_id, m.question 
            FROM answers a LEFT JOIN questions m
            on m.q_id = a.q_id
            WHERE a.roll_no = '$url_roll_no'and a.exam_id = '$url_exam_id' and m.exam_id = '$url_exam_id' and m.t_id = '$t_id' and a.type = 'QUE' GROUP BY a.ans_id;";
            $result_fetch = mysqli_query($conn, $que_fetch);
            $que_num = mysqli_num_rows($result_fetch);
            $js_id_que = 1;
            if ($resulcheck == 0) {
            if ($que_num >= 1) {
                while ($que_fetch = mysqli_fetch_assoc($result_fetch)) {
                    $exam_id = $que_fetch['exam_id'];
                    $ans_id = $que_fetch['ans_id'];
                    $question = $que_fetch['question'];
                    $q_ans = $que_fetch['ans'];
                    $marks_que = $que_fetch['marks'];
                    $marks_obtained = $que_fetch['marks_obtained'];

                        echo "<div class='container mt-sm-5 my-1' id='mcq_check'>
                            <div id='marks'> <h5>marks: $marks_que</h5> </div>
                            <div class='question ml-sm-5 pl-sm-5 pt-2'>
                                <div id='heading' class='py-2 h5'><h4>Q;$js_id_que:- $question</h4></div>
                                <form id='mcq_form' method='post'>
                                <div class='ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3' id='options'>
                                <label class='options'> Answer</label>
                                <textarea id='address' onpaste='paste()' class='data_st_text' name='ans'  rows='10' cols='65' readonly>$q_ans</textarea>
                                <label> Obtained Marks</label>
                                <input class='data_st' type='text' id='' value='$marks_obtained' readonly>

                            <form method='post'>
                            <input class='data_st' type='hidden' name='id' value='" . "$ans_id" . "'>
                            <input class='data_st' type='text' name='marks' placeholder='Enter Marks'>
                            <input class='btn' type='submit' value='Submit Marks' name='submit_que_result'>
                            </form>
                            </div>
                        </div>";
                        $js_id_que++;
                }}

                echo "<div class='submitexam'>" .
                "<form method='post'>" .
                "<input type='submit' class='btn' value='Submit Exam' name = 'submit_result'>" .
                "</form>" .
                "</div>";
              }
                else {
                    echo '<b>Marks Has Been submitted <br>
                OR <br>
                Student Is Still Doing Paper <br>
                </b>';
                }
                echo "</tbody>" .
                    "</table>";
            
            if ($que_num == 0 && $resulcheck == 0) {
                echo '<b>NO Result Available Please Check your Your TimeTable For Exam</b>';
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
  <script src="../assets/js/script.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>
</html>