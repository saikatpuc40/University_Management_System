<?php
session_start();
include '../connection.php';
if (!isset($_SESSION['user_id']) || !isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}
$name = ($_SESSION['name']);
$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT image FROM users WHERE id = '$user_id'");
$row = mysqli_fetch_assoc($result);
$_SESSION['image'] = $row['image'] ?? 'default.png';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../logout.php">Logout</a>
        </li>
        <li class="nav-item me-3">
            <div style="width: 45px; height: 45px; background-color: white; border-radius: 50%; overflow: hidden;">
                <img src="../uploads/<?php echo $_SESSION['image'] ?? 'default.png'; ?>" 
                     alt="Profile" class="rounded-circle" width="45" height="45">
            </div>
        </li>
    </ul>
</nav>


    <div class="container mt-4">
        <h3 class="text-center">Welcome, <?php echo $name; ?>!</h3>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Attendance</h5>
                        <p class="card-text">Check your monthly attendance records.</p>
                        <a href="view_attandance.php" class="btn btn-primary">View Attendance</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Courses Book</h5>
                        <p class="card-text">View your enrolled courses books.</p>
                        <a href="view_file.php" class="btn btn-primary">View Courses</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <p class="card-text">Update your profile details.</p>
                        <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Teacher</h5>
                        <p class="card-text">View your Teacher.</p>
                        <a href="teacher.php" class="btn btn-primary">View Teacher</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>