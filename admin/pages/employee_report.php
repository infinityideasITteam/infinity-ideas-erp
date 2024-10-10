<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Reports</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <h1 class="mb-4">Employee Reports</h1>

    <div class="form-group row">
        <label for="id" class="col-sm-2 col-form-label">Select User:</label>
        <div class="col-sm-4">
            <select id="id" class="form-control">
                <option value="">-- Select User --</option>
                <?php
                include '../includes/db_connection.php'; // Include your database connection file
                $result = $conn->query("SELECT id, username FROM users");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['username']}</option>";
                }
                ?>
            </select>
        </div>

        <label for="startDate" class="col-sm-2 col-form-label">Start Date:</label>
        <div class="col-sm-4">
            <input type="date" id="startDate" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="endDate" class="col-sm-2 col-form-label">End Date:</label>
        <div class="col-sm-4">
            <input type="date" id="endDate" class="form-control">
        </div>
        <div class="col-sm-2">
            <button id="fetchReports" class="btn btn-primary">Fetch Reports</button>
        </div>
    </div>

    <table id="reportsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Report Date</th>
                <th>Work Description</th>
                <th>Submission Time</th>
            </tr>
        </thead>
    </table>

    <div class="mt-4">
        <button id="downloadExcel" class="btn btn-success">Download Excel</button>
        <button id="downloadPDF" class="btn btn-danger">Download PDF</button>
    </div>
</div>

<script>
$(document).ready(function() {
    var reportsTable = $('#reportsTable').DataTable({
        columns: [
            { data: 'id' },
            { data: 'user_id' },
            { data: 'report_date' },
            { data: 'work_description' },
            { data: 'submission_time' }
        ]
    });

    $('#fetchReports').click(function() {
        var userId = $('#id').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        $.ajax({
            url: '../includes/fetch_reports.php',
            type: 'GET',
            data: {
                user_id: userId,
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                reportsTable.clear().rows.add(data).draw();
            },
            error: function(xhr, status, error) {
                console.error("Error fetching reports:", error);
            }
        });
    });

    $('#downloadExcel').click(function() {
        var userId = $('#id').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        window.location.href = '../includes/download.php?type=excel&user_id=' + userId + '&start_date=' + startDate + '&end_date=' + endDate;
    });

    $('#downloadPDF').click(function() {
        var userId = $('#id').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        window.location.href = '../includes/download.php?type=pdf&user_id=' + userId + '&start_date=' + startDate + '&end_date=' + endDate;
    });
});
</script>
</body>
</html>
