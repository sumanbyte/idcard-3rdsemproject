<?php

session_start();
if(isset($_SESSION["email"])){
    unset($_SESSION["email"]);
    header("Location:login.php");
}

if(isset($_SESSION["admin"])){
    unset($_SESSION["admin"]);
    header("Location:admin.php");
}
