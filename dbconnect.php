<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'attendancemanagementsystem';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn) {
 // echo "connection successfull";

} else {
  echo "failed" . mysqli_error($conn);
}