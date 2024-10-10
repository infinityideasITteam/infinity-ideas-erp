<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Management</title>
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
        <h2 class="text-center mb-4">Leads Management</h2>

        <!-- Form to Add Leads -->
        <form id="leadForm">
            <div class="form-group">
                <label for="quote_id">Quote ID</label>
                <input type="text" class="form-control" id="quote_id" name="quote_id" required>
            </div>
            <div class="form-group">
                <label for="client_name">Client Name</label>
                <input type="text" class="form-control" id="client_name" name="client_name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" required></textarea>
            </div>
            <div class="form-group">
                <label for="next_followup">Next Follow-up Date</label>
                <input type="date" class="form-control" id="next_followup" name="next_followup" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Interested">Interested</option>
                    <option value="Exited">Exited</option>
                    <option value="Break">Break</option>
                    <option value="Success">Success</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Lead</button>
        </form>

        <!-- Leads Data Table -->
        <table id="leadsTable" class="table table-striped table-bordered mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Quote ID</th>
                    <th>Client Name</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Next Follow-up</th>
                    <th>Status</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

    <script>
        // Initialize DataTable and load existing leads
        $(document).ready(function() {
            loadLeads();
            
            // Submit form using AJAX to insert data
            $('#leadForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '../includes/insert_lead.php',
                    type: 'POST',
                    data: $(this).serialize(), // Serialize form data
                    success: function(response) {
                        alert('Lead added successfully');
                        $('#leadForm')[0].reset(); // Reset form
                        loadLeads(); // Reload leads in the table
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            });
        });

        // Function to load leads into DataTable
        function loadLeads() {
            $.ajax({
                url: '../includes/fetch_leads.php',
                type: 'GET',
                success: function(data) {
                    // Destroy existing DataTable before reloading data
                    if ($.fn.DataTable.isDataTable('#leadsTable')) {
                        $('#leadsTable').DataTable().destroy();
                    }

                    // Populate table body with fetched data
                    $('#leadsTable tbody').html(data);

                    // Reinitialize DataTable
                    $('#leadsTable').DataTable({
                        pageLength: 25,
                        order: [[0, 'asc']]
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading leads:', error);
                }
            });
        }
    </script>
</body>
</html>
