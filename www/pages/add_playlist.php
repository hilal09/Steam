<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <?php include "../functions/logo.php"; ?>

    <div class="container-button" id="bigButton">
        <button id="openPopup" class="add-playlist-button">Add new Playlist</button>
    </div>

    <div id="popup" class="popup">
        <div class="popup-content">
            <h2>Create New Playlist</h2>
            <form id="playlistForm">
                <label for="playlist_name">Playlist Name:</label>
                <input type="text" id="playlist_name" name="playlist_name" required>
                <button type="submit">Save</button>
            </form>
            <a href="#" id="closePopup" class="close-btn">×</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openButton = document.getElementById('openPopup');
            const closeButton = document.getElementById('closePopup');
            const popup = document.getElementById('popup');

            openButton.addEventListener('click', function() {
                popup.style.display = 'flex';
            });

            closeButton.addEventListener('click', function() {
                popup.style.display = 'none';
            });

            // Form submission
            const playlistForm = document.getElementById('playlistForm');
            playlistForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent form submission
                // Here you can add code to handle form submission via AJAX or other methods
                // For now, let's just close the popup
                popup.style.display = 'none';
            });
        });
    </script>
</body>
</html>