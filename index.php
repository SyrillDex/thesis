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
    <title>Student Log In</title>
    <link rel="stylesheet" href="styles/index.css">
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1a1f89beb9.js" crossorigin="anonymous"></script>
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
    <div class="header">
        <div class="left-header"> DoCapture</div>
        <div class="right-header">
            <button class="logout" onclick="logout()">&#8592<i class="fa-solid fa-right-from-bracket"></i></button>
            <span>Log out</span> 
        </div>
    </div>
    <button id="back" onclick="refreshPage()">&#8592</button>
    <div id="main">
        <div class="welcome" >
            Welcome! <?php echo $row['username'];?>
            <br> <br> Select the file you want to scan
        </div>
        <div class="outer"  >
            <div class="options" >
                <button onclick="loadFrame('options.php?id=<?php echo $row['id'];?>')">
                    Medical Results
                </button>
                <button onclick="loadFrame('camera2.php?id=<?php echo $row['id'];?>')">
                    Personal Info Sheet
                </button>
                <button onclick="loadFrame('camera3.php?id=<?php echo $row['id'];?>')">
                    Notice of Admission
                </button>
                <button disabled>
                    Others
                </button>
            </div>
        </div>
    </div>
    <div class="navigation-bar">
        <button onclick="loadFrame('details.php?ID=<?php echo $row['id'];?>')">
            <i class="fa-solid fa-folder"></i> <br> <span>Files</span>
        </button>
        <button autofocus onClick="refreshPage()">
            <i class="fa-solid fa-plus"></i> <br> <span>Add Files</span>
        </button>
        <button onclick="loadFrame('profile.php?ID=<?php echo $row['id'];?>')">
            <i class="fa-solid fa-user-pen"></i> <br> <span>Profile</span>
        </button>           
    </div>
    <div id="content" src="">
        <iframe id="frame" src=""></iframe>
    </div>
    <div class="logout-prompt" id="logout">
        <div class="container" >
            <p>Are you sure you want to Log out?</p>
            <div class="yes-no">
                <button class="no" onclick="closeLogout()">No</button>
                <a href="logout.php">
                    <button class="yes">Yes</button>
                </a>
            </div>
        </div>
    </div>

    <script>
        function loadFrame(url) {
            document.getElementById('frame').src = url;
            document.getElementById('frame').style.display = 'block';
            document.getElementById('back').style.display = 'block';
            document.getElementById('main').style.display = 'none';
            
        }
        function refreshPage(){
            window.location.reload();
        } 
    </script>
    <script>
        function logout(){
            document.getElementById('logout').style.display = 'block';
        }
        function closeLogout(){
            document.getElementById('logout').style.display = 'none';
        }
        
    </script>
<body>

</body>
</html>




    <!-- <h1>Student Log In</h1> <br> <br>
    <a href="logout.php">Log Out</a>
    <table>
        <thead>
        <tr>
            <th></th>
            <th>Username</th>
        </tr>
        </thead>
        <tbody>
            
        <?php do{?>
            <tr>
                <td><a href="details.php?ID=<?php echo $row['id'];?>" ><button>View Files</button></a></td>
                <td><?php echo $row['username'];?></td>
            </tr>
            <?php }while($row = $students->fetch_assoc());?>
        </tbody>
    </table> -->