<?php
session_start();
if(isset($_SESSION['user'])){
  if($_SESSION['user']=="Admin"){
    header('Location: Admin/dashboard.php');
  }
  else if($_SESSION['user']=="Teacher"){
    header('Location: Teacher/dashboard.php');
  }
  else if($_SESSION['user']=="Student"){
    header('Location: Student/dashboard.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
<div class="card shadow-lg p-4" style="width:400px;">
  <div class="text-center mb-3">
    <img src="Images/puc_logo.png" class="img-fluid" alt="..." style="width:120px;">
  </div>


  <h2 class="text-center">Login</h2>
  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter Your password">
    </div>
    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
  </form>
  <p class="text-center mt-3">You don't have an account?<a href="Register/student_register.php">Register</a></p>


</div>
  

</body>
</html>


<?php 
include 'connection.php';
if(isset($_POST["submit"])){
    $email=$_POST["email"];
    $password=md5($_POST['password']);
    $sql ="SELECT * FROM students WHERE email='$email' AND password='$password'";

    $Data=mysqli_query($conn,$sql);
    $result=mysqli_fetch_array($Data);
    if($result['role']=="Student"){
        $_SESSION['user']="Student";
        $_SESSION['user_id']=$result['id'];
        header("Location: Student/dashboard.php");
    }
    else if($result['role']=="Teacher"){
        $_SESSION['user']="Teacher";
        $_SESSION['user_id']=$result['id'];
        header("Location: Teacher/dashboard.php");
    }
    else if($result['role']=="Admin"){
        $_SESSION['user']="Admin";
        $_SESSION['user_id']=$result['id'];
        header("Location: Admin/dashboard.php");
    }
    
    else{
        echo "password ismatch";
    }
}




?>




