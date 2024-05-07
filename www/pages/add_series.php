<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Serien hinzufügen</title>
<link rel="stylesheet" href="style.css">
<style>
.popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 999;
}
.popup-content {
  width: 300px; /* Breite des Popup-Inhalts erhöhen */
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
}
.close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
</style>
</head>
<body>

<div class="popup" id="addSeriesPopup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <h2>Serie hinzufügen</h2>
    <form action="add_series.php" method="POST">
      <div class="form-group">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="year">Jahr:</label>
        <input type="text" id="year" name="year" required>
      </div>
      <div class="form-group">
        <label for="seasons">Staffeln:</label>
        <input type="number" id="seasons" name="seasons" required>
      </div>
      <div class="form-group">
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>
      </div>
      <div class="form-group">
        <label for="platform">Plattform:</label>
        <input type="text" id="platform" name="platform">
      </div>
      <div class="form-group">
        <label for="picture_url">Bild URL:</label>
        <input type="text" id="picture_url" name="picture_url">
      </div>
      <button type="submit" name="submit">Serie hinzufügen</button>
    </form>
  </div>
</div>

<script>
function openPopup() {
  document.getElementById("addSeriesPopup").style.display = "block";
}

function closePopup() {
  window.location.href = "dashboard.php"; // Weiterleitung zur Dashboard-Seite
}
</script>



<!-- PHP-Skript zum Verarbeiten des Formulars -->
<?php
if(isset($_POST['submit'])) {
    // Verbindung zur Datenbank herstellen

    // Informationen aus dem Formular erfassen
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $seasons = isset($_POST['seasons']) ? $_POST['seasons'] : '';
    $genre = isset($_POST['genre']) ? $_POST['genre'] : '';
    $platform = isset($_POST['platform']) ? $_POST['platform'] : '';
    $picture_url = isset($_POST['picture_url']) ? $_POST['picture_url'] : '';

    // SQL-Befehl zum Einfügen der Serie in die Datenbank
    $sql = "INSERT INTO my_series (user_id, series_id, playlist_id, title, year, seasons, genre, platform, picture_url) 
            VALUES (:user_id, :series_id, :playlist_id, :title, :year, :seasons, :genre, :platform, :picture_url)";

    // SQL-Befehl ausführen und Parameter binden

    // Weiterleiten oder Fehler behandeln
}
?>

</body>
</html>