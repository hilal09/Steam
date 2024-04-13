<?php
$servername = "localhost";
$name = "root"; 
$password = ""; 
$database = "user_accounts"; 

// Create connection
$conn = new mysqli($servername, $name, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
