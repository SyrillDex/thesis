<?php 

if(!isset($_SESSION)){
    session_start();    
}
if(empty($_SESSION["UserLogin"])){
    echo header("Location:login.php");
}

include_once("connections/connection.php");

$con = connection();

if(isset($_FILES['webcam'])){

    $id = $_GET['id'];

    $image = addslashes(file_get_contents($_FILES['webcam']['tmp_name']));
    $store_data = "UPDATE `student_docs` SET `medical_certificate`='$image' WHERE id = '$id'";
    mysqli_query($con,$store_data);
}
