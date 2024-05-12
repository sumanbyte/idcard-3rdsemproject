<?php
include "connection.php";
session_start();
if (!isset($_SESSION["email"])) {
    header("Location:login.php");
}

$email = $_SESSION["email"];

$dbQuery = "SELECT * FROM students WHERE email='$email'";
$data = mysqli_query($conn, $dbQuery);
$result = mysqli_fetch_assoc($data);

$image = $result["image"];

// print_r($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>ID Card</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            text-transform: capitalize;
        }

        .card-container{
            height: 500px;
            width: 400px;
            border: 1px solid red;
            position: relative;
            
        }

        .path{
            position: absolute;
            clip-path: polygon(0 0, 100% 0, 100% 80%, 60% 100%, 40% 100%, 0 80%);
            background-color: #9AD7FF;
            z-index: -1;
height: 100%;
            width: 100%;
        }
        .card {
            
            display: flex;
            align-items: center;
            flex-direction: column;
            gap: 10px;
        }

        .image {
            height: 100px;
            width: 100px;
            border: 1px solid green;
            margin-top: 20px;
            border-radius: 50%;
        }

        .image img {
            height: 100%;
            width: 100%;
            border-radius: inherit;
            object-fit: cover;
        }

        .rest{
            padding: 20px 20px;
            font-size: 20px;
        }
    </style>
</head>

<body>

<?php include "navbar.php"  ?>

    <h1>Welcome to this page</h1>
    <center>

        <div class="card-container">
            <div class="path"></div>
            <div class="card">
            <div class="image">
                <img src="<?php echo "images/$image" ?>" alt="<?php echo $result["fullname"]; ?>">
            </div>
            <h1><?php echo $result["fullname"]; ?></h1>

        </div>
        <div class="rest">

            <p>Roll No. <?php echo $result["rollno"]; ?></p>
            <p>Email: <?php echo $result["email"]; ?></p>
            <p>Phone Number: <?php echo $result["phone"]; ?></p>
        </div>
    </div>
    </center>
    
   
</body>

</html>