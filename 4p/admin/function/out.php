<?php

session_start();

if(!isset($_SESSION['admin'])){
    header("Location: index.php");
}

function fetchDataBasedOnSearch($search) {
    // Implement the logic to fetch data based on search
    // Example: You may use SQL queries to fetch data from your database
}

function fetchTotalCount($search) {
    // Implement the logic to fetch total count based on search
    // Example: You may use SQL queries to count rows in your database
}
?>