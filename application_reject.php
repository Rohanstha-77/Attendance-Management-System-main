<?php
include ('dbconnect.php');

$app_id = $_GET['id'];

$query = "DELETE FROM application WHERE app_id='$app_id'";
$data = mysqli_query($conn, $query);
if ($data) {
    echo "<script>alert('application Rejected')</script>";
    header("location:admin_dashboard.php");
} else {
    echo "failed to reject";
}
?>