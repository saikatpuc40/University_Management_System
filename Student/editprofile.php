<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT name, email, image FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $user['image']; // default to old image

    // Image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $img_name = $_FILES['profile_image']['name'];
        $tmp_name = $_FILES['profile_image']['tmp_name'];
        $target_path = "../uploads/" . $img_name;
        move_uploaded_file($tmp_name, $target_path);
        $image = $img_name;
    }

    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET name='$name', email='$email', password='$password', image='$image' WHERE id='$user_id'";
    } else {
        $query = "UPDATE users SET name='$name', email='$email', image='$image' WHERE id='$user_id'";
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['name'] = $name;
        $_SESSION['image'] = $image;
        echo "<script>alert('Profile updated successfully!'); window.location='editprofile.php';</script>";
    } else {
        echo "<script>alert('Update failed!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3 class="text-center">Edit Profile</h3>
    <form method="POST" enctype="multipart/form-data" class="w-50 mx-auto">
        <div class="text-center mb-3">
            <div style="width: 100px; height: 100px; background: white; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                <img src="../uploads/<?php echo $user['image'] ?? 'default.png'; ?>" 
                     alt="Profile" class="rounded-circle" width="100" height="100">
            </div>
        </div>

        <label>Name</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" class="form-control" required><br>

        <label>Email</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" required><br>

        <label>New Password (optional)</label>
        <input type="password" name="password" class="form-control"><br>

        <label>Profile Image</label>
        <input type="file" name="profile_image" class="form-control mb-3"><br>

        <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
    </form>

    <div class="text-center mt-3">
        <a href="student_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>
</body>
</html>