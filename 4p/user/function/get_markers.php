<?php
// Database connection
include ("include/conn.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch marker data (replace with your own query)
$sql = "SELECT lat, lon, mode FROM markers"; // Include the 'mode' field in the query
$result = $conn->query($sql);

$markers = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Convert lat and lon to float values
        $lat = floatval($row['lat']);
        $lon = floatval($row['lon']);

        $markers[] = array(
            'lat' => $lat,
            'lon' => $lon,
            'mode' => $row['mode'] // Include the 'mode' field in the response
        );
    }
}

// Close the database connection
$conn->close();

// Send marker data as JSON response
header('Content-Type: application/json');
echo json_encode($markers);
?>
