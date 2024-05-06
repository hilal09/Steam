<?php
session_start(); // Add session_start() at the beginning

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../pages/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <?php include "../functions/logo.php"; ?>
    
    <div class="container">
        <?php include "../functions/search_handler.php"; ?> <!-- Include the search handler here to process the form submission -->
        
        <div class="search-form">
            <form action="../functions/search_handler.php" method="GET">
                <input type="text" name="query" placeholder="What are you looking for?">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="filter-options">
            <form action="../functions/search_handler.php" method="GET">
                <select name="title">
                    <option value="all">All</option>
                    <option value="a-j">A-J</option>
                    <option value="k-t">K-T</option>
                    <option value="u-z">U-Z</option>
                </select>

                <select name="genre">
                <option value="all">All</option>
                    <option value="fantasy">Fantasy</option>
                    <option value="action">Action</option>
                    <option value="drama">Drama</option>
                    <option value="thriller">Thriller</option>
                    <!-- Weitere Genre-Optionen hier hinzufügen -->
                </select>

                <select name="platform">
                    <option value="all">All</option>
                    <option value="netflix">Netflix</option>
                    <option value="prime">Prime Video</option>
                    <option value="disney+">Disney+</option>
                    <option value="rtl+">RTL+</option>
                    <!-- Weitere Plattform-Optionen hier hinzufügen -->
                </select>
            </form>
        </div>
        
        <!-- Hier können die Suchergebnisse angezeigt werden -->
    </div>
</body>
</html>