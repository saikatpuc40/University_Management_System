<?php
 session_start();
 echo $_SESSION['user'];
//Authentication
if(!isset($_SESSION['user'])){
    header('Location:../logout.php');
    exit();
 }

//Authorization (end to end verification)

if($_SESSION['user'] != "Admin"){
    header('Location:../unauthorised.php');
    exit();
 }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>Admin Dashboard</h4>

    <a href="../logout.php">Logout</a>
</body>
</html>