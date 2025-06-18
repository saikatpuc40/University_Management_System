<?php
include '../connection.php';
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
    <img src="../Images/puc_logo.png" class="img-fluid" alt="..." style="width:120px;">
  </div>


  <h2 class="text-center">Teacher Register</h2>

  <?php
    if(isset($_POST["submit"])){
      $name = $_POST["name"];
      $email = $_POST["email"];
      $contact = $_POST["contact"];
      $password = md5($_POST["password"]);
      $confirmPassword=md5($_POST['confirm_password']);
      $role="Teacher";
      if($password==$confirmPassword){
        $sql="INSERT INTO students(name,email,contact,role,password) VALUES ('$name','$email','$contact','$role','$password')";
        if(mysqli_query($conn,$sql)){
          echo '<div class="alert alert-success">Registration Successfull</div>';
        }
        else{
          echo '<div class="alert alert-danger">Error: '. mysqli_error($conn).' </div>';
        }

      }
      else{
         echo '<div class="alert alert-danger">Password mismatch</div>';

      }

      
    }

    


  ?>

  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
    </div>
    <div class="mb-3">
      <label class="form-label">Contact</label>
      <input type="text" class="form-control" name="contact" placeholder="Enter Your Number">
    </div>
    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter Your password">
    </div>
    <div class="mb-3">
      <label class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="confirm_password" placeholder="Enter Your password">
    </div>

    <button type="submit" name="submit" class="btn btn-primary w-100">Submit</button>
  </form>



</div>
  

</body>
</html>


