<?php
//require 'db_connection.php';  // Ensure this points to your actual database connection script
// require 'profile_functions.php';  // Include your existing profile functions

$userId = $_POST['userId'];  // Assuming you're passing the user ID somehow (e.g., hidden form field)

// Check if image file is a actual image or fake image
$target_dir = '../uploads/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
echo $target_file."<br>";
//die();
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
    
    // Check if file already exists
if (file_exists($target_file)) {
    echo "<br>Sorry, file already exists.<br>";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<br>Sorry, your file is too large.<br>";
    $uploadOk = 0;
  }


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<br>Sorry, your file was not uploaded.<br>";
  // if everything is ok, try to upload file
  } else {
    echo "<br>uploading<br>";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "<br>The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br>";
    } else {
      echo "<br>Sorry, there was an error uploading your file.<br>";
    }
  }


// Now handle other profile updates (e.g., name, email, password)
// Assuming you have form fields for these and are passing them via POST
if ($uploadOk) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Update other fields in your database
}
// header('Location: ../pages/profile.php');
// exit;
// Fetch updated user data to confirm changes or redisplay the form
// $userData = getUserProfileData($userId);
// Output or return $userData as needed for your application
?>