<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/index.php");
    exit();
}

// datenbankverbindung
$servername = "localhost";
$username = "root";
$password = "";
$database = "steam";

// verbindung herstellen
$conn = mysqli_connect($servername, $username, $password, $database);

// verbindung überprüfen
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
$titleFilter = isset($_GET['title']) ? $_GET['title'] : 'title';
$genreFilter = isset($_GET['genre']) ? $_GET['genre'] : 'genre';
$platformFilter = isset($_GET['platform']) ? $_GET['platform'] : 'platform';
$paramTypes = '';
$paramValues = array();

$sql = "SELECT * FROM default_series WHERE 1=1";

if ($searchQuery != '') {
    // suchanfrage zur SQL-anweisung hinzufügen
    $sql .= " AND title LIKE '%$searchQuery%'";
} else {
    $titleFilter = 'title';
}

if ($titleFilter != 'title') {
    // titelfilter zur SQL-anweisung hinzufügen
    if ($titleFilter == 'a-j') {
        $sql .= " AND title >= 'A' AND title <= 'J'";
    } elseif ($titleFilter == 'k-t') {
        $sql .= " AND title >= 'K' AND title <= 'T'";
    } elseif ($titleFilter == 'u-z') {
        $sql .= " AND title >= 'U' AND title <= 'Z'";
    }
}

if ($genreFilter != 'genre') {
    // genre-filter
    $sql .= " AND genre = ?";
    $paramTypes .= 's';
    $paramValues[] = $genreFilter;
}

if ($platformFilter != 'platform') {
    // plattform-filter
    $sql .= " AND platform = ?";
    $paramTypes .= 's';
    $paramValues[] = $platformFilter;
}

$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    $paramTypes = '';
    $paramValues = array();
    
    if ($genreFilter != 'genre') {
        $paramTypes .= 's';
        $paramValues[] = $genreFilter;
    }
    
    if ($platformFilter != 'platform') {
        $paramTypes .= 's';
        $paramValues[] = $platformFilter;
    }

    if (!empty($paramTypes)) {
        mysqli_stmt_bind_param($stmt, $paramTypes, ...$paramValues);
    }
    
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='search-results-container'>";
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='search-result'>";
            echo "<img src='" . $row['picture_url'] . "' alt='" . $row['title'] . "'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p><strong>Genre:</strong> " . $row['genre'] . "</p>";
            echo "<p><strong>Platform:</strong> " . $row['platform'] . "</p>";
            echo "<p><strong>Seasons:</strong> " . $row['seasons'] . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>