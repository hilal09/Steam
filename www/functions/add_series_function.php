<?php
session_start();

// Stelle die Verbindung zur Datenbank her
include "db_connection.php";

// Hole die Benutzer-ID aus der Sitzungsvariable
$user_id = $_SESSION['user_id'];

// Check if all required fields are filled
if (empty($_POST['title']) || empty($_POST['year']) || empty($_POST['seasons']) || empty($_POST['genre']) || empty($_POST['platform'])) {
    echo "All fields are required.";
    exit();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hole die Daten aus dem Formular
    $title = $_POST['title'];
    $year = $_POST['year'];
    $seasons = $_POST['seasons'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];

    // Rufe die Funktion zum Hinzufügen einer Serie auf
    $result = addSeries($user_id, $playlist_id, $title, $year, $seasons, $genre, $platform, $_FILES['picture']);
    // Gib das Ergebnis zurück
    echo $result;

} else {
    // If the request method is not POST, return an error message
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method";
    exit();
}

// Function to get the playlist ID based on the playlist name and user ID
function getPlaylistID($playlistName, $userId) {
    global $conn;

    // Prepare the SQL query
    $sql = "SELECT playlist_id FROM my_playlists WHERE playlist_name =? AND user_id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $playlistName, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a playlist exists with the given name and user ID
    if ($result->num_rows > 0) {
        // Return the playlist ID
        $row = $result->fetch_assoc();
        return $row['playlist_id'];
    } else {
        // Create a new playlist and return its ID
        $sql = "INSERT INTO my_playlists (user_id, playlist_name) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $userId, $playlistName);
        if ($stmt->execute()) {
            $playlist_id = $conn->insert_id;
            return $playlist_id;
        } else {
            return "Error: ". $sql. "<br>". $conn->error;
        }
    }
}


// Überprüfe, ob der Request von einem Plus-Button kommt und führe dann die Funktion aus
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["playlist_name"])) {
    $playlistName = $_GET["playlist_name"];
    $userId = $_SESSION['user_id'];
    
    // Debugging: Ausgabe des Playlist-Namens
    echo "Playlist Name: " . $playlistName . "<br>";

    // Hole die Playlist-ID basierend auf dem Playlist-Namen und der Benutzer-ID
    $playlistId = addPlaylistID($playlistName, $userId);
    
    // Hier kannst du die Playlist-ID weiter verarbeiten oder zurückgeben
    if ($playlistId !== null) {
        echo "Playlist ID: " . $playlistId;
    } else {
        echo "Playlist not found or user not authorized.";
    }
}

// Funktion zum Hinzufügen einer Serie
function addSeries($user_id, $playlist_id, $title, $year, $seasons, $genre, $platform, $picture) {
    global $conn;

    // Bild in die Datenbank einfügen
    $pictureData = addslashes(file_get_contents($picture['tmp_name']));

    // SQL-Anweisung zum Einfügen der Serie mit dem Bild
    $sql = "INSERT INTO my_series (user_id, playlist_id, title, year, seasons, genre, platform, picture) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisiisss", $user_id, $playlist_id, $title, $year, $seasons, $genre, $platform, $pictureData);

    // Führe die SQL-Anweisung aus
    if ($stmt->execute()) {
        return "Series added successfully.";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }

    // Schließe die vorbereitete Anweisung
    $stmt->close();
    $conn->close();
}
?>
