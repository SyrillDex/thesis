<?php

include_once("connection.php");



$con = connection();



$sql = "SELECT * FROM bmi_table";

$students = $con->query($sql) or die($con->error);

$row = $students->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DoCapture Kiosk</title>
<link rel="stylesheet" href="BMIResults.css">
<style>
        body {
          background-image: url('bg1.jpg');
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
        }
</style>
</head>
<body>
    <div class="header">
        <div class="left-header"> DoCapture</div>
        <div><button class="right-header">About us</button></div>
    </div>
    <a href="http://localhost/StudentLogIn/Main.html">
        <button class="back">🏠︎</button>
    </a>
    <div class="container">
        <div class="content">
            <p>Your Height:</p>
            <p><?php echo $row['ft'];?>'<?php echo $row['inches'];?>"</p>
        </div>
        <div class="content">
            <p>Your Weight:</p>
            <p><?php echo $row['kg'];?> kg</p>
        </div>
        <div class="content">
            <p>Your BMI:</p>
            <p><?php echo $row['bmi'];?></p>
        </div>
        <div class="B-Category">
            <p>
                BMI <br> <br>
                Below 18.5	 <br>
                18.5 – 24.9	<br>
                25.0 – 29.9	<br>
                30.0 and Above
            </p>
            <p>
                Weight Status <br><br>
                Underweight <br>
                Healthy Weight <br>
                Overweight <br>
                Obesity <br>
            </p>
        </div>
    </div>

</body>
</html>
