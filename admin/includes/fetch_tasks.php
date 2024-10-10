<?php
include 'db_connection.php'; // Include your database connection

$sql = "SELECT tasks.id, tasks.user_id, users.username, tasks.task_name, tasks.started_date, tasks.completed_date, tasks.status 
        FROM tasks 
        JOIN users ON tasks.user_id = users.id"; // Join tasks with users table

$result = $conn->query($sql);

if (!$result) {
    die("Database query failed: " . $conn->error); // Error handling
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['task_name'] . '</td>';
        echo '<td>' . $row['started_date'] . '</td>';
        echo '<td>' . $row['completed_date'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">No tasks found</td></tr>';
}

$conn->close();
?>
