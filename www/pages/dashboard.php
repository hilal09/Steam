<?php
/**
 * Author: Zeinab Barakat (add series functionality), Hilal Cubukcu(get series), Yudum Yilmaz (initial layout)
 * Last modified on: 12.05.2024
 * Title: Dashboard Page 
 * Summary: This page displays the dashboard for logged-in users. It retrieves series data for the current user and allows users to add new series.
 */

 session_start();

 if (!isset($_SESSION['user_id'])) {
     header("Location: ../pages/index.php");
     exit();
 }
 
 include "../functions/db_connection.php";
 
 $user_id = $_SESSION['user_id'];
 
 $stmt = $conn->prepare("SELECT * FROM my_series WHERE user_id = ?");
 $stmt->bind_param("i", $user_id);
 $stmt->execute();
 $result = $stmt->get_result();
 
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
         .popup {
             background-color: rgba(0, 0, 0, 0.7);
             padding: 20px;
             border-radius: 15px;
             text-align: center;
             position: absolute;
             top: 50%;
             transform: translateY(-50%);
             left: 50%;
             transform: translate(-50%, -50%);
             width: 98%; 
             max-width: 400px;
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
             width: auto;
             padding: 8px 16px;
             bottom: 5px;
             right: 10px;
             position: absolute; 
             background: #eee;
             color: #111;
             border: none;
             outline: none;
             border-radius: 4px;
             cursor: pointer;
             transition: background-color 0.3s ease;
         }
 
         .popup form button[type="submit"]:hover {
             background-color: #ddd; 
         }
         .popup > * {
             margin: 15px 0px;
         }
 
         .popup input[type="text"],
         .popup input[type="number"],
         .popup select,
         .popup select option,
         .popup button[type="submit"] {
             color: black;
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
             filter: blur(10px);
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
             position: relative;
             width: 200px;
             height: 300px;
             background-color: #14143c;
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
             color: white;
             border: none;
             border-radius: 8px;
             font-size: 25px;
             cursor: pointer;
             margin: 20px; 
             display: flex;
             align-items: center;
             justify-content: center;
             text-align: center;
             text-decoration: none;
             z-index: 2; 
         }
 
         .dashboard-container {
             display: flex;
             flex-direction: column;
             align-items: center;
         }
 
         .series-list {
             display: flex;
             flex-wrap: wrap;
             justify-content: center;
             margin-top: 100px;
             margin-left: 150px;
             margin-right: 150px; 
         }
 
         .series-item {
             position: relative;
             width: 200px;
             height: 300px;
             overflow: hidden;
             border-radius: 8px;
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
             cursor: pointer;
             transition: transform 0.3s;
             margin: 20px;
         }
 
         .series-item:hover {
             transform: scale(1.05);
             box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
         }
 
         .series-item img {
             width: 100%;
             height: 100%;
             object-fit: cover;
             border-radius: 10px;
             transition: opacity 0.3s;
         }
 
         .series-item:hover img {
             opacity: 0.5;
         }
 
         .series-item-info {
             position: absolute;
             bottom: 0;
             left: 0;
             right: 0;
             background-color: rgba(0, 0, 0, 0.7);
             padding: 5px;
             color: white;
             font-size: 12px;
             opacity: 0;
             transition: opacity 0.3s;
         }
 
         .series-item:hover .series-item-info {
             opacity: 1;
         }
 
         .delete-btn {
             position: absolute;
             top: 5px;
             left: 5px;
             width: auto;
             height: 20px;
             background-color: #CD3333;
             color: #fff;
             border: none;
             border-radius: 4px;
             cursor: pointer;
             display: flex;
             align-items: center;
             justify-content: center;
             font-size: 15px;
             opacity: 1;
         }
         .delete-btn:hover {
             background-color: #fff; 
             color: #CD3333; 
         }
 
     </style>
 </head>
 <body>
 
     <?php include "../widgets/navigation.php"; ?>
     <?php include "../widgets/logo.php"; ?>
 
     <div class="content">
         <div class="dashboard-container">
             <div class="series-list">
             <button class="open-popup">Add new series</button>
                 <?php while ($row = $result->fetch_assoc()) { ?>
                     <!-- Serie anzeigen -->
                     <div class="series-item">
                         <!-- Delete button --> 
                         <img src="data:image/jpg;base64,<?php echo base64_encode($row['picture']); ?>" alt="<?php echo $row['title']; ?>">
                         <div class="series-item-info">
                             <p><?php echo $row['title']; ?></p>
                             <p>Year: <?php echo $row['year']; ?></p>
                             <p>Seasons: <?php echo $row['seasons']; ?></p>
                             <p>Genre: <?php echo $row['genre']; ?></p>
                             <p>Platform: <?php echo $row['platform']; ?></p>
                         </div>
                         <button type="button" value="1" name="delete-series" class="delete-btn" data-series-id="<?php echo $row['id']; ?>">Delete</button>
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
             <input type="number" class="year" name="year" required min="1895" max="2024">
 
             <label for="seasons">Seasons:</label>
             <input type="number" class="seasons" name="seasons" required min="0">
 
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
                 <option value="Sci-Fi">Sci-fi</option>
                 <option value="Thriller">Thriller</option>
                 <option value="Western">Western</option>
                 <option value="Other">Other</option>
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
 document.addEventListener("DOMContentLoaded", function() {
     // Function to toggle popup and disable/enable form elements
     function togglePopup(active) {
         const popup = document.querySelector(".popup");
         const formElements = document.querySelectorAll(".popup input, .popup select, .popup button");
 
         if (active) {
             // Activate popup
             document.body.classList.add("active-popup");
             popup.style.opacity = 1;
             popup.style.top = "50%";
             popup.style.marginTop = "0px";
 
             // Disable form elements
             formElements.forEach(function(element) {
                 element.disabled = false;
             });
         } else {
             // Deactivate popup
             document.body.classList.remove("active-popup");
             popup.style.opacity = 0;
             popup.style.top = "-100%";
             popup.style.marginTop = "-20px";
 
             // Enable form elements
             formElements.forEach(function(element) {
                 element.disabled = true;
             });
         }
     }
 
     // Initially disable form elements and hide popup
     togglePopup(false);
 
 
     document.querySelectorAll(".open-popup").forEach(function(button) {
         button.addEventListener("click", function(){
             togglePopup(true);
             // Scrollen zum Anfang der Seite
             window.scrollTo(0, 0);
         });
     });
 
     document.querySelector(".popup .close-btn").addEventListener("click", function(){
         togglePopup(false);
         
 
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
                 togglePopup(false);
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
 
     document.querySelectorAll(".delete-btn").forEach(function(button) {
         button.addEventListener("click", function(){
             console.log("Delete button clicked");
             var seriesId = button.getAttribute("data-series-id");
 
             // Display confirmation message (you can customize this)
             var confirmDelete = confirm("Are you sure you want to delete this series?");
             console.log("Series ID:", seriesId);
             // If user confirms deletion
             if (confirmDelete) {
                 // Send an AJAX request to delete the series
                 fetch("../functions/delete_series.php", {
                     method: "POST",
                     body: "series_id=" + seriesId
                 })
                 .then(response => {
                     if (response.ok) {
                         // Refresh the page after deletion
                         location.reload();
                     } else {
                         console.error("Failed to delete series");
                     }
                 })
                 .catch(error => {
                     console.error("Error:", error);
                 });
             }
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
 });
 
 </script>
 
 </body>
 </html>