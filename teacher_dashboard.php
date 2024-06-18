<?php
include ("dbconnect.php");

session_start();
if (isset($_SESSION['teacher_id'])) {
    $teacher_id = $_SESSION['teacher_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM teacher WHERE teacher_id = $teacher_id";
    $result = mysqli_query($conn, $query);
    if ($result && $total = mysqli_num_rows($result) == 1) {
        $teacher_data = mysqli_fetch_assoc($result);
        // echo $teacher_data['teacher_name'];
    }
} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}

// faculty data
$select_csit = "SELECT * FROM student WHERE faculty='csit' ";
$select_data = mysqli_query($conn, $select_csit);
$total_csit = mysqli_num_rows($select_data);

$select_bca = "SELECT * FROM student WHERE faculty='bca' ";
$select_data = mysqli_query($conn, $select_bca);
$total_bca = mysqli_num_rows($select_data);

$select_bbm = "SELECT * FROM student WHERE faculty='bbm' ";
$select_data = mysqli_query($conn, $select_bbm);
$total_bbm = mysqli_num_rows($select_data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher dashboard</title>
    <link rel="stylesheet" href="css/teachers.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>

<body>
    <div class="body_container">
        <!-- sidebar -->
        <div class="sidebar_container">
            <div class="logo_img">
                <img src="image/graduated.png">
            </div>
            <div class="menu">
                <div class="item active" id="dashboard" onclick="dashboardShow()">
                    <i class="fa-solid fa-gauge"></i>
                    <p>Dashboard</p>
                </div>
                <a href="attendance.php">
                    <div class="item">
                        <i class="fa-solid fa-book"></i>
                        <p>Take Attendance</p>
                    </div>
                </a>
                <div class="item" id="attendance" onclick="attendanceShow()">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <p>View Attendance</p>
                </div>

            </div>
            <div class="logout_btn">
                <a href="logout.php">
                    <div class="item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>
                    </div>
                </a>
            </div>
        </div>
        <!-- mains section -->
        <div class="main_container">
            <!-- header -->
            <div class="header_container">
                <div class="search">
                    <input type="text" placeholder="Search here">
                    <button><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                </div>
                <div class="profile_btn">
                    <div class="letter">
                        <?php echo substr($teacher_data['teacher_name'], 0, 1); ?>
                    </div>
                    <p>
                        <?php echo $teacher_data['teacher_name'] ?>
                    </p>
                </div>
            </div>

            <!-- Faculty -->
            <div class="faculty_wrapper ">
                <div class="faculty_container">
                    <div class="faculty_card csit">
                        <a href="#">
                            <p>CSIT</p><br>
                            <p class="p_text">Total student: <?php echo $total_csit ?></php>
                            </p>

                            <img src="image/csit.png">
                        </a>
                    </div>
                    <div class="faculty_card bca">
                        <a href="#">
                            <p>BCA</p>
                            <p class="p_text">Total student: <?php echo $total_bca ?></php>
                            </p>
                            <img src="image/bca.png">
                        </a>
                    </div>
                    <div class="faculty_card bbm">
                        <a href="#">
                            <p>BBM</p>
                            <p class="p_text">Total student: <?php echo $total_bbm ?></php>
                            </p>
                            <img src="image/bbm.png">
                        </a>
                    </div>

                </div>
            </div>


            <!-- View attendance -->
            <div class="attendance_container hide">
                <h2>Attendance Details</h2>
                <div class="attendance_wrapper">
                    <form action="" method="post">
                        <div class="search_container">
                            <div class="fields">
                                <div class="input_field">
                                    <input type="date" name="date" required>
                                </div>
                                <div class="input_field">
                                    <select name="faculty" required>
                                        <option selected disabled>Select the faculty</option>
                                        <option>CSIT</option>
                                        <option>BCA</option>
                                        <option>BBM</option>
                                    </select>
                                </div>
                                <div class="input_field">
                                    <select name="semester" required>
                                        <option selected disabled>Select the semester</option>
                                        <option>One</option>
                                        <option>Two</option>
                                        <option>Three</option>
                                        <option>Four</option>
                                        <option>Five</option>
                                        <option>six</option>
                                        <option>Seven</option>
                                        <option>Eight</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="search"><i
                                    class="fa-solid fa-magnifying-glass"></i>Search</button>
                        </div>
                    </form>

                    <!-- //triggering the form for search -->
                    <div class="table_container">
                        <table>
                            <thead>
                                <th>Student Name</th>
                                <th>Roll No.</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Attendance</th>
                            </thead>
                            <tbody>

                                <?php
                                include ("dbconnect.php");
                                error_reporting(E_ALL);

                                if (isset($_POST['search'])) {
                                    $date = date("Y/M/d l", strtotime($_POST['date']));
                                    $faculty = $_POST['faculty'];
                                    $semester = $_POST['semester'];

                                    if (!empty($date) || !empty($faculty) || !empty($semester)) {
                                        // Adjusted SQL query with proper syntax
                                        $search_query = "SELECT * 
                                        FROM attendance AS a
                                        INNER JOIN student AS s ON a.s_id = s.student_id
                                        WHERE a.date = '$date' AND a.faculty = '$faculty' AND a.semester = '$semester'";

                                        $search_data = mysqli_query($conn, $search_query);
                                        if ($search_data) {
                                            if (mysqli_num_rows($search_data) > 0) {
                                                while ($row_search = mysqli_fetch_assoc($search_data)) {
                                                    //echo $row_search['student_name'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <div class="data">
                                                                <?php echo $row_search['student_name'] ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="data">
                                                                <?php echo $row_search['student_roll'] ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="data">
                                                                <?php echo $row_search['student_email'] ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="data">
                                                                <?php echo $row_search['date'] ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="data"
                                                                style="color: <?php echo ($row_search['status'] == 'present') ? 'green' : 'red'; ?>">
                                                                <?php echo $row_search['status']; ?>
                                                            </div>
                                                        </td>


                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo "<script>alert('No records found for the specified criteria.')</script>";
                                            }
                                        } else {
                                            echo "Error executing search query: " . mysqli_error($conn);
                                        }
                                    } else {
                                        echo "Please provide all search criterion.";
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>


    <script>
        function dashboardShow() {
            document.querySelector('#dashboard').classList.add('active');
            document.querySelector('#attendance').classList.remove('active');
            document.querySelector('.attendance_container').classList.add('hide');
            document.querySelector('.faculty_wrapper').classList.remove('hide');
        }
        function attendanceShow(){
            document.querySelector('#dashboard').classList.remove('active');
            document.querySelector('#attendance').classList.add('active');
            document.querySelector('.attendance_container').classList.remove('hide');
            document.querySelector('.faculty_wrapper').classList.add('hide');
        }
    </script>
</body>

</html>