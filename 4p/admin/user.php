<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
    <!-- Add Bootstrap CSS -->
    <script src="include/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Add the viewport meta tag -->
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            font-family: 'Helvetica', sans-serif;
        }

        .navbar {
            background-color: #2c3e50;
            /* Darker background color for a professional look */
            padding: 20px 35px;
            /* Reduced padding for a sleeker appearance */
            color: #ecf0f1;
            /* Light text color for better contrast */
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            /* Subtle box shadow for depth */
        }

        .navbar a {
            color: #ecf0f1;
            /* Light text color */
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
            /* Added spacing between links */
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: #3498db;
            /* A slightly lighter shade than the main color */
            color: #fff;
            /* White text color on hover */
        }

        .sidebar {
            background-color: #2c3e50;
            height: 100vh;
            color: gold;
            padding: 20px;
        }

        .content {
            background-color: #ecf0f1;
            padding: 20px;
        }

        .list-group-item {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .list-group-item:hover {
            background-color: #2980b9;
        }

        h1 {
            color: gold;
        }

        p {
            color: #555;
        }

        .btn-primary {
            background-color: #1f3a5d;
            color: gold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #c0392b;
        }

        .legend {
            position: fixed;
            bottom: 10px;
            right: 10px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 10px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
        }

        .legend-text {
            color: #333;
            font-size: 14px;
        }

        .legend-color-green {
            background-color: #6dbb63;
            /* Green color */
        }

        .legend-color-yellow {
            background-color: #fdd835;
            /* Yellow color */
        }

        .legend-color-red {
            background-color: #e74c3c;
            /* Red color */
        }

        .form-container {
            flex: 1;
            background-color: #f5f5f5;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            margin: 30px auto;
            font-family: "Arial", sans-serif;
            max-height: 550px;
            overflow: auto;
        }

        .form-container label {
            font-weight: bold;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            color: #555;
        }

        .form-container button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 15px 30px;
            cursor: pointer;
            font-family: "Arial", sans-serif;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .form-container button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Custom hover effect for the logout button */
        .swal2-confirm:hover {
            background-color: #0056b3;
            color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-toggler {
            padding: .25rem .75rem;
            font-size: 1.25rem;
            line-height: 1;
            background-color: transparent;
            border: 1px solid transparent;
            border-radius: .25rem;

        }

        #activityLog {
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 1000;
            max-width: 400px;
        }


        /* Adjustments for responsive layout */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar a {
                margin: 5px 0;
            }

            #content {
                margin-left: 0;
                padding-left: 20px;
                padding-right: 20px;
            }

            .form-container {
                margin-top: 10px;
                margin-left: 0;
                width: 100%;
            }

            .logo {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <img src="image/mercedes.png" alt="Logo" width="60px">
        <a class="navbar-brand text-white" href="#">Municipal Social Welfare Development</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="dashboard.php">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link text-white" href="user.php">
                        <i class="fas fa-user"></i> Create User
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link text-white" href="manage_user.php">
                        <i class="fas fa-users"></i> Manage User
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" style="cursor: pointer;" onclick="logout()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>

            </ul>
        </div>
    </nav>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Content -->
            <div class="col content">
                <h2>Create User</h2>
                <form id="submitForm" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required aria-describedby="passwordHelpBlock">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be at least 8 characters long and should include a mix of letters, numbers, and symbols.
                        </small>
                        <div id="activityLog" class="alert alert-info" style="display:none;"></div>
                    </div>

                    <button type="submit" class="btn btn-primary" aria-label="Create User">Create User</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function logActivity(message, type = 'info') {
            const activityLog = $('#activityLog');
            const timestamp = new Date().toLocaleString();

            const logEntry = `<p><strong>${timestamp}:</strong> ${message}</p>`;
            activityLog.append(logEntry);

            // Display the log container if it was hidden
            activityLog.show();

            // Optionally, you can add styling based on the log type (info, success, error, etc.)
            activityLog.removeClass().addClass(`alert alert-${type}`);
        }

        $(document).ready(function() {
            $("#submitForm").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "function/create_user.php",
                    type: "POST",
                    cache: false,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        response = response.trim();

                        if (response === "success") {
                            Swal.fire({
                                title: 'Save Successfully',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "manage_user.php";
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "ERROR",
                                text: response,
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "ERROR",
                            text: "Something went wrong",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                        console.error("AJAX Error:", status, error);
                    },

                    success: function(response) {
                        // ... existing code ...

                        if (response === "success") {
                            logActivity('User created successfully', 'success');

                            Swal.fire({
                                title: 'Save Successfully',
                                icon: 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "manage_user.php";
                                }
                            });
                        } else {
                            logActivity(`Error: ${response}`, 'danger');

                            Swal.fire({
                                title: "ERROR",
                                text: response,
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        logActivity(`AJAX Error: ${status} - ${error}`, 'danger');

                        Swal.fire({
                            title: "ERROR",
                            text: "Something went wrong",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                        console.error("AJAX Error:", status, error);
                    },

                });
            });
        });

        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to logout!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "function/logout.php";
                }
            });
        }
    </script>


    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>