<?php
session_start();
require_once("../connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id']; 
$selected_month = isset($_GET['selected_month']) ? $_GET['selected_month'] : date("Y-m");

$year = date("Y", strtotime($selected_month));
$month_text = date("M", strtotime($selected_month)); 

$total_days = date("t", strtotime($selected_month . "-01"));

$present_days = 0;
$absent_days = 0;
$leave_days = 0;
$holiday_days = 0;

$query = "SELECT curr_date, attendance FROM attendance 
          WHERE student_id = '$student_id' 
          AND attendance_month = '$month_text' 
          AND attendance_year = '$year'";

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

$attendance_data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $attendance_data[$row['curr_date']] = $row['attendance'];
}

for ($day = 1; $day <= $total_days; $day++) {
    $current_date = "$year-" . str_pad(date("m", strtotime($selected_month)), 2, "0", STR_PAD_LEFT) . "-" . str_pad($day, 2, "0", STR_PAD_LEFT);

    if (isset($attendance_data[$current_date])) {
        if ($attendance_data[$current_date] == 'P') {
            $present_days++;
        } elseif ($attendance_data[$current_date] == 'A') {
            $absent_days++;
        } elseif ($attendance_data[$current_date] == 'L') {
            $leave_days++;
        } elseif ($attendance_data[$current_date] == 'H') {
            $holiday_days++;
        }
    } else {
        $absent_days++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Student Dashboard</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Attendance Summary</h4>
        </div>
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <label for="month" class="form-label">Select Month:</label>
                    <input type="month" id="month" name="selected_month" value="<?php echo $selected_month; ?>" class="form-control" required>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">View Attendance</button>
                </div>
            </form>

            <div class="mt-4">
                <h5 class="text-center">Attendance for <?php echo date("F Y", strtotime($selected_month)); ?></h5>
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Total Days</th>
                            <th class="text-success">Present</th>
                            <th class="text-danger">Absent</th>
                            <th class="text-warning">Leave</th>
                            <th class="text-info">Holidays</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $total_days; ?></td>
                            <td class="text-success"><?php echo $present_days; ?></td>
                            <td class="text-danger"><?php echo $absent_days; ?></td>
                            <td class="text-warning"><?php echo $leave_days; ?></td>
                            <td class="text-info"><?php echo $holiday_days; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-3">
    <a href="student_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
