<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Image upload
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
        mysqli_query($conn, "UPDATE users SET name='$name', email='$email', image='$image' WHERE id='$user_id'");
        $_SESSION['image'] = $image;
    } else {
        mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id='$user_id'");
    }

    $_SESSION['name'] = $name;
    header("Location: profile.php");
    exit();
}

// Get current info
$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card p-4">
        <h3 class="text-center">Edit Profile</h3>
        <form method="post" enctype="multipart/form-data">
            <div class="text-center mb-3">
                <img src="../uploads/<?php echo $user['image']; ?>" 
                     alt="Profile Image" 
                     width="100" height="100" 
                     class="rounded-circle" 
                     style="object-fit: cover;">
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Change Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </form>
    </div>
</div>
</body>
</html>
