<?php
require_once './db_conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskId = $_POST['taskId'];
    $status = $_POST['status'];
    
    // If the status is set to "Completed", also update the completed_date
    if ($status === 'Completed') {
        $completedDate = date('Y-m-d');
        $sql = "UPDATE tasks SET status = ?, completed_date = ? WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii', $status, $completedDate, $taskId, $_SESSION['id']);
    } else {
        // For "Pending" and "Cancelled", clear the completed_date
        $completedDate = NULL;
        $sql = "UPDATE tasks SET status = ?, completed_date = NULL WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $status, $taskId, $_SESSION['id']);
    }

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update task status']);
    }

    $stmt->close();
}
?>
