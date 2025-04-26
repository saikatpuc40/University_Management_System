<?php
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES['pdf_file']['name'])) {
    $upload_dir = "../uploads/";
    $file_name = basename($_FILES['pdf_file']['name']);
    $file_path = $upload_dir . $file_name;
    $uploaded_by = $_SESSION['user_id'];

    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $file_path)) {
        $query = "INSERT INTO pdf_files (file_name, file_path, uploaded_by) VALUES ('$file_name', '$file_path', '$uploaded_by')";
        if (mysqli_query($conn, $query)) {
            $message = "<div class='alert alert-success text-center'>Upload successful!</div>";
        } else {
            $message = "<div class='alert alert-danger text-center'>Database insert failed.</div>";
        }
    } else {
        $message = "<div class='alert alert-danger text-center'>File upload failed.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto shadow-lg p-4" style="max-width: 500px;">
        <h2 class="text-center">Upload PDF File</h2>

        <?php if (isset($message)) echo $message; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="pdf_file" class="form-label">Select PDF</label>
                <input type="file" class="form-control" name="pdf_file" accept=".pdf" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>

        <a href="teacher_dashboard.php" class="btn btn-secondary w-100 mt-3">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
