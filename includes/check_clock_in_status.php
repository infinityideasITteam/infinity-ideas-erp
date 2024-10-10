<?php
require_once './db_conn.php';
session_start();

date_default_timezone_set('Asia/Kolkata');

$userId = $_SESSION['id'];  // Assuming user ID is stored in session

// Function to check the clock-in status
function getClockInStatus($conn, $userId) {
    // Query the database to find if the user has clocked in but not clocked out
    $sql = "SELECT sign_in_time FROM attendance WHERE user_id = ? AND sign_out_time IS NULL ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    
    // Ensure the query was prepared successfully
    if (!$stmt) {
        return false; // Handle error, query could not be prepared
    }
    
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    
    // Initialize the variable to avoid unassigned variable issue
    $signInTime = null;
    
    $stmt->bind_result($signInTime);
    
    // Fetch the result and check if a row was returned
    if ($stmt->fetch()) {
        $stmt->close();
        return true; // User has clocked in but not clocked out
    } else {
        $stmt->close();
        return false; // No active clock-in found
    }
}

$isClockedIn = getClockInStatus($conn, $userId);

// Return the result in a JSON format so it can be used by JavaScript
echo json_encode(['isClockedIn' => $isClockedIn]);

$conn->close();
?>
