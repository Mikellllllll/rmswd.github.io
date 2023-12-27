<?php
include "function/out.php";
include "include/conn.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="include/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            /* Use a light background color */

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

            .form-container {
                width: 100%;
                margin: 10px;
            }
        }

        .custom-button {
            background-color: #3498db;
            color: gold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .custom-button:hover {
            background-color: #2980b9;
        }

        /* Styles for the icon inside the button */
        .custom-button i {
            margin-right: 8px;
        }

        .swal2-popup:not(.swal2-toast) {
            max-width: 500px;
            border-radius: 10px;
        }

        .swal2-title {
            color: #e74c3c;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .swal2-content {
            color: #555;
            font-size: 16px;
        }

        /* Custom styles for the 'All Members are Qualified' alert */
        .swal2-title.question {
            color: #27ae60;
        }

        .swal2-title.question::before {
            content: '\f058';
            /* Font Awesome checkmark icon */
            font-family: 'Font Awesome 6 Free';
            margin-right: 8px;
            font-size: 24px;
        }

        /* General styles */
        .swal2-icon {
            color: #3498db;
        }

        .swal2-actions {
            text-align: center;
        }

        .swal2-confirm {
            color: #fff;
            background-color: #3498db;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .swal2-confirm:hover {
            background-color: #2980b9;
        }

        .swal2-close {
            color: #e74c3c;
            font-size: 24px;
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
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="visualization.php">
                            <i class="fas fa-chart-bar"></i> Graph
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="report.php">
                            <i class="fas fa-chart-pie"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="member.php">
                            <i class="fas fa-list"></i> List of Beneficiary
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="add.php">
                            <i class="fas fa-plus"></i> Add
                        </a>
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

    <div class="form-container">
        <h2>Beneficiaries</h2>

        <form id="filter" method="post">
            <div class="table-search">
                <select id="searchInput" class="form-control">
                    <option value="">All Barangay</option>
                    <option value="Banquero">Banquero</option>
                    <option value="Binarsang">Binarsang</option>
                    <option value="Cutog Grande">Cutog Grande</option>
                    <option value="Cutog Pequeno">Cutog Pequeno</option>
                    <option value="Dangan">Dangan</option>
                    <option value="District 01">District 01</option>
                    <option value="District 02">District 02</option>
                    <option value="Labinab Grande">Labinab Grande</option>
                    <option value="Labinab Pequeno">Labinab Pequeno</option>
                    <option value="Mallalatang Grande">Mallalatang Grande</option>
                    <option value="Mallalatang Tungui">Mallalatang Tungui</option>
                    <option value="Napaccu Grande">Napaccu Grande</option>
                    <option value="Napaccu Pequeno">Napaccu Pequeno</option>
                    <option value="Salucong">Salucong</option>
                    <option value="Santor">Santor</option>
                    <option value="Sinippil">Sinippil</option>
                    <option value="Tallungan">Tallungan</option>
                    <option value="Turod">Turod</option>
                    <option value="Villador">Villador</option>
                    <option value="Santiago">Santiago</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Household ID Number</th>
                        <th>Barangay</th>
                        <th>Income</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody id="reloadTable">


                </tbody>
            </table>
        </div>
    </div>
    </div>

    <button type="button" class="custom-button" onclick="income()">
        <i class="fas fa-list"></i> List of Nearly Unqualified
    </button>

    <script>
        function income() {
            $.ajax({
                type: 'POST',
                url: 'function/table_income.php',
                data: {},
                success: function(response) {
                    // response = response.replace(/<br>/g, '\n');

                    if (response != "") {

                        Swal.fire({
                            title: 'Not Qualified',
                            html: response.replace(/<br>/g, '<br/>').replace(/\n/g, '<br/>'), // Replace <br> and \n
                            icon: 'question'
                        });
                    } else {
                        Swal.fire({
                            title: 'All Members are Qualified',
                            icon: 'question'
                        });

                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'An error occurred while processing your request.',
                        'error'
                    );
                }
            });
        }




        // Function to toggle the sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // $("#searchInput").on("input", function() {
        //     // Get the input value
        //     if ($("#searchInput").val().trim() === '') {
        //         //loadContent();
        //     }
        // });

        // const searchForm = document.querySelector("#filter");
        // searchForm.addEventListener("submit", function(event) {
        //     event.preventDefault();
        //     loadContent();
        // });

        $(document).ready(function() {
            $("#searchInput").on("change", function() {
                // Your code to handle the change event goes here

                loadContent();
            });
        });


        function loadContent() {

            var searchInput = document.getElementById("searchInput").value;



            // Send an AJAX request to load content
            $(document).ready(function() {
                $("#reloadTable").load("function/table_barangay.php", {
                    search: searchInput
                });
            });
        }

        loadContent();

        function edit(id) {
            window.location.href = "edit.php?id=" + id;
        }

        function mark(id, nav) {
            if (nav == "Add Marker") {
                window.location.href = "add_map.php?id=" + id;
            } else {
                window.location.href = "update_map.php?id=" + id;
            }

        }

        function updateBeneficiaryCounts() {
    $("#searchInput option").each(function() {
        var barangay = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'function/get_count.php',
            data: {
                barangay: barangay
            },
            success: function(response) {
                $("#count_" + barangay).text(response);
            },
            error: function() {
                console.log('Error fetching count for ' + barangay);
            }
        });
    });
}


        function logout() {
            Swal.fire({
                title: 'Confirm Logout',
                text: 'Are you sure you want to log out?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007BFF',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'swal2-confirm'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "function/logout.php";
                }
            });
        }
    </script>

    <!-- Bootstrap JS and jQuery (required for the navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script sr="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"></script>
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datepicker JavaScript (Assuming you have a date picker library) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Client-side JavaScript -->
</body>

</html>