<?php
    function connection(){
        
        $host = "localhost";
        $username = "phpmyadmin";
        $password = "docapture";
        $database = "phpmyadmin";
        

        $con = new mysqli($host, $username, $password, $database);
        if ($con->connect_error){
            echo $con->connect_error;
        }else{
            return $con;
        }
    }
