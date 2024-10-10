<?php
// Start the session
session_start();

// Include database connection
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to get user data from database
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        // Fetch user data
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // If the password is correct, set session variables
            $_SESSION['username'] = $user['username'];

            // Redirect to a protected page (dashboard.php or home page)
            header("Location: ../home.php");
            exit();
        } else {
            // If the password is incorrect
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        // If no user is found
        echo "<script>alert('No user found with that username!');</script>";
    }
}
?>
