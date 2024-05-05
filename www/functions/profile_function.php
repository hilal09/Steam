<?php
require '_db_connection.php';  // Ensure this points to your actual database connection script
require 'profile_functions.php';  // Include your existing profile functions

$userId = $_POST['userId'];  // Assuming you're passing the user ID somehow (e.g., hidden form field)

// First, handle the image upload if a file was provided
if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["error"] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($check !== false) {
        // Try to upload file
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            // File is valid and was successfully uploaded, now update the database
            $sql = "UPDATE users SET avatar = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $target_file, $userId);
            $stmt->execute();
        } else {
            $uploadOk = 0;
        }
    } else {
        $uploadOk = 0;
    }
}

// Now handle other profile updates (e.g., name, email, password)
// Assuming you have form fields for these and are passing them via POST
if ($uploadOk) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Update other fields in your database
}

// Fetch updated user data to confirm changes or redisplay the form
$userData = getUserProfileData($userId);
// Output or return $userData as needed for your application
?>

