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
.error {
  display: none;
  color: red;
}
</style>
</head>
<body>

<div class="popup" id="addSeriesPopup">
  <div class="popup-content">
    <span class="close-btn" onclick="closePopup()">&times;</span>
    <h2>Add series</h2>
    <form action="add_series.php" method="POST">
      <!-- Hier ein verstecktes Input-Feld, um die Playlist-ID zu übergeben -->
      <input type="hidden" id="playlist_id" name="playlist_id" value="<?php echo $playlist_id; ?>">
      <!-- Weitere Formularfelder für die Serieninformationen -->
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
function openPopup(playlistId) {
  document.getElementById("addSeriesPopup").style.display = "block";
  // Playlist-ID im versteckten Input-Feld setzen
  document.getElementById("playlist_id").value = playlistId;
}
// Funktion zum Schließen des Popups
function closePopup() {
  window.location.href = "dashboard.php"; // Weiterleitung zur Dashboard-Seite
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
    $playlist_id = isset($_POST['playlist_id']) ? $_POST['playlist_id'] : '';

    // Hier musst du sicherstellen, dass deine Verbindung zur Datenbank hergestellt wird.
    // An dieser Stelle solltest du deine Verbindung zur Datenbank einrichten.
    // Das kann auf verschiedene Weise geschehen, abhängig davon, welche Art von Datenbank du verwendest und welche PHP-Bibliotheken verfügbar sind.

    // Wenn du beispielsweise MySQL und PDO verwendest, könnte die Verbindung so aussehen:
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=deineDatenbank', 'deinBenutzername', 'deinPasswort');
        // Setze den PDO-Error-Modus auf Exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die('Verbindung zur Datenbank fehlgeschlagen: ' . $e->getMessage());
    }

    // SQL-Befehl zum Einfügen der Serie in die Datenbank
    $sql = "INSERT INTO my_series (user_id, series_id, playlist_id, title, year, seasons, genre, platform, picture_url) 
            VALUES (:user_id, :series_id, :playlist_id, :title, :year, :seasons, :genre, :platform, :picture_url)";

    // PDO-Statement vorbereiten
    $stmt = $pdo->prepare($sql);

    // Parameter binden
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':series_id', $series_id);
    $stmt->bindParam(':playlist_id', $playlist_id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':seasons', $seasons);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':platform', $platform);
    $stmt->bindParam(':picture_url', $picture_url);

    // Hier müsstest du sicherstellen, dass $user_id und $series_id definiert sind.
    // $user_id könnte beispielsweise die ID des eingeloggten Benutzers sein.
    // $series_id könnte eine eindeutige ID für die neue Serie sein. Diese könnte automatisch erzeugt werden oder auf andere Weise festgelegt werden.

    // Weiterleiten oder Fehler behandeln
    try {
        // SQL-Befehl ausführen
        $stmt->execute();
        // Weiterleitung zur Dashboard-Seite nach erfolgreichem Hinzufügen der Serie
        header('Location: dashboard.php');
        exit; // Beende das Skript nach der Weiterleitung
    } catch(PDOException $e) {
        // Fehlerbehandlung, falls das Einfügen fehlschlägt
        echo 'Fehler beim Hinzufügen der Serie: ' . $e->getMessage();
    }
}
?>

</body>
</html>