<?php
require './db_conn.php';

session_start();
$user_id = $_SESSION['id']; // Assuming the user ID is stored in the session when logged in

$sql = "SELECT * FROM leave_requests WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$leave_requests = [];
while ($row = $result->fetch_assoc()) {
    $leave_requests[] = $row;
}

echo json_encode($leave_requests);
?>
