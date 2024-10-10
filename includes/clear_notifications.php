<?php
include 'db_conn.php';

session_start();
$user_id = $_SESSION['id']; // Get user_id from session

$sql = "UPDATE notifications SET is_read = 1 WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);

if ($stmt->execute()) {
    echo 'All notifications cleared';
} else {
    echo 'Error clearing notifications: ' . $conn->error;
}

$stmt->close();
$conn->close();
?>
