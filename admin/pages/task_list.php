<?php
// Connect to the database
include('../includes/db_connection.php');

// Fetch employee task and user details
$sql = "SELECT t.id AS task_id, u.username, u.phone, t.task_name, t.status, t.started_date, t.completed_date
        FROM tasks t
        INNER JOIN users u ON t.user_id = u.id";
$result = $conn->query($sql);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Task Table</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Optional: jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../home.php">Task Manager</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../home.php">Back</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Employee Task Table</h2>
    
    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Employee Name</th>
                    <th>Phone Number</th>
                    <th>Assigned Task</th>
                    <th>Started At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['task_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['started_date']); ?></td>
                    <td><?php echo ucfirst(htmlspecialchars($row['status'])); ?></td>
                    <td>
                        <?php if (strtolower($row['status']) == 'completed') { ?>
                            <button class="action-btn btn btn-success" data-id="<?php echo $row['task_id']; ?>" data-phone="<?php echo $row['phone']; ?>" data-name="<?php echo $row['username']; ?>" data-status="completed">Send Appreciation</button>
                        <?php } else { ?>
                            <button class="action-btn btn btn-warning" data-id="<?php echo $row['task_id']; ?>" data-phone="<?php echo $row['phone']; ?>" data-name="<?php echo $row['username']; ?>" data-status="pending">Send Enquiry</button>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.action-btn').click(function() {
        // Get the data from the button
        var taskId = $(this).data('id');
        var phoneNumber = $(this).data('phone');
        var employeeName = $(this).data('name');
        var status = $(this).data('status');

        // AJAX request to send the WhatsApp message
        $.ajax({
            url: 'send_whatsapp.php',
            type: 'POST',
            data: {
                id: taskId,
                phone: phoneNumber,
                name: employeeName,
                status: status
            },
            dataType: 'json', // Expect a JSON response
            success: function(response) {
                if (response.url) {
                    // Show the generated URL
                    alert("WhatsApp message has been generated. Click the link to confirm: " + response.url);
                    // Optionally, you can also open the link directly
                    window.open(response.url, '_blank');
                } else if (response.error) {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error sending message.');
            }
        });
    });
});
</script>

</body>
</html>
