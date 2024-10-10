<?php
include 'db_connection.php'; // Include your database connection

$sql = "SELECT username FROM users";
$result = $conn->query($sql);

$usernames = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usernames[] = $row['username'];
    }
}

// Return usernames as a comma-separated string
echo implode(",", $usernames);

$conn->close();
?>
