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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Datepicker CSS (Assuming you have a date picker library) -->
    <link rel="stylesheet" href="path-to-datepicker.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f4f4f4;
            margin: 0;
            font-family: 'Helvetica', sans-serif;
        }

        .navbar {
    background-color: #2c3e50; /* Darker background color for a professional look */
    padding: 20px 35px; /* Reduced padding for a sleeker appearance */
    color: #ecf0f1; /* Light text color for better contrast */
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Subtle box shadow for depth */
}

.navbar a {
    color: #ecf0f1; /* Light text color */
    text-decoration: none;
    padding: 10px;
    margin: 0 10px; /* Added spacing between links */
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.navbar a:hover {
    background-color: #3498db; /* A slightly lighter shade than the main color */
    color: #fff; /* White text color on hover */
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
                <input type="text" id="searchInput" placeholder="Search">
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Household ID Number</th>
                        <th>Barangay</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="reloadTable">
                    <?php
                    $sql = "SELECT * FROM household_data";
                    $result = $conn->query($sql);
                   
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $row["last_name"] . " " . $row["first_name"] . " " . $row["middle_name"] ?></td>
                                <td><?= $row["household_id_number"] ?></td>
                                <td><?= $row["barangay"] ?></td>
                                <td><?= $row["city_municipality"] ?></td>
                                
                               
                                <td><button class="btn btn-success" onclick="edit(<?= $row['id'] ?>)">Edit</button> 
                    <?php
                        }
                    } else {
                        echo "<tr> <td> No reports found. </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                             </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <script>
        // Function to toggle the sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        $("#searchInput").on("input", function() {
            // Get the input value
            if ($("#searchInput").val().trim() === '') {
                loadContent();
            }
        });

        const searchForm = document.querySelector("#filter");
        searchForm.addEventListener("submit", function(event) {
            event.preventDefault();
            loadContent();
        });

        function loadContent() {

            var searchInput = document.getElementById("searchInput").value;

            // Send an AJAX request to load content
            $(document).ready(function() {
                $("#reloadTable").load("function/filter.php", {
                    search: searchInput
                });
            });
        }

        function edit(id) {
            window.location.href = "edit.php?id=" + id;
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