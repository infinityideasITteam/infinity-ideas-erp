<?php
require_once './db_conn.php';

header('Content-Type: application/json');

$sql = "SELECT id, quote_id, client_name, phone, message, next_followup, status, updated_at FROM leads";
$result = $conn->query($sql);

$leads = array();
while($row = $result->fetch_assoc()) {
    $leads[] = $row;
}

echo json_encode($leads);

$conn->close();
?>
