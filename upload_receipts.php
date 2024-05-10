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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user has already uploaded receipts
    $sql_check = "SELECT * FROM students LIMIT 1";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "You have already uploaded receipts. Please delete existing ones to upload new ones.";
    } else {
        // Check if files are uploaded successfully
        if (isset($_FILES['receipts'])) {
            $uploadOk = 1;

            // Check each uploaded file
            foreach ($_FILES['receipts']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['receipts']['name'][$key];
                $file_size = $_FILES['receipts']['size'][$key];
                $file_tmp = $_FILES['receipts']['tmp_name'][$key];
                $file_type = $_FILES['receipts']['type'][$key];

                // Check file extension
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                if ($file_ext != "pdf") {
                    echo "Only PDF files are allowed.";
                    $uploadOk = 0;
                    break;
                }

                // Check file size
                if ($file_size > 1500000) {
                    echo "File size must be less than 1.5MB.";
                    $uploadOk = 0;
                    break;
                }
            }

            if ($uploadOk) {
                // Upload files
                foreach ($_FILES['receipts']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['receipts']['name'][$key];
                    $file_tmp = $_FILES['receipts']['tmp_name'][$key];
                    $upload_directory = "uploads/";

                    if (move_uploaded_file($file_tmp, $upload_directory . $file_name)) {
                        // Insert file details into database
                        $sql = "INSERT INTO students (year_1_receipt, year_2_receipt, year_3_receipt) 
                                VALUES ('$file_name', NULL, NULL)";
                        if ($conn->query($sql) !== TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            break;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your files.";
                        break;
                    }
                }
                echo "Receipts uploaded successfully.";
            }
        } else {
            echo "Please select files to upload.";
        }
    
    // Redirect to index.php
    header("Location: /test/index.php");
    exit();

    }
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Receipts | Online Clearance System</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/Gulu.png">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
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
        .logo {
            text-align: center;
            margin-bottom: 20px;
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

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #000099;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            width: 100%;
            padding: 8px 12px;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <div class="logo">
                    <a href="index.php"><img src="images/Gulu.png" alt="onlineclearance" width="210" height="250"></a>
                    <h1 class="style3">GULU UNIVERSITY</h1>
                    <h1 class="style4">Student Clearance</h1>

                </div>
                <div class="upload-box">
                    <h2>Upload Receipts for Payment</h2>
                    <!-- Form for uploading receipts for payment -->
                    <form action="upload_receipts.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="year_1_receipt">Year 1 Receipt: </br><i> <strong>(Please scan the Receipts for both semsters to one document)</strong></i></label>
                            <input type="file" class="form-control" id="year_1_receipt" name="year_1_receipt">
                        </div>
                        <div class="form-group">
                            <label for="year_2_receipt">Year 2 Receipt: </br><i> <strong>(Please scan the Receipts for both semsters to one document)</strong></i></label>
                            <input type="file" class="form-control" id="year_2_receipt" name="year_2_receipt">
                        </div>
                        <div class="form-group">
                            <label for="year_3_receipt">Year 3 Receipt: </br><i> <strong>(Please scan the Receipts for both semsters to one document)</strong></i></label>
                            <input type="file" class="form-control" id="year_3_receipt" name="year_3_receipt">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Upload Receipts</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </br>
    </br>
    <div class="footer">
            
            <div>
<?php include('footer.php');  ?>            </div>
        </div>
        </div>
</body>
</html>
