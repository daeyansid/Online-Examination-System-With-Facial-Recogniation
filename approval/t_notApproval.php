<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <title>Not Approved</title>
    <style>
        body {
    background-color: #f6f6f6;
    font-size: 14px;
    font-weight: 400;
    font-family: "Nunito", "Segoe UI", arial;
    color: #6c757d;
    max-width: 500px;
  margin: auto;
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
     padding: 10px;
}
.right_area{
    margin-left: 100px;
}
#block{
    font-size: 50px;
    color: red;
    margin-left: 190px;
}
#acc{
    color: red;
}
    </style>
</head>
<body>
    <?php
     require '../connection/config.php';
     session_start();
     $name = $_SESSION["name"];
     $tid = $_SESSION["t_id"];
    ?>
        <div>
        <span><h1 id="acc">Account Verification In pending</h1></span>
        <span><i id='block' class="fa fa-ban" aria-hidden="true"></i></span>
        </div>
        <h2><?php echo "G.R Number:".$tid; ?></h2>
        <h2><?php echo "Name :".$name; ?></h2>
        <h3>Note: We are thankfull to register on Hayat Online Program Please Wait Our Team Working on It.</h3>

    <div class="right_area">
        <a href="/h_exams/connection/logout.php" class="btn">Logout</a>
      </div>
</body>
</html>