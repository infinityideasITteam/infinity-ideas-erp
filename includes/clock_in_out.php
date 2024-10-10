<?php
require_once './db_conn.php';
session_start();

// Set the correct timezone
date_default_timezone_set('Asia/Kolkata');

$userId = $_POST['userId'];
$action = $_POST['action'];

$response = array('success' => false, 'message' => '');

if ($action == 'Clock In') {
    // Get the current time for clock-in in the correct time zone
    $signInTime = date('Y-m-d H:i:s');

    // Insert a new record into the attendance table
    $sql = "INSERT INTO attendance (user_id, sign_in_time) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('is', $userId, $signInTime);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Successfully clocked in!';
    } else {
        $response['message'] = 'Error during clock in.';
    }

} elseif ($action == 'Clock Out') {
    // Get the current time for clock-out in the correct time zone
    $signOutTime = date('Y-m-d H:i:s');

    // Find the user's latest clock-in record where clock-out is null
    $sql = "SELECT sign_in_time FROM attendance WHERE user_id = ? AND sign_out_time IS NULL ORDER BY id DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($signInTime);
    $stmt->fetch();
    $stmt->close();

    if ($signInTime) {
        // Calculate total working hours
        $signInDateTime = new DateTime($signInTime);
        $signOutDateTime = new DateTime($signOutTime);
        $interval = $signInDateTime->diff($signOutDateTime);
        $totalWorkingHours = $interval->format('%H:%I:%S');

        // Update the attendance record with clock-out time and total working hours
        $sql = "UPDATE attendance SET sign_out_time = ?, total_working_hours = ? WHERE user_id = ? AND sign_out_time IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $signOutTime, $totalWorkingHours, $userId);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Successfully clocked out! Total working hours: ' . $totalWorkingHours;
        } else {
            $response['message'] = 'Error during clock out.';
        }
    } else {
        $response['message'] = 'No clock-in record found.';
    }
}

echo json_encode($response);
$conn->close();
?>
