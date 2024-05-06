<?php
session_start(); // Add session_start() at the beginning

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../pages/index.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the playlist name
    if (empty($_POST["playlist_name"])) {
        $error = "Playlist name is required";
    } else {
        // Here you can add code to save the playlist to the database or perform any other necessary actions
        // For now, let's just redirect the user back to the dashboard
        header("Location: ../pages/dashboard.php");
        exit();
    }
}
?>