<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the student's current details
    $result = mysqli_query($conn, "SELECT name, email FROM users WHERE id = $id AND role = 0");
    $student = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Update student details in the database
    mysqli_query($conn, "UPDATE users SET name = '$name', email = '$email' WHERE id = $id");
    header("Location: all_students.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Student</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Student Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-success">Update</button>
        <a href="all_students.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
