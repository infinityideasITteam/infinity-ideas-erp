<?php
// Include your database connection file
require './db_conn.php'; // Path to your database connection file

header('Content-Type: application/json');

// Query to fetch events from the database
$query = "SELECT * FROM events ORDER BY event_date DESC";
$result = $conn->query($query);

$events = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);

$conn->close();
?>
