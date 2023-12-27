<?php
include '../include/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the ID from POST
    $id = $_POST["id"];

    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $extension_name = $_POST["extension_name"];
    $sexM = $_POST["sexM"];
    $household_id_number = $_POST["household_id_number"];
    $barangay = $_POST["barangay"];
    $city_municipality = $_POST["city_municipality"];
    $province = $_POST["province"];
    $region = $_POST["region"];
    $income = $_POST["income"];


    // Data Change/Correction/Updating
    $child_name = $_POST["child_name"];
    $child_dob = $_POST["child_dob"];
    $attending_school = $_POST["attending_school"];
    $reason_for_not_attending = $_POST["reason_for_not_attending"];
    $school_name = $_POST["school_name"];
    $sexC = $_POST["sexC"];

    // Child Data
    $childData = [
        [
            $_POST["child1_name"],
            $_POST["child1_address"],
            $_POST["child1_school_name"],
            $_POST["child1_school_address"],
            $_POST["child1_grade_level"]
        ],
        [
            $_POST["child2_name"],
            $_POST["child2_address"],
            $_POST["child2_school_name"],
            $_POST["child2_school_address"],
            $_POST["child2_grade_level"]
        ],
        [
            $_POST["child3_name"],
            $_POST["child3_address"],
            $_POST["child3_school_name"],
            $_POST["child3_school_address"],
            $_POST["child3_grade_level"]
        ]
    ];


    // Create a prepared statement for updating based on the ID
    $stmt = $conn->prepare("UPDATE household_data SET 
        last_name = ?,
        first_name = ?,
        middle_name = ?,
        extension_name = ?,
        sexM = ?,
        household_id_number = ?,
        barangay = ?,
        city_municipality = ?,
        province = ?,
        region = ?,
        income = ?,
        child_name = ?,
        child_dob = ?,
        attending_school = ?,
        reason_for_not_attending = ?,
        school_name = ?,
        sexC = ?,
        child1_name = ?,
        child1_address = ?,
        child1_school_name = ?,
        child1_school_address = ?,
        child1_grade_level = ?,
        child2_name = ?,
        child2_address = ?,
        child2_school_name = ?,
        child2_school_address = ?,
        child2_grade_level = ?,
        child3_name = ?,
        child3_address = ?,
        child3_school_name = ?,
        child3_school_address = ?,
        child3_grade_level = ?
        WHERE id = ?");

    // Bind parameters to the statement
    $stmt->bind_param("sssssssssssssssssssssssssssssssss",
        $last_name, $first_name, $middle_name, $extension_name, $sexM, $household_id_number,
        $barangay, $city_municipality, $province, $region, $income,  $child_name, $child_dob, $attending_school, $reason_for_not_attending,
        $school_name, $sexC,
        $childData[0][0], $childData[0][1], $childData[0][2], $childData[0][3], $childData[0][4],
        $childData[1][0], $childData[1][1], $childData[1][2], $childData[1][3], $childData[1][4],
        $childData[2][0], $childData[2][1], $childData[2][2], $childData[2][3], $childData[2][4],
        $id // The ID to use in the WHERE clause
    );

    // Execute the prepared statement
    $result = $stmt->execute();

    // Check if the query was successful
    if ($result) {
        echo "success";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $conn->close();
}
?>
