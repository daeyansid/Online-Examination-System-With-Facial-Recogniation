<?php
include '../connection/config.php';

        $roll_no = $_POST['roll_no'];
        $st_class = $_POST['st_class'];
        $section = $_POST['section'];
        $tid = $_POST['tid'];
        $exam_id = $_POST['exam_id'];
        $sub = $_POST['sub'];
        $exam_name = $_POST['exam_name'];

            $sql = "INSERT INTO `marksheet` (`roll_no`, `subject`, `class`, `section`, `t_id`, `exam_id`, `exam_time_complete`, `total_marks_obtained`, `paper_status` ,`remarks`,`exam_name`) VALUES ('{$roll_no}', '{$sub}', '{$st_class}', '{$section}', '{$tid}', '{$exam_id}', now() , '0', 'Checked' ,'Cheating Case','{$exam_name}');";
            $result = mysqli_query($conn,$sql);
            if($result){
                echo '1';
            }else{
                echo '0';
            }
?>