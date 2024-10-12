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
    $id = $_GET['ID'];

$sql = "SELECT * FROM student_docs WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Log In</title>
    <!-- <link rel="stylesheet" href="styles/style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/1a1f89beb9.js" crossorigin="anonymous"></script>
    <style>
        body{
            margin: 0px;
            font-family: Inter,Arial;
            background-color: #ecffdf;
            background-image: url('img/bg1.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        .user{
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-top: 30px;
        }
        .user-icon{
            text-align: center;
            font-size: 115px;
            width: 180px;
            height: 180px;
            border-radius: 170px;
            color: #00af52;
            background-color: rgb(40, 40, 40);
            margin-bottom: 25px;
            margin-top: 5px;
        }
        .user-icon p{
            margin-top: 20px;
            margin-left: 5px;
        }
        .name,
        .labels{
            font-size: 25px;
            margin-bottom: 10px;
        }
        .info{
            display: block;
            font-size: 30px;
            margin-top: 20px;
            line-height: 50px;
        }
        .info div{
            border: 2px solid black;
            display: flex;
            justify-content: space-between;
            padding: 12px;
            margin: 12px;
            border: 1px solid;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0,0,0, .5);
            background-color: #f4f4f4;
            /* background-image: linear-gradient(to bottom,#3FCA7F, #BCF3B3); */
        }
        .info p{
            margin: 0px;
        }
    </style>
</head>
<body>
    <div class="user">
        <div class="user-icon"><p>DC</p></div>
        <div class="labels">STUDENT</div>
        <div class="name"><?php echo $row['username'];?></div>
    </div>
    <div class="info">
        <div>Year Level:  <p><?php echo $row['year_level'];?></p> </div>
        <div>Program:  <p><?php echo $row['program'];?></p> </div>
        <div>School Year:  <p><?php echo $row['school_year'];?></p></div>
        <div>Gender:  <p><?php echo $row['gender'];?></p> </div>
    </div>

</body>
</html>

<!-- <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>date</th>
        </tr>
        </thead>
        <tbody>
            
        <?php do{?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['password'];?></td>
                <td><?php echo $row['date'];?></td>
            </tr>
            <?php }while($row = $students->fetch_assoc());?>
        </tbody>
    </table> -->