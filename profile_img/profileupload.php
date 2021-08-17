<?php
	if(isset($_POST['student'])){ student(); }
	if(isset($_POST['teacher'])){ teacher(); }
	if(isset($_POST['admin'])){ admin(); }


            function student(){

			// database connection
			include '../connection/config.php';
			// end database connection

				$sid = $_GET['id'];

			$sql = "select * from students where roll_no = '$sid';";
			$result = mysqli_query($conn,$sql);
			if($row = mysqli_fetch_assoc($result)){
				$stname = $row['name'];
			}
                $st_img = $_FILES['image']['name'];
				$image_tmp = $_FILES['image']['tmp_name'];
				$folder = "../profile_img/student/"."student-"."$stname"."-"."$sid"."-"."$st_img";
				// $folder_upload = "profile_img/student/"."student-"."$stname"."-"."$sid"."-"."$st_img"; ---------- For server code---------
				$folder_upload = "../profile_img/student/"."student-"."$stname"."-"."$sid"."-"."$st_img";  //---For local enviroment-----



				if($st_img==''){
					echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
					echo "<script>window.open('../student/profile_st.php' , '_self')</script>";
				}else{
					move_uploaded_file($image_tmp, $folder);
					$update = "update students set user_image ='$folder_upload' where roll_no='$sid'";
					$run = mysqli_query($conn, $update);
					if($run){
						header('location:/h_exams/student/profile_st.php');
					}else{
						echo 'fail Go back conatact Admin';
					}
				}
            }

            function teacher(){
			// database connection
			include '../connection/config.php';
			// end database connection

				$tid = $_GET['id'];
			$sql = "select * from teachers where t_id = '$tid';";
			$result = mysqli_query($conn,$sql);
			if($row = mysqli_fetch_assoc($result)){
				$tname = $row['name'];
			}
                $t_img = $_FILES['image']['name'];
				$image_tmp_t = $_FILES['image']['tmp_name'];
				$folder = "../profile_img/teacher/"."teacher-"."$tname"."-"."$tid"."-"."$t_img";
				$folder_upload = "../profile_img/teacher/"."teacher-"."$tname"."-"."$tid"."-"."$t_img";  //---For local enviroment-----



				if($t_img==''){
					echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
					echo "<script>window.open('../teacher/profile_t.php' , '_self')</script>";
				}else{
					move_uploaded_file($image_tmp_t, $folder);
					$update = "update teachers set user_image ='$folder_upload' where t_id='$tid'";
					$run = mysqli_query($conn, $update);
					if($run){
						header('location:/h_exams/teacher/profile_t.php');
					}else{
						echo 'fail Go back conatact Admin';
					}
				}
            }

            function admin(){
				// database connection
				include '../connection/config.php';
				// end database connection
				$aid = $_GET['id'];

			$sql = "select * from admin where s_no = '$aid'";
			$result = mysqli_query($conn,$sql);
			if($row = mysqli_fetch_assoc($result)){
				$admin = $row['name'];
			}

                $a_img = $_FILES['image']['name'];
				$image_tmp = $_FILES['image']['tmp_name'];
				$folder = "../profile_img/admin/"."admin-"."$admin"."-"."$aid"."-"."$a_img";
				$folder_upload = "../profile_img/admin/"."admin-"."$admin"."-"."$aid"."-"."$a_img";

				if($a_img==''){
					echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
					echo "<script>window.open('/h_exams/admin/profile.php' , '_self')</script>";
					exit();
				}else{
					move_uploaded_file($image_tmp, $folder);
					$update = "update admin set user_image='$folder_upload' where s_no='$aid'";

					$run = mysqli_query($conn, $update);

					if($run){
						header('location:/h_exams/admin/profile.php');
					}else{
						echo 'fail Go back conatact Admin';
					}
				}


            }
?>