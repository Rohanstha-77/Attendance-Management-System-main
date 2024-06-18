<?php
include ("dbconnect.php");
session_start();
$error = "";
$email = "";
$password = "";
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate and sanitize user inputs (to prevent SQL injection)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);


    // Check admin table for login
    $check_admin = "SELECT * FROM admin WHERE admin_email='$email' AND admin_password='$password'";
    $admin_data = mysqli_query($conn, $check_admin);

    // Check student table for login
    $check_student = "SELECT * FROM student WHERE student_email='$email' AND student_roll='$password'";
    $student_data = mysqli_query($conn, $check_student);
    // Check teacher table for login
    $check_teacher = "SELECT * FROM teacher WHERE teacher_email='$email' AND teacher_password='$password'";
    $teacher_data = mysqli_query($conn, $check_teacher);

    if (mysqli_num_rows($admin_data) == 1) {
        $admin = mysqli_fetch_assoc($admin_data);
        $_SESSION['admin_id'] = $admin['admin_id'];
        header("location: admin_dashboard.php");
        exit();
    } elseif (mysqli_num_rows($student_data) == 1) {
        $student = mysqli_fetch_assoc($student_data);
        $_SESSION['student_id'] = $student['student_id']; // Assuming the column name is 'student_id'
        header("location: student_dashboard.php");
        exit();
    } elseif (mysqli_num_rows($teacher_data) == 1) {
        $teacher = mysqli_fetch_assoc($teacher_data);
        $_SESSION['teacher_id'] = $teacher['teacher_id']; // Assuming the column name is 'student_id'
        header("location: teacher_dashboard.php");
        exit();
    } else {
        $error = "*Username or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login page</title>
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
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: poppins;
            background-color: var(--whiteColor);
        }

        a {
            text-decoration: none;
        }

        .form_container {
            background-color: var(--whiteColor);
            box-shadow: rgba(101, 101, 101, 0.2)0px 15px 20px 2px;
            position: fixed;
            top: 20%;
            left: 35%;
            width: 500px;
            padding: 20px;
            border-radius: 15px;
        }

        .form_container h2 {
            display: flex;
            justify-content: center;
            color: var(--lightBlackColor);
        }

        .fields {
            /* background-color: red; */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .input_field {
            /* background-color: yellow; */
            margin: 10px 0;
        }

        label {
            font-size: 18px;
        }

        .input {
            border: 1px solid var(--blackColor);
            border-radius: 5px;
            font-size: 20px;
            display: flex;
            align-items: center;
            padding: 5px 10px;
            width: 300px;
        }

        .input input {
            font-size: 18px;
            border: none;
            outline: none;
            background-color: transparent;
        }

        .input i {
            margin-right: 10px;
        }

        .hide {
            display: none;
        }

        .login_btn {
            display: flex;
            justify-content: center;
        }

        .login_btn button {
            border: 1px solid var(--blackColor);
            border-radius: 5px;
            font-size: 20px;
            background-color: var(--primaryColor);
            color: var(--whiteColor);
            padding: 5px 20px;
            margin-top: 20px;
        }

        .message {
            font-size: 12px;
            color: var(--redColor);
        }
    </style>

</head>

<body>
    <!-- Login Form -->
    <div class="form_container">
        <h2>Login Form</h2>

        <form action="" method="post">
            <div class="fields">
                <div class="input_field">
                    <label>Email</label>
                    <div class="input">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="email" placeholder="Enter your email" value="<?php echo $email ?>"
                            required>
                    </div>
                    <div class="message">
                        <?php echo $error ?>
                    </div>
                </div>
                <div class="input_field">
                    <label>Password</label>
                    <div class="input">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="password" placeholder="Enter your email" id="password"
                            value="<?php echo $password ?>" required>
                        <i class="fa-solid fa-eye hide" onclick="eyeOpen()" id="eyeopen"></i>
                        <i class="fa-solid fa-eye-slash" onclick="eyeClose()" id="eyeclose"></i>
                    </div>
                </div>
            </div>
            <div class="login_btn">
                <button type="submit" name="login_btn">Login</button>
            </div>
        </form>
    </div>
    <script>
        function eyeClose() {
            document.querySelector("#eyeclose").classList.add("hide");
            document.querySelector("#eyeopen").classList.remove("hide");
            document.querySelector("#password").type = 'text';
        }
        function eyeOpen() {
            document.querySelector("#eyeclose").classList.remove("hide");
            document.querySelector("#eyeopen").classList.add("hide");
            document.querySelector("#password").type = 'password';
        }
    </script>
</body>

</html>