<?php
require_once './db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $quote_id = $_POST['quote_id'];
    $client_name = $_POST['client_name'];
    $message = $_POST['message'];
    $next_followup = $_POST['next_followup'];
    $status = $_POST['status'];

    $sql = "UPDATE leads SET quote_id = ?, client_name = ?, message = ?, next_followup = ?, status = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $quote_id, $client_name, $message, $next_followup, $status, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
