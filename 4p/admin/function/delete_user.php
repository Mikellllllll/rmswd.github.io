<?php

include '../include/conn.php';

$id = $_POST ['id'];


// Construct the SQL statement for deletion
$sql = "DELETE FROM login_log WHERE log_id = $id";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
