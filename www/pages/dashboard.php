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
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <?php include "../functions/logo.php"; ?>

    <div class="container-button" id="bigButton">
        <a href="../pages/add_playlist.php" class="add-playlist-button">Add new Playlist</a>
            <div class="add-playlist-content">
                <!--was aktuell geschaut wird-->
            </div>
    </div>

    <div class="currently-watching">
        <p>Currently Watching</p>
        <a href="add_series.php" class="add-series-button">+</a>
            <div class="playlist-content">
                <!--was aktuell geschaut wird-->
            </div>
    </div>

    <div class="want-to-watch">
            <p>Want to Watch</p>
            <a href="add_series.php" class="add-series-button">+</a>
            <div class="playlist-content">
                <!-- Hier können Serien hinzugefügt werden, die man schauen möchte -->
            </div>
        </div>

    <div class="already-watched">
        <p>Already Watched</p>
        <a href="add_series.php" class="add-series-button">+</a>
        <div class="playlist-content">
            <!-- Hier können bereits geschauten Serien hinzugefügt werden -->
        </div>
    </div>

</body>
</html>