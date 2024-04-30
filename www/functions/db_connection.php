<?php

$servername = "localhost";
$name = "root"; 
$password = ""; 
$database = "steam"; 

//Create connection
$conn = mysqli_connect($servername, $name, $password, $database);

// Check connection (funktioniert noch nicht; zum Testen database name ändern und im browser diese datei angeben und gucken, ob da connection failed steht )
if (!$conn) {
    echo "Connection failed!";
}
?>