<?php
include ("dbconnect.php");

$name = "";
$email = "";
$pass = "";
$name_error = "";
$email_error = "";
$pass_error = "";

if (isset($_POST['teacher_add'])) {
    $name = $_POST['teacher_name'];
    $email = $_POST['teacher_email'];
    $pass = $_POST['teacher_password'];

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
        $query = "SELECT * FROM teacher WHERE teacher_email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Email already exists
            echo "<script>alert('Teacher with this email already exists.')</script>";
        } else {
            // Insert new teacher if email does not exist
            $insert_query = "INSERT INTO teacher (teacher_name, teacher_email, teacher_password) VALUES('$name', '$email', '$pass')";
            $insert_data = mysqli_query($conn, $insert_query);

            if ($insert_data) {
                echo "<script>alert('Successfully teacher added to system')</script>";
                $name = "";
                $email = "";
                $pass = "";
            } else {
                echo "Failed to insert data: " . mysqli_error($conn);
            }
        }
    }
}
?>