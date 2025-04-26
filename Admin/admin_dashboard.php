<?php
session_start();
include '../connection.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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

    <div class="sidebar">
        <h3>Admin Panel</h3>
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="add_teacher.php">Add Teacher</a>
        <a href="add_student.php">Add Student</a>
        <a href="#">Manage Users</a>
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
            <h2>Admin Dashboard</h2>
            <p>Manage teachers, students, and user accounts.</p>

            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">All Teachers</h5>
                            <p class="card-text">See the list of all registered teachers.</p>
                            <a href="all_teachers.php" class="btn btn-primary">View Teachers</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">All Students</h5>
                            <p class="card-text">See the list of all registered students.</p>
                            <a href="all_students.php" class="btn btn-primary">View Students</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

</body>

</html>