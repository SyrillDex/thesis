<?php

if(!isset($_SESSION)){
    session_start();    
}
if(empty($_SESSION["UserLogin"])){
    echo header("Location:login.php");
}
if(isset($_SESSION['UserLogin'])){
    $_SESSION['UserLogin'];
}
include_once("connections/connection.php");

$con = connection();

$username = $_SESSION["UserLogin"];
$password = $_SESSION['UserPassword'];

$sql = "SELECT * FROM student_docs WHERE username = '$username' AND password = '$password'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoCapture Kiosk</title>
    <link rel="stylesheet" href="styles/options.css">
    <style>
        body {
          background-image: url('img/bg1.jpg');
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
        }
    </style>
</head>
<body>
    <div class="outer"  >
        <div class="options" >
            <button onclick="loadFrame('camera.php?id=<?php echo $row['id'];?>')">
                Medical Certificate
            </button>
            <button onclick="loadFrame('camera4.php?id=<?php echo $row['id'];?>')">
                Complete Blood Count
            </button>
            <button onclick="loadFrame('camera5.php?id=<?php echo $row['id'];?>')">
                Hepa Screening
            </button> 
            <button onclick="loadFrame('camera6.php?id=<?php echo $row['id'];?>')">
                Drug Test
            </button>
            <button onclick="loadFrame('camera7.php?id=<?php echo $row['id'];?>')">
                Chest X-ray
            </button>
            <button onclick="loadFrame('camera8.php?id=<?php echo $row['id'];?>')">
                Dental Clearance
            </button>
            <button onclick="loadFrame('camera9.php?id=<?php echo $row['id'];?>')">
                Urinalysis
            </button>
        </div>
    </div>
    <div id="content" src="">
        <iframe id="frame" src=""></iframe>
    </div>
    <script>
        function loadFrame(url) {
            document.getElementById('frame').src = url;
            document.getElementById('frame').style.display = 'block';
        }
        function refreshPage(){
            window.location.reload();
        } 
    </script>
</body>
</html>