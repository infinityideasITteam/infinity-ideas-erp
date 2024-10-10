<?php
include 'db_connection.php'; // Include your database connection file

$query = "SELECT * FROM clients";
$result = $conn->query($query);

$clients = [];
while ($row = $result->fetch_assoc()) {
    $clients[] = $row;
}

echo json_encode($clients);
?>
