<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
    <h1>Social Media Management</h1>
    
    <div class="form-group row align-items-end">
        <label for="clientSelect" class="col-sm-2 col-form-label">Select Client</label>
        <div class="col-sm-8">
            <select id="clientSelect" class="form-control">
                <option value="">-- Select Client --</option>
                <?php
                include '../includes/db_connection.php';
                $result = $conn->query("SELECT id, name FROM clients");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#eventModal">Add Event</button>
            <button id="downloadCSV" class="btn btn-success">Download CSV</button>
            <button id="downloadPDF" class="btn btn-info">Download PDF</button>
        </div>
    </div>
    
    <div id="calendar"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="client_id">Client ID</label>
                        <input type="text" class="form-control" id="client_id" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                        <input type="date" class="form-control" id="event_date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        events: function(start, end, timezone, callback) {
            var clientId = $('#clientSelect').val();
            if (clientId) {
                $.ajax({
                    url: '../includes/manage_calender.php',
                    dataType: 'json',
                    data: {
                        client_id: clientId
                    },
                    success: function(data) {
                        var events = [];
                        $(data).each(function() {
                            events.push({
                                title: this.title, // Use title for display
                                start: this.event_date
                            });
                        });
                        callback(events);
                    }
                });
            } else {
                callback([]);
            }
        }
    });

    $('#clientSelect').change(function() {
        calendar.fullCalendar('refetchEvents'); // Refresh calendar based on selected client
        $('#client_id').val($(this).val()); // Update hidden input for event form
    });

    $('#eventForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: '../includes/manage_calender.php',
            type: 'POST',
            data: {
                client_id: $('#client_id').val(),
                title: $('#title').val(),
                description: $('#description').val(),
                event_date: $('#event_date').val()
            },
            success: function(response) {
                $('#eventModal').modal('hide');
                calendar.fullCalendar('refetchEvents'); // Refresh calendar
            }
        });
    });

    // Download CSV
    $('#downloadCSV').click(function() {
        var clientId = $('#clientSelect').val();
        if (clientId) {
            $.ajax({
                url: '../includes/manage_calender.php',
                dataType: 'json',
                data: {
                    client_id: clientId
                },
                success: function(data) {
                    var csvContent = "data:text/csv;charset=utf-8,";
                    csvContent += "ID,Title,Description,Date\n"; // Header row
                    
                    $(data).each(function() {
                        var row = this.id + "," + this.title + "," + this.description + "," + this.event_date;
                        csvContent += row + "\n"; // Add each row
                    });

                    var encodedUri = encodeURI(csvContent);
                    var link = document.createElement("a");
                    link.setAttribute("href", encodedUri);
                    link.setAttribute("download", "calendar_events.csv");
                    document.body.appendChild(link);
                    link.click(); // Trigger the download
                    document.body.removeChild(link); // Clean up
                }
            });
        } else {
            alert('Please select a client to download events.');
        }
    });

    // Download PDF
    $('#downloadPDF').click(function() {
        var clientId = $('#clientSelect').val();
        if (clientId) {
            $.ajax({
                url: '../includes/manage_calender.php',
                dataType: 'json',
                data: {
                    client_id: clientId
                },
                success: function(data) {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    doc.text("Calendar Events", 10, 10);
                    doc.text("ID | Title | Description | Date", 10, 20);
                    let y = 30;

                    $(data).each(function() {
                        doc.text(this.id + " | " + this.title + " | " + this.description + " | " + this.event_date, 10, y);
                        y += 10; // Increase Y position for next row
                    });

                    doc.save('calendar_events.pdf'); // Save PDF
                }
            });
        } else {
            alert('Please select a client to download events.');
        }
    });
});
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
