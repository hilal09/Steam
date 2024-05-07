<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Serien hinzufügen</title>
<!-- Hier kannst du deine CSS-Datei einbinden, falls du eine externe CSS-Datei verwendest -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HTML für das Popup-Fenster -->
<div class="popup" id="addSeriesPopup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <h2>Serie hinzufügen</h2>
    <form action="add_series.php" method="POST">
      <div class="form-group">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
      </div>
      <!-- Weitere Eingabefelder für Jahr, Staffel, Genre, Plattform und Bild -->
      <!-- Ein Submit-Button zum Absenden des Formulars -->
      <button type="submit" name="submit">Serie hinzufügen</button>
    </form>
  </div>
</div>

<!-- JavaScript zum Öffnen und Schließen des Popup-Fensters -->
<script>
function openPopup() {
  document.getElementById("addSeriesPopup").style.display = "block";
}

function closePopup() {
  document.getElementById("addSeriesPopup").style.display = "none";
}
</script>

<!-- PHP-Skript zum Verarbeiten des Formulars -->
<?php
// Verbindung zur Datenbank herstellen

// Informationen aus dem Formular erfassen
$title = $_POST['title'];
$year = $_POST['year'];
$seasons = $_POST['seasons'];
$genre = $_POST['genre'];
$platform = $_POST['platform'];
$picture_url = $_POST['picture_url'];

// SQL-Befehl zum Einfügen der Serie in die Datenbank
$sql = "INSERT INTO my_series (user_id, series_id, playlist_id, title, year, seasons, genre, platform, picture_url) 
        VALUES (:user_id, :series_id, :playlist_id, :title, :year, :seasons, :genre, :platform, :picture_url)";

// SQL-Befehl ausführen und Parameter binden

// Weiterleiten oder Fehler behandeln
?>

</body>
</html>