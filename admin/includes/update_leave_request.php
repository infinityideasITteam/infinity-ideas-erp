<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // // Get the user_id based on the leave request ID
    $sql = "SELECT user_id FROM leave_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Update the leave request status
    $sql = "UPDATE leave_requests SET status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {
        // Insert a notification for the user
        $message = '';

        if ($status === 'approved') {
            $message = 'Your leave request has been approved.';
        } elseif ($status === 'rejected') {
            $message = 'Your leave request has been rejected.';
        } else {
            $message = 'Your leave request is pending.';
        }
        
        $notification_sql = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
        $notification_stmt = $conn->prepare($notification_sql);
        $notification_stmt->bind_param('is', $user_id, $message);
        $notification_stmt->execute();
        $notification_stmt->close();

        echo 'Leave request updated and notification sent successfully';
    } else {
        echo 'Error updating leave request: ' . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
