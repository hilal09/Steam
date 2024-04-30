<?php
$servername = "localhost";
$name = "root"; 
$password = ""; 
$database = "steam"; 

//Create connection
$conn = new mysqli($servername, $name, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>