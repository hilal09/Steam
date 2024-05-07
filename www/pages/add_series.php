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
  top: 100px; /* Position des Popups von oben */
  left: 50%;
  transform: translateX(-50%);
  background-color: rgba(0, 0, 0, 0.8); /* Hintergrundfarbe mit Transparenz */
  padding: 10px;
  border-radius: 8px;
  z-index: 999;
}
.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
}
.popup-content input {
  display: block;
  margin-bottom: 10px;
}
.close-btn {
  position: absolute;
  top: 5px;
  right: 5px;
  cursor: pointer;
  color: white;
}
</style>
</head>
<body>

<div class="popup" id="addSeriesPopup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <h2 style="margin-bottom: 20px;">Serie hinzufügen</h2>
    <form action="add_series.php" method="POST">
      <input type="text" id="title" name="title" placeholder="Titel" required>
      <input type="text" id="year" name="year" placeholder="Jahr" required>
      <input type="number" id="seasons" name="seasons" placeholder="Staffeln" required>
      <input type="text" id="genre" name="genre" placeholder="Genre" required>
      <input type="text" id="platform" name="platform" placeholder="Plattform">
      <input type="text" id="picture_url" name="picture_url" placeholder="Bild URL">
      <button type="submit" name="submit" style="margin-top: 10px;">Serie hinzufügen</button>
    </form>
  </div>
</div>

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