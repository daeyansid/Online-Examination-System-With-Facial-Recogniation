<?php
if(isset($_POST['st_btn'])){student();}
if(isset($_POST['t_btn'])){teacher();}
if(isset($_POST['a_btn'])){admin();}

  function student(){
    // database connection
    include 'config.php';
    // end database connection

      $suser = $_POST['suser'];
      $spass = $_POST['spass'];
      // for student login
      $sql_st = "SELECT * FROM `students` WHERE username = '$suser' and password = '$spass'";
      $result_st = mysqli_query($conn,$sql_st);
      $row_st = mysqli_num_rows($result_st);
      while($row = mysqli_fetch_assoc($result_st)){
        $username = $row['username'];
        $name = $row['name'];
        $sid = $row['roll_no'];
      }
      // to check Student password
      $sqlp = "SELECT password FROM `students` where password = '$spass' where username = '$user'";
      $resultp = mysqli_query($conn,$sqlp);
      $rowp_st = mysqli_num_rows($resultp);
      // to check user exist or not
      $sqle = "SELECT * FROM `students` where username = '$suser'";
      $resulte = mysqli_query($conn,$sqle);
      $rowe_st = mysqli_num_rows($resulte);

      if($row_st == 1){
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["name"] = $name;
        $_SESSION["st_id"] = $sid;
        $_SESSION["in"] = true;
        $_SESSION["st"] = true;
      header("location:/h_exams/student/profile_st.php");

    } else if($rowe_st == 1 && $rowp_st == 0){
      header("location:/h_exams/index.php?err=wrongstpass");
      echo 'p';
    }
    else if($rowe_st == 0){
      header("location:/h_exams/index.php?err=wrongst");
      echo 'k';
    }
  }


function teacher(){
    // database connection
    include 'config.php';
  // end database connection

    // for Teacher login
      $tuser = $_POST['tuser'];
      $tpass = $_POST['tpass'];

      $sql_t = "SELECT * FROM `teachers` WHERE username = '$tuser' and password = '$tpass'";
      $result_t = mysqli_query($conn,$sql_t);
      $row_t = mysqli_num_rows($result_t);
      while($row = mysqli_fetch_assoc($result_t)){
        $username = $row['username'];
        $name = $row['name'];
        $tid = $row['t_id'];
      }
      // to check teacher password
      $sqlp = "SELECT * FROM `teachers` where password = '$tpass' where username = '$tuser'";
      $resultp = mysqli_query($conn,$sqlp);
      $rowp_t = mysqli_num_rows($resultp);
      // to check user exist or not
      $sqle = "SELECT * FROM `teachers` where username = '$tuser'";
      $resulte = mysqli_query($conn,$sqle);
      $rowe_t = mysqli_num_rows($resulte);

      if($row_t == 1){
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["name"] = $name;
        $_SESSION["t_id"] = $tid;
        $_SESSION["in"] = true;
        $_SESSION["t"] = true;
      header("location:/h_exams/teacher/profile_t.php");

    } else if($rowe_t == 1 && $rowp_t == 0){
      header("location:../teacherlog.php?err=wrongtpass");
    }
    else if($rowe_t == 0){
      header("location:../teacherlog.php?err=wrongt");
    }
}

function admin(){
    // database connection
    include 'config.php';
  // end database connection



    // for admin login
      $user = $_POST['user'];
      $pass = $_POST['pass'];

      $sql_a = "SELECT * FROM `admin` WHERE username = '$user' and password = '$pass'";
      $result_a = mysqli_query($conn,$sql_a);
      $row_a = mysqli_num_rows($result_a);
      while($row = mysqli_fetch_assoc($result_a)){
        $username = $row['username'];
        $name = $row['name'];
        $id = $row['s_no'];
      }
      // to check admin password
      $sqlp = "SELECT * FROM `admin` where password = '$pass' where username ='$user'";
      $resultp = mysqli_query($conn,$sqlp);
      $rowp_a = mysqli_num_rows($resultp);
      // to check user exist or not
      $sqle = "SELECT * FROM `admin` where username = '$user'";
      $resulte = mysqli_query($conn,$sqle);
      $rowe_a = mysqli_num_rows($resulte);

      if($row_a == 1){
        session_start();
        $_SESSION["username"] = $username;
        $_SESSION["name"] = $name;
        $_SESSION["id"] = $id;
        $_SESSION["in"] = true;
        $_SESSION["admin"] = true;
      header("location:/h_exams/admin/dashboard.php");


      // header("location:{$servername}/{$datbase}/welcome.php");
    } else if($rowe_a == 1 && $rowp_a == 0){
      header("location:/h_exams/admin/index.php?err=wrongpass");
    }
    else if($rowe_a == 0){
      header("location:/h_exams/admin/index.php?err=wrongad");
    }
  }
?>