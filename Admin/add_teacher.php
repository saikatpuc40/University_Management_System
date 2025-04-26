<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}

$name = $_SESSION['name'];
$msg = "";

if (isset($_POST['submit'])) {
    $t_name = $_POST['name'];
    $t_email = $_POST['email'];
    $t_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check email
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$t_email'");
    if (mysqli_num_rows($check) > 0) {
        $msg = "Email already exists!";
    } else {
        $insert = mysqli_query($conn, "INSERT INTO users (name, email, password, role) VALUES ('$t_name', '$t_email', '$t_pass', 1)");
        $msg = $insert ? "Teacher added successfully!" : "Failed to add teacher!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Teacher</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .content { padding: 20px; }
    .back-button { margin-top: 20px; }
  </style>
</head>
<body>

<div class="content">
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <span class="navbar-brand">Welcome, <?php echo $name; ?>!</span>
    </div>
  </nav>

  <div class="container mt-4">
    <h2>Add Teacher</h2>
    <?php if ($msg) echo "<div class='alert alert-info'>$msg</div>"; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" name="submit" class="btn btn-success">Add Teacher</button>
    </form>

    <a href="admin_dashboard.php" class="btn btn-primary back-button w-100">Back to Dashboard</a>
  </div>
</div>

</body>
</html>
