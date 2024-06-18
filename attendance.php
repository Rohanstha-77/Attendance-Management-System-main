<?php
include ("dbconnect.php");
require ("attendance_submit.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Take Attendance</title>
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
    <style>
        :root {
            --primaryColor: #7163ba;
            --secondaryColor: #978ec7;
            --bodyColor: #ebe9e9;
            --lightGreyColor: #f4f5fa;
            --whiteColor: #ffffff;
            --blackColor: #222;
            --lightBlackColor: #454955;
            --darkPurpleColor: #2c2f4e;
            --redColor: rgb(255, 55, 0);
            --greenColor: rgb(89, 183, 110);
            --lightBlue: rgb(52, 116, 245);
            --lightRedColor: #ff0844;

        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: poppins;
            background-color: var(--bodyColor);
        }

        .body_container {
            background-color: var(--whiteColor);
            width: 100%;
            height: 100vh;
            padding: 20px;
        }

        .back_btn button {
            padding: 5px 10px;
            font-size: 20px;
            color: var(--lightBlackColor);
        }

        .body_container h2 {
            display: flex;
            justify-content: center;
            color: var(--lightBlackColor);
        }

        .student_details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
        }

        table {
            margin-top: 20px;
        }

        .student_details input {
            width: 200px;
            font-size: 20px;
            border-radius: 5px;
            border: 1px solid var(--blackColor);
            padding: 5px 10px;
            background-color: var(--lightRedColor);
            color: var(--whiteColor);
        }

        label {
            font-size: 20px;
            font-weight: 500;
        }

        .student_details table th {
            border: 1px solid var(--blackColor);
            width: 200px;
            padding: 5px 10px;
            background-color: #36B9C9;
        }

        td {
            border: 1px solid var(--blackColor);
        }

        .data {
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .data input {
            transform: scale(2);
        }

        .save_btn {
            display: flex;
            justify-content: right;
        }

        .save_btn button {
            background-color: var(--lightRedColor);
            color: var(--whiteColor);
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            margin-top: 20px;
            margin-right: 20px;
            width: 200px;
        }

        .search_container {
            background-color: var(--lightGreyColor);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;

            .search_wrapper {
                /* background-color: red; */
                display: flex;
                justify-content: center;

                .search_fields {
                    /* background-color: yellow; */
                    display: flex;
                    align-items: center;

                    select {
                        font-size: 20px;
                        padding: 5px 10px;
                        border-radius: 5px;
                        margin-left: 20px;
                        width: 300px;
                    }

                }

                button {
                    font-size: 20px;
                    border-radius: 5px;
                    border: none;
                    padding: 5px 10px;
                    margin-left: 10px;
                    background-color: var(--lightRedColor);
                    color: #fff;

                    i {
                        margin-right: 10px
                    }
                }
            }
        }

        .table_fields {
            display: flex;
            justify-content: space-between;
            align-items: center;

            p {
                color: var(--redColor);
                font-weight: 500;
            }
        }
    </style>
</head>

<body>
    <div class="body_container">
        <div class="back_btn">
            <button><a href="teacher_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <h2>Take Attendance</h2>
        <div class="search_container">
            <form action="" method="post">
                <div class="search_wrapper">
                    <div class="search_fields">
                        <select name="faculty" required>
                            <option selected disabled>Select the faculty</option>
                            <option>CSIT</option>
                            <option>BCA</option>
                            <option>BBM</option>
                        </select>
                    </div>
                    <div class="search_fields" required>
                        <select name="semester">
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
                    <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass"></i>Search</button>
                </div>
            </form>
        </div>

        <!-- attendance details -->
        <form action="" method="post">
            <div class="student_details">
                <div class="table_fields">
                    <input type="date" id="datepicker" name="date" readonly>
                    <p>Note: Click on the checkboxes to take the attendance.</p>
                </div>
                <table>
                    <thead>
                        <th>Sr.no.</th>
                        <th>Name</th>
                        <th>Roll no.</th>
                        <th>Attendance</th>
                    </thead>
                    <tbody>
                        <?php
                        include ("dbconnect.php");
                        $faculty = "";
                        $semester = "";
                        if (isset($_POST['search'])) {
                            $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : '';
                            $semester = isset($_POST['semester']) ? $_POST['semester'] : '';

                            if (!empty($faculty) || !empty($semester)) {
                                $student_query = "SELECT * FROM student WHERE faculty='$faculty' AND semester='$semester'";
                                $student_data = mysqli_query($conn, $student_query);
                                if (mysqli_num_rows($student_data) > 0) {
                                    $serialNumber = 1;
                                    while ($row_student = mysqli_fetch_assoc($student_data)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="data"><?php echo $serialNumber ?></div>
                                            </td>
                                            <td>
                                                <div class="data"><?php echo $row_student['student_name'] ?></div>
                                            </td>
                                            <td>
                                                <div class="data"><?php echo $row_student['student_roll'] ?></div>
                                            </td>
                                            <td>
                                                <div class="data"><input type="checkbox" name="checked[]"
                                                        value="<?php echo $row_student['student_id'] ?>"></div>
                                            </td>
                                            <input type="hidden" name="student_id[]" value="<?php echo $row_student['student_id'] ?>">
                                        </tr>
                                        <?php
                                        $serialNumber++;
                                    }
                                } else {
                                    echo "no students";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <input type="hidden" name="faculty" value="<?php echo $faculty ?>" readonly>
                <input type="hidden" name="semester" value="<?php echo $semester ?>" readonly>
                <div class="save_btn">
                    <button type="submit" name="save_btn">Take Attendance</button>
                </div>
            </div>
        </form>


    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get today's date in the format "YYYY-MM-DD"
            var today = new Date().toISOString().slice(0, 10);

            // Set the value of the date input field to today's date
            document.getElementById('datepicker').value = today;
        });
    </script>
</body>

</html>