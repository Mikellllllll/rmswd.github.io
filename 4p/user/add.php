<?php
include 'function/out.php';

?>
<!DOCTYPE html>
<html lang="en">


<style>
    body {
        background-color: #f4f4f4;
        margin: 0;
        font-family: 'Helvetica', sans-serif;
    }

    .navbar {
    background-color: #2c3e50; /* Darker background color for a professional look */
    padding: 20px 35px; /* Reduced padding for a sleeker appearance */
    color: #ecf0f1; /* Light text color for better contrast */
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Subtle box shadow for depth */
}

.navbar a {
    color: #ecf0f1; /* Light text color */
    text-decoration: none;
    padding: 10px;
    margin: 0 10px; /* Added spacing between links */
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.navbar a:hover {
    background-color: #3498db; /* A slightly lighter shade than the main color */
    color: #fff; /* White text color on hover */
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
        color: white;
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

    .form-container {
        flex: 1;
        background-color: #f5f5f5;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 30px;
        margin: 30px auto;
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
        padding: 15px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        color: #555;
    }

    .form-container button[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 15px 30px;
        cursor: pointer;
        font-family: "Arial", sans-serif;
        border-radius: 8px;
        transition: background-color 0.3s, color 0.3s;
    }

    .form-container button[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Custom hover effect for the logout button */
    .swal2-confirm:hover {
        background-color: #0056b3;
        color: #fff;
        transition: background-color 0.3s, color 0.3s;
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

    .navbar-toggler {
        padding: .25rem .75rem;
        font-size: 1.25rem;
        line-height: 1;
        background-color: transparent;
        border: 1px solid transparent;
        border-radius: .25rem;

    }

    .map-container {
        padding-top: 30px;
        color: black;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: whitesmoke;

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="include/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Datepicker CSS (Assuming you have a date picker library) -->

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
    <div id="content">
        <div class="map-container">
            <h2>Household Personal Data</h2>
            <p>
        </div>
        <!-- ... (previous HTML code) ... -->
        <div class="form-container">
            <form id="saveForm" method="post">
                <div class="form-group">
                    <label for="last_name"><strong>Last Name:</strong></label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="first_name"><strong>First Name:</strong></label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="middle_name"><strong>Middle Name:</strong></label>
                    <input type="text" id="middle_name" name="middle_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="extension_name"><strong>Extension Name:</strong></label>
                    <input type="text" id="extension_name" name="extension_name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="Sex"><strong>Sex:</strong></label>
                    <select id="sexM" name="sexM" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="household_id_number"><strong>Household Id Number:</strong></label>
                    <input type="text" id="household_id_number" name="household_id_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="barangay"><strong>Barangay/Purok:</strong></label>
                    <select id="barangay" name="barangay" class="form-control" required>
                        <option value="Banquero">Banquero</option>
                        <option value="Binarsang">Binarsang</option>
                        <option value="Cutog Grande">Cutog Grande</option>
                        <option value="Cutog Pequeno">Cutog Pequeno</option>
                        <option value="Dangan">Dangan</option>
                        <option value="District 01">District 01</option>
                        <option value="District 02">District 02</option>
                        <option value="Labinab Grande">Labinab Grande</option>
                        <option value="Labinab Pequeno">Labinab Pequeno</option>
                        <option value="Mallalatang Grande">Mallalatang Grande</option>
                        <option value="Mallalatang Tungui">Mallalatang Tungui</option>
                        <option value="Napaccu Grande">Napaccu Grande</option>
                        <option value="Napaccu Pequeno">Napaccu Pequeno</option>
                        <option value="Salucong">Salucong</option>
                        <option value="Santor">Santor</option>
                        <option value="Sinippil">Sinippil</option>
                        <option value="Tallungan">Tallungan</option>
                        <option value="Turod">Turod</option>
                        <option value="Villador">Villador</option>
                        <option value="Santiago">Santiago</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city_municipality"><strong>City/Municipality:</strong></label>
                    <input type="text" id="city_municipality" name="city_municipality" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="province"><strong>Province:</strong></label>
                    <input type="text" id="province" name="province" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="region"><strong>Region:</strong></label>
                    <input type="text" id="region" name="region" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="income"><strong>Expected Monthly Income:</strong></label>
                    <input type="text" id="income" name="income" class="form-control" required>
                </div>
                <h2>NewBorn/Additional Household Member:</h2>
                <div class="form-group">
                    <label for="child_name"><strong>Name of Child:</strong></label>
                    <input type="text" id="child_name" name="child_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child_dob"><strong>Date of Birth (MM/DD/YYYY):</strong></label>
                    <input type="text" id="child_dob" name="child_dob" class="form-control">
                </div>
                <div class="form-group">
                    <label for="attending_school"><strong>Attending School:</strong></label>
                    <select id="attending_school" name="attending_school" class="form-control" required>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="reason_for_not_attending"><strong>Reason for not Attending:</strong></label>
                    <input type="text" id="reason_for_not_attending" name="reason_for_not_attending" class="form-control">
                </div>
                <div class="form-group">
                    <label for="school_name"><strong>Name of School:</strong></label>
                    <input type="text" id="school_name" name="school_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="Sex"><strong>Sex:</strong></label>
                    <select id="sexC" name="sexC" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <h2>CHILD 1</h2>
                <div class="form-group">
                    <label for="child1_name"><strong>Name:</strong></label>
                    <input type="text" id="child1_name" name="child1_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child1_address"><strong>Address:</strong></label>
                    <input type="text" id="child1_address" name="child1_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child1_school_name"><strong>Name of School:</strong></label>
                    <input type="text" id="child1_school_name" name="child1_school_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child1_school_address"><strong>Address of School:</strong></label>
                    <input type="text" id="child1_school_address" name="child1_school_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child1_grade_level"><strong>Grade Level:</strong></label>
                    <input type="text" id="child1_grade_level" name="child1_grade_level" class="form-control">
                </div>

                <h2>CHILD 2</h2>
                <div class="form-group">
                    <label for="child2_name"><strong>Name:</strong></label>
                    <input type="text" id="child2_name" name="child2_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child2_address"><strong>Address:</strong></label>
                    <input type="text" id="child2_address" name="child2_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child2_school_name"><strong>Name of School:</strong></label>
                    <input type="text" id="child2_school_name" name="child2_school_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child2_school_address"><strong>Address of School:</strong></label>
                    <input type="text" id="child2_school_address" name="child2_school_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child2_grade_level"><strong>Grade Level:</strong></label>
                    <input type="text" id="child2_grade_level" name="child2_grade_level" class="form-control">
                </div>

                <h2>CHILD 3</h2>
                <div class="form-group">
                    <label for="child3_name"><strong>Name:</strong></label>
                    <input type="text" id="child3_name" name="child3_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child3_address"><strong>Address:</strong></label>
                    <input type="text" id="child3_address" name="child3_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child3_school_name"><strong>Name of School:</strong></label>
                    <input type="text" id="child3_school_name" name="child3_school_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child3_school_address"><strong>Address of School:</strong></label>
                    <input type="text" id="child3_school_address" name="child3_school_address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="child3_grade_level"><strong>Grade Level:</strong></label>
                    <input type="text" id="child3_grade_level" name="child3_grade_level" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#saveForm").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "function/save_data.php",
                    type: "POST",
                    cache: false,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === "success") {
                            Swal.fire({
                                title: "Report Submit",
                                icon: "success",
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "add.php";
                                }
                            });
                        } else {
                            Swal.fire({
                                title: "ERROR",
                                text: response,
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "ERROR",
                            text: "Something went wrong",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                        console.error("AJAX Error:", status, error);
                    },
                });
            });
        });


        // Function to toggle the sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

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
    <!-- Bootstrap JS and jQuery (required for the navbar) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</body>

</html>