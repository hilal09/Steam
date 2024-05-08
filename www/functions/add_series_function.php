<?php
// Include database connection
include 'db_connection.php';

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve form data
    $playlist_id = $_POST['playlist_id'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $seasons = $_POST['seasons'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];
    $picture_url = $_POST['picture_url'];

    // Validate form data (you can add more validation as needed)

    // Insert data into the database
    $sql = "INSERT INTO my_series (playlist_id, title, year, seasons, genre, platform, picture_url) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $playlist_id, $title, $year, $seasons, $genre, $platform, $picture_url);
    $stmt->execute();

    // Redirect back to dashboard.php after successful insertion
    header("Location: dashboard.php");
    exit();
}


// $stmt->close();
// $conn->close();
?>
