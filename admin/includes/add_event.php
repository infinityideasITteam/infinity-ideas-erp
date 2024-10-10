<?php
include('../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventDate = $_POST['event_date'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO events (event_date, title, description) VALUES ('$eventDate', '$title', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New event added successfully.";
    } else {
        echo "Error adding event: " . $conn->error;
    }
}
?>
