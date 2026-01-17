<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prasat_cinema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    // If connection fails, stop everything and show the error
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>