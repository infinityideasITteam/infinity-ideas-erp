<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Infinity ideas Admin Panel</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/logo-dark.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo-dark.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-dark.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/dashboard/user.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="./includes/logout.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3" id="events-list">
              <!-- Dynamic Events -->
            </div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/attendance.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Attendance Management</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/add_task.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Add Tasks</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/insert_lead.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Leads Management</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/leave_approve.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Leave Updates</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/task_list.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Tasks List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/events.php">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Events</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/employee_report.php">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Work Report</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/add_client.php">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Clients</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/calender.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Calender</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="pages/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <?php
// Include the database connection file
include('includes/db_connection.php');

$user = $_SESSION['username'];

// Prepare the SQL query using a prepared statement to avoid SQL injection
$sql = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql);

// Bind the parameter
$stmt->bind_param("s", $user);  // 's' means the parameter is a string

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
?>
        <h3 class="font-weight-bold">Welcome &nbsp;<?php echo $row['username']; ?></h3>
<?php
    }
} else {
    echo "No results found.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
          </div>
          <?php 
          include('includes/db_connection.php');
          
                      if (isset($_SESSION['username'])) {
                      $user_id = $_SESSION['username'];
    
                      // Fetch employee details linked to the user
                      $sql = "SELECT * FROM admin WHERE username = ?";
                      $stmt = $conn->prepare($sql);
                      $stmt->bind_param("i", $user_id);
                      $stmt->execute();
                      $result = $stmt->get_result();
    
                      if ($result->num_rows > 0) {
                        $employee_details = $result->fetch_assoc();
                    ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i><?php echo $employee_details['position']; ?></h2>
                      </div>
                      <!-- <div class="ml-2">
                        <h4 class="location font-weight-normal">Bangalore</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            } else {
              echo "No employee details found.";
          }
      } else {
          echo "User not logged in.";
      }
      ?>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                    <?php 
include('includes/db_connection.php');

if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['username']; // This is still available, but not used in the query
    
    // Fetch unique attendance count for today
    $sql = "SELECT COUNT(DISTINCT user_id) AS attendance_count 
            FROM attendance 
            WHERE DATE(sign_in_time) = CURDATE()";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee_details = $result->fetch_assoc();
    ?>
        <p class="mb-4">Total Attendance</p>
        <p class="fs-30 mb-2"><?php echo $employee_details['attendance_count']; ?></p>
        <p>10.00% (30 days)</p>
    </div>
    </div>
    </div>
    <?php
    } else {
        echo "No attendance records found for today.";
    }
} else {
    echo "User not logged in.";
}
?>


                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                    <?php 
include('includes/db_connection.php');

if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['username']; // This is still available, but not used in the query
    
    // Fetch attendance count for today
    $sql = "SELECT COUNT(*) AS pending_count FROM tasks WHERE status='pending'";
    $stmt = $conn->prepare($sql);
    
    // No need to bind parameters, as the query doesn't have any placeholders
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee_details = $result->fetch_assoc();
    ?>
                      <p class="mb-4">Total Pending Works</p>
                      <p class="fs-30 mb-2"><a href="pages/task_list.php" class="text-white"><?php echo $employee_details['pending_count']; ?></a>
                      <p>22.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <?php
    } else {
        echo "No attendance records found for today.";
    }
} else {
    echo "User not logged in.";
}

?>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                    <?php 
include('includes/db_connection.php');

if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['username']; // This is still available, but not used in the query
    
    // Fetch attendance count for today
    $sql = "SELECT COUNT(*) AS sucess_count FROM leads WHERE status='Success'";
    $stmt = $conn->prepare($sql);
    
    // No need to bind parameters, as the query doesn't have any placeholders
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee_details = $result->fetch_assoc();
    ?>
                      <p class="mb-4">No.of Posetive Clients</p>
                      <p class="fs-30 mb-2"><?php echo $employee_details['sucess_count']; ?></p>
                      <p>2.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <?php
    } else {
        echo "No attendance records found for today.";
    }
} else {
    echo "User not logged in.";
}

?>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                    <?php 
include('includes/db_connection.php');

if (isset($_SESSION['username'])) {
    $user_id = $_SESSION['username']; // This is still available, but not used in the query
    
    // Fetch attendance count for today
    $sql = "SELECT COUNT(*) AS total_count FROM leads";
    $stmt = $conn->prepare($sql);
    
    // No need to bind parameters, as the query doesn't have any placeholders
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee_details = $result->fetch_assoc();
    ?>
                      <p class="mb-4">Total No.of Leads</p>
                      <p class="fs-30 mb-2"><?php echo $employee_details['total_count']; ?></p>
                      <p>0.22% (30 days)</p>
                    </div>
                  </div>
                </div>
                <?php
    } else {
        echo "No attendance records found for today.";
    }
} else {
    echo "User not logged in.";
}

?>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Leads Table</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="leadsTable" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Quote ID</th>
                                                <th>Client Name</th>
                                                <th>Phone Number</th>
                                                <th>Message</th>
                                                <th>Next Follow-up</th>
                                                <th>Status</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data will be loaded here by DataTables -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Lead Modal -->
    <div class="modal fade" id="editLeadModal" tabindex="-1" aria-labelledby="editLeadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLeadModalLabel">Edit Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editLeadForm">
                        <input type="hidden" id="editLeadId" name="id">
                        <div class="mb-3">
                            <label for="editQuoteId" class="form-label">Quote ID</label>
                            <input type="text" class="form-control" id="editQuoteId" name="quote_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="editClientName" class="form-label">Client Name</label>
                            <input type="text" class="form-control" id="editClientName" name="client_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="editMessage" name="message"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editNextFollowup" class="form-label">Next Follow-up</label>
                            <input type="date" class="form-control" id="editNextFollowup" name="next_followup" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select class="form-select" id="editStatus" name="status" required>
                                <option value="Interested">Interested</option>
                                <option value="Exited">Exited</option>
                                <option value="Break">Break</option>
                                <option value="Success">Success</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        </div>
        
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024.  Premium <a href="" target="_blank">Infinity Ideas</a></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">All rights reserved.</span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>
<script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#leadsTable').DataTable({
                "ajax": {
                    "url": "../includes/fetch_leads.php",
                    "type": "GET",
                    "dataSrc": ""
                },
                "columns": [
                    { "data": "id" },
                    { "data": "quote_id" },
                    { "data": "client_name" },
                    { "data": "phone" },
                    { "data": "message" },
                    { "data": "next_followup" },
                    { "data": "status" },
                    { "data": "updated_at" },
                    {
                        "data": null,
                        "defaultContent": '<button class="btn btn-primary btn-sm edit-btn">Edit</button> <button class="btn btn-danger btn-sm delete-btn">Delete</button>'
                    }
                ]
            });

            // Handle Edit button click
            $('#leadsTable tbody').on('click', '.edit-btn', function() {
                var data = table.row($(this).parents('tr')).data();
                $('#editLeadId').val(data.id);
                $('#editQuoteId').val(data.quote_id);
                $('#editClientName').val(data.client_name);
                $('#editMessage').val(data.message);
                $('#editNextFollowup').val(data.next_followup);
                $('#editStatus').val(data.status);
                $('#editLeadModal').modal('show');
            });

            // Handle Delete button click
            $('#leadsTable tbody').on('click', '.delete-btn', function() {
                var data = table.row($(this).parents('tr')).data();
                if (confirm("Are you sure you want to delete this lead?")) {
                    $.ajax({
                        url: '../includes/delete_lead.php',
                        type: 'POST',
                        data: { id: data.id },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                table.ajax.reload();
                                alert('Lead deleted successfully.');
                            } else {
                                alert('Failed to delete lead.');
                            }
                        },
                        error: function() {
                            alert('Failed to delete lead.');
                        }
                    });
                }
            });

            // Handle Edit Form Submission
            $('#editLeadForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '../includes/update_lead.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#editLeadModal').modal('hide');
                            table.ajax.reload();
                            alert('Lead updated successfully.');
                        } else {
                            alert('Failed to update lead.');
                        }
                    },
                    error: function() {
                        alert('Failed to update lead.');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Function to fetch and display events
            function fetchEvents() {
                $.ajax({
                    url: '../includes/fetch_events.php', // Path to your PHP file
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let eventsHtml = '';
                        $.each(data, function(index, event) {
                            let eventDate = new Date(event.event_date);
                            let formattedDate = eventDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

                            eventsHtml += `
                                <div class="events pt-4 px-3">
                                    <div class="wrapper d-flex mb-2">
                                        <i class="ti-control-record text-primary mr-2"></i>
                                        <span>${formattedDate}</span>
                                    </div>
                                    <h4 class="mb-0 font-weight-thin text-gray">${event.title}</h4>
                                    <p class="text-gray mb-0">${event.description}</p>
                                </div>
                            `;
                        });

                        $('#events-list').html(eventsHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching events: " + error);
                    }
                });
            }

            // Fetch events on page load
            fetchEvents();
        });
    </script>
</html>

