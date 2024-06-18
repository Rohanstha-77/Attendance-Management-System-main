<?php
include ("dbconnect.php");
$name = "";
$email = "";
$roll = "";
$name_error = "";
$email_error = "";
$roll_error = "";

if (isset($_POST['student_add'])) {
    $name = $_POST['student_name'];
    $email = $_POST['student_email'];
    $roll = $_POST['student_roll'];
    $faculty = $_POST['faculty'];
    $semester = $_POST['semester'];


    // Name validation
    if (empty($name)) {
        $name_error = "Name is required*";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $name_error = "Name can only contain letters and spaces.";
    } elseif (strlen($name) > 40) {
        $name_error = "Full name exceeds 40 characters.";
    }

    // Email validation
    if (empty($email)) {
        $email_error = "Email is required*";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    } else {
        // Check if email already exists in the database
        $query = "SELECT * FROM student WHERE student_email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert( 'Student with this email already exists.')</script>";
        }
    }

    // Roll number validation
    if (empty($roll)) {
        $roll_error = "Roll number is required*";
    } elseif (!ctype_digit($roll)) {
        $roll_error = "Roll number can only contain digits.";
    } elseif (strpos($roll, '.') !== false) {
        $roll_error = "Roll number cannot contain decimal points.";
    } else {
        // Check if roll no. already exists in the database
        $query = "SELECT * FROM student WHERE student_roll = '$roll'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert( 'Student Roll number is already taken, Use new roll.')</script>";
        } else {

            $insert_query = "INSERT INTO student (student_name, student_email, student_roll, faculty,semester) VALUES('$name', '$email', '$roll', '$faculty', '$semester')";
            $insert_data = mysqli_query($conn, $insert_query);
            if ($insert_data) {
                echo "<script>alert('Successfully studnet added to system') </script>";
                $name = "";
                $email = "";
                $roll = "";

            } else {
                echo "failed " . mysqli_error($conn);
            }

        }
    }


}


?>