<?php
session_start(); // Start session

if (isset($_SESSION['user'])) {
    echo "Session User: " . $_SESSION['user'];
} else {
    echo "Session User: Not set";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h4>You are not authorised to access this page</h4>
</body>
</html>