
<?php
session_start();
error_reporting(1);
include('connect2.php');

if(isset($_POST['submit_matric_no'])) {
    $matric_no = $_POST['matric_no'];

    // Check if the matric number exists in the system
    $sql = "SELECT * FROM `students` WHERE `matric_no`=?";
    $query = $dbh->prepare($sql);
    $query->execute(array($matric_no));
    $row = $query->fetch();

    if($row) {
        // Matric number exists, show password reset form
        $_SESSION['reset_matric_no'] = $matric_no;
        header("Location: reset_password.php");
        exit;
    } else {
        // Matric number not found, show error message
        // $_SESSION['error'] = 'Matric number not found in the system.';
        echo "<script>alert('Matric number not found in the system.');</script>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Online Clearance System</title>
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
            color: #FF0000
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="gray-bg">
    <div class="logo">
        <a href="index.php"><img src="images/Gulu.png" alt="onlineclearance" width="210" height="250"></a>
        <h1 class="style3">GULU UNIVERSITY</h1>
    </div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class="login-box">
            <h5 class="style3">Forgot Password</h5>
            <form class="m-t" role="form" method="POST" action="">
                <div class="form-group">
                    <input type="text" name="matric_no" class="form-control" placeholder="Registration Number" required="">
                </div>
                <button type="submit" name="submit_matric_no" class="btn btn-primary block full-width m-b">Submit</button>
            </form>
            <p class="m-t"></p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
