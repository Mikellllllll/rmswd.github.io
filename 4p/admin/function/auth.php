<?php
// Include the database connection file
include '../include/conn.php';
// Start the session
session_start();


$username = $_POST['username'];
$password = $_POST['password'];

// Create a prepared statement
$stmt = mysqli_prepare($conn, "SELECT id FROM admins WHERE username = ? AND password = ?");

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, "ss", $username, $password);

// Execute the statement
mysqli_stmt_execute($stmt);

// Bind the result to variables
mysqli_stmt_bind_result($stmt, $adminId);

if (mysqli_stmt_fetch($stmt)) {
    // User found, login successful

    // Store the user ID in the session
    $_SESSION['admin'] = $adminId;

    echo "success";
} else {
    // No matching user found
    echo "Invalid username or password.";
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);
?>
