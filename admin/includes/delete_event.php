<?php
include('../includes/db_connection.php');

if (isset($_POST['id'])) {
    $eventId = $_POST['id'];
    $sql = "DELETE FROM events WHERE id = $eventId";

    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully.";
    } else {
        echo "Error deleting event: " . $conn->error;
    }
}
?>
