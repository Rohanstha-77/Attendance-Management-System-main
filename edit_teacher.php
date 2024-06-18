<?php
include ("dbconnect.php");
$ID = $_GET['id'];

$select = "SELECT * FROM teacher WHERE teacher_id='$ID'";
$data = mysqli_query($conn, $select);
if (mysqli_num_rows($data) == 1) {
    $row = mysqli_fetch_assoc($data);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="css/admin.css" />
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
        .form_container {
            padding: 20px;
            background-color: white;
            width: 100%;
            border-radius: 15px;
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;

            h2 {
                display: flex;
                justify-content: center;
            }

            form {
                display: flex;
                flex-direction: column;
                align-items: center;

                .fields {
                    display: flex;
                    flex-wrap: wrap;
                    width: 700px;

                    .field {
                        /* background-color: red; */
                        font-size: 18px;
                        margin: 10px;

                        label {
                            font-weight: 500;
                        }

                        input {
                            border: none;
                            font-size: 18px;
                            border-bottom: 1px solid black;
                            padding: 5px 10px;
                            width: 300px;
                            margin-top: 10px;
                        }
                    }
                }

                button {
                    width: 100px;
                    cursor: pointer;
                    font-size: 20px;
                    background-color: #ddd;
                    border: none;
                    border-radius: 5px;
                    padding: 5px 10px;
                }
            }
        }

        button {
            padding: 5px 10px;
            font-size: 20px;
        }
    </style>

</head>

<body>
    <div class="form_container">
        <button><a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        <h2>Edit Form</h2>
        <form action="" method='post'>
            <div class="fields">
                <div class="field">
                    <lable>Name:</lable><br>
                    <input type="text" name="name" value="<?php echo $row['teacher_name'] ?>" required>
                </div>
                <div class="field">
                    <lable>Email:</lable><br>
                    <input type="text" name="email" value="<?php echo $row['teacher_email'] ?>" required>
                </div>
                
            </div>
            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>

</html>

<?php
$ID = $_GET['id'];
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    

    $update = "UPDATE teacher SET teacher_name='$name', teacher_email='$email' WHERE teacher_id='$ID'";
    $data = mysqli_query($conn, $update);
    if ($data) {
        echo "<script>alert('successfully updated')</script>";
    } else {
        echo "<script>alert('Failed to updated')</script>";

    }

}

?>