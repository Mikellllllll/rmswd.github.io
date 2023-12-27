<?php
include 'include/conn.php';

$colorArray = array();

colorretrieve();

function colorretrieve(){
    global $conn, $colorArray;

// Fetch data from the database
$sql = "SELECT barangay, color FROM barangay";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $color = $row['color'];

        // Store color data in an array
        $colorArray[] = $color;
    }
}

}

// Retrieve all data from the household_data table
$sql = "SELECT * FROM household_data";
$result = $conn->query($sql);

// Create an array to hold all the marker data
$markerData = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lat = floatval($row['lat']);
        $long = floatval($row['lon']);
        $lastName = $row['last_name'];
        $firstName = $row['first_name'];
        $middleName = $row['middle_name'];
        $extensionName = $row['extension_name'];
        $sex = $row['sexM'];
        $householdIdNumber = $row['household_id_number'];

        // Add the marker data to the array
        $markerData[] = [
            "lat" => $lat,
            "long" => $long,
            "lastName" => $lastName,
            "firstName" => $firstName,
            "middleName" => $middleName,
            "extensionName" => $extensionName,
            "sex" => $sex,
            "householdIdNumber" => $householdIdNumber
        ];
    }
}


// Encode the $markerData array as JSON
$markerDataJSON = json_encode($markerData);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>
    
    <script src="include/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Datepicker CSS (Assuming you have a date picker library) -->
    <link rel="stylesheet" href="path-to-datepicker.css">
    <style>
        body {
            background-color: gray;
            margin: 0;
            padding: 0;
            font-family: "Arial", sans-serif;
        }

        .dashboard {
    background: lightgray;
    color: #333;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-family: Arial, sans-serif;
}

        .dashboard h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #3498db;
        }

        .dashboard p {
            font-size: 18px;
            /* Comfortable font size for paragraphs */
            margin-bottom: 10px;
        }

        .dashboard-content {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .nav-link {
            cursor: pointer;
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #ffce54;
            /* Yellow text color on hover for links */
        }

        #sidebar {
            height: 97%;
            width: 240px;
            position: fixed;
            top: 0;
            background-color: darkblue;
            color: #fff;
            padding-top: 80px;
            transition: width 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
            font-family: "Arial", sans-serif;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            margin: 20px;

        }

        #sidebar .brand {
            position: relative;
            text-align: center;
        }

        #sidebar .brand img {
            max-width: 200px;
            display: center;

        }

        #sidebar .brand::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 50%;
            top: 50%;
            left: 0;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.5));
            transform: translateY(-50%);
            z-index: -1;
            border-radius: 100%;
            margin-top: 26px;
        }




        #sidebar .nav-item {
            padding: 30px 0;
            text-align: center;
            transition: transform 0.3s ease, padding 0.3s ease;
        }

        #sidebar .nav-item a {
            color: gold;
            text-decoration: none;
            display: block;
            padding: 5px 10px;
            font-family: "Arial", sans-serif;
            border-radius: 10px;
            transition: background-color 0.3s, border-left 0.3s, padding 0.3s;
        }

        #sidebar .nav-item a:hover {
            background-color: white;
            border-left: 5px solid #fff;
            transform: translateX(5px);
            transition: transform 0.3s ease, background-color 0.3s ease, border-left 0.3s ease;
        }

        #hamburger {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 2;
            background: gold;
            /* iOS Blue background */
            color: gold;
            /* White icon color for contrast */
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 100%;
            /* Circular shape */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
            font-family: "Arial", sans-serif;
            /* Modern font family */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Smooth color transition */
        }

        #hamburger:hover {
            background: silver;
            /* Darker blue on hover */
            color: gold;
            
        }

        #content {
            padding: 20px;
            margin-left: 250px;
            font-family: "Arial", sans-serif;
        }

        .map-container {
            background-color: darkblue;
            color: gold;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }

        .form-container {
            flex: 1;
            background-color: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 30px;
            font-family: "Arial", sans-serif;
            max-height: 550px;
            overflow: auto;
        }

        .form-container label {
            font-weight: bold;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
        }

        .legend {
            position: fixed;
            bottom: 10px;
            right: 10px;
            padding: 10px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            z-index: 1000;
            margin-bottom: 44px;
            margin-right: 39px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            border-radius: 50%;
        }

        .form-container button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-family: "Arial", sans-serif;
            border-radius: 5px;
        }

        .form-container button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Custom hover effect for the logout button */
        .swal2-confirm:hover {
            background-color: #0056b3;
            /* Change the background color on hover */
            color: #fff;
            /* Change the text color on hover */
            transition: background-color 0.3s, color 0.3s;
            /* Add a smooth transition */
        }


        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(0);
            }

            #sidebar.active {
                transform: translateX(-250px);
            }

            #hamburger {
                display: block;
                background-color: gold;
                background-color: transparent;
                margin-top: 15px;
                margin-right: 25px;
            }

            #content {
                margin-left: 0;
                padding-left: 20px;
                padding-right: 20px;
            }

            .form-container {
                margin-top: 10px;
                margin-left: 0;
                width: 100%;
            }

        }
    </style>
</head>

<body>
    <div id="hamburger" onclick="toggleSidebar()">☰</div>
    <div id="sidebar" class="active">
        <div class="brand">
            <img src="image/dswdmswd.png" alt="Logo">
            </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="member.php">
                <i class="fas fa-home"></i> Home
        </a>
            </li>
            <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="map.php">
                <i class="fas fa-map-marker-alt"></i> Map
            </a>
        </li>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="add.php">
                <i class="fas fa-plus-circle"></i> Add
            </a>
        </li>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="settings.php">
                <i class="fas fa-cogs"></i> Settings
            </a>
        </li>
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
        </ul>
    </div>
    <div id="content">
        <div class="dashboard">
            <div class="map-container">
                <h2>Bayan ng Reina Mercedes</h2>
                <p>Municipal Social Welfare Development</p>
            </div>

            <div class="form-container">
                <!-- Add the map container here -->
                <div id="map" style="height: 500px;"></div>
            </div>
        </div>
        <div class="legend">
        <div class="legend-item">
            <div class="legend-color" style="background-color: green;"></div>
            <div>Low Number of Beneficiary</div>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background-color: yellow;"></div>
            <div>Medium Number of Beneficiary</div>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background-color: red;"></div>
            <div>High Number of Benneficiary</div>
        </div>
        <script>
            // Function to toggle the sidebar
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');

                sidebar.style.zIndex = '9999';


                sidebar.classList.toggle('active');
            }

            // Initialize the map
            function initializeMap() {
                // Create the map
                var map = L.map('map').setView([16.9961, 121.818], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19
                }).addTo(map);

                // Parse the JSON data
                var markerData = <?php echo $markerDataJSON; ?>;

                // Loop through the markerData array and create markers with pop-ups
                markerData.forEach(function(markerInfo) {
                    var marker = L.marker([markerInfo.lat, markerInfo.long]).addTo(map);

                    // Create a pop-up with the information
                    var popupContent = `
            <b>Last Name:</b> ${markerInfo.lastName}<br>
            <b>First Name:</b> ${markerInfo.firstName}<br>
            <b>Middle Name:</b> ${markerInfo.middleName}<br>
            <b>Extension Name:</b> ${markerInfo.extensionName}<br>
            <b>Sex:</b> ${markerInfo.sex}<br>
            <b>Household ID Number:</b> ${markerInfo.householdIdNumber}
        `;

                    marker.bindPopup(popupContent);
                });
                var polygonCoordinates0 = [
                    [16.97078, 121.82990],
                    [16.97625, 121.83357],
                    [16.99098, 121.83218],

                    [16.99178, 121.82740],
                    [16.98783, 121.82761],
                    [16.98723, 121.82752],
                    [16.98615, 121.82747],
                    [16.9847, 121.8276],
                    [16.9837, 121.8275],
                    [16.9800, 121.8252],
                    [16.97413, 121.82281],
                ];

                var polygonCoordinates1 = [
                    [16.9807, 121.8196],
                    [16.9843, 121.8199],
                    [16.98668, 121.82093],
                    [16.98744, 121.82097],
                    [16.98929, 121.82265],

                    [16.99222, 121.82469],
                    [16.99178, 121.82740],
                    [16.98783, 121.82761],
                    [16.98723, 121.82752],
                    [16.98615, 121.82747],
                    [16.9847, 121.8276],
                    [16.9837, 121.8275],
                    [16.9800, 121.8252],
                    [16.97413, 121.82281],
                    [16.97628, 121.81817],

                ];
                var polygonCoordinates2 = [
                    [16.9802, 121.8131],
                    [16.9843, 121.8141],
                    [16.9888, 121.8148],
                    [16.9909, 121.8162],
                    [16.9903, 121.8175],
                    [16.9908, 121.8193],
                    [16.9917, 121.8201],
                    [16.9922, 121.8225],
                    [16.99247, 121.82316],

                    [16.99222, 121.82469],
                    [16.98929, 121.82265],
                    [16.98744, 121.82097],
                    [16.98668, 121.82093],
                    [16.9843, 121.8199],
                    [16.9807, 121.8196],

                    [16.97628, 121.81817],
                    [16.97743, 121.81578],

                    [16.97828, 121.81173],

                ];
                var polygonCoordinates3 = [
                    [16.9822, 121.8078],
                    [16.9868, 121.8092],
                    [16.9899, 121.8111],
                    [16.9914, 121.8121],
                    [16.99197, 121.81320],
                    [16.99327, 121.81419],
                    [16.99504, 121.81522],
                    [16.99607, 121.81647],
                    [16.99654, 121.81824],
                    [16.99735, 121.81871],
                    [16.99800, 121.82038],
                    [16.9982, 121.8215],

                    [16.99247, 121.82316],
                    [16.9922, 121.8225],
                    [16.9917, 121.8201],
                    [16.9908, 121.8193],
                    [16.9903, 121.8175],
                    [16.9909, 121.8162],
                    [16.9888, 121.8148],
                    [16.9843, 121.8141],
                    [16.9802, 121.8131],

                    [16.97828, 121.81173],

                    [16.97930, 121.80668],

                ];
                var polygonCoordinates4 = [

                    [17.00539, 121.81792],

                    [17.00027, 121.82090],

                    [16.9982, 121.8215],
                    [16.99800, 121.82038],
                    [16.99735, 121.81871],
                    [16.99654, 121.81824],
                    [16.99607, 121.81647],
                    [16.99504, 121.81522],
                    [16.99327, 121.81419],
                    [16.99197, 121.81320],
                    [16.9914, 121.8121],

                    [16.98989, 121.81110],

                    [16.9963, 121.8046],

                    [16.99884, 121.80876],

                ];
                var polygonCoordinates5 = [




                    [16.9936, 121.8033],

                    [16.9953, 121.7979],

                    [16.97802, 121.80217],

                    [16.97929, 121.80667],


                    [16.98989, 121.81110],

                    [16.9963, 121.8046],


                ];
                var polygonCoordinates6 = [

                    [16.97802, 121.80217],

                    [16.9953, 121.7979],

                    [16.9942, 121.7875],

                    [16.9937, 121.7888],
                    [16.9927, 121.7888],
                    [16.9927, 121.7888],
                    [16.9927, 121.7888],
                    [16.9860, 121.7924],
                    [16.9860, 121.7924],
                    [16.9860, 121.7924],
                    [16.9806, 121.7939],
                    [16.9806, 121.7939],
                    [16.9791, 121.7952],

                    [16.97632, 121.79610],

                ];
                var polygonCoordinates7 = [

                    [16.9937, 121.7888],
                    [16.9927, 121.7888],
                    [16.9927, 121.7888],
                    [16.9927, 121.7888],
                    [16.9860, 121.7924],
                    [16.9860, 121.7924],
                    [16.9860, 121.7924],
                    [16.9806, 121.7939],
                    [16.9806, 121.7939],
                    [16.9791, 121.7952],

                    [16.97632, 121.79612],
                    [16.97931, 121.79087],

                    [16.9821, 121.7632],

                    [16.9851, 121.7623],


                    [16.98966, 121.76277],
                    [16.99171, 121.76193],
                    [16.9960, 121.7676],

                    [16.9942, 121.7875],



                ];
                var polygonCoordinates8 = [
                    [16.97078, 121.82990],
                    [16.97625, 121.83357],
                    [16.99098, 121.83218],
                    [16.99247, 121.82315],
                    [17.00030, 121.82089],
                    [17.00061, 121.82070],
                    [17.00185, 121.81998],
                    [17.00731, 121.81678],
                    [17.02214, 121.81137],
                    [17.02604, 121.80910],
                    [17.03089, 121.80171],
                    [17.02947, 121.79870],
                    [17.03074, 121.78883],
                    [17.02094, 121.76423],
                    [17.02211, 121.76153],
                    [17.01928, 121.76461],
                    [16.99143, 121.73787],
                    [16.98366, 121.74777],
                    [16.98211, 121.76316],
                    [16.97931, 121.79086],
                    [16.97630, 121.79612],
                    [16.97929, 121.80669],
                    [16.97743, 121.81577],


                ];
                var polygonCoordinates9 = [

                    [16.9821, 121.7632],

                    [16.9830, 121.7541],
                    [16.98537, 121.75336],
                    [16.98718, 121.75224],
                    [16.98891, 121.75229],
                    [16.98908, 121.75358],
                    [16.98771, 121.75910],
                    [16.9851, 121.7623],

                ];
                var polygonCoordinates10 = [

                    [16.98718, 121.75224],
                    [16.98537, 121.75336],
                    [16.9830, 121.7541],

                    [16.98366, 121.74776],
                    [16.9883, 121.7419],
                    [16.9906, 121.7452],
                    [16.9938, 121.7449],
                    [16.99295, 121.75214],


                    [16.98891, 121.75229],

                ];
                var polygonCoordinates11 = [

                    [16.9906, 121.7452],
                    [16.9883, 121.7419],
                    [16.99143, 121.73788],

                    [16.9950, 121.7413],


                    [16.9938, 121.7449],

                ];
                var polygonCoordinates12 = [

                    [16.98891, 121.75229],

                    [16.98908, 121.75358],
                    [16.98771, 121.75910],
                    [16.98978, 121.76117],
                    [16.98966, 121.76277],
                    [16.99171, 121.76193],

                    [16.9960, 121.7676],

                    [17.0001, 121.7593],

                    [16.99616, 121.75525],

                    [16.99295, 121.75214],

                ];
                var polygonCoordinates13 = [

                    [16.9942, 121.7875],
                    [16.99559, 121.77209],
                    [17.0101, 121.7656],
                    [17.0163, 121.7912],

                    [16.9953, 121.7979],

                ];
                var polygonCoordinates14 = [

                    [17.01234,121.77487],
                    [17.01598,121.78974],
                    [17.0192,121.7894],
                    [17.0218,121.7859],
                    [17.0265,121.7869],
                    [17.02918,121.78900],
                    [17.0307,121.7888],
                    [17.0232,121.7699],
                    [17.0218,121.7716],
                    [17.0216,121.7725],

                ];
                var polygonCoordinates15 = [

                    [17.01234,121.77487],
                    [17.0216,121.7725],
                    [17.0218,121.7716],
                    [17.0232,121.7699],
                    [17.02095,121.76426],
                    [17.02211,121.76153],
                    [17.01927,121.76460],
                    [17.0133,121.7589],
                    [17.0108,121.7593],
                    [17.0088,121.7596],
                    [17.0101, 121.7656],

                ];
                var polygonCoordinates16 = [

                    [17.0280,121.8060],
                    [17.0238,121.8034],
                    [17.0194,121.7977],
                    [17.0163, 121.7912],
                    [17.01598,121.78974],
                    [17.0192,121.7894],
                    [17.0218,121.7859],
                    [17.0265,121.7869],
                    [17.02918,121.78900],
                    [17.0307,121.7888],
                    [17.02947,121.79871],
                    [17.03089,121.80171],
                    
                ];
                var polygonCoordinates17 = [
        
                    [17.02229,121.81127],
                    [17.0162,121.8070],
                    [17.0101,121.8069],
                    [17.0113,121.8012],
                    [17.0131,121.7970],
                    [17.01855,121.79581],
                    [17.0194,121.7977],
                    [17.0238,121.8034],
                    [17.0280,121.8060],
                    [17.02604,121.80909],

                ];
                var polygonCoordinates18 = [

                    [17.0101,121.8069],
                    [17.0081,121.8080],
                    [17.00813,121.79903],
                    
                    [17.00555,121.79449],
                    [17.0163, 121.7912],
                    [17.01855,121.79581],
                    [17.0131,121.7970],
                    [17.0113,121.8012],

                ];
                var polygonCoordinates19 = [

                    [17.02229,121.81127],
                    [17.0162,121.8070],
                    [17.0101,121.8069],
                    
                ];
                var district1Polygon = L.polygon(polygonCoordinates0, {
                    color: 'red', // Border color
                    fillColor: '<?=$colorArray[0]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var district2Polygon = L.polygon(polygonCoordinates1, {
                    color: 'red', // Border color
                    fillColor: '<?=$colorArray[1]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var labpeqPolygon = L.polygon(polygonCoordinates2, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[2]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var LGPolygon = L.polygon(polygonCoordinates3, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[3]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var TallunganPolygon = L.polygon(polygonCoordinates4, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[4]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var SinippilPolygon = L.polygon(polygonCoordinates5, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[5]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var NapGPolygon = L.polygon(polygonCoordinates6, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[6]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var NapPPolygon = L.polygon(polygonCoordinates7, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[7]?>', // Fill color
                    fillOpacity: 0.5, // Opacity of the fill
                }).addTo(map);

                var ReinaMercedesPolygon = L.polygon(polygonCoordinates8, {
                    color: 'red', // Border color
                    fillColor:  'transparent', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var CutogGPolygon = L.polygon(polygonCoordinates9, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[8]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var CutogPPolygon = L.polygon(polygonCoordinates10, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[9]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var SantorPolygon = L.polygon(polygonCoordinates11, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[10]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var DanganPolygon = L.polygon(polygonCoordinates12, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[11]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var TurodPolygon = L.polygon(polygonCoordinates13, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[12]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var BanqueroPolygon = L.polygon(polygonCoordinates14, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[13]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var SallucongPolygon = L.polygon(polygonCoordinates15, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[14]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var BarSanPolygon = L.polygon(polygonCoordinates16, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[15]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var MTPolygon = L.polygon(polygonCoordinates17, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[16]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

                var MGPolygon = L.polygon(polygonCoordinates18, {
                    color: 'red', // Border color
                    fillColor:  '<?=$colorArray[17]?>', // Fill color
                    fillOpacity: 0.3, // Opacity of the fill
                }).addTo(map);

              


            }

            // Call the initializeMap function after the page has loaded
            window.addEventListener('load', initializeMap);

            function logout() {
                Swal.fire({
                    title: 'Confirm Logout',
                    text: 'Are you sure you want to log out?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Logout',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        confirmButton: 'swal2-confirm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "function/logout.php";
                    }

                });
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Include additional libraries and scripts here -->
        <!-- Leaflet JavaScript -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Datepicker JavaScript (Assuming you have a date picker library) -->
        <script src="path-to-datepicker.js"></script>
        <!-- Include your other scripts and libraries below -->
        <!-- For example, add Bootstrap or any other needed libraries here -->
</body>

</html>