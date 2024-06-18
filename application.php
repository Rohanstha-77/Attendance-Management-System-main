<?php
include ("dbconnect.php");

if (isset($_POST['application'])) {
    $date = date("Y/M/d l", strtotime($_POST['date']));
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $insert_query = "INSERT INTO application (student_id, date, subject, message) VALUES('$student_id','$date','$subject', '$message')";
    $insert_data = mysqli_query($conn, $insert_query);
    if ($insert_data) {
        echo "<script>alert('successfully sent')</script>";
    } else {
        echo "<script>alert('Failed to submit')</script>" . mysqli_error($conn);
    }
}

?>