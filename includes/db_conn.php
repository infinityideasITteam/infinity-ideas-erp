
<?php
// Database connection parameters
$servername = "localhost";  // Typically 'localhost' if running on the same server
$username = "root";         // Your MySQL username (default is 'root')
$password = "";             // Your MySQL password (leave empty for default XAMPP setup)
$dbname = "user_management"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: You can uncomment the line below for debugging purposes to confirm connection
// echo "Connected successfully";

?>
