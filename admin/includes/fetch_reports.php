<?php
include 'db_connection.php';

header('Content-Type: application/json');

$user_id = $_GET['user_id'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

// Fetch reports from the database
$query = "SELECT * FROM employee_reports WHERE user_id = ? AND report_date BETWEEN ? AND ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $user_id, $start_date, $end_date);
$stmt->execute();
$reports = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Return JSON response
echo json_encode($reports);
?>
