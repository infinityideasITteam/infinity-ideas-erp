<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
        <h2 class="text-center mb-4">Admin Panel: Manage Leave Requests</h2>

        <!-- Leave Requests Table -->
        <table id="leaveRequestsTable" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be populated using AJAX -->
            </tbody>
        </table>
    </div>

    <script>
        // Initialize DataTable and load data using AJAX
        $(document).ready(function() {
            loadLeaveRequests();
        });

        // Load leave requests from the server using AJAX
        function loadLeaveRequests() {
            $.ajax({
                url: '../includes/fetch_leave_requests.php', // PHP file to fetch leave requests
                type: 'GET',
                success: function(data) {
                    // Destroy existing DataTable before reinitializing
                    if ($.fn.DataTable.isDataTable('#leaveRequestsTable')) {
                        $('#leaveRequestsTable').DataTable().destroy();
                    }

                    // Append data to table body
                    $('#leaveRequestsTable tbody').html(data);

                    // Reinitialize DataTable with options
                    $('#leaveRequestsTable').DataTable({
                        pageLength: 25,
                        order: [[0, 'asc']] // Sort by ID ascending
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching leave requests:', error);
                }
            });
        }

        // Update leave request via AJAX
        $(document).on('click', '.updateBtn', function() {
            var id = $(this).data('id');
            var status = $('.status[data-id="'+id+'"]').val();

            $.ajax({
                url: '../includes/update_leave_request.php', // PHP file to update leave requests
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    alert('Leave request updated successfully');
                    loadLeaveRequests(); // Reload the table after updating
                },
                error: function(xhr, status, error) {
                    alert('Error updating leave request: ' + error);
                }
            });
        });
    </script>
</body>
</html>
