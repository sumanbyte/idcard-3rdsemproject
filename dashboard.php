<?php 
include "connection.php";
session_start();
    if(!isset($_SESSION["admin"])){
        header("Location:admin.php");
    }
    $fetchQuery = "SELECT * FROM `students`";

    $result = mysqli_query($conn, $fetchQuery);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <title>Dashboard</title>
</head>
<body>
<?php include "navbar.php"  ?>

<table border="1" width="100%">
    <tr align="center">
    <td>S.N.</td>
    <td>Image</td>
     <td>Name</td>
      <td>Roll </td>
       <td>Phone</td>
       <td>Email</td>
       <td colspan="2">Action</td>
    </tr>
    <?php 
    $count = 1;
    foreach ($data as $key => $value) {
    
        ?>
    
        <tr align="center">
            <td><?php echo $count ?></td>
            <td><img src="images/<?php echo $value["image"]; ?>" width="50" height="50"></td>
             <td><?php echo $value["fullname"]; ?></td>
              <td><?php echo $value["rollno"]; ?> </td>
              <td><?php echo $value["phone"]; ?></td>
              <td><?php echo $value["email"]; ?></td>
              <td><a href="delete.php?id=<?php echo $value["id"]; ?>">Delete</a> 
            </td>
            <td>
            <a href="edit.php?id=<?php echo $value["id"]; ?>">Edit</a>

            </td>
            </tr>
            <?php
            $count++;
    }
    ?>

    
</table>


</body>
</html>