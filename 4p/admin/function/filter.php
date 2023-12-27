<?php
include '../include/conn.php';

// Get the search input
$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT * FROM household_data";

$result = $conn->query($sql);
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Combine first name, middle name, and last name
        $full_name = $row["last_name"] . " " . $row["first_name"] . " " . $row["middle_name"];

        // Determine the text for the button
        $text = ($row["lon"] == "") ? "Add Marker" : "Edit Marker";

        // Check if the search term is contained in the full name
        if (empty($search) || strpos($full_name, $search) !== false) {
            $data[] = array(
                'full_name' => $full_name,
                'household_id' => $row["household_id_number"],
                'barangay' => $row["barangay"],
                'city_municipality' => $row["city_municipality"],
                'button_text' => $text,
                'id' => $row['id']
            );
        }
    }
}

foreach ($data as $row) {
    ?>
    <tr>
        <td><?= $row['full_name'] ?></td>
        <td><?= $row['household_id'] ?></td>
        <td><?= $row['barangay'] ?></td>
        <td><?= $row['city_municipality'] ?></td>
        <td>
            <button class="btn btn-success" onclick="edit(<?= $row['id'] ?>)">Edit</button>
            <button class="btn btn-primary" onclick="mark(<?= $row['id'] ?>, '<?= $row['button_text'] ?>')"><?= $row['button_text'] ?></button>
        </td>
    </tr>
    <?php
}
?>
