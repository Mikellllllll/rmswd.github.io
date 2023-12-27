<?php

include "../../include/dbcon.php";

$seed = $_POST['seed'];
$from = $_POST['from'];
$to = $_POST['to'];

$organic = 0;
$conventional = 0;

// Create a prepared statement to get Organic sacks
$query = "SELECT SUM(sacks) AS total_sacks FROM yields WHERE seed = ? AND date >= ? AND date <= ? AND type = 'Organic'";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $seed, $from, $to);
$stmt->execute();
$stmt->bind_result($organic);
$stmt->fetch();
$stmt->close();

// Create a prepared statement to get Conventional sacks
$query = "SELECT SUM(sacks) AS total_sacks FROM yields WHERE seed = ? AND date >= ? AND date <= ? AND type = 'Conventional'";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $seed, $from, $to);
$stmt->execute();
$stmt->bind_result($conventional);
$stmt->fetch();
$stmt->close();

echo $organic . "," . $conventional.",".$seed ;

// Close the database connection when done
$conn->close();
?>
