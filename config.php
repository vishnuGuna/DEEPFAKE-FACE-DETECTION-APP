<?php
// config.php
$servername = "localhost";
$username = "root";  // MySQL username
$password = "";       // MySQL password (leave empty for XAMPP)
$dbname = "deepfake"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}
?>
