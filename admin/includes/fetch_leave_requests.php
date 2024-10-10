<?php
include 'db_connection.php'; // Add your DB connection file

$sql = "SELECT * FROM leave_requests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td><input type='text' class='form-control leave_type' data-id='" . $row['id'] . "' value='" . $row['leave_type'] . "' /></td>";
        echo "<td><input type='date' class='form-control start_date' data-id='" . $row['id'] . "' value='" . $row['start_date'] . "' /></td>";
        echo "<td><input type='date' class='form-control end_date' data-id='" . $row['id'] . "' value='" . $row['end_date'] . "' /></td>";
        echo "<td><input type='text' class='form-control reason' data-id='" . $row['id'] . "' value='" . $row['reason'] . "' /></td>";
        echo "<td>
                <select class='form-control status' data-id='" . $row['id'] . "'>
                    <option value='pending'" . ($row['status'] == 'pending' ? ' selected' : '') . ">Pending</option>
                    <option value='approved'" . ($row['status'] == 'approved' ? ' selected' : '') . ">Approved</option>
                    <option value='rejected'" . ($row['status'] == 'rejected' ? ' selected' : '') . ">Rejected</option>
                </select>
            </td>";
        echo "<td><button class='btn btn-primary updateBtn' data-id='" . $row['id'] . "'>Update</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No leave requests found.</td></tr>";
}

$conn->close();
?>
