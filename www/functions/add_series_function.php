<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../pages/index.php");
    exit();
}

// Include the database connection
include "db_connection.php";

// Define the user ID
$user_id = $_SESSION['user_id'];

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $year = $_POST['year'];
    $seasons = $_POST['seasons'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];

    // Handle image upload
    $picture = null;
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
    }

    // Prepare and execute SQL statement to insert series into database
    $stmt = $conn->prepare("INSERT INTO my_series (user_id, title, year, seasons, genre, platform, picture) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississs", $user_id, $title, $year, $seasons, $genre, $platform, $picture);
    $stmt->execute();

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Redirect to dashboard after series addition
    header("Location: ../pages/dashboard.php");
    exit();
}
?>
