<?php
require_once './db_conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskId = $_POST['taskId'];
    $isCompleted = $_POST['isCompleted'] == 'true' ? 1 : 0;

    $sql = "UPDATE todolist SET is_completed = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $isCompleted, $taskId, $_SESSION['id']);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
}
?>
