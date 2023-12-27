<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "peace";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  // Set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("ERROR: Could not connect. " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- Datepicker CSS (Assuming you have a date picker library) -->
  <link rel="stylesheet" href="path-to-datepicker.css">

  <title>testing</title>

  <style type="text/css">
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      /* Ensure box-sizing consistency */
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f5;
      /* Use a light background color */
    }

    .chartMenu {
      width: 100%;
      height: 60px;
      background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
      /* Adjusted gradient colors */
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      /* Added subtle shadow for elevation */
    }

    .chartMenu p {
      padding: 10px;
      font-size: 24px;
      color: #fff;
      /* Changed text color to white for better visibility */
    }

    .chartCard {
      width: 100%;
      height: calc(85vh);
      background: lightgray;
      /* Adjusted gradient colors */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .chartBox {
      width: 700px;
      padding: 50px;
      border-radius: 20px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      /* Added a bit more shadow for a lifted appearance */
      background: #fff;
      text-align: center;
      
    }

    /* Additional styles for a light look */
    .chartBox h2 {
      color: #4e54c8;
      /* Match the gradient color for header */
      margin-bottom: 15px;
      /* Improved spacing for better readability */
    }

    .chartBox p {
      color: #555;
      /* Adjusted text color for better contrast */
    }

    .chartBox canvas {
      margin-top: 20px;
    }



    .navbar {
      background-color: #2c3e50;
      /* Darker background color for a professional look */
      padding: 20px 35px;
      /* Reduced padding for a sleeker appearance */
      color: #ecf0f1;
      /* Light text color for better contrast */
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      /* Subtle box shadow for depth */
    }

    .navbar a {
      color: #ecf0f1;
      /* Light text color */
      text-decoration: none;
      padding: 10px;
      margin: 0 10px;
      /* Added spacing between links */
      border-radius: 5px;
      transition: background-color 0.3s, color 0.3s;
    }

    .navbar a:hover {
      background-color: #3498db;
      /* A slightly lighter shade than the main color */
      color: #fff;
      /* White text color on hover */
    }

    .sidebar {
      background-color: #2c3e50;
      height: 100vh;
      color: gold;
      padding: 20px;
    }

    .content {
      background-color: #ecf0f1;
      padding: 20px;
    }

    .list-group-item {
      background-color: #3498db;
      color: gold;
      border: none;
    }

    .list-group-item:hover {
      background-color: #2980b9;
    }

    h1 {
      color: gold;
    }

    p {
      color: #555;
    }

    .btn-primary {
      background-color: #e74c3c;
      color: gold;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #c0392b;
    }

    .legend {
      position: fixed;
      bottom: 10px;
      right: 10px;
      padding: 10px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      z-index: 1000;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .legend-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .legend-color {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      margin-right: 10px;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
    }

    .legend-text {
      color: #333;
      font-size: 14px;
    }

    .legend-color-green {
      background-color: #6dbb63;
      /* Green color */
    }

    .legend-color-yellow {
      background-color: #fdd835;
      /* Yellow color */
    }

    .legend-color-red {
      background-color: #e74c3c;
      /* Red color */
    }

    .navbar-toggler {
      padding: .25rem .75rem;
      font-size: 1.25rem;
      line-height: 1;
      background-color: transparent;
      border: 1px solid transparent;
      border-radius: .25rem;

    }

    /* Adjustments for responsive layout */
    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .navbar a {
        margin: 5px 0;
      }

      .chartMenu p {
        font-size: 18px;
      }

      .chartBox {
        padding: 20px;
      }
    }


    #colorLegendBarangay {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 10px;
    }

    .legend-item {
      display: flex;
      align-items: center;
      margin-right: 20px;
    }

    .legend-color {
      width: 20px;
      height: 20px;
      margin-right: 5px;
    }

    .form-container {
   
   background-color: #f5f5f5;
   border-radius: 15px;
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
   padding: 30px;
   margin: 30px 30px 30px auto; /* Adjusted margin for right alignment */
   font-family: "Arial", sans-serif;
   max-height: 700px; /* Adjusted max-height as needed */
   overflow: auto;
   width: 800px; /* Adjusted width as needed */
}

  </style>
</head>


<body>
  <!-- Navigation Bar -->
  
  <nav class="navbar navbar-expand-lg navbar-light">
    <img src="image/mercedes.png" alt="Logo" width="60px">
    <a class="navbar-brand text-white" href="#">Municipal Social Welfare Development</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link text-white" href="dashboard.php">
            <i class="fas fa-home"></i> Home
          </a>
        </li>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link text-white" href="visualization.php">
              <i class="fas fa-chart-bar"></i> Graph
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="report.php">
              <i class="fas fa-chart-pie"></i> Reports
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-white" href="member.php">
              <i class="fas fa-list"></i> List of Beneficiary
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="add.php">
              <i class="fas fa-plus"></i> Add
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" style="cursor: pointer;" onclick="logout()">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </li>

        </ul>
    </div>
  </nav>
  </div>

 

      
  <?php

  try {
    $sql = "SELECT barangay, COUNT(*) as count FROM peace.household_data GROUP BY barangay";
    $result = $pdo->query($sql);

    $totalBeneficiaries = 0; // Initialize total count variable

    if ($result->rowCount() > 0) {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $barangay[] = $row["barangay"];
        $count[] = $row["count"];

        // Add each count to the total count
        $totalBeneficiaries += $row["count"];
      }
      unset($result);
    } else {
      echo "No records matching your query were found.";
    }
  } catch (PDOException $e) {
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }
  // Close connection
  unset($pdo);

  /////////////////////////////    B A R A N G A Y  C O N N E C T I O N DB  //////////////////////
  $barangayData = array();

  foreach ($barangay as $key => $b) {
    $barangayData[$b] = $count[$key];
  }

  $barangayData = json_encode(array_values($barangayData));
  ?>


<div class="chartCard">
    <div class="chartBox">

      <canvas id="myChartBarangay"></canvas>

      <div>Total Beneficiaries: <?php echo $totalBeneficiaries; ?></div>
      <div id="colorLegendBarangay" class="colorLegend"></div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="path-to-glyph-statistics.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Add this updated script after your current script -->
  <script>
    //////////////////////////////   Barangay Data        ////////////////////////////////
    const barangayData = <?php echo $barangayData; ?>;
    const dataBarangay = {
      labels: <?php echo json_encode($barangay); ?>,
      datasets: [{
        label: 'Number of Beneficiaries',
        data: barangayData,
        backgroundColor: barangayData.map(value => {
          if (value === Math.max(...barangayData)) {
            return 'rgba(255, 99, 132, 0.7)'; // Red for the highest number
          } else if (value === Math.min(...barangayData)) {
            return 'rgba(0, 255, 0, 0.2)'; // Green for the lowest number
          } else {
            return 'rgba(255, 205, 86, 0.7)'; // Yellow for medium numbers
          }
        }),
        borderColor: 'rgba(255, 26, 104, 1)',
        borderWidth: 1
      }]
    };

    // config
    const configBarangay = {
      type: 'bar',
      data: dataBarangay,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChartBarangay = new Chart(
      document.getElementById('myChartBarangay'),
      configBarangay
    );

    // Color Legend
    const colorLegendBarangay = document.getElementById('colorLegendBarangay');
    colorLegendBarangay.innerHTML = `
    <div class="legend-item">
      <div class="legend-color" style="background-color: rgba(255, 99, 132, 0.7);"></div>
      <span>Highest Number</span>
    </div>
    <div class="legend-item">
      <div class="legend-color" style="background-color: rgba(0, 255, 0, 0.2);"></div>
      <span>Lowest Number</span>
    </div>
    <div class="legend-item">
      <div class="legend-color" style="background-color: rgba(255, 205, 86, 0.7);"></div>
      <span>Medium Number</span>
    </div>
  `;


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
  </script>

  </script>

</body>

</html>