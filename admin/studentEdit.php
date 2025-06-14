<?php 
include '../connection.php';

if(!isset($_GET['id'])||empty($_GET['id'])){
    die('Error:Id not set in url.');
}

$id=intval($_GET['id']);
$sql ="SELECT * FROM students where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Edit Student</title>
</head>
<body>
    <form class="card" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']?>">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['name'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
        </div>
         <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" class="form-control" name="contact" value="<?php echo $row['contact'] ?>">
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
    </form>
</body>
</html>

<?php
include '../connection.php';
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $name= $_POST['name'];
    $email= $_POST['email'];
    $contact= $_POST['contact'];
    $sql="UPDATE students SET name='$name', email='$email', contact='$contact' where id='$id'";
    $Data=mysqli_query($conn,$sql);
    if($Data){
        header("Location:students.php");
    }
    else{
        echo 'not successful';
    }
}




?>