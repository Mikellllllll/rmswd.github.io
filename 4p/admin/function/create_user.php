<?php
include "../include/conn.php";

$username = $_POST['username'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$password = $_POST['password'];


// Check if the username is already in use
$check_query = $conn->prepare("SELECT username FROM users WHERE username = ?");
$check_query->bind_param("s", $username);
$check_query->execute();
$check_query->store_result();

if ($check_query->num_rows > 0) {
    echo "Username already in use.";
} else {
    // The username is not in use, proceed to insert the data into the database
    $insert_query = $conn->prepare("INSERT INTO users (username, name, contact, password) VALUES (?, ?, ?, ?)");
    $insert_query->bind_param("ssss", $username, $name, $contact, $password);

    if ($insert_query->execute()) {
        echo "success";
    } else {
        echo "Error: " . $insert_query->error;
    }

    $insert_query->close();
}

// Close the check_query and the database connection
$check_query->close();
$conn->close();
?>
