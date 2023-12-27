<?php
include "../include/conn.php";

$id = $_POST['id']; // You need to get the user's ID from the form or elsewhere
$username = $_POST['username'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$password = $_POST['password'];

// Check if the new username already exists and is not the same as the current user's ID
$checkQuery = "SELECT id FROM users WHERE username = ? AND id <> ?";
$checkStmt = mysqli_prepare($conn, $checkQuery);
mysqli_stmt_bind_param($checkStmt, "si", $username, $id);
mysqli_stmt_execute($checkStmt);
mysqli_stmt_store_result($checkStmt);

if (mysqli_stmt_num_rows($checkStmt) > 0) {
    // Username is already in use by another user
    echo "Username is already in use. Please choose a different one.".$id;
} else {
    // The username is not in use by other users, proceed to update the user's data in the database
    $update_query = $conn->prepare("UPDATE users SET username = ?, name = ?, contact = ?, password = ? WHERE id = ?");
    $update_query->bind_param("ssssi", $username, $name, $contact, $password, $id);

    if ($update_query->execute()) {
        echo "success";
    } else {
        echo "Error: " . $update_query->error;
    }

    $update_query->close();
}
