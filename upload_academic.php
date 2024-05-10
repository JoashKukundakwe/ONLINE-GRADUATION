<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_clearance";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if file is uploaded successfully and is a PDF
if (isset($_FILES['university_id']) && isset($_FILES['admission_letter'])) {
    $university_id_file = $_FILES['university_id'];
    $admission_letter_file = $_FILES['admission_letter'];

    // Check file types
    $allowed_types = array('application/pdf');
    if (in_array($_FILES['university_id']['type'], $allowed_types) && in_array($_FILES['admission_letter']['type'], $allowed_types)) {
        
        // Check file sizes
        $max_file_size = 2 * 1024 * 1024; // 2MB
        if ($_FILES['university_id']['size'] <= $max_file_size && $_FILES['admission_letter']['size'] <= $max_file_size) {
            
            // Process uploaded files
            $university_id_name = $_FILES['university_id']['name'];
            $admission_letter_name = $_FILES['admission_letter']['name'];

            // Move uploaded files to desired directory
            $upload_directory = "uploads/"; // Directory where files will be stored
            $university_id_target = $upload_directory . basename($university_id_name);
            $admission_letter_target = $upload_directory . basename($admission_letter_name);

            if (move_uploaded_file($_FILES['university_id']['tmp_name'], $university_id_target) &&
                move_uploaded_file($_FILES['admission_letter']['tmp_name'], $admission_letter_target)) {

                // Insert file details into database
                $sql = "INSERT INTO students (university_id, admission_letter) VALUES ('$university_id_name', '$admission_letter_name')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Files uploaded successfully and details inserted into database.');</script>";
                } else {
                    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
                }
            } else {
                echo "<script>alert('Sorry, there was an error uploading your files.');</script>";
            }
        } else {
            echo "<script>alert('File size exceeds the limit (2MB). Please upload files with size 2MB or below.');</script>";
        }
    } else {
        echo "<script>alert('Please upload PDF files only.');</script>";
    }
} else {
    echo "<script>alert('Please select both files to upload.');</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload  Documents | Online Clearance System</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/Gulu.png">


    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .upload-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }
        .style3 {
            color: #000099;
            font-weight: bold;
        }
        .style4 {
            color: black;
            font-size: 25px;
            font-weight: bold;
        }
    </style>
</head>
<body class="gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="logo">
                    <a href="index.php"><img src="images/Gulu.png" alt="onlineclearance" width="210" height="250"></a>
                    <h1 class="style3">GULU UNIVERSITY </h1>
                    <h1 class="style4">Student Clearance</h1>

                </div>
                <div class="upload-box">
                    <h2>Upload Academic Documents</h2>

                    <!-- Form for uploading academic documents -->
                    <form action="upload_academic.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="university_id"><b>University ID:</b> </br><i> <strong>(Please scan both sides of ID)</strong></i></label>
                            <input type="file" class="form-control" id="university_id" name="university_id">
                        </div>
                        <div class="form-group">
                            <label for="admission_letter"><b>Admission Letter: </br><i> <strong>(Please scan both sides of the Admission)</strong></i></b></label>
                            <input type="file" class="form-control" id="admission_letter" name="admission_letter">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </br>
    </br>
    <div class="footer">       
        <?php include('footer.php'); ?>            
    </div>

    <!-- Your existing HTML code goes here -->

    <!-- Your existing JavaScript code goes here -->
</body>
</html>
