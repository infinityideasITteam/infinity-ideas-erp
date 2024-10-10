<?php
include 'db_connection.php'; // Include your database connection

$sql = "SELECT * FROM leads"; // Fetch all leads from the database
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['quote_id'] . '</td>';
        echo '<td>' . $row['client_name'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['message'] . '</td>';
        echo '<td>' . $row['next_followup'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td>' . $row['updated_at'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">No leads found</td></tr>';
}

$conn->close();
?>
