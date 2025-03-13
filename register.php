<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="text" class="form-control" name="contact" placeholder="Enter Contact" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" name="location" placeholder="Enter Location" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

<?php 
if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $location = $_POST["location"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, contact, location, password) 
            VALUES ('$name', '$email', '$contact', '$location', '$hashed_password')";

    if(mysqli_query($conn, $sql)){
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
