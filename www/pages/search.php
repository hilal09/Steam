<?php include "../functions/navigation.php"; ?>
<?php include "../functions/logo.php"; ?>
<?php include "../functions/profile_functions.php"; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <h2>Steam<sup class="tm">TM</sup> - Dashboard</h2>
        </div>
        <h3>Willkommen, <?php echo $_SESSION['name']; ?>!</h3> <!-- Zeige den Benutzernamen an -->
        <h4>Deine Playlists:</h4>
        <ul>
            <?php
            // Hier könntest du die Benutzer-Playlists abrufen und anzeigen
            // Beispielcode: $userId = $_SESSION['user_id']; $playlists = getUserPlaylists($userId);
            // Dann eine Schleife durchlaufen und jede Playlist anzeigen
            ?>
        </ul>
        <a href="../pages/playlist.php">Zur Playlist</a> <!-- Beispiel-Link zur Playlist-Seite -->
    </div>
</body>
</html>