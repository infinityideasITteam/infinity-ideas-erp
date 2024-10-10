<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
        <h2 class="text-center mb-4">Task Management</h2>

        <!-- Form to Add Task -->
        <form id="taskForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="task_name">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="completed_date">Completed Date</label>
                <input type="date" class="form-control" id="completed_date" name="completed_date">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <!-- Tasks Data Table -->
        <table id="tasksTable" class="table table-striped table-bordered mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Task Name</th>
                    <th>Start Date</th>
                    <th>Completed Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

    <script>
        // Initialize DataTable and load existing tasks
        $(document).ready(function() {
            loadTasks();
            loadUsernames(); // Load usernames for autocomplete

            // Submit form using AJAX to insert data
            $('#taskForm').on('submit', function(e) {
                e.preventDefault();

                var username = $('#username').val(); // Get the username
                var task_name = $('#task_name').val();
                var start_date = $('#start_date').val();
                var completed_date = $('#completed_date').val();
                var status = $('#status').val();

                // Fetch user ID based on username
                $.ajax({
                    url: '../includes/get_user_id.php',
                    type: 'POST',
                    data: { username: username },
                    success: function(userId) {
                        if (userId) {
                            $.ajax({
                                url: '../includes/insert_task.php',
                                type: 'POST',
                                data: {
                                    user_id: userId,
                                    task_name: task_name,
                                    start_date: start_date,
                                    completed_date: completed_date,
                                    status: status
                                },
                                success: function(response) {
                                    alert('Task added successfully');
                                    $('#taskForm')[0].reset(); // Reset form
                                    loadTasks(); // Reload tasks in the table
                                },
                                error: function(xhr, status, error) {
                                    alert('Error: ' + error);
                                }
                            });
                        } else {
                            alert('User not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching user ID: ' + error);
                    }
                });
            });
        });

        // Function to load tasks into DataTable
        function loadTasks() {
            $.ajax({
                url: '../includes/fetch_tasks.php',
                type: 'GET',
                success: function(data) {
                    if ($.fn.DataTable.isDataTable('#tasksTable')) {
                        $('#tasksTable').DataTable().destroy();
                    }

                    $('#tasksTable tbody').html(data);
                    $('#tasksTable').DataTable({
                        pageLength: 25,
                        order: [[0, 'asc']]
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading tasks:', error);
                }
            });
        }

        // Function to load usernames for autocomplete
        function loadUsernames() {
            $.ajax({
                url: '../includes/fetch_usernames.php', // This should return a list of usernames
                type: 'GET',
                success: function(data) {
                    $("#username").autocomplete({
                        source: data.split(",") // Assuming usernames are returned as a comma-separated string
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading usernames:', error);
                }
            });
        }
    </script>
</body>
</html>
