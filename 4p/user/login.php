<?php
session_start();

error_reporting(0);

if (isset($_SESSION['users'])) {
    header("Location: member.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Accident Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
    <style>
        /* Add CSS for the map container */
        #map {
            height: 500px;
            width: 100%;
        }

        /* Update the header with a futuristic theme */
        .header {
            background: linear-gradient(to bottom, #04045e, #1e88e5);
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .logo {
            max-width: 100px;
        }

        /* Update button style */
        .btn-success {
            background-color: #32cd32;
            color: #fff;
            border: none;
            border-radius: 6rem;
            padding: 1rem 2rem;
        }

        .btn-success:hover {
            background-color: #228b22;
        }
    </style>
</head>
<body>
    <!-- Futuristic Header -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 text-center">
                    <img  src="image/4ps.png" alt="Logo" class="logo mx-auto">
                </div>
                <div class="col-lg-4 text-center">
                    <h1 class="display-4">4P's</h1>
                    <p class="lead"> Pantawid Pamilyang Pilipino Program</p>
                </div>
                
                <div class="col-lg-6 text-center">
               
                <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                </div>
            </div>
        </div>
    </header>


    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Wait for the DOM to load
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize the map
            var map = L.map('map').setView([0, 0], 2);

            // Add a tile layer for the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        });
    </script>

    <!-- Include Bootstrap JS and jQuery (required for some Bootstrap features) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
     <!-- Add Bootstrap JS and jQuery -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Add Bootstrap JS and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <!-- Then include Bootstrap's JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Include additional libraries and scripts here -->
        <!-- Leaflet JavaScript -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Datepicker JavaScript (Assuming you have a date picker library) -->
        <script src="path-to-datepicker.js"></script>
        <!-- Include your other scripts and libraries below -->
        <!-- For example, add Bootstrap or any other needed libraries here -->
</body>
</html>