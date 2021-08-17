<?php
// database connection
include 'connection/config.php';

// end database connection

    if(isset($_POST['st_btn'])){
      $sname = $_POST['sname'];
      $spass = $_POST['spass'];
      $suser = $_POST['suser'];
      $semail = $_POST['semail'];
      $scninc = $_POST['scninc'];
      $sfname = $_POST['sfname'];
      $sfoccupation = $_POST['sfoccupation'];
      $sfcninc = $_POST['sfcninc'];
      $sclass = $_POST['sclass'];
          // to check the email is already registerd or not---------------
          $sqlc = "select * from students where email = '$semail'";
          $resultc = mysqli_query($conn ,$sqlc); //result check
          $rows = mysqli_num_rows($resultc);
          
          $sqls_user = "select * from students where username = '$suser'";
          $resultt_user = mysqli_query($conn ,$sqls_user); //result check
          $rowt_user = mysqli_num_rows($resultt_user);
          if($rowt_user == 1){
          header("location:/centut/index.php?err=username_exisit");
          }else if($rows == 0){
            $sql = "INSERT INTO `students` (`st_id`, `name`, `email`, `username`, `password`, `acc_approval`, `user_image`, `father_name`, `class`, `st_cnic`, `father_cnic`) VALUES ('$sname', '$semail', '$suser', '$spass', '0', '', '$sfname', '$sclass', '$scninc', '$sfcninc')";
            $result = mysqli_query($conn,$sql);
            header("location:/centut/reg_page.php?err=regcom");
          }else{
            header("location:/centut/reg_page.php?err=notreg");
          
          }
  }
  else if(isset($_POST['t_btn'])){
  
      $tname = $_POST['tname'];
      $tpass = $_POST['tpass'];
      $tuser = $_POST['tuser'];
      $temail = $_POST['temail'];
      $tcnic = $_POST['tcnic'];
      $curr_job = $_POST['curr_job'];
      $subject = $_POST['subject'];

  // to check the email is already registerd or not---------------
  $sqlt = "select * from teachers where email = '$temail'";
  $resultt = mysqli_query($conn ,$sqlt); //result check
  $rowt = mysqli_num_rows($resultt);

  // to check username
  $sqlt_user = "select * from teachers where username = '$tuser'";
  $resultt_user = mysqli_query($conn ,$sqlt_user); //result check
  $rowt_user = mysqli_num_rows($resultt_user);

  if($rowt_user == 1){
    header("location:/centut/reg_page.php?err=username_exisit");
  }else if( $rowt == 1){
    header("location:/centut/reg_page.php?err=alreg");
  }else if($rowt == 0){
    $sqlt = "INSERT INTO `teachers` (`name`, `email`, `username`, `password`, `subject`, `t_cnic`, `current_job`) VALUES ('$tname', '$temail', '$tusexxr', '$tpass', '$subject', '$tcnic', '$curr_job')";
    $querry = mysqli_query($conn,$sqlt);
    header("location:/centut/reg_page.php?err=regcom");
  }else{
    header("location:/centut/reg_page.php?err=notreg");
  }
}
  
  
?>



<!-- INSERT INTO `students` (`st_id`, `name`, `email`, `username`, `password`, `user_image`, `father_name`, `class`, `st_cnic`, `father_cnic`) VALUES (NULL, 'a', 'a', 'aa', 'a', 'a', 'a', 'a', 'a', 'a'); -->

<!-- INSERT INTO `teachers` (`t_id`, `name`, `email`, `username`, `password`, `user_image`, `subject`, `t_cnic`, `current_job`) VALUES (NULL, 'a', 'a', 'a', 'a', 'aaa', 'a', 'a', 'a');   -->
