<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the teacher's current details
    $result = mysqli_query($conn, "SELECT name, email FROM users WHERE id = $id AND role = 1");
    $teacher = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Update teacher details in the database
    mysqli_query($conn, "UPDATE users SET name = '$name', email = '$email' WHERE id = $id");
    header("Location: all_teachers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Teacher</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Edit Teacher</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Teacher Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $teacher['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Teacher Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $teacher['email']; ?>" required>
                        </div>
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                        <a href="all_teachers.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
