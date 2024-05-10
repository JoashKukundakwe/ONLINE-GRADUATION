<?php
session_start();
error_reporting(0);
include('../connect.php');
include('../connect2.php');

if (isset($_POST["btnregister"])) {
    // Retrieve form data
    $fullname = mysqli_real_escape_string($conn, $_POST['txtfullname']);
    $matric_no = mysqli_real_escape_string($conn, $_POST['txtmatric_no']);
    $phone = mysqli_real_escape_string($conn, $_POST['txtphone']);
    $session = mysqli_real_escape_string($conn, $_POST['cmdsession']);
    $faculty = mysqli_real_escape_string($conn, $_POST['cmdfaculty']);
    $dept = mysqli_real_escape_string($conn, $_POST['cmddept']);

    // Your logic for generating a password
    $password_stud = generatePassword(); // You need to implement this function

    // Check if matric number already exists
    $sql = "SELECT * FROM students WHERE matric_no='$matric_no'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Matric No already exists.';
    } else {
        // Insert user data into the database
        $query = "INSERT INTO `students` (fullname, matric_no, password, session, faculty, dept, phone, photo)
                  VALUES ('$fullname', '$matric_no', '$password_stud', '$session', '$faculty', '$dept', '$phone', 'uploads/avatar_nick.png')";

        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = 'Student registration was successful. Your password is: ' . $password_stud;
            // Redirect user to login page
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = 'Problem registering student.';
        }
    }
}

// Function to generate a random password
function generatePassword() {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($permitted_chars), 0, 6);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Register Student
                    </div>
                    <div class="card-body">
                        <form id="form" action="" method="post">
                            <div class="form-group">
                                <label for="txtfullname">Full Name</label>
                                <input type="text" class="form-control" id="txtfullname" name="txtfullname" required>
                            </div>
                            <div class="form-group">
                                <label for="txtmatric_no">Matric No</label>
                                <input type="text" class="form-control" id="txtmatric_no" name="txtmatric_no" required>
                            </div>
                            <div class="form-group">
                                <label for="txtphone">Phone No</label>
                                <input type="text" class="form-control" id="txtphone" name="txtphone" required>
                            </div>
                            <div class="form-group">
                                <label for="cmdsession">Academic Year</label>
                                <input type="text" class="form-control" id="cmdsession" name="cmdsession" required>
                            </div>
                            <div class="form-group">
                    <label for="exampleInputPassword1">Faculty</label>
                    <select name="cmdfaculty" id="select" class="form-control" required="">
    <option value="Select faculty">Select faculty</option>
   <option value="Science">Science</option>
   <option value="Law">Law</option>
   <option value="Medicine">Medicine</option>
   <option value="Education">Education</option>
   <option value="Business">Business</option>
   <option value="IPS">IPS</option>



   </select>  
     </div>
                            </div>
				  <div class="form-group">
                    <label for="exampleInputPassword1">Department</label>
                    <select name="cmddept" id="select" class="form-control" required="">
    <option value="Select Department">Select Department</option>
   <option value="Computer Science">Computer Science</option>
   <option value="Electrical Engineering">Electrical Engineering</option>
   <option value="Business Management">Business Management</option>
   <option value="Information Technology">Information Technology</option>
   </select>  
    </div>
		   </div>
                            <button type="submit" name="btnregister" class="btn btn-primary">Register Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
