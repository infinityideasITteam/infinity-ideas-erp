<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $task_name = $_POST['task_name'];
    $start_date = $_POST['start_date'];
    $completed_date = $_POST['completed_date'];
    $status = $_POST['status'];

    // Prepare SQL statement to insert the new task
    $sql = "INSERT INTO tasks (user_id, task_name, started_date, completed_date, status)
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $user_id, $task_name, $start_date, $completed_date, $status);

    if ($stmt->execute()) {
        echo 'Task added successfully';
    } else {
        echo 'Error adding task: ' . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
