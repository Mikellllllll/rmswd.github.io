<?php
// Set the default time zone to Philippines (Asia/Manila)
date_default_timezone_set('Asia/Manila');

// Include the database connection file
include '../include/conn.php';

// Start the session
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

// Create a prepared statement
$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE username = ? AND password = ?");

// Bind parameters to the statement
mysqli_stmt_bind_param($stmt, "ss", $username, $password);

// Execute the statement
mysqli_stmt_execute($stmt);

// Bind the result to variables
mysqli_stmt_bind_result($stmt, $adminId);

if (mysqli_stmt_fetch($stmt)) {
    // User found, login successful

    // Store the user ID in the session
    $_SESSION['user'] = $adminId;

    // Log the login activity
    logLoginActivity($adminId);

    echo "success";
} else {
    // No matching user found
    echo "Invalid username or password.";
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);

// Function to log login activity
function logLoginActivity($adminId) {
    // Include the database connection file
    include '../include/conn.php';

    // Get the current date and time
    $loginTime = date("Y-m-d h:i A"); // Format with AM/PM

    // Insert the login activity into the log table
    $insertQuery = "INSERT INTO login_log (user_id, login_time) VALUES (?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "ss", $adminId, $loginTime);
    mysqli_stmt_execute($insertStmt);
    mysqli_stmt_close($insertStmt);
    mysqli_close($conn);

    
}
?>
