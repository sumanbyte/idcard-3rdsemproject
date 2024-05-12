<?php
include "connection.php";
session_start();

if(isset($_SESSION["email"])){
    header("Location:profile.php");
}

print_r($_SESSION["email"]); 
if (isset($_POST["signup"])) {



    $name = $_POST["name"];
    $rollno = $_POST["rollno"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $imageInstance = $_FILES["image"];

    

    if (empty($name) || empty($rollno) || empty($email) || empty($phone) || empty($password) || empty($cpassword) || empty($imageInstance['name'])) {
        echo "All Fields are required.";

    } else {



        $image = rand() . $imageInstance["name"];
        $tmplocation = $imageInstance["tmp_name"];
        $destination = "images/" . $image;





        if ($password != $cpassword) {
            echo "<h1>Passwords do not match</h1>";
        } else {
            $searchEmail = "SELECT * FROM `students` WHERE email='$email'";
            $data = mysqli_query($conn, $searchEmail);
            $exists = mysqli_fetch_row($data);

            if ($exists) {
                echo "<h1>Email Already exists.</h1>";
            } else {
                $insertQuery = "INSERT INTO `students` (`fullname`, `rollno`, `email`, `phone`, `image`, `password`) VALUES ('$name', '$rollno', '$email', '$phone', '$image', '$password');";


                if (mysqli_query($conn, $insertQuery)) {
                    move_uploaded_file($tmplocation, $destination);

                    $_SESSION["email"] = $email;
                    unset($_SESSION["admin"]);

                    header("Location:profile.php");
                
                }
            }
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

<h1>Student Signup</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name</label><br>
        <input type="text" name="name" placeholder="Enter your name">
        <br>
        <label for="image">Image</label><br>
        <input type="file" name="image" id="image">
        <br>
        <label for="rollno">Roll No</label><br>
        <input type="number" name="rollno" placeholder="Enter your rollno">
        <br>
        <label for="name">Email</label><br>
        <input type="email" name="email" placeholder="Enter your email">
        <br>
        <label for="phone">Phone Number</label><br>
        <input type="number" name="phone" placeholder="Enter your phone number">
        <br>
        <label for="password">Password</label><br>
        <input type="password" name="password" placeholder="Enter your password">
        <br>
        <label for="cpassword">Confirm Password</label><br>
        <input type="password" name="cpassword" placeholder="Reenter the password">
        <br><br>
        <button type="submit" name="signup">Signup</button>
    </form>
    <p>Already have an account ? <a href="login.php">Login</a></p>

</body>

</html>