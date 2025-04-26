<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['name']) || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit();
}

$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];

if (!isset($_SESSION['image'])) {
    $result = mysqli_query($conn, "SELECT image FROM users WHERE id = '$user_id'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['image'] = $row['image'] ?? 'default.png';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            display: flex;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="sidebar text-center">
    <h3>Teacher Panel</h3>
    <img src="../uploads/<?php echo $_SESSION['image']; ?>" 
         alt="Profile Image" 
         class="rounded-circle mb-3" 
         width="80" height="80" 
         style="object-fit: cover; background-color: white; padding: 2px;">

    <a href="teacher_dashboard.php">Dashboard</a>
    <a href="manage_student.php">Manage Students</a>
    <a href="attendance.php">Manage Attendance</a>
    <a href="fileupload.php">Upload Materials</a>
    <a href="profile.php">Profile</a>
    <a href="../logout.php" class="btn btn-danger w-100">Logout</a>
</div>


<div class="content">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Welcome, <?php echo $name; ?>!</span>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Teacher Dashboard</h2>
        <p>Manage students, attendance, and course materials.</p>
        
        <div class="row">
            <div class="col-md-4">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Manage Students</h5>
                        <p class="card-text">Add, edit, or remove student records.</p>
                        <a href="manage_student.php" class="btn btn-light">Go to Students</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Take Attendance</h5>
                        <p class="card-text">Track and update student attendance.</p>
                        <a href="takeAttendance.php" class="btn btn-light">Go to Attendance</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Manage Attendance</h5>
                        <p class="card-text">Track and update student attendance.</p>
                        <a href="attendance.php" class="btn btn-light">Go to Attendance</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Upload Materials</h5>
                        <p class="card-text">Share course files and study materials.</p>
                        <a href="fileupload.php" class="btn btn-light">Upload Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
