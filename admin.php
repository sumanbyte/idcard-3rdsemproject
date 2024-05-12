<?php
include "connection.php";
session_start();


if(isset($_SESSION["admin"])){
    header("Location:dashboard.php");
}

if (isset($_POST["login"])) {



 
    $username = $_POST["username"];
    $password = $_POST["password"];


    

    if (empty($username) || empty($password)) {
        echo "All Fields are required.";

    } else {



        $searchUser = "SELECT * FROM `admin` WHERE username='$username'";
        $data = mysqli_query($conn, $searchUser);
        $exists = mysqli_fetch_assoc($data);


        if($exists){
            if($password == $exists["password"]){
                $_SESSION["admin"] = $username;
                unset($_SESSION["email"]);
                header("Location:dashboard.php");
            }else{
                echo "<h1>Password doesn't match</h1>";
            }
        }else{
            echo "<h1>The account doesn't exists.</h1>";
        }




        




    }



}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <?php include "navbar.php"  ?>
    <h1>College Login</h1>
    <form action="" method="post" enctype="multipart/form-data">
       
        <label for="username">Username</label><br>
        <input type="text" name="username" placeholder="Enter admin username">
        <br>
       
        <label for="password">Password</label><br>
        <input type="password" name="password" placeholder="Enter admin password">
        <br>
        
        <br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>