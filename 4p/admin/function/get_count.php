<?php
include '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['barangay'])) {
    $barangay = $_POST['barangay'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM household_data WHERE barangay = ?");
    $stmt->bind_param("s", $barangay);

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    echo $row['total'];
} else {
    echo 'Invalid request';
}
?>
