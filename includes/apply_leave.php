<?php
require './db_conn.php';

session_start();
$user_id = $_SESSION['id']; // Assuming the user ID is stored in the session when logged in

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    // Insert leave request into the database
    $stmt = $conn->prepare("INSERT INTO leave_requests (user_id, leave_type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $leave_type, $start_date, $end_date, $reason);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Leave request submitted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit leave request']);
    }
}
?>
