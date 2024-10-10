<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <title>Clients Management</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1 {
            font-size: 2rem;
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #e9ecef;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
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
    <h1 class="mb-4">Clients Management</h1>

    <form id="clientForm">
        <div class="form-group">
            <label for="clientName">Client Name:</label>
            <input type="text" id="clientName" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Client</button>
    </form>

    <table id="clientsTable" class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created At</th>
            </tr>
        </thead>
    </table>
</div>

<script>
$(document).ready(function() {
    var clientsTable = $('#clientsTable').DataTable({
        ajax: {
            url: '../includes/fetch_clients.php',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'created_at' }
        ]
    });

    $('#clientForm').submit(function(e) {
        e.preventDefault();
        var clientName = $('#clientName').val();

        $.ajax({
            url: '../includes/add_client.php',
            type: 'POST',
            data: { name: clientName },
            success: function(response) {
                $('#clientName').val('');
                clientsTable.ajax.reload(); // Refresh the DataTable
            }
        });
    });
});
</script>
</body>
</html>
