<?php
include 'db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $stmt = $conn->prepare("INSERT INTO clients (name, created_at) VALUES (?, NOW())");
    $stmt->bind_param("s", $name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Client added successfully!";
    } else {
        echo "Error adding client.";
    }
}
?>
