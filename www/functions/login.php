<?php
session_start();
include 'db_connection.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare and execute SQL statement to fetch user from the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User found, verify password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, set session variables and redirect to dashboard
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $row['name'];
        // Redirect to dashboard
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        // Password is incorrect, redirect back to register page
        header("Location: ../pages/registration.php?error=invalid");
        exit();
    }
} else {
    // User not found, redirect back to register page
    header("Location: ../pages/registration.php?error=notfound");
    exit();
}

$conn->close();
?>
