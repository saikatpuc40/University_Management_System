<?php 
include 'connection.php'; 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Login</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required><br>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required><br>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>

<?php 
if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, password, role FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
        
            if ($_SESSION['role'] == 1) {
                header("Location: teacher_dashboard.php"); 
            } else {
                header("Location: student_dashboard.php");
            }
            exit();
        }
         else {
            echo "<script>alert('Invalid Password!');</script>";
        }
    } else {
        echo "<script>alert('No user found with this email.');</script>";
    }
}
?>
