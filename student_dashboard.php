<?php
include ("dbconnect.php");
require ("application.php");

session_start();
if (isset($_SESSION['student_id'])) {
    $student_id = $_SESSION['student_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM student WHERE student_id = $student_id";
    $result = mysqli_query($conn, $query);
    if ($result && $total = mysqli_num_rows($result) == 1) {
        $student_data = mysqli_fetch_assoc($result);
        // echo $student_data['student_name'];
    }
} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>student dashboard</title>
    <link rel="stylesheet" href="css/student1.css" />
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
    <!-- <div class="background"></div> -->
    <div class="body_container">

        <div class="sidebar">
            <div class="side_menu">
                <div class="logo_img">
                    <img src="image/graduated.png">
                </div>
                <div class="menu_item">
                    <div class="item active" id="dashboard" onclick="dashboardInfo()">
                        <i class="fa-solid fa-gauge"></i>
                        <p>Dashboard</p>
                    </div>

                    <div class="item" id="application" onclick="applicationInfo()">
                        <i class="fa-solid fa-person-circle-check"></i>
                        <p>Applications</p>
                    </div>

                </div>
                <a href="logout.php">
                    <div class="item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>
                    </div>
                </a>

            </div>

        </div>

        <!-- main section -->
        <div class="main_section">

            <!-- header -->
            <div class="search_container">
                <div class="header">
                    <span>Student</span>
                    <h2>Dashboard</h2>
                </div>
                <div class="search_btn">
                    <input type="text" placeholder="Search here">
                    <button><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                </div>
                <div class="profile_container">
                    <div class="profile_btn">
                        <div class="letter">
                            <?php echo substr($student_data['student_name'], 0, 1); ?>
                        </div>
                        <p>
                            <?php echo $student_data['student_name'] ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- application FROM -->
            <div class="application_form">
                <h2>Application Form</h2>
                <div class="form_container">
                    <form action="" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                        <div class="fields">
                            <div class="input_fields">
                                <label>Date:</label>
                                <input type="date" id="datepicker" name="date" readonly>
                            </div>
                            <div class="input_fields">
                                <label>Subject:</label>
                                <input type="text" name="subject" placeholder="Enter the subject" required>
                            </div>
                            <div class="input_fields">
                                <label>Application:</label>
                                <textarea name="message" placeholder="Type your message here" required></textarea>
                            </div>
                        </div>
                        <div class="submit_btn">
                            <button type="submit" name="application">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        // current date
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date().toISOString().slice(0, 10);

            document.getElementById('datepicker').value = today;
        });
    </script>
</body>

</html>