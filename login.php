<?php 
include 'connection.php'; 
session_start();
$message = ""; 

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
                header("Location: Teacher/teacher_dashboard.php");
            } elseif ($_SESSION['role'] == 0) {
                header("Location: Student/student_dashboard.php");
            } elseif ($_SESSION['role'] == 2) {
                header("Location: Admin/admin_dashboard.php");
            }
            exit();
        } else {
            $message = "Invalid Password!";
        }
    } else {
        $message = "No user found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 rounded" style="width: 400px;">
        <div class="text-center mb-3">
            <img src="images/puc_logo.png" alt="Logo" class="img-fluid" style="width: 120px;">
        </div>
        <h2 class="text-center">Login</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-danger text-center"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <p class="text-center mt-3">
            Don't have an account? <a href="register.php">Register</a>
        </p>
    </div>
</body>
</html>
