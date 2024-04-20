<?php
session_start(); // Sitzung starten

include "../functions/db_connection.php"; // Datenbankverbindung einbinden

// Überprüfen, ob der Benutzer angemeldet ist
if(!isset($_SESSION['loggedin'])) {
    // Falls nicht, weiterleiten zur Anmeldeseite oder anderen geeigneten Aktionen
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watchedlist</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <?php include "../functions/logo.php"; ?>
    <div class="container">
        <h2>Watchedlist</h2>

        <!-- Anzeige der gesehenen Serien -->
        <?php
        // SQL-Abfrage, um alle gesehenen Serien des Benutzers abzurufen
        $user_id = $_SESSION['user_id']; // Annahme: Die Benutzer-ID wurde während der Anmeldung gespeichert
        $sql = "SELECT * FROM watched_series WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Gesehene Serien gefunden, sie anzeigen
            while($row = $result->fetch_assoc()) {
                echo "<div class='series'>";
                echo "<img src='" . $row['image_url'] . "' alt='" . $row['title'] . "' />";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>Seasons: " . $row['seasons'] . "</p>";
                // Weitere Informationen anzeigen
                echo "</div>";
            }
        } else {
            echo "Keine gesehenen Serien vorhanden.";
        }
        ?>

        <!-- Formular zum Hinzufügen einer Serie zur WatchedList -->
        <h3>Serie zur Watchedlist hinzufügen</h3>
        <form action="../functions/add_to_watchedlist.php" method="POST">
            <input type="text" name="title" placeholder="Titel" required>
            <input type="number" name="seasons" placeholder="Anzahl der Staffeln" required>
            <!-- Weitere Felder für Genre, Plattform usw. können hinzugefügt werden -->
            <input type="submit" name="add_to_watched" value="Zur Watchedlist hinzufügen">
        </form>
    </div>
</body>
</html>