<?php
include("dbconnect.php");

if (isset($_POST['save_btn'])) {
    // Check if any student is selected for attendance
    if (empty($_POST['student_id'])) {
        echo "<script>alert('No student is selected for attendance')</script>";
    } else {
        $date = date("Y/M/d l", strtotime($_POST['date'])); // Use MySQL-compatible date format
        $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        $students = $_POST['student_id'];
        $checked = isset($_POST['checked']) ? $_POST['checked'] : [];

        // Check if the attendance is done for today or not
        $check_query = "SELECT * FROM attendance WHERE date='$date' AND faculty='$faculty' AND semester='$semester'";
        $check_data = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($check_data) > 0) {
            echo "<script>alert('Attendance is already done for today')</script>";
        } else {
            $attendance_done = true;

            // Mark all students as absent initially
            foreach ($students as $student_id) {
                $s_id = mysqli_real_escape_string($conn, $student_id);
                $status = in_array($s_id, $checked) ? 'present' : 'absent';

                // Insert or update attendance record
                $insert_query = "INSERT INTO attendance (s_id, date, faculty, semester, status) 
                                 VALUES ('$s_id', '$date', '$faculty', '$semester', '$status')
                                 ON DUPLICATE KEY UPDATE status='$status'";

                $insert_result = mysqli_query($conn, $insert_query);
                if (!$insert_result) {
                    $attendance_done = false;
                    echo "<script>alert('Failed to take attendance for student ID $s_id: " . mysqli_error($conn) . "')</script>";
                }
            }

            if ($attendance_done) {
                echo "<script>alert('Successfully completed attendance for today')</script>";
            }
        }
    }
}
?>
