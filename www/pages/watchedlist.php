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
    <title>Watchedlist</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <?php include "../functions/logo.php"; ?>
    <div class="container">
        <h2>Watchedlist</h2>
        <!-- watchedlistfunktion -->
    </div>
</body>
</html>