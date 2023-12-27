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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <script src="include/jquery.js"></script>
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
            background-color: gray;
            margin: 0;
            padding: 0;
            font-family: "Arial", sans-serif;
        }

        .dashboard {
            background: lightgray;
            color: #333;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-family: Arial, sans-serif;
        }

        .dashboard h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #3498db;
        }

        .dashboard p {
            font-size: 18px;
            /* Comfortable font size for paragraphs */
            margin-bottom: 10px;
        }

        .dashboard-content {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .nav-link {
            cursor: pointer;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #ffce54;
            /* Yellow text color on hover for links */
        }

        #sidebar {
            height: 97%;
            width: 240px;
            position: fixed;
            top: 0;
            background-color: darkblue;
            color: #fff;
            padding-top: 80px;
            transition: width 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
            font-family: "Arial", sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            margin: 20px;

        }

        #sidebar .brand {
            position: relative;
            text-align: center;
        }

        #sidebar .brand img {
            max-width: 200px;
            display: center;
          
        }

        #sidebar .brand::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 50%;
            top: 50%;
            left: 0;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.5));
            transform: translateY(-50%);
            z-index: -1;
            border-radius: 100%;
            margin-top: 26px;
        }




        #sidebar .nav-item {
            padding: 30px 0;
            text-align: center;
            transition: transform 0.3s ease, padding 0.3s ease;
        }

        #sidebar .nav-item a {
            color: gold;
            text-decoration: none;
            display: block;
            padding: 5px 5%px;
            font-family: "Arial", sans-serif;
            border-radius: 10px;
            transition: background-color 0.3s, border-left 0.3s, padding 0.3s;
        }

        #sidebar .nav-item a:hover {
            background-color: white;
            border-left: 5px solid #fff;
            transform: translateX(5px);
            transition: transform 0.3s ease, background-color 0.3s ease, border-left 0.3s ease;
        }

        #hamburger {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2;
            background: gold;
            /* iOS Blue background */
            color: gold;
            /* White icon color for contrast */
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 100%;
            /* Circular shape */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
            font-family: "Arial", sans-serif;
            /* Modern font family */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Smooth color transition */
        }

        #hamburger:hover {
            background: silver;
            /* Darker blue on hover */
            color: gold;

        }

        #content {
            padding: 20px;
            margin-left: 250px;
            font-family: "Arial", sans-serif;
        }

        .map-container {
            background-color: darkblue;
            color: gold;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        .form-container {
            flex: 1;
            background-color: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 30px;
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
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
        }

        .form-container button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-family: "Arial", sans-serif;
            border-radius: 5px;
        }

        .form-container button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Custom hover effect for the logout button */
        .swal2-confirm:hover {
            background-color: #0056b3;
            /* Change the background color on hover */
            color: #fff;
            /* Change the text color on hover */
            transition: background-color 0.3s, color 0.3s;
            /* Add a smooth transition */
        }


        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(0);
            }

            #sidebar.active {
                transform: translateX(-250px);
            }

            #hamburger {
                display: block;
                background-color: gold;
                background-color: transparent;
                margin-top: 15px;
                margin-right: 25px;
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

        }
    </style>
</head>

<body>
    <div id="hamburger" onclick="toggleSidebar()">☰</div>
    <div id="sidebar" class="active">

        <div class="brand">
            <img src="image/dswdmswd.png" alt="Logo">
            </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="member.php">
                <i class="fas fa-home"></i> Home
        </a>
            </li>
            <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="map.php">
                <i class="fas fa-map-marker-alt"></i> Map
            </a>
        </li>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="add.php">
                <i class="fas fa-plus-circle"></i> Add
            </a>
        </li>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-cogs"></i> Settings
            </a>
        </li>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
        </ul>
    </div>
    <div id="content">
        <div class="dashboard">
            <div class="map-container">
                <h2>Municipal Social Welfare Development</h2>
                <p>Bayan ng Reina Mercedes</p>


            </div>

            <div class="form-container">
                <h2>Edit Color Coordinates</h2>

                <form id="filter" method="post">
                    <div class="table-search">
                        <input type="text" id="searchInput" placeholder="Search">
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>

                                <th>Barangay</th>
                                <th>Color Cordinates</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="reloadTable">
                            <?php
                            $sql = "SELECT * FROM barangay";
                            $result = $conn->query($sql);
                            $text = "Add Marker";

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $row["barangay"] ?></td>
                                        <td><?= $row["color"] ?></td>

                                        <td><button class="btn btn-success" onclick="edit(<?= $row['id'] ?>)">Edit</button></td>
                                    </tr>
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

            function mark(id, nav) {
                if (nav == "Add Marker") {
                    window.location.href = "add_map.php?id=" + id;
                } else {
                    window.location.href = "update_map.php?id=" + id;
                }

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