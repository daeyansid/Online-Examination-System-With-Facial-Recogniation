<?php
session_start();
// database connection
include '../connection/config.php';
// end database connection
if(isset($_SERVER['HTTP_REFERER'])){
    $data = $_SESSION['data'];
   //  $ar = array("st_roll_no" => "$roll_no", "t_id" => "$tid", "t_class" => "$class_t", "st_sec" => "$sec", "exam_id" => "$url_exam_id");
    $st_roll_no = $data['st_roll_no'];
    $t_id = $data['t_id'];
    $class_t = $data['t_class'];
    $section = $data['st_sec'];
    $exam_name = $data['exam_name'];
}
// $st_id_sql="SELECT * from students s JOIN marksheet m on m.roll_no = s.roll_no where s.class = '$class_t' and s.section = '$section'";



// echo "T_ROLL =>".$st_roll_no."<br>";
// echo "T_ID=>".$t_id."<br>";
// echo "Class =>".$class_t."<br>";
// echo "Section=>".$section."<br>";
// echo "Exam_id=>".$exam_name."<br>";




$st_id_sql="SELECT * from students where class = '$class_t' and section = '$section' and roll_no = '$st_roll_no'";
$st_id_re = mysqli_query($conn, $st_id_sql);
while($row = mysqli_fetch_assoc($st_id_re)){
    $st_name = $row['name'];
    // Obtained total marks
                $sql = "SELECT sum(marks_obtained) as Total_Marks, roll_no, st_name FROM answers WHERE roll_no = '$st_roll_no' and st_name = '$st_name'  and exam_name='$exam_name';";
                $result = mysqli_query($conn, $sql);
                while ($row_re = mysqli_fetch_assoc($result)) {
                    $obtain_marks = $row_re['Total_Marks'];
    // question marks
                            $sql_que = "SELECT sum(marks) as que_marks, exam_id,class,section from questions WHERE section = '$section'  and class = '$class_t' and exam_name='$exam_name'";
                            $result_que = mysqli_query($conn, $sql_que);
                            while ($row_que = mysqli_fetch_assoc($result_que)){
                                $t_marks_que = $row_que['que_marks'];
    // MCQ total marks
                                    $sql_ans = "SELECT sum(marks) as mcq_marks, exam_id,class,section from mcq WHERE section = '$section'  and class = '$class_t' and exam_name='$exam_name'";
                                    $result_ans = mysqli_query($conn, $sql_ans);
                                    while ($row_ans = mysqli_fetch_assoc($result_ans)) {
                                        $t_marks_mcq = $row_ans['mcq_marks'];
                                        $total_marks = $t_marks_que + $t_marks_mcq;





                                        echo $obtain_marks.'<br>';
                                        echo $total_marks;
        $total_percentage = $obtain_marks / $total_marks * 100;
        if ($total_percentage >= 0 && $total_percentage <= 49) {
            $grade = "Fail";
        } else if ($total_percentage >= 50 && $total_percentage <= 59) {
            $grade = "C";
        } else if ($total_percentage >= 60 && $total_percentage <= 69) {
            $grade = "B";
        } else if ($total_percentage >= 70 && $total_percentage <= 79) {
            $grade = "A";
        } else if ($total_percentage >= 80 && $total_percentage <= 100) {
            $grade = "A-1";
        }
}
}
}
}

if( $result && $result_que && $result_ans && isset($grade)){
    
    $sql = "update `results` set percentage = '$total_percentage', `exam_name` = '$exam_name' , Grade = '$grade', paper_status = 'Result Annouced' where roll_no = '$st_roll_no'";
    $re = mysqli_query($conn,$sql);

    if($re){
        header('location:../teacher/maksheet.php?e=ra&s='.$st_roll_no.'&se='.$section.'&c='.$class_t.'&e_n='.$exam_name.'');
    }else{
        header('location:../teacher/maksheet.php?e=rf&s='.$st_roll_no.'&se='.$section.'&c='.$class_t.'&e_n='.$exam_name.'');

    }
}



?>