<?php
// Include the database connection
include "db_connection.php";

// Check if the request method is GET and if the playlist name is set
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["playlist_name"])) {
    // Get the playlist name from the GET parameters
    $playlistName = $_GET["playlist_name"];

    // Prepare the SQL query to fetch series information based on playlist name
    $sql = "SELECT title, year, seasons, genre, platform, picture FROM my_series 
            INNER JOIN my_playlists ON my_series.playlist_id = my_playlists.playlist_id 
            WHERE my_playlists.playlist_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $playlistName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Array to hold series data
        $seriesData = array();

        // Fetch series data and store in the array
        while ($row = $result->fetch_assoc()) {
            $seriesData[] = $row;
        }

        // Return series data as JSON
        header('Content-Type: application/json');
        echo json_encode($seriesData);
    } else {
        // If no series found for the given playlist name, return an empty array
        echo json_encode(array());
    }
} else {
    // If the request method is not GET or playlist name is not set, return an error
    http_response_code(400); // Bad Request
    echo "Invalid request";
}
?>
