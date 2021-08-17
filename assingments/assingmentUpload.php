<?php
	if(isset($_POST['teacher'])){ assingment(); }
function assingment(){
    // database connection
    include '../connection/config.php';
    // end database connection

        $tid = $_GET['id'];
        $class = $_POST['class'];
        $sec = $_POST['sec'];
        $sub = $_POST['sub'];
        $title = $_POST['title'];
        $pdf_type = $_FILES['pdf']['type'];
        $pdf_tmp = $_FILES['pdf']['tmp_name'];
        $folder = "../assingments/"."teacher Assingment-"."$tid"."-"."$class"."-"."$sec";
        $folder_upload = "../assingments/"."teacher Assingment-"."$tid"."-"."$class"."-"."$sec";  //---For local enviroment-----



        if($pdf_type !== 'application/pdf'){
            header('location:../teacher/assingment.php?err=np');
        }
        else{
            move_uploaded_file($pdf_tmp, $folder);
            $update = "INSERT INTO `assingments` (`title`,`subject`, `file`, `class`, `section`, `date`,`t_id`) VALUES ('$title','$sub', '$folder_upload', '$class', '$sec', now(), '$tid');";
            $run = mysqli_query($conn, $update);
            if($run){
                header('location:../teacher/assingment.php?err=fd');
            }else{
                header('location:../teacher/assingment.php?err=uf');
            }
        }
    }



?>