<?php
include '../include/conn.php';

$sql = "SELECT * FROM household_data";

$result = $conn->query($sql);
$full_name="";


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Combine first name, middle name, and last name
        if($row["income"] >= 30000){
        $full_name = $full_name." ".$row["last_name"] . " " . $row["first_name"] . " " . $row["middle_name"].'<br>';
        }
    }
}

echo $full_name;