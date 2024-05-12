<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $db="idcard";


    $conn = mysqli_connect($server, $username, $password, $db);

    if($conn){
        // echo "Connected with database successfully";
    }else{
        echo "Failed to connect with database";
    }

