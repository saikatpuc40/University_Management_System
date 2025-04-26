<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT name, email, contact, location, image FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teacher Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto shadow p-4" style="max-width: 500px;">
        <div class="text-center">
            <img src="../uploads/<?php echo $user['image']; ?>" 
                 alt="Profile" 
                 class="rounded-circle mb-3" 
                 width="120" height="120" 
                 style="object-fit: cover; border: 3px solid #dee2e6; background-color: white;">
            <h4><?php echo $user['name']; ?></h4>
        </div>
        <hr>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Contact:</strong> <?php echo $user['contact']; ?></p>
        <p><strong>Location:</strong> <?php echo $user['location']; ?></p>
        <a href="editprofile.php" class="btn btn-primary w-100">Edit Profile</a>
        <a href="teacher_dashboard.php" class="btn btn-secondary mt-2 w-100">Back to Dashboard</a>
    </div>
</div>
</body>
</html>
