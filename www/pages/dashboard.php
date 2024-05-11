<?php
/**
 * Author: Zeinab Barakat, Hilal Cubukcu(get series)
 * Title: Dashboard Page 
 * Summary: This page displays the dashboard for logged-in users. It retrieves series data for the current user and allows users to add new series.
 */

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: ../pages/index.php");
    exit();
}

// Include the database connection
include "../functions/db_connection.php";

// Define the user ID
$user_id = $_SESSION['user_id'];

// Fetch series data for the current user
$stmt = $conn->prepare("SELECT * FROM my_series WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Close the database connection
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


    <style>
        .content {
            min-height: 100vh;
            transition: filter 0ms ease-in-out 0ms;
        }
        .popup {
            background-color: rgba(0, 0, 0, 0.7); /* Dunkler Hintergrund */            padding: 20px;
            border-radius: 15px;
            text-align: center;
            /* Center vertically */
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            /* Center horizontally */
            left: 50%;
            transform: translate(-50%, -50%);
            width: 98%; /* Adjust width as needed */
            max-width: 400px; /* Set max-width to prevent the form from taking up the whole page */
            opacity: 0;
            transition: top 0ms ease-in-out 300ms, opacity 300ms ease-in-out, margin-top 300ms ease-in-out;
            z-index: 1;
        }
        
        .popup form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .popup form label {
            margin-bottom: 5px;
        }

        .popup form input,
        .popup form select {
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
            box-sizing: border-box;
        }

        .popup form button[type="submit"] {
            width: auto; /* Automatische Breite basierend auf dem Textinhalt */
            padding: 8px 16px; /* Innenabstand für den Button */
            bottom: 5px;
            right: 10px;
            position: absolute; 
            background: #eee;
            color: #111;
            border: none;
            outline: none;
            border-radius: 4px; /* Eckenradius für den rechteckigen Button */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Übergangseffekt für Hover */
        }

        .popup form button[type="submit"]:hover {
            background-color: #ddd; /* Hintergrundfarbe ändern, wenn der Mauszeiger über dem Button ist */
        }
        .popup > * {
            margin: 15px 0px;
        }

        .popup input[type="text"],
        .popup input[type="number"],
        .popup select,
        .popup select option,
        .popup button[type="submit"] {
            color: black; /* Ändere die Schriftfarbe der Eingabefelder und des Buttons auf Schwarz */
        }

        .popup .close-btn {
            position: absolute;
            top: -5px;
            right: 10px;
            width: 20px;
            height: 20px;
            background: #eee;
            color: #111;
            border: none;
            outline: none;
            border-radius: 50%;
            cursor: pointer;
        }

        body.active-popup {
            overflow: hidden; 
        }

        body.active-popup .content {
            filter: blur(5px);
            background: rgba(0, 0, 0, 0.08);
            transition: filter 0ms ease-in-out 0ms;

        }

        body.active-popup .popup {
            top: 50%;
            opacity: 1;
            margin-top: 0px;
            transition: top 0ms ease-in-out 0ms, opacity 300ms ease-in-out, margin-top 300ms ease-in-out;

        }

        .open-popup {
            width: 150px;
            height: 200px;
            background-color: #14143c;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-decoration: none;
        }

        /* Styling für das Dashboard */
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start; /* Den Container oben ausrichten */
            gap: 20px;
        }

        .series-item {
            position: relative; /* Position relativ für Hover-Effekt */
            width: 150px; /* Breite für die Serie */
            height: 200px; /* Höhe für die Serie */
            overflow: hidden; /* Verhindert das Überlaufen von Inhalten */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            cursor: pointer; /* Zeige Handcursor beim Hover an */
            transition: transform 0.3s; /* Übergangseffekt für Hover */
        }

        .series-item:hover {
            transform: scale(1.05); /* Vergrößere das Bild beim Hover */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Erhöhe den Schatten beim Hover */
        }

        .series-item img {
            width: 100%; /* Bildbreite 100% des Elternelements */
            height: 100%; /* Bildhöhe 100% des Elternelements */
            object-fit: cover; /* Behalte das Seitenverhältnis bei und fülle das Element */
            transition: opacity 0.3s; /* Übergangseffekt für Hover */
        }

        .series-item:hover img {
            opacity: 0.5; /* Reduziere die Deckkraft des Bildes beim Hover */
        }

        .series-item-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.7); /* Halbtransparenter Hintergrund */
            padding: 5px;
            color: white;
            font-size: 12px;
            opacity: 0; /* Standardmäßig unsichtbar */
            transition: opacity 0.3s; /* Übergangseffekt für Hover */
        }

        .series-item:hover .series-item-info {
            opacity: 1; /* Informationen anzeigen beim Hover */
        }

        .series-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
    </style>
</head>
<body>

    <?php include "../widgets/navigation.php"; ?>
    <?php include "../widgets/logo.php"; ?>

    <div class="content">
        <!-- Container für die Serien -->
        <div class="dashboard-container">
            <!-- Button zum Hinzufügen von Serien -->
            <button class="open-popup">+</button>
            
            <div class="series-list">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <!-- Serie anzeigen -->
                    <div class="series-item">
                        <img src="data:image/jpg;base64,<?php echo base64_encode($row['picture']); ?>" alt="<?php echo $row['title']; ?>">
                        <div class="series-item-info">
                            <p><?php echo $row['title']; ?></p>
                            <p>Year: <?php echo $row['year']; ?></p>
                            <p>Seasons: <?php echo $row['seasons']; ?></p>
                            <p>Genre: <?php echo $row['genre']; ?></p>
                            <p>Platform: <?php echo $row['platform']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="content">
    <?php while ($row = $result->fetch_assoc()) { ?>
        <!-- Start of series item -->
        <div class="series-item">
            <h3><?php echo $row['title']; ?></h3>
            <p>Year: <?php echo $row['year']; ?></p>
            <p>Seasons: <?php echo $row['seasons']; ?></p>
            <p>Genre: <?php echo $row['genre']; ?></p>
            <p>Platform: <?php echo $row['platform']; ?></p>
            <!-- Display image if available -->
            <?php if ($row['picture']) { ?>
                <img src="data:image/jpg;base64,<?php echo base64_encode($row['picture']); ?>" alt="<?php echo $row['title']; ?>">
            <?php } else { ?>
                <p>No image available</p>
            <?php } ?>
        </div>
        <!-- End of series item -->
    <?php } ?>
</div>


    <div class="popup">
        <button class="close-btn">&times;</button>
        <h2>Add Series</h2>
        <form id="series-form" enctype="multipart/form-data" action="../functions/add_series_function.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" class="title" name="title" required>

            <label for="year">Year:</label>
            <input type="number" class="year" name="year" required>

            <label for="seasons">Seasons:</label>
            <input type="number" class="seasons" name="seasons" required>

            <label for="genre">Genre:</label>
            <select class="genre" name="genre" required>
                <option value="" disabled selected>Choose Genre</option>
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <option value="animation">Animation</option>
                <option value="comedy">Comedy</option>
                <option value="docu">Documentary</option>
                <option value="drama">Drama</option>
                <option value="fantasy">Fantasy</option>
                <option value="horror">Horror</option>
                <option value="romantic">Romantic</option>
                <option value="sci-fi">Sci-fi</option>
                <option value="thriller">Thriller</option>
                <option value="western">Western</option>
                <option value="other">Other</option>
            </select>

            <label for="platform">Platform:</label>
            <select class="platform" name="platform" required>
                <option value="" disabled selected>Choose Platform</option>
                <option value="amazon prime">Amazon Prime</option>
                    <option value="hbo">HBO</option>
                    <option value="hbo max">HBO Max</option>
                    <option value="hulu">Hulu</option>
                    <option value="netflix">Netflix</option>
                    <option value="nbc">NBC</option>
                    <option value="rtl+">RTL+</option>
                    <option value="other">Other</option>
            </select>

            <label for="picture">Picture:</label>
            <input type="file" class="picture" name="picture" required>

            <button type="submit">Save</button>
        </form>
    </div>
</div>

<script>

    document.querySelectorAll(".open-popup").forEach(function(button) {
        button.addEventListener("click", function(){
            document.body.classList.add("active-popup");
            // Scrollen zum Anfang der Seite
            window.scrollTo(0, 0);

            // Hole den Playlist-Namen aus dem data-Attribut des geklickten Buttons
            var playlistName = this.getAttribute("data-playlist-name");
        
            // Führe AJAX-Anfrage durch, um die Playlist-ID abzurufen
            fetch("../functions/add_series_function.php?playlist_name=" + playlistName)
            .then(response => response.text())
            .then(data => {
                console.log(data); // Hier kannst du die Antwort verarbeiten
                // Zeige das Popup an oder führe andere Aktionen aus
            })
            .catch(error => {
                console.error("Error:", error);
            });


        });
    });

    document.querySelector(".popup .close-btn").addEventListener("click", function(){
        document.body.classList.remove("active-popup");
    });

    // Event listener for form submission
    document.getElementById("series-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        // Fetch the form data
        const formData = new FormData(this);

        // Perform AJAX request to submit the form data
        fetch("../functions/add_series_function.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // If submission is successful, close the popup and reset the form
                document.body.classList.remove("active-popup");
                document.getElementById("series-form").reset(); // Reset the form
                location.reload(); // Reload the page
                // Optionally, you can reload the page or perform other actions
            } else {
                // If submission fails, display an error message or perform other actions as needed
                console.error("Failed to submit series data");
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });

    // Event listener für das Datei-Eingabefeld
    document.querySelector('.picture').addEventListener('change', function() {
        const file = this.files[0]; // Erhalte die ausgewählte Datei
        const fileName = file.name; // Erhalte den Dateinamen
        const fileExtension = fileName.split('.').pop().toLowerCase(); // Erhalte die Dateierweiterung und konvertiere sie in Kleinbuchstaben

    // Überprüfe, ob die Dateierweiterung .jpg oder .png ist
        if (fileExtension !== 'jpg' && fileExtension !== 'png') {
           alert('Bitte wählen Sie eine Datei mit der Erweiterung .jpg oder .png aus.');
           // Setze den Wert des Datei-Eingabefelds auf leer, um die ungültige Datei zu löschen
           this.value = '';
        }
    });
</script>

</body>
</html>