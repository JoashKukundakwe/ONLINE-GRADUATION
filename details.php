<?php
session_start();
error_reporting(0);
include('connect.php');
if(empty($_SESSION['matric_no']))
    {   
    header("Location: login.php"); 
    }
    else{
	}
	
$ID = $_SESSION["ID"];
$matric_no = $_SESSION["matric_no"];

$sql = "select * from students where matric_no='$matric_no'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Details |Gulu  University</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="images/Gulu.png">




    <style type="text/css">
<!--
.style1 {
	font-size: xx-large;
	font-weight: bold;
}
.style2 {font-weight: bold}
-->
    </style>
</head>

<body>

            <div class="wrapper wrapper-content  animated fadeInRight article">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="ibox">
                        <div class="ibox-content">
                          <div class="text-center article-title">
                            <p class="text-muted">&nbsp;</p>
                            <h1>
                                    GULU UNIVERISTY, Uganda  <img src="<?php echo $rowaccess['photo']; ?>" width="157" height="175"></h1>
                          </div>
                            <p align="center" class="style1"> <u>OFFICE OF ACADEMIC REGISTRA</u> </br> </br> ACADEMIC DETAILS  </p>
                            <p>&nbsp;</p>
                            <p>
                            HELLO <?php echo $rowaccess['fullname']; ?>, </p>
                            <p>&nbsp;</p>
                            <p align="justify">This informs you that  : </p>
                            
                          
                           
                            <p align="justify">Your Registered  Details remains:</p>
                            <p align="justify"><strong>FULLNAME:</strong> <?php echo $rowaccess['fullname']; ?></p>
                            <p align="justify"><strong>MATRIC NUMBER:</strong> <?php echo $rowaccess['matric_no']; ?></p>
                            <p align="justify"><strong>FACULTY:</strong> <?php echo $rowaccess['faculty']; ?></p>
                            <p align="justify"><strong>DEPARTMENT:</strong> <?php echo $rowaccess['dept']; ?></p>
                            <p align="justify">&nbsp;</p>
                            <p align="justify">
                                Please be informed that these are your details that will apper on your Academic Transcript and any other university documents</p>. <p>Contact us in case there is need for correction of your details. we wish you best of luck.</p>
                            <p align="right" class="style2">
                                SIGNED</p>
                            <p align="right">&nbsp;</p>
                            <p align="right"><strong>REGISTRA                            </strong></p>
                            <hr>
                            <div class="row">
                              <div align="center"><a href="#" id="print-button" onclick="window.print();return false;">Print this page</a> </div>
							  
							  
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
       

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

</body>

</html>
