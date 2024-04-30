<?php
session_start(); // Add session_start() at the beginning

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../pages/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <div class="profile-container">
        <aside class="profile-sidebar">
            <div class="profile-user-card">
                <div class="profile-user-avatar">
                    <img src="path_to_avatar.jpg" alt="User Avatar"> <!-- Replace with the path to the user's avatar -->
                </div>
                <div class="profile-user-info">
                    <h2>Michael Eniston</h2>
                </div>
            </div>
            <nav class="profile-navigation">
                <ul>
                    <li><a href="#profile-section">Profile</a></li>
                    <li><a href="#playlist-section">My Playlist</a></li>
                    <li><a href="#watch-history-section">Watch History</a></li>
                    <li><a href="#settings-section">Settings</a></li>
                </ul>
            </nav>
        </aside>
        <main class="profile-main">
            <section id="profile-section">
                <!-- Profile content goes here -->
            </section>
            <section id="playlist-section">
                <!-- Playlist content goes here -->
            </section>
            <section id="watch-history-section">
                <!-- Watch history content goes here -->
            </section>
            <section id="settings-section">
                <!-- Settings content goes here -->
            </section>
        </main>
    </div>
</body>
</html>
