<?php
session_start(); // Add session_start() at the beginning

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../pages/index.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "steam";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Dummy search query, replace with actual search query based on form input
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
$titleFilter = isset($_GET['title']) ? $_GET['title'] : 'all';
$genreFilter = isset($_GET['genre']) ? $_GET['genre'] : 'all';
$platformFilter = isset($_GET['platform']) ? $_GET['platform'] : 'all';

// Construct the SQL query based on filters
$sql = "SELECT * FROM default_series WHERE 1=1"; // 1=1 is used to simplify the SQL query construction

if ($searchQuery != '') {
    // Add search query to the SQL statement
    $sql .= " AND title LIKE '$searchQuery%'";
}

if ($titleFilter != 'all') {
    // Add title filter to the SQL statement
    if ($titleFilter == 'a-j') {
        $sql .= " AND title >= 'A' AND title <= 'J'";
    } elseif ($titleFilter == 'k-t') {
        $sql .= " AND title >= 'K' AND title <= 'T'";
    } elseif ($titleFilter == 'u-z') {
        $sql .= " AND title >= 'U' AND title <= 'Z'";
    }
}

if ($genreFilter != 'all') {
    // Add genre filter to the SQL statement
    $sql .= " AND genre = ?";
}

if ($platformFilter != 'all') {
    // Add platform filter to the SQL statement
    $sql .= " AND platform = ?";
}

$stmt = mysqli_prepare($conn, $sql);
if ($stmt) {
    // Bind parameters
    $paramTypes = '';
    $paramValues = array();
    
    if ($genreFilter != 'all') {
        $paramTypes .= 's';
        $paramValues[] = $genreFilter;
    }
    
    if ($platformFilter != 'all') {
        $paramTypes .= 's';
        $paramValues[] = $platformFilter;
    }

    if (!empty($paramTypes)) {
        mysqli_stmt_bind_param($stmt, $paramTypes, ...$paramValues);
    }
    
    // Execute statement
    mysqli_stmt_execute($stmt);
    // Get result set
    $result = mysqli_stmt_get_result($stmt);

    // Output data of each row
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='search-results-container'>";
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='search-result'>";
            echo "<h2>" . $row['title'] . "</h2>";
            echo "<p><strong>Genre:</strong> " . $row['genre'] . "</p>";
            echo "<p><strong>Platform:</strong> " . $row['platform'] . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>