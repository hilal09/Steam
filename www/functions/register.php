<?php
include 'db_connection.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute SQL statement to insert user into the database
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    // Registration successful, redirect to dashboard page
    header("Location: ../pages/dashboard.php");
    exit();
} else {
    header("Location: ../pages/login.php?error=notfound");
    exit();}

$conn->close();
?>
