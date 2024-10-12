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
    <link rel="stylesheet" href="styles/style.css">
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
    <h1 style="text-align:center;">Submitted Files</h1>
    <div class="main-container">
        <div class="img-container" >
            <div>Personal Info Sheet</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['PIS'] ).'" height="200" width="300"/>' ?>
        </div>
        <div class="img-container" >
            <div>Notice of Admission</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['NOA'] ).'" height="200" width="300"/>' ?>
        </div>
    </div>
    <div class="main-container">
        <div class="img-container" >
            <div>Medical Certificate</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['medical_certificate'] ).'" height="200" width="300"/>' ?>
        </div>
        <div class="img-container" >
            <div>Drug Test</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['drug_test'] ).'" height="200" width="300"/>' ?>
        </div>
    </div>
    <div class="main-container">
        <div class="img-container" >
            <div>Complete Blood Count</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['CBC'] ).'" height="200" width="300"/>' ?>
        </div>
        <div class="img-container" >
            <div>Dental Clearance</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['dental_clearance'] ).'" height="200" width="300"/>' ?>
        </div>
    </div>
    <div class="main-container">
        <div class="img-container" >
            <div>Urinalysis</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['urinalysis'] ).'" height="200" width="300"/>' ?>
        </div>
        <div class="img-container" >
            <div>Hepa Screening</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['hepa_screening'] ).'" height="200" width="300"/>' ?>
        </div>
    </div>
    <div class="main-container">
        <div class="img-container" >
            <div>Chest X-ray</div>
            <div class="no-image"><i class="fa-solid fa-file-image"></i> No Image Yet</div>
            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['chest_xray'] ).'" height="200" width="300"/>' ?>
        </div>
    </div>
        <!-- PIS
        NOA
        Medical Result
        CBC
        Dental Clearance
        Physical Exam
        Hepa Screening
        Chest X-ray
        Drug Test
        VA -->
</body>
</html>




<!-- <table>
        <thead>
            <h1 style="text-align:center;">Submitted Files</h1>
        </thead>
        <thead>
        <tr>
            <th>Medical Result</th>
            <th>PIS</th>
            <th>NOA</th>
            <th>date</th>
        </tr>
        </thead>
        <tbody>
            
        <?php do{?>
            <tr> -->
                <!-- <td><?php echo $row['id'];?></td>
                <td><?php echo $row['username'];?></td> -->
                <!-- <td><?php echo $row['password'];?></td> -->
                <!-- <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['medical_result'] ).'" height="200" width="300"/>' ?></td>
                <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['PIS'] ).'" height="200" width="300"/>' ?></td>
                <td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['NOA'] ).'" height="200" width="300"/>' ?></td>
                <td><?php echo $row['date'];?></td>
            </tr>
            <?php }while($row = $students->fetch_assoc());?>
        </tbody>
    </table> -->