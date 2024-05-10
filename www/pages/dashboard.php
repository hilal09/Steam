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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../widgets/navigation.php"; ?>
    <?php include "../widgets/logo.php"; ?>

    <div>
        <h3>Hello, <?php echo $_SESSION['name']; ?>!</h3>
    </div>

    <div class="currently-watching">
        <p>Currently Watching</p>
        <a href="add_series.php" class="add-series-button">+</a>
            <div class="playlist-content">
                <!--was aktuell geschaut wird-->
            </div>
    </div>

    <div class="wishlist">
            <p>Wishlist</p>
            <a href="add_series.php" class="add-series-button">+</a>
            <div class="playlist-content">
                <!-- serien hinzufügen, die man schauen möchte -->
            </div>
        </div>

    <div class="watched">
        <p>Watched</p>
        <a href="add_series.php" class="add-series-button">+</a>
        <div class="playlist-content">
            <!-- serien hinzufügen, die man schon geschaut hat -->
        </div>
    </div>

</body>
</html>