<?php
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notification_id = $_POST['notification_id']; // Notification ID from the frontend

    $sql = "UPDATE notifications SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $notification_id);

    if ($stmt->execute()) {
        echo 'Notification marked as read';
    } else {
        echo 'Error marking notification as read: ' . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
