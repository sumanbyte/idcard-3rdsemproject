<?php
include "connection.php";
session_start();
if(isset($_SESSION["email"])){
    header("Location:profile.php");
}

print_r($_SESSION["email"]);
if (isset($_POST["login"])) {



 
    $email = $_POST["email"];
    $password = $_POST["password"];


    

    if (empty($email) || empty($password)) {
        echo "All Fields are required.";

    } else {



        $searchEmail = "SELECT * FROM `students` WHERE email='$email'";
        $data = mysqli_query($conn, $searchEmail);
        $exists = mysqli_fetch_assoc($data);


        if($exists){
            if($password == $exists["password"]){
                $_SESSION["email"] = $email;
                unset($_SESSION["admin"]);
                header("Location:profile.php");
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
    <title>Student Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
<?php include "navbar.php"  ?>

    <h1>Student Login</h1>
    <form action="" method="post" enctype="multipart/form-data">
       
        <label for="name">Email</label><br>
        <input type="email" name="email" placeholder="Enter your email">
        <br>
       
        <label for="password">Password</label><br>
        <input type="password" name="password" placeholder="Enter your password">
        <br>
        
        <br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don&apos;t have an account ? <a href="signup.php">Create new account</a></p>
</body>

</html>