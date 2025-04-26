<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['name'];
$teachers = mysqli_query($conn, "SELECT id, name, email, image FROM users WHERE role = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Teachers</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-img { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; }
  </style>
</head>
<body>

<div class="container mt-4">
  <h2>All Teachers</h2>
  <a href="add_teacher.php" class="btn btn-success mb-3">Add Teacher</a>

  <?php if (mysqli_num_rows($teachers) > 0): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Profile Image</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($t = mysqli_fetch_assoc($teachers)): ?>
          <tr>
            <td><?php echo $t['id']; ?></td>
            <td><?php echo $t['name']; ?></td>
            <td><?php echo $t['email']; ?></td>
            <td>
              <?php if ($t['image']): ?>
                <img src="../uploads/<?php echo $t['image']; ?>" alt="Image" class="profile-img">
              <?php else: ?>
                No image
              <?php endif; ?>
            </td>
            <td>
              <a href="edit_teacher.php?id=<?php echo $t['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="delete_teacher.php?id=<?php echo $t['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="alert alert-warning">No teachers found.</div>
  <?php endif; ?>

  <a href="admin_dashboard.php" class="btn btn-primary w-100">Back to Dashboard</a>
</div>

</body>
</html>
