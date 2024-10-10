<?php
require_once './db_conn.php';
session_start();

$userId = $_SESSION['id'];  // Get the logged-in user's ID

$sql = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [];

while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;  // Fetch each task into an array
}

echo json_encode($tasks);  // Return tasks as JSON
?>
