<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert users (this should be done securely in a real environment)
$password1 = password_hash('Alan2k2', PASSWORD_DEFAULT);
$password2 = password_hash('Akshay2k2', PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('Alan', '$password1'), ('Akshay', '$password2')";

if ($conn->query($sql) === TRUE) {
    echo "Users created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
