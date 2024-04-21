<?php include "../functions/navigation.php"; ?>
<?php include "../functions/logo.php"; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlist</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <h2>Steam<sup class="tm">TM</sup> - My Playlist</h2>
        </div>
        <h3>Meine Playlists:</h3>
        <ul>
            <?php
            // Verbindung zur Datenbank herstellen und Benutzer-Playlists abrufen
            // Annahme: $conn ist die Verbindungsvariable
            $userId = $_SESSION['user_id']; // Angenommen, die Benutzer-ID ist in der Sitzungsvariable gespeichert
            $sql = "SELECT * FROM my_playlists WHERE user_id = $userId";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . $row['playlist_name'] . "</li>";
                }
            } else {
                echo "<li>Keine Playlists vorhanden</li>";
            }
            ?>
        </ul>
        <h3>Neue Playlist erstellen:</h3>
        <form action="../functions/create_playlist.php" method="POST">
            <input type="text" name="playlist_name" placeholder="Playlist Name" required>
            <input type="submit" value="Erstellen">
        </form>
    </div>
</body>
</html>