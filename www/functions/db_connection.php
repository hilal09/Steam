<?php
$servername = "localhost";
$name = "root"; // Your MySQL username
$password = ""; // Your MySQL password (if any)
$database = "user_accounts"; // Your database name

// Create connection
$conn = new mysqli($servername, $name, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
