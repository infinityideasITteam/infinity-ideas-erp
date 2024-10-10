<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- jQuery (required for AJAX) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg">
            <h2 class="text-center mb-4">Login</h2>
            <!-- Login Form -->
            <form id="loginForm" action="javascript:void(0);">
                <div class="mb-3">
                    <label for="username" class="form-label">Email address</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <!-- Alert Box (Initially Hidden) -->
            <div id="alertBox" class="alert d-none mt-3"></div>

            <p class="text-center mt-3"><a href="#">Forgot your password?</a></p>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();  // Prevent default form submission
                
                // Collect form data
                var username = $('#username').val();
                var password = $('#password').val();

                // Clear any previous alert messages
                $('#alertBox').removeClass('d-none alert-success alert-danger').empty();

                // Send AJAX request to the server
                $.ajax({
                    type: 'POST',
                    url: './includes/employee_login.php',  // Path to your PHP login script
                    data: { username: username, password: password },
                    dataType: 'json',
                    success: function(response) {
                        // Check if login is successful
                        if (response.success) {
                            // Redirect to user dashboard if login is successful
                            window.location.href = './user';
                        } else {
                            // Show error message in alert box
                            $('#alertBox').addClass('alert-danger').text(response.message).fadeIn();
                        }
                    },
                    error: function() {
                        // Handle unexpected errors
                        $('#alertBox').addClass('alert-danger').text('An error occurred. Please try again.').fadeIn();
                    }
                });
            });
        });
    </script>
</body>
</html>
