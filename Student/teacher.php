<?php 
include '../connection.php'; 
session_start();

// Check if the student is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all teachers from the database
$sql = "SELECT id, name, image FROM users WHERE role = 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .teacher-image {
            width: 40px;
            height: 40px;
            object-fit: cover; /* Ensures the image is contained within the circle */
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Teacher List</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Teacher Name</th>
                    <th>Profile Image</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Display the teacher image if available, otherwise show a default image
                        $image = !empty($row['image']) ? "../uploads/" . $row['image'] : "../uploads/default.png";
                        echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['name']}</td>
                                <td><img src='{$image}' alt='' class='rounded-circle teacher-image'></td>
                              </tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No teachers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="student_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</body>
</html>
