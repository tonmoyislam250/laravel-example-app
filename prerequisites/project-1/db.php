<?php
$servername = "localhost";
$username = "root"; // Default username for local servers
$password = "test0000"; // Default password for XAMPP/WAMP
$dbname = "test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
