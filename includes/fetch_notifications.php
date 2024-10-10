<?php
include 'db_conn.php';

session_start();
$user_id = $_SESSION['id']; // Ensure user_id is set in session

$sql = "SELECT id, message, created_at AS timestamp FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$notifications = array();
while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
}

if (empty($notifications)) {
    echo json_encode(['status' => 'No notifications found']);
} else {
    echo json_encode($notifications);
}

$stmt->close();
$conn->close();
?>
