<?php
session_start();

error_reporting(0);

if (isset($_COOKIE['LOGIN'])) {
    $_SESSION['LOGIN'] = $_COOKIE['LOGIN'];
    //header("Location: dashboard.php");
}

error_reporting(0);

if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
}

?>
<!DOCTYPE html>
<html>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="include/jquery.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    body {
        background-color: lightgray;
        /* Change background color to green (hex color code) */
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .logo {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .header {
        text-align: center;
        padding: 20px;
        background-color: white;
        color: #fff;

    }

    .row {
        background-color: whitesmoke;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
    }

    .vl {
        border-left: 1px solid #4CAF50;
        /* Change border color to green (hex color code) */
        height: 22rem;
    }

    @media (max-width: 767px) {
        .logo {
            flex-direction: column;
        }

        .vl {
            display: none;
        }

        .col-md-6 {
            margin-bottom: 20px;
        }

        .col-md-4 {
            margin-top: 20px;
        }

        .logo {
            margin-left: 0;
        }
    }
</style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="main-container">
                    <div class="carousel-container">
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="image/1.jpg" class="d-block w-100" alt="Image 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="image/2.jpg" class="d-block w-100" alt="Image 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="image/3.jpg" class="d-block w-100" alt="Image 3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="vl d-none d-lg-block"></div> <!-- Show on large screens only -->
            <div class="col-md-4 my-1">
                <div class="main-container">
                    <div class="logo">
                        <h2 class="text-center text-blck">Admin Login</h2>
                        <img src="image/mercedes.png" alt="Logo" width="60px">
                    </div>

                    <form id="submitForm" method="POST">
                        <div class="form-group">
                            <div class="col-lg-2 text-center">

                            </div>
                            <div class="form-group">
                            <label for="username"><i class="fas fa-user"></i> Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary btn-block">Login</button>
                        <div class="signup-link">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#submitForm").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "function/auth.php",
                    type: "POST",
                    cache: false,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        response = response.trim();

                        if (response === "success") {
                            window.location.href = "dashboard.php";
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
    </script>
    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>