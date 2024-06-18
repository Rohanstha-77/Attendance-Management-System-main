<?php
include ("dbconnect.php");

$app_id = $_GET['id'];
$select = "SELECT * 
FROM application as a
INNER JOIN student as s ON a.student_id=s.student_id 
WHERE app_id='$app_id'";
$data = mysqli_query($conn, $select);
if (mysqli_num_rows($data) == 1) {
    $result = mysqli_fetch_assoc($data);

    //echo $result['date'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Application</title>
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

        .body_container {
            padding: 20px;

            .back_btn {
                button {
                    font-size: 25px;
                    padding: 5px 10px;
                    width: 50px;
                    color: var(--lightBlackColor);
                }
            }

            .application_container {
                padding: 100px;
                border: 1px solid black;
                margin-top: 20px;
                width: 1000px;
                display: flex;
                flex-direction: column;

                .date_container {
                    font-size: 20px;

                    p {
                        font-size: 20px;
                        font-weight: 500;
                        margin-top: 50px;

                        span {
                            font-weight: 300;
                        }
                    }
                }

                .subject_container {
                    display: flex;
                    font-size: 20px;
                    font-weight: 500;
                    margin-top: 20px;

                    p {
                        font-size: 20px;
                        margin-left: 200px;
                        font-weight: 400;
                        margin-right: 10px;
                    }
                }

                .message {
                    margin-top: 20px;
                    font-size: 20px;

                    span {
                        font-weight: 500;
                    }

                    p {
                        margin-top: 10px;
                    }
                }

                .ending {
                    font-size: 20px;
                    margin-top: 20px;

                    p {
                        font-weight: 500;
                    }
                }
            }
        }

        .wrapper {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="body_container">
        <div class="back_btn">
            <a href="admin_dashboard.php"><button><i class="fa-solid fa-arrow-left"></i></button></a>
        </div>
        <div class="wrapper">
            <div class="application_container">
                <div class="date_container">
                    <?php echo $result['student_name'] ?><br>
                    <?php echo $result['student_roll'] ?><br>
                    <?php echo $result['date'] ?><br>
                    <p>ASIAN COLLEGE OF HIGHER STUDIES<br><span>Ekantakuna, lalitpur</span></p>
                </div>
                <div class="subject_container">
                    <p> Subject:</p>
                    <?php echo $result['subject'] ?>
                </div>
                <div class="message">
                    <span>Dear Sir/Ma'am</span>
                    <p><?php echo $result['message'] ?></p>
                </div>
                <div class="ending">
                    <p>Sincerly,</p>
                    <?php echo $result['student_name'] ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>