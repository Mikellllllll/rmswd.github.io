<?php
include '../include/conn.php';

session_start();
$id = $_SESSION['user'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from the form
    $name = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $new = $_POST["new"];
    $dateofbirth = $_POST["birthdate"];
    $gender = $_POST["gender"];

    $id = $_SESSION['user'];
    $passwordCheck = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM users WHERE id = '$id'"))['password'];

    if ($passwordCheck ==  $password) {
        Check();
    } else {
        echo "Incorrect Password!";
    }
}

function Check()
{
    global $conn, $username, $id;

    // Prepare the SQL statement to check if the username is in use in either table
    $sql = "SELECT username FROM users WHERE username = ? AND id <> ?";

    $stmt = $conn->prepare($sql);

    // Bind the username and id parameters and execute the statement
    $stmt->bind_param("si", $username, $id);

    $stmt->execute();

    // Bind the result to a variable
    $stmt->bind_result($existingUsername);

    // Fetch the result
    $stmt->fetch();

    if ($existingUsername) {
        echo "Username is already in use.";
    } else {
        SaveData();
    }
}

function SaveData()
{
    global $name, $email, $dateofbirth, $gender, $id, $new, $username, $conn;

    $updateSql = "UPDATE users SET name = ?, email = ?, dateofbirth = ?, gender = ?, username = ?";

    $bindTypes = "sssss";
    $bindParams = array($name, $email, $dateofbirth, $gender, $username);

    // Check if $new is not blank (assuming $new contains the new password)
    if (!empty($new)) {
        $updateSql .= ", password = ?";
        $bindTypes .= "s";
        $bindParams[] = $new; // Add the new password to the parameters
    }

    $updateSql .= " WHERE id = ?";
    $bindTypes .= "i";
    $bindParams[] = $id; // Add the id to the parameters

    $stmt = $conn->prepare($updateSql);

    // Bind parameters and execute the statement
    $stmt->bind_param($bindTypes, ...$bindParams);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
