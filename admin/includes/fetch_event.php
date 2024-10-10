<?php
include('../includes/db_connection.php');

if (isset($_POST['id'])) {
    $eventId = $_POST['id'];
    $sql = "SELECT * FROM events WHERE id = $eventId";
    $result = $conn->query($sql);
    $event = $result->fetch_assoc();
    
    echo json_encode($event);
}
?>
