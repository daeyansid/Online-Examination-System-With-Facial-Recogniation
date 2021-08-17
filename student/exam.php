<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection

$sid = $_SESSION["st_id"];

// Take parameter From URL
$url_exam_id = $_GET['e'];
$url_subject = $_GET['s'];
$url_exam_name = $_GET['ex_n'];


$sql_t = "SELECT * FROM `students` where roll_no = '$sid'";
$result_t = mysqli_query($conn,$sql_t);
$row_t = mysqli_num_rows($result_t);
while($row = mysqli_fetch_assoc($result_t)){
    $roll_no = $row['roll_no'];
    $name = $row['name'];
    $class =  $row['class'];
    $sec = $row['section'];
}

// $sql_sub = "SELECT * from results s JOIN students st ON s.roll_no = st.roll_no where st.roll_no = '$st_roll_no'";
$st_result = "SELECT * from students s RIGHT JOIN marksheet a on a.roll_no = s.roll_no WHERE a.exam_name='$url_exam_name'and a.section = '$sec' and a.class = '$class' and s.section = '$sec' and s.class = '$class' and a.subject = '$url_subject' and s.roll_no = '$roll_no'";
$st_re_result = mysqli_query($conn,$st_result);
$st_result_num = mysqli_num_rows($st_re_result);

if($st_result_num == 1){
    echo 'hkbhhbk';
    header('location:../student/exam_submt.php');
}
// variable for row name the js item
$js_id = '1';
$js_id_que = '1';
function gettid($conn,$url_exam_id,$url_subject,$url_exam_name){
    $sql = "SELECT * FROM exam_data WHERE exam_id = '$url_exam_id' and exam_name='$url_exam_name' and subject = '$url_subject'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $tid = $row['t_id'];
        $time = $row['time'];
    }
    
    $array[0] = $tid;
    $array[1] = $time;

    return $array;

}
// Function to get tid
$data = gettid($conn,$url_exam_id,$url_subject,$url_exam_name);

$t_id = $data[0];
$time = $data[1]*60;

// if For submittion of questions
// submit QUE
if(isset($_POST['submit_que'])){
    $ans = $_POST['ans'];
    $que_id = $_POST['id'];
    $sql = "INSERT INTO `answers` (`ans`, `type`, `st_name`, `subject`, `roll_no`, `q_id`, `mcq_id`, `exam_id`, `marks_obtained` ,`exam_name`) VALUES ('$ans', 'QUE', '$name', '$url_subject', '$roll_no', '$que_id', '0', '$url_exam_id', 'un-checked' ,'$url_exam_name');";
    $resul = mysqli_query($conn,$sql);
            if($resul){
                header('location:../student/exam.php?err=qd&e='.$url_exam_id.'&s='.$url_subject.'&ex_n='.$url_exam_name.'');
            }else{
                header('location:../student/exam.php?err=qf&e='.$url_exam_id.'&s='.$url_subject.'&ex_n='.$url_exam_name.'');
            }
}
// submit MCQ
if(isset($_POST['submit_mcq'])){
    $ans = $_POST['ans'];
    $mcq_id = $_POST['id'];
    $sql = "INSERT INTO `answers` (`ans`, `type`, `st_name`, `subject`, `roll_no`, `q_id`, `mcq_id`, `exam_id`, `marks_obtained` ,`exam_name`) VALUES ('$ans', 'MCQ', '$name', '$url_subject', '$roll_no', '0', '$mcq_id', '$url_exam_id', 'un-checked','$url_exam_name');";
    $resul = mysqli_query($conn,$sql);
            if($resul){
                header('location:../student/exam.php?err=md&e='.$url_exam_id.'&s='.$url_subject.'&ex_n='.$url_exam_name.'');
            }else{
                header('location:../student/exam.php?err=mf&e='.$url_exam_id.'&s='.$url_subject.'&ex_n='.$url_exam_name.'');
            }

}
// submit Exam
if(isset($_POST['submit_btn'])){
    $sql = "INSERT INTO `marksheet` (`roll_no`, `subject`, `class`, `section`, `t_id`, `exam_id`, `exam_time_complete`, `total_marks_obtained`, `paper_status` ,`exam_name`) VALUES ('$roll_no', '$url_subject', '$class', '$sec', '$t_id', '$url_exam_id', now() , 'Un-Checked Yet', 'Un-Checked Yet','$url_exam_name');";
    $resul = mysqli_query($conn,$sql);
            if($resul){
                header('location:../student/exam.php?err=esd&e='.$url_exam_id.'&s='.$url_subject.'&ex_n='.$url_exam_name.'');
            }else{
                header('location:../student/exam.php?err=esf&e='.$url_exam_id.'&s='.$url_subject.'&ex_n='.$url_exam_name.'');
            }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Exam Here Do Not Cheat</title>
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
</head>
<body>



 <!-- error msgs -->
<?php
    if(isset($_SERVER['HTTP_REFERER'])){
    if(isset($_GET['err']) && $_GET['err'] == "qd"){
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-check'></i></div>
        <strong>Success!</strong>  Question Updated Succesfull!
        </div>";
    }
    if (isset($_GET['err']) && $_GET['err'] == "qf"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> Question Update Updated UnSuccesfull, Contact Admin
        </div>";
    }
    if(isset($_GET['err']) && $_GET['err'] == "md"){
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  MCQ Update Updated Succesfull
                </div>";
    }
    if (isset($_GET['err']) && $_GET['err'] == "mf"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> MCQ Update Updated UnSuccesfull, Contact Admin
        </div>";
    }
    if(isset($_GET['err']) && $_GET['err'] == "esd"){
        echo  "<div id='mes' class='alert alert-success alert-white rounded'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
                <div class='icon'><i class='fa fa-check'></i></div>
                <strong>Success!</strong>  Exam Submit Done, Best Of Luck For Results
                </div>";
    }
    if (isset($_GET['err']) && $_GET['err'] == "mf"){
        echo  "<div id='mes' class='alert alert-danger alert-white rounded'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true' id='cut'>×</button>
        <div class='icon'><i class='fa fa-times-circle'></i></div>
        <strong>Error!</strong> Exam Submit UnSuccesfull, Contact Admin
        </div>";
    }
}

?>


<div class="instuction">
<h3>Do Not Use ctrl Key On Key Board</h3>
<h3>Do Not Use alt Key On Key Board</h3>
<h3>Do Not Use Window Key On Key Board</h3>
<h3>Do Not Past AnyThing to text Box</h3>
<h3>Do Not Leave Screen</h3>
<h3>If You Do Exam Will Cancle Automatically</h3>
</div>

<div class="paper">
<p>Time Left: </p><div id="countdown"></div>
<div class="mcqs">
    <h1>MCQS Section: </h1>
   <?php
if($st_result_num == 0){
    $mcq_fetch = "SELECT * FROM exam_data e RIGHT JOIN mcq a on a.exam_id = e.exam_id where a.class = '$class' and a.section = '$sec' and e.class = '$class' and e.section = '$sec' and e.status = 'active' and e.status <> 'done' and e.subject = '$url_subject'";
    $result_fetch = mysqli_query($conn,$mcq_fetch);
    $mcq_num = mysqli_num_rows($result_fetch);
    if($mcq_num >= 1 || $mcq_num == false){
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
        $exam_id = $mcq_fetch['exam_id'];
        $subject = $mcq_fetch['subject'];
            echo "<div class='container mt-sm-5 my-1'>
            <div id='marks'> marks: $m_marks </div>
            <div class='question ml-sm-5 pl-sm-5 pt-2'>
                <div id='heading' class='py-2 h5'><h4>Q;$js_id:- $m_title</h4></div>
                <form id='mcq_form' method='post'>
                <div class='ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3' id='options'> 
                <input type='hidden' name='id' value='"."$m_mcq_id"."'>
                <label class='options'>$m_option_1 <input type='radio' name='ans' value='$m_option_1' required> <span class='checkmark'></span> </label>
                <label class='options'>$m_option_2 <input type='radio' name='ans'value='$m_option_2' > <span class='checkmark'></span> </label>
                <label class='options'>$m_option_3 <input type='radio' name='ans' value='$m_option_3' > <span class='checkmark'></span> </label>
                <label class='options'>$m_option_4 <input type='radio' name='ans' value='$m_option_4' > <span class='checkmark'></span> </label> </div>
            </div>
            <div class='d-flex align-items-center pt-3'>
                <div class='ml-auto mr-sm-5'>
                <input id='mcq-$js_id' type='submit' class='btn' value='Submit MCQ' name='submit_mcq'>
                </div>
            </div>
            </form>
        </div>";
        $js_id = $js_id+1;
    }
    }
    if($mcq_num == 0){
    echo "<b id='no_exam' >NO Exam Available Please Check your Your TimeTable For Exam</b>";
    }
}else{
    echo "<h1>Nothing To Show</h1>";
}
?>
</div>

<div class="question">
<h1 id="q-a" >Questions/Answers Section: </h1>
<?php
if($st_result_num == 0){
    $que_fetch = "SELECT * FROM exam_data e RIGHT JOIN questions a on a.exam_id = e.exam_id where a.class = '$class' and a.section = '$sec' and e.class = '$class' and e.section = '$sec' and e.status = 'active' and e.status <> 'done' and e.subject = '$url_subject'";
    $exam_que_fetch = mysqli_query($conn,$que_fetch);
    $question_num_fetch = mysqli_num_rows($exam_que_fetch);
    if($question_num_fetch >= 1){
    while($question_fetch = mysqli_fetch_assoc($exam_que_fetch)){
    
        $q_id = $question_fetch['q_id'];
        $question = $question_fetch['question'];
        $marks = $question_fetch['marks'];
        $q_name = $question_fetch['name'];
        $sec = $question_fetch['section'];
        $class = $question_fetch['class'];
        $exam_id = $question_fetch['exam_id'];
        
        echo "<form class='question_form' method='post'>
        <div id='marks'> marks: $marks </div>
        <input type='hidden' name='id' value='$q_id'>
        <div id='heading' class='py-2 h5'><h4>Q;$js_id_que:- $question</h4></div>
            <h2>Answer Here:</h2>
            <textarea id='address' onpaste='paste()' class='data_st' name='ans' placeholder='Answer Here' rows='10' cols='65' required>

            </textarea>
            <br>
            <input id='que-$js_id_que' type='submit' class='btn_q' value='Submit Quetion' name='submit_que'>
        </form>";

        $js_id_que = $js_id_que+1;
    }
    }
    echo "</tbody>".
    "</table>";
// submit button
    echo "<form method='post'>
    <div class='submit'>
    <input type='submit' value='Submit Exam' class='btn btn-submit' id='smt_btn' name='submit_btn'>
    </form>
    </div>";
    
}else{
    echo "<h1>Nothing To Show</h1>";
}
?>
            <!-- <input id='ans' class='ans' type='text' placeholder='Enter Answer' name='ans' required> -->

</div>
</div>
<script src="../assets/js/script.js"></script>

<script type="text/javascript">
var timeleft = <?php echo $time; ?>;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.getElementById("countdown").innerHTML = "Finished";
    $.ajax({
        url: "ajax-done.php",
        type: "POST",
        data: {roll_no:rollNo, st_class:stClass, section:sec, tid:tId, exam_id:examId, sub:url_sub, exam_name:url_exam_name},
        success: function(data){
            if(data == 1){
            window.location.reload();
        }else if (data == 0){
            alert('System Error Contact Admin');
        }
        }
    });
    // // ajax end
  } else {
    document.getElementById("countdown").innerHTML = timeleft + " seconds remaining";
  }
  timeleft -= 1;
}, 1000);

$('textarea').val($('textarea').val().trim())
// // setTimeout(function () {
// //    window.location.href= 'profile_st.php'; // the redirect goes here
// // },60000);

// check the keyboard checting methods like alt,crlt tab Change in tab etc
var paste_no = 0;
var rollNo = <?php echo json_encode($sid); ?>;
var url_sub = <?php echo json_encode($url_subject); ?>;
var stClass = <?php echo json_encode($class); ?>;
var sec = <?php echo json_encode($sec); ?>;
var tId = <?php echo json_encode($t_id); ?>;
var examId = <?php echo json_encode($url_exam_id); ?>;
var url_exam_name = <?php echo json_encode($url_exam_name); ?>;
function paste(){
    paste_no = paste_no + 1;
    console.log (paste_no);
    if(paste_no == 1){
    $.ajax({
        url: "ajax-cheat.php",
        type: "POST",
        data: {roll_no:rollNo, st_class:stClass, section:sec, tid:tId, exam_id:examId, sub:url_sub, exam_name:url_exam_name},
        success: function(data){
            if(data == 1){
            window.location.reload();
        }else if (data == 0){
            alert("SYSTEM ERROR Please Take picture And it to your Concern Class Teacher!!!");
        }
        }
    });
    }
}

// paste checker


/// key events
document.body.addEventListener("keydown", down);
var crlt_no = 0;
var alt_no = 0;
function down(e) {
  var k = e.keyCode;
//   Control key
  if (k == 17) {
crlt_no = crlt_no + 1;
    console.log (crlt_no);
    if(crlt_no == 1){
        alert('DO NOT USE CONTROL KEY "LAST WARING" ELSE YOU WILL FACE A CHEATING CASE')
    }
    if(crlt_no == 2){
    $.ajax({
        url: "ajax-cheat.php",
        type: "POST",
        data: {roll_no:rollNo, st_class:stClass, section:sec, tid:tId, exam_id:examId, sub:url_sub, exam_name:url_exam_name},
        success: function(data){
            if(data == 1){
            window.location.reload();
            window.location.href = "../student/exam_submt.php";
        }else if (data == 0){
            alert("SYSTEM ERROR Please Take picture And it to your Concern Class Teacher!!!");
        }
        }
    });
    }
} else if (k == 18) {
    //   alt key
alt_no = alt_no + 1;
    console.log (alt_no);
    if(alt_no == 1){
        alert('DO NOT USE CONTROL KEY "LAST WARING" ELSE YOU WILL FACE A CHEATING CASE')
    }
    if(alt_no == 2){
    $.ajax({
        url: "ajax-cheat.php",
        type: "POST",
        data: {roll_no:rollNo, st_class:stClass, section:sec, tid:tId, exam_id:examId, sub:url_sub, exam_name:url_exam_name},
        success: function(data){
            if(data == 1){
            window.location.reload();
            window.location.href = "../student/exam_submt.php";
        }else if (data == 0){
            alert("SYSTEM ERROR Please Take picture And it to your Concern Class Teacher!!!");
        }
        }
    });
    }
}
}
/// key events END====================

// to dedect windows is changed or not
// document.addEventListener("visibilitychange", event => {
//   if (document.visibilityState != "visible") {
//     $.ajax({
//         url: "ajax-cheat.php",
//         type: "POST",
//         data: {roll_no:rollNo, st_class:stClass, section:sec, tid:tId, exam_id:examId, sub:url_sub},
//         success: function(data){
//             if(data == 1){
//             // window.location.reload();
//             window.location.href = "../student/exam_submt.php";
//             process.exit();
//         }else if (data == 0){
//             alert(data);
//         }
//         }
//     });
// }

// })


$(document).on('mouseleave',function(){
console.log('mouse exited');
});

$(window).blur(function() {
        if(!document.hasFocus()) {
            $.ajax({
        url: "ajax-cheat.php",
        type: "POST",
        data: {roll_no:rollNo, st_class:stClass, section:sec, tid:tId, exam_id:examId, sub:url_sub, exam_name:url_exam_name},
        success: function(data){
            if(data == 1){
            // window.location.reload();
            window.location.href = "../student/exam_submt.php";
            process.exit();
        }else if (data == 0){
            alert("SYSTEM ERROR Please Take picture And it to your Concern Class Teacher!!!");
        }
        }
    });
    }
});
// // to dedect windows is changed or not ---------------------

</script>
</body>
</html>