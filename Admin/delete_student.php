<?php
session_start();
include '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Delete the student from the database
    mysqli_query($conn, "DELETE FROM users WHERE id = $id AND role = 0");
    header("Location: all_students.php");
    exit();
}
?>
