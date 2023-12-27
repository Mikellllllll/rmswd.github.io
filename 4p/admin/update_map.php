<?php
include 'function/out.php';
$id = $_GET['id'];

include 'include/conn.php';

// Retrieve a single row based on the ID
$sql = "SELECT * FROM household_data WHERE id = $id";
$result = $conn->query($sql);


if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $lon = $row['lon'];
    $lat = $row['lat'];
}

global $lon, $lat;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Location</title>
    <script src="include/jquery.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Style the map container */
        #map {
            height: 400px;
            width: 100%;
        }

        .futuristic-header {
            background: #007BFF;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <header class="futuristic-header">
        <h1>Mark Location</h1>
    </header>

    <div class="container">
        <div id="map"></div>
    </div>

    <div class="container button-container">
        <button onclick="saveLocationToServer()" id="confirmLocation" class="btn btn-primary">Confirm Location</button>
        <button onclick="Exit()" id="cancelLocation" class="btn btn-danger">Cancel</button>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var marker; // Declare the marker variable outside of functions

        // Initialize the map
        var map = L.map('map');

        // Add a tile layer (e.g., OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        // Use the geolocation API to get the user's current position
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var initialLocation = [<?php echo $lat; ?>, <?php echo $lon; ?>];
                map.setView(initialLocation, 15); // You can adjust the zoom level

                // Create a marker for the initial location and add it to the map
                marker = L.marker(initialLocation, {
                    draggable: true
                }).addTo(map);

                // Add an event listener to update the marker's position when it's dragged
                marker.on('dragend', function(event) {
                    var newPosition = marker.getLatLng();
                    console.log('New Latitude: ' + newPosition.lat);
                    console.log('New Longitude: ' + newPosition.lng);
                });
            });
        } else {
            // Handle the case where geolocation is not available in the browser
            console.log("Geolocation is not available in this browser.");
        }

        // Check if there are existing lon and lat values
        if (<?php echo json_encode($lon) ?> !== null && <?php echo json_encode($lat) ?> !== null) {
            var savedLocation = [<?php echo $lat ?>, <?php echo $lon ?>];
            marker.setLatLng(savedLocation); // Set the marker's position
            map.setView(savedLocation, 15); // Set the map's view to the saved location
        }

        // Add an event listener to the confirm button
        document.getElementById('confirmLocation').addEventListener('click', function() {
            // Get the latitude and longitude from the marker
           
            // Send the latitude and longitude to the server using an AJAX request
            saveLocationToServer(confirmedLat, confirmedLng);
        });

        // Add an event listener to the cancel button
        function Exit() {
            // You can perform an action here when the location is canceled
            window.location.href = "member.php";
        }

        // Function to send the latitude and longitude to the server
        function saveLocationToServer() {
            var confirmedLat = marker.getLatLng().lat;
            var confirmedLng = marker.getLatLng().lng;
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to save marker",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        method: 'POST',
                        url: 'function/update_location.php', // Replace with the server-side script to handle saving
                        data: {
                            id: <?php echo $id ?>,
                            lat: confirmedLat,
                            lng: confirmedLng
                        },
                        success: function(response) {
                            if (response === "success") {
                                Swal.fire({
                                    title: "Marker Saved",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "member.php";
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
                        error: function(error) {
                            Swal.fire({
                                title: "ERROR",
                                text: "Something went wrong",
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                            console.error(error);
                        }
                    });
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>