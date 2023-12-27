<?php
$id = $_POST['id'];
$lon = $_POST['lng'];
$lat = $_POST['lat'];

include '../include/conn.php'; // Include your database connection file

// Update the lon and lat for the specific row based on the ID
$sql = "UPDATE household_data SET lon = '$lon', lat = '$lat' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // The lon and lat were updated successfully
    echo "success";
} else {
    // An error occurred while updating the location
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();

?>
