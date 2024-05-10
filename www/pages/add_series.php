<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Serien hinzufügen</title>
<link rel="stylesheet" href="style.css">

<style>
.popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Dunkler Hintergrund */
  display: flex;
  justify-content: center;
  align-items: center;
}
.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  position: relative; /* Added */
}
.popup-content input {
  display: block;
  margin-bottom: 10px;
}
.close-btn {
  position: absolute; /* Changed */
  top: 5px;
  right: 5px;
  cursor: pointer;
  color: black; /* Changed */
}
.error {
  display: none;
  color: red;
}
</style>
</head>
<body>

<div class="popup" id="addSeriesPopup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span> <!-- Moved inside popup-content -->
    <h2>Add series</h2>
    <form action="add_series.php" method="POST" onsubmit="return validateForm()">
      <!-- Hier ein verstecktes Input-Feld, um die Playlist-ID zu übergeben -->
      <input type="hidden" id="playlist_id" name="playlist_id" value="<?php echo $playlist_id; ?>">
      <!-- Weitere Formularfelder für die Serieninformationen -->
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <div id="title-error" class="error">Bitte geben Sie einen Titel ein.</div>
      </div>
      <div class="form-group">
        <label for="year">Year:</label>
        <input type="text" id="year" name="year" required>
        <div id="year-error" class="error">Bitte geben Sie ein Jahr ein.</div>
      </div>
      <div class="form-group">
        <label for="seasons">Seasons:</label>
        <input type="number" id="seasons" name="seasons" required>
        <div id="seasons-error" class="error">Bitte geben Sie die Anzahl der Staffeln ein.</div>
      </div>
      <div class="form-group">
        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>
        <div id="genre-error" class="error">Bitte geben Sie das Genre ein.</div>
      </div>
      <div class="form-group">
        <label for="platform">Platform:</label>
        <input type="text" id="platform" name="platform">
        <div id="platform-error" class="error">Bitte geben Sie die Plattform ein.</div>
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
function openPopup(playlistId) {
  document.getElementById("addSeriesPopup").style.display = "flex";
  // Playlist-ID im versteckten Input-Feld setzen
  document.getElementById("playlist_id").value = playlistId;
}

// Funktion zum Schließen des Popups und Zurückkehren zur Dashboard-Seite
function closePopup() {
  window.location.href = "dashboard.php";
}

function validateForm() {
  var title = document.getElementById("title").value;
  var year = document.getElementById("year").value;
  var seasons = document.getElementById("seasons").value;
  var genre = document.getElementById("genre").value;
  var platform = document.getElementById("platform").value;
  
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
</body>
</html>
