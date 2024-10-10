<?php
// Start session to get user data
session_start();

// Include the database connection file
include 'db_conn.php'; // Ensure the path is correct

// Check if the user is logged in by checking if 'user_id' is set in session
if (!isset($_SESSION['id'])) {
    echo "User not logged in!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the logged-in user's ID from session
    $userId = $_SESSION['id']; 
    
    $reportDate = $_POST['reportDate'];
    $workDescription = $_POST['workDescription'];

    // Input validation (optional but recommended)
    if (empty($reportDate) || empty($workDescription)) {
        echo "All fields are required!";
        exit();
    }

    // Prepare and bind the query
    $stmt = $conn->prepare("INSERT INTO employee_reports (user_id, report_date, work_description) VALUES (?, ?, ?)");
    if ($stmt === false) {
        echo "Error in statement preparation: " . $conn->error;
        exit();
    }

    $stmt->bind_param("iss", $userId, $reportDate, $workDescription); // 'iss' = integer, string, string

    // Execute the query
    if ($stmt->execute()) {
        echo "Report successfully submitted!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
} else {
    echo "Invalid request method!";
}

$conn->close(); // Close the database connection
?>
