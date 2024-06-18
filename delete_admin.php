<?php
include ("dbconnect.php");

$aid = $_GET['a_id'];

$delete_admin = "DELETE FROM admin WHERE admin_id='$aid'";
$delete_data = mysqli_query($conn, $delete_admin);
if ($delete_data) {
    echo "<script>alert('admin successfully deleted');</script>";
    header("location:admin_dashboard.php");
} else {
    echo "failed to delete." . mysqli_error($conn);
}
?>