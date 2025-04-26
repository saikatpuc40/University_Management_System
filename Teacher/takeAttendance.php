<?php
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card mx-auto shadow-lg p-4" style="max-width: 700px;">
        <h2 class="text-center">Take Attendance</h2>

        <form action="" method="POST">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Student Name</th>
                        <th>P</th>
                        <th>A</th>
                        <th>L</th>
                        <th>H</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                       $fetchingData = mysqli_query($conn, "SELECT id, name FROM users WHERE role = 0");
                        while ($data = mysqli_fetch_assoc($fetchingData)) {
                            $student_name = $data["name"];
                            $student_id = $data["id"];
                    ?>
                    <tr>
                        <td><?php echo $student_name; ?></td>
                        <td><input type="radio" name="attendance[<?php echo $student_id; ?>]" value="P" required></td>
                        <td><input type="radio" name="attendance[<?php echo $student_id; ?>]" value="A"></td>
                        <td><input type="radio" name="attendance[<?php echo $student_id; ?>]" value="L"></td>
                        <td><input type="radio" name="attendance[<?php echo $student_id; ?>]" value="H"></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Select Date</td>
                        <td colspan="4"><input type="date" class="form-control" name="selectedDate" required></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <button type="submit" name="submitButton" class="btn btn-primary w-100">Submit Attendance</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <a href="teacher_dashboard.php" class="btn btn-secondary w-100 mt-2">Back to Dashboard</a>
    </div>
</div>

</body>
</html>

<?php 
if(isset($_POST['submitButton'])){
    date_default_timezone_set("Asia/Dhaka");
    $selected_date = $_POST['selectedDate'] ?? date("Y-m-d");
    $attendance_month = date("M", strtotime($selected_date));
    $attendance_year = date("Y", strtotime($selected_date));

    if(isset($_POST['attendance'])){
        foreach($_POST['attendance'] as $student_id => $attendance){

            $query = "INSERT INTO attendance (student_id, curr_date, attendance_month, attendance_year, attendance) 
                      VALUES ('$student_id', '$selected_date', '$attendance_month', '$attendance_year', '$attendance')
                      ON DUPLICATE KEY UPDATE attendance='$attendance'";

            mysqli_query($conn, $query) or die(mysqli_error($conn));
        }
    }

    echo "<div class='alert alert-success text-center'>Attendance Added Successfully</div>";
}
?>
