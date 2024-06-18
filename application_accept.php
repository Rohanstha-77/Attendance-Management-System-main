<?php
include ('dbconnect.php');

$app_id = $_GET['id'];

$query = "UPDATE application SET application_status='approved' WHERE app_id='$app_id'";
$data = mysqli_query($conn, $query);
if ($data) {
    echo "<script>alert('application accepted')</script>";
    header("location:admin_dashboard.php");
} else {
    echo "failed to approved";
}
?>