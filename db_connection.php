<?php
// Database credentials
$host = "localhost"; // XAMPP default host
$username = "root";  // Default username for XAMPP
$password = "";      // Leave empty for XAMPP
$database = "commute_connect"; // Replace with your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
