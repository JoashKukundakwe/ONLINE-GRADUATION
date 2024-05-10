<?php
session_start();
error_reporting(1);
include('connect2.php');

if(isset($_POST['btnlogin']))
{
if($_POST['txtmatric_no'] != "" || $_POST['txtpassword'] != ""){

$matric_no =$_POST['txtmatric_no'];
$password = $_POST['txtpassword'];

$sql = "SELECT * FROM `students` WHERE `matric_no`=? AND `password`=? ";
			$query = $dbh->prepare($sql);
			$query->execute(array($matric_no,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
			
      //  $_SESSION['matric_no'] = $fetch['matric_no'];
      //$_SESSION['dept'] = $fetch['dept'];
			//$_SESSION['faculty'] = $fetch['faculty'];
		//	$_SESSION['session'] = $fetch['session'];
		//	$_SESSION['ID'] = $fetch['ID'];
				
				//Get Get all session value
    foreach($fetch as $items => $v){
      if(!is_numeric($items))
      $_SESSION[$items] = $v;
  }

		header("Location: index.php");

} else{
$_SESSION['error']=' Invalid Matric No/Password';
}
}else{
$_SESSION['error']=' Must Fill-in All Fields';

}
}

?>


<?php
session_start();
error_reporting(1);
include('connect2.php');

if(isset($_POST['btnlogin']))
{
if($_POST['txtmatric_no'] != "" || $_POST['txtpassword'] != ""){

$matric_no =$_POST['txtmatric_no'];
$password = $_POST['txtpassword'];

$sql = "SELECT * FROM `students` WHERE `matric_no`=? AND `password`=? ";
			$query = $dbh->prepare($sql);
			$query->execute(array($matric_no,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
			
      //  $_SESSION['matric_no'] = $fetch['matric_no'];
      //$_SESSION['dept'] = $fetch['dept'];
			//$_SESSION['faculty'] = $fetch['faculty'];
		//	$_SESSION['session'] = $fetch['session'];
		//	$_SESSION['ID'] = $fetch['ID'];
				
				//Get Get all session value
    foreach($fetch as $items => $v){
      if(!is_numeric($items))
      $_SESSION[$items] = $v;
  }

		header("Location: index.php");

} else{
$_SESSION['error']=' Invalid Matric No/Password';
}
}else{
$_SESSION['error']=' Must Fill-in All Fields';

}
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gulu University | Online Clearance System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="images/Gulu.png">
    <style type="text/css">
        .login-box {
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .style3 {
            color: #000099;
            font-weight: bold;
        }

        .style4 {
            color: #000099
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    <script>
        // JavaScript function to display alert messages
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>

<body class="gray-bg">
    <div class="logo">
        <a href="index.php"><img src="images/Gulu.png" alt="onlineclearance" width="210" height="250"></a>
        <h1 class="style3">GULU UNIVERSITY </br></h1>
        <!-- <h1 class="style4"> GRADUATION</h1> -->

    </div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class="login-box">
            <h5 class="style3">STUDENT CLEARANCE PORTAL</h5>
            <!-- PHP code to display error message if it exists -->
            <?php if(isset($_SESSION['error'])) { ?>
                <script>
                    // Call JavaScript function to display alert message
                    showAlert("<?php echo $_SESSION['error']; ?>");
                </script>
            <?php 
                // Unset the session variable after displaying the message
                unset($_SESSION['error']);
            ?>
            <?php } ?>
            <form class="m-t" role="form" method="POST" action="">
                <div class="form-group">
                    <input type="text" name="txtmatric_no" class="form-control" placeholder="Registration Number" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="txtpassword" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="btnlogin" class="btn btn-primary block full-width m-b">Login</button>
                <a href="forgotpassword.php"><small>Forgot password?</small></a>
            </form>
           
        </div>
    </div>
    <div>
<?php include('footer.php');  ?>            </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

