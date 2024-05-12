<?php
include "connection.php";
$id = $_GET["id"];





if (isset($_POST["edit"])) {

    $name = $_POST["name"];
    $rollno = $_POST["rollno"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $oldimage = $_POST["oldimage"];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        $imageToDelete = 'images/' . $oldimage;

        if (file_exists($imageToDelete)) {
            unlink($imageToDelete);
        }

        $imageInstance = $_FILES["image"];

        $imageName = rand() . $imageInstance["name"];

        $destination = 'images/' . $imageName;
        $tmplocation = $imageInstance["tmp_name"];

        move_uploaded_file($tmplocation, $destination);
        $updateQuery = "UPDATE `students` SET `image`='$imageName', `fullname`='$name', `rollno`='$rollno', `email`='$email', `phone`='$phone' WHERE id='$id'";
       
    } else {
        $updateQuery = "UPDATE `students` SET `fullname`='$name', `rollno`='$rollno', `email`='$email', `phone`='$phone' WHERE id='$id'";
        

    }

    if (mysqli_query($conn, $updateQuery)) {
        header("Location:dashboard.php");
    }


}

$fetchQuery = "SELECT * FROM `students` WHERE id='$id'";
$result = mysqli_query($conn, $fetchQuery);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo $row;
    $dbimage = $row["image"];
    // Similarly, fetch other values like rollno, email, phone, etc.
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <title>Edit page</title>
</head>

<body>
<?php include "navbar.php"  ?>

    <h1>Edit Information</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Name</label><br>
        <input type="text" name="name" placeholder="Enter your name" value="<?php if (!empty($row["fullname"]))
            echo $row["fullname"] ?>">
            <br><br>
            <img src="<?php echo "images/$dbimage"; ?>" height="50" alt="">
        <input type="hidden" name="oldimage" value="<?php echo $row["image"]; ?>">
        <br>
        <label for="image">Image</label><br>
        <input type="file" name="image" id="image">
        <br>
        <label for="rollno">Roll No</label><br>
        <input type="number" name="rollno" placeholder="Enter your rollno" value="<?php if (!empty($row["rollno"]))
            echo $row["rollno"] ?>">
            <br>
            <label for="name">Email</label><br>
            <input type="email" name="email" placeholder="Enter your email" value="<?php if (!empty($row["email"]))
            echo $row["email"] ?>">
            <br>
            <label for="phone">Phone Number</label><br>
            <input type="number" name="phone" placeholder="Enter your phone number" value="<?php if (!empty($row["phone"]))
            echo $row["phone"] ?>">
            <br>
            <br>
            <button type="submit" name="edit">Edit</button>
        </form>
    </body>

    </html>