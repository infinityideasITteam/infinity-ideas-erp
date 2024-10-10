<?php
include 'db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    // Prepare SQL statement to get the user ID
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();

    // Return user ID if found
    if ($user_id) {
        echo $user_id; // Return user ID
    } else {
        echo null; // User not found
    }

    $stmt->close();
}
$conn->close();
?>
