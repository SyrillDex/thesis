<?php
session_start();
unset($_SESSION['UserLogin']);
unset($_SESSION['Userpassword']);

echo header('Location: login.php');