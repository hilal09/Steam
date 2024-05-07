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
  background-color: rgba(0, 0, 0, 0.8); /* Dunkler Hintergrund */
  padding: 20px;
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
    <h2>Add series</h2>
    <form action="add_series.php" method="POST">
      <div class="form-group">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
      </div>
      <div class="form-group">
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" required>
      </div>
      <div class="form-group">
        <label for="seasons">Seasons:</label>
        <input type="number" id="seasons" name="seasons" required>
      </div>
      <div class="form-group">
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>
      </div>
      <div class="form-group">
        <label for="platform">Platform:</label>
        <input type="text" id="platform" name="platform">
      </div>
      <div class="form-group">
        <label for="picture_url">Picture URL:</label>
        <input type="text" id="picture_url" name="picture_url">
      </div>
      <button type="submit" name="submit">save</button>
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

function showEditLink(serieId) {
  // Zeige den Bearbeitungslink für die angegebene Serie an
}

function hideEditLink(serieId) {
  // Verstecke den Bearbeitungslink für die angegebene Serie
}
function validateForm() {
  var title = document.getElementById("title").value;
  var year = document.getElementById("year").value;
  var seasons = document.getElementById("seasons").value;
  var genre = document.getElementById("genre").value;
  var platform = document.getElementById("platform").value;
  var pictureUrl = document.getElementById("picture_url").value;
  
  if (!title) {
    document.getElementById("title-error").style.display = "block";
    return false;
  } else {
    document.getElementById("title-error").style.display = "none";
  }
  
  if (!year) {
    document.getElementById("year-error").style.display = "block";
    return false;
  } else {
    document.getElementById("year-error").style.display = "none";
  }
  
  if (!seasons) {
    document.getElementById("seasons-error").style.display = "block";
    return false;
  } else {
    document.getElementById("seasons-error").style.display = "none";
  }
  
  if (!genre) {
    document.getElementById("genre-error").style.display = "block";
    return false;
  } else {
    document.getElementById("genre-error").style.display = "none";
  }
  
  if (!platform) {
    document.getElementById("platform-error").style.display = "block";
    return false;
  } else {
    document.getElementById("platform-error").style.display = "none";
  }
  
  return true;
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