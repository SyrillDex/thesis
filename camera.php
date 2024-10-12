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

$id = $_GET['id'];

$sql = "SELECT * FROM student_docs WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera</title>
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="cam/favicon-16x16.png"> -->
    <link rel="stylesheet" href="styles/camera.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1a1f89beb9.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">
        <div id="my_camera"></div>
    </div>
    <div class="shutter">
            <button onclick="take_snapshot()">
                <i class="fa-solid fa-camera"></i>
            </button>
    </div>
    <div class="saved-prompt" id="saved">
        <div class="container" >
            <p>Image Saved!</p>
            <div class="check">
                <i class="fa-regular fa-circle-check"></i>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="webcam.min.js"></script>

    <script language="JavaScript">

        Webcam.set({
        width: 570,
        height: 480,
        image_format: 'jpg',
        jpeg_quality: 90
        });
        Webcam.attach( '#my_camera' );

        function take_snapshot() {

            Webcam.snap( function(data_uri) {
            
            Webcam.upload( data_uri, 'saveimage.php?id=<?php echo $row["id"]; ?>', function(code, text,Name) {

            const saved = document.getElementById('saved');
        
            saved.style.display = 'block';
            
            setTimeout(() => {
                saved.style.display = 'none';
            }, 3000); 
            setTimeout(() => {
                window.location = "options.php";
            }, 3000);
            } );
            } );
            }

        function refreshPage(){
            window.location.reload();
        }
    </script>
</body>
</html>
