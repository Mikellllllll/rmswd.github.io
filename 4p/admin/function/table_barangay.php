<?php
include '../include/conn.php';

// Get the search input
$search = isset($_POST['search']) ? $_POST['search'] : '';



$sql = "SELECT * FROM household_data";

if ($search != "") {
    $sql = $sql . " where barangay = '$search' ";
}

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Combine first name, middle name, and last name
        $full_name = $row["last_name"] . " " . $row["first_name"] . " " . $row["middle_name"];
?>
        <tr>
            <td><?= $full_name ?></td>
            <td><?= $row['household_id_number'] ?></td>
            <td><?= $row['barangay'] ?></td>
            <td><?= $row['income'] ?></td>
            <td><?= $row['city_municipality'] ?></td>
            <td id="count_<?= $row['barangay'] ?>"></td><!-- Count placeholder for the barangay -->
        </tr>
<?php
    }
}
