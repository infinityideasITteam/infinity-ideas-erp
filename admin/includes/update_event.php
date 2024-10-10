<?php
include('../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventId = $_POST['event_id'];
    $eventDate = $_POST['event_date'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "UPDATE events SET event_date = '$eventDate', title = '$title', description = '$description' WHERE id = $eventId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Event updated successfully.";
    } else {
        echo "Error updating event: " . $conn->error;
    }
}
?>
