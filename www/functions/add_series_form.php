<h3>Neue Serie zur Playlist hinzufügen:</h3>
<form action="../functions/add_series_to_playlist.php" method="POST">
    <input type="hidden" name="playlist_id" value="<?php echo $playlistId; ?>"> <!-- Angenommen, $playlistId ist die ID der Playlist -->
    <input type="text" name="title" placeholder="Titel" required>
    <input type="text" name="year" placeholder="Jahr" required>
    <input type="text" name="genre" placeholder="Genre" required>
    <input type="text" name="platform" placeholder="Plattformen" required>
    <input type="text" name="seasons" placeholder="Staffeln" required>
    <input type="submit" value="Hinzufügen">
</form>