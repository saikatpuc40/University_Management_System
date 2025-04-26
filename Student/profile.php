<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn, "SELECT name, email, contact, location, image FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="text-center">Your Profile</h3>

    <div class="card w-50 mx-auto shadow-sm p-3">
        <!-- Display profile image -->
        <div class="text-center mb-3">
            <?php if (isset($user['image']) && !empty($user['image'])): ?>
                <img src="../uploads/<?php echo $user['image']; ?>" alt="Profile Image" class="rounded-circle" width="100" height="100">
            <?php else: ?>
                <img src="../uploads/default.png" alt="Default Profile Image" class="rounded-circle" width="100" height="100">
            <?php endif; ?>
        </div>

        <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Contact:</strong> <?php echo $user['contact']; ?></p>
        <p><strong>Location:</strong> <?php echo $user['location']; ?></p>

        <div class="d-flex justify-content-between">
            <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
            <a href="student_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
