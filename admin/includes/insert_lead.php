<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quote_id = $_POST['quote_id'];
    $client_name = $_POST['client_name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $next_followup = $_POST['next_followup'];
    $status = $_POST['status'];
    $updated_at = date('Y-m-d H:i:s'); // Get current timestamp for updated_at

    // Prepare SQL statement to insert the new lead
    $sql = "INSERT INTO leads (quote_id, client_name, phone, message, next_followup, status, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssss', $quote_id, $client_name, $phone, $message, $next_followup, $status, $updated_at);

    if ($stmt->execute()) {
        echo 'Lead added successfully';
    } else {
        echo 'Error adding lead: ' . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
