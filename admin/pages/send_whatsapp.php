<?php
if (isset($_POST['phone']) && isset($_POST['status']) && isset($_POST['name'])) {
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $employeeName = $_POST['name'];

    // Set the message based on the status
    if ($status == 'completed') {
        $message = "Hi $employeeName, Congratulations on completing your task! Keep up the great work.";
    } else {
        $message = "Hi $employeeName, Please provide an update on your pending task as soon as possible.";
    }

    // WhatsApp API URL (using wa.me for sending messages)
    $whatsappUrl = "https://wa.me/{$phone}?text=" . urlencode($message);
    
    // Return the URL as a JSON response
    echo json_encode(['url' => $whatsappUrl]);
} else {
    echo json_encode(['error' => 'Invalid request.']);
}
?>
