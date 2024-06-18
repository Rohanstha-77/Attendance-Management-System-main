<?php
include('dbconnect.php');

$ID=$_GET['id'];

$delete="DELETE FROM teacher WHERE teacher_id='$ID'";
$data=mysqli_query($conn, $delete);
if($data){
    echo"<script>alert('Teacher has been deleted successfully')</script>";
    header("location:admin_dashboard.php");
}else{
    echo"<script>alert('Failed to delete')</script>";

}
?>