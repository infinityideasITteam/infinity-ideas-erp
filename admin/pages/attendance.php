<?php
include '../includes/db_connection.php'; // Include your database connection

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to calculate total working days in a month excluding second Saturdays and Sundays
function getWorkingDaysInMonth($month, $year) {
    $workingDays = 0;
    $secondSaturdayCount = 0;
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Iterate through all days in the month
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $date = "$year-$month-$day";
        $dayOfWeek = date('w', strtotime($date)); // Sunday = 0, Monday = 1, ..., Saturday = 6

        // Skip Sundays
        if ($dayOfWeek == 0) {
            continue;
        }

        // Identify and skip second Saturday
        if ($dayOfWeek == 6) {
            $secondSaturdayCount++;
            if ($secondSaturdayCount == 2) {
                continue; // Skip second Saturday
            }
        }

        // Count the day as a working day
        $workingDays++;
    }

    return $workingDays;
}

// Function to convert total working hours from HH:MM:SS format to seconds
function timeToSeconds($time) {
    $parts = explode(':', $time);
    return $parts[0] * 3600 + $parts[1] * 60 + $parts[2];
}

// Function to convert seconds to HH:MM:SS format
function secondsToTime($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

// Assume the current month and year
$currentMonth = date('m');
$currentYear = date('Y');

// Calculate total working days in the current month
$totalWorkingDaysInMonth = getWorkingDaysInMonth($currentMonth, $currentYear);

// SQL to fetch attendance data
$sql = "
    SELECT 
        u.username,
        COUNT(DISTINCT DATE(a.sign_in_time)) AS total_days_worked,
        SEC_TO_TIME(SUM(TIME_TO_SEC(a.total_working_hours))) AS total_hours_worked
    FROM 
        attendance a
    JOIN 
        users u ON a.user_id = u.id
    WHERE 
        MONTH(a.sign_in_time) = ? AND YEAR(a.sign_in_time) = ?
    GROUP BY 
        u.username
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $currentMonth, $currentYear);
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for display
$attendance_data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendance_data[] = [
            'username' => $row['username'],
            'total_days_worked' => $row['total_days_worked'],
            'total_hours_worked' => $row['total_hours_worked']
        ];
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Download PDF
if (isset($_POST['download_pdf'])) {
    require_once '../vendor/autoload.php'; // Include the Dompdf autoload file

    $dompdf = new Dompdf\Dompdf();
    $html = '<h2>Attendance for ' . date('F Y') . '</h2>';
    $html .= '<table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%;">';
    $html .= '<thead><tr><th>Username</th><th>Total Days Worked</th><th>Total Working Hours</th><th>Total Working Days in Month</th></tr></thead>';
    $html .= '<tbody>';

    if (!empty($attendance_data)) {
        foreach ($attendance_data as $data) {
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($data['username']) . '</td>';
            $html .= '<td>' . htmlspecialchars($data['total_days_worked']) . '</td>';
            $html .= '<td>' . htmlspecialchars($data['total_hours_worked']) . '</td>';
            $html .= '<td>' . $totalWorkingDaysInMonth . '</td>';
            $html .= '</tr>';
        }
    } else {
        $html .= '<tr><td colspan="4" class="text-center">No attendance data available for this month.</td></tr>';
    }

    $html .= '</tbody></table>';

    // Load HTML content to Dompdf
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape'); // Set paper size and orientation
    $dompdf->render(); // Render the PDF

    // Output the generated PDF to browser
    $dompdf->stream('attendance_report.pdf', ['Attachment' => true]); // Download the file
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            margin-bottom: 30px;
            font-weight: bold;
            color: #343a40;
        }
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        .table tbody td {
            font-weight: 500;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.1rem;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home.php">Task Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../home.php">Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h2 class="text-center">Employee Attendance for <?php echo date('F Y'); ?></h2>
    
    <form method="post">
        <button type="submit" name="download_pdf" class="btn btn-primary mb-3">Download as PDF</button>
    </form>

    <table id="attendanceTable" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>Username</th>
                <th>Total Days Worked</th>
                <th>Total Working Hours</th>
                <th>Total Working Days in Month</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($attendance_data)): ?>
                <?php foreach ($attendance_data as $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['username']); ?></td>
                        <td><?php echo htmlspecialchars($data['total_days_worked']); ?></td>
                        <td><?php echo htmlspecialchars($data['total_hours_worked']); ?></td>
                        <td><?php echo $totalWorkingDaysInMonth; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No attendance data available for this month.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#attendanceTable').DataTable();
});
</script>
</body>
</html>
