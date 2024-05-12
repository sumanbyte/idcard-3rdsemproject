<?php 
include "connection.php";
$id = $_GET["id"];


$query = "SELECT `image` from `students` WHERE id='$id'";
$data = mysqli_fetch_assoc(mysqli_query($conn, $query));

$deleteQuery = "DELETE FROM `students` WHERE id='$id'";
if(mysqli_query($conn, $deleteQuery)){
    $destination = 'images/'.$data["image"];
    if(file_exists($destination)){
        unlink($destination);
    }

    header("Location:dashboard.php");
    
}else{
    echo "Failed";
}
