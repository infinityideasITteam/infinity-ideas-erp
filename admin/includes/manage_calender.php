<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add a new event
    $client_id = $_POST['client_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    
    $sql = "INSERT INTO clients_calenders (client_id, title, description, event_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $client_id, $title, $description, $event_date);
    $stmt->execute();
    echo json_encode(['success' => true]);
    exit;
}

// Fetch events for a specific client
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    $sql = "SELECT * FROM clients_calenders WHERE client_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $events = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($events);
    exit;
}
?>
