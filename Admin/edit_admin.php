<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $contact  = $_POST['contact'];
    $location = $_POST['location'];

    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $image);
        $query = "UPDATE users SET name='$name', email='$email', contact='$contact', location='$location', image='$image' WHERE id='$user_id'";
        $_SESSION['image'] = $image;
    } else {
        $query = "UPDATE users SET name='$name', email='$email', contact='$contact', location='$location' WHERE id='$user_id'";
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['name'] = $name;
        header("Location: profile.php");
        exit();
    } else {
        $error = "Update failed!";
    }
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user   = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card p-4 mx-auto" style="max-width: 500px;">
        <h4 class="text-center mb-3">Edit Profile</h4>

        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="text-center mb-3">
                <img src="../uploads/<?php echo $user['image'] ?? 'default.png'; ?>" width="100" height="100" class="rounded-circle">
            </div>

            <input type="text" name="name" class="form-control mb-2" value="<?php echo $user['name']; ?>" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-2" value="<?php echo $user['email']; ?>" placeholder="Email" required>
            <input type="text" name="contact" class="form-control mb-2" value="<?php echo $user['contact']; ?>" placeholder="Contact">
            <input type="text" name="location" class="form-control mb-2" value="<?php echo $user['location']; ?>" placeholder="Location">
            <input type="file" name="image" class="form-control mb-3">

            <button class="btn btn-primary w-100">Update</button>
            <a href="profile.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>
