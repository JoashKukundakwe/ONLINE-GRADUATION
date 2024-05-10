<?php
session_start();
error_reporting(1);
include('connect2.php');

if(isset($_POST['reset_password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password === $confirm_password) {
        // Passwords match, update the password in the database
        $matric_no = $_SESSION['reset_matric_no'];

        $sql = "UPDATE `students` SET `password`=? WHERE `matric_no`=?";
        $query = $dbh->prepare($sql);
        $query->execute(array($password, $matric_no));

        // Password updated, redirect to login page
        $_SESSION['success'] = 'Password reset successful. You can now login with your new password.';
        echo 'Pasword changed succefully';
        header("Location: login.php");
        exit;
    } else {
        // Passwords don't match, show error message
        $_SESSION['error'] = 'Passwords do not match.';
        header("Location: reset_password.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Online Clearance System</title>
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
            <h5 class="style3">Reset Password</h5>
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; ?>
                </div>
            <?php unset($_SESSION['error']); } ?>

            <form class="m-t" role="form" method="POST" action="">
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="New Password" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="">
                </div>
                <button type="submit" name="reset_password" class="btn btn-primary block full-width m-b">Reset Password</button>
            </form>
            <p class="m-t"></p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
