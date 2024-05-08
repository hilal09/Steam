<?php
require 'db_connection.php';  // Ensure this points to your actual database connection script
// require 'profile_functions.php';  // Include your existing profile functions

$userId = $_POST['userId'];  // Assuming you're passing the user ID somehow (e.g., hidden form field)

// Now handle other profile updates (e.g., name, email, password)
// Assuming you have form fields for these and are passing them via POST
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    // Update other fields in your database
if (isset($_POST['cat1'])){
    $avatar = "cat1.jpg";
} elseif (isset($_POST['cat2'])){
    $avatar = "cat2.jpg";
} elseif (isset($_POST['cat3'])){
    $avatar = "cat3.jpg";
} elseif (isset($_POST['cat4'])){
    $avatar = "cat4.jpg";
}

$sql = "UPDATE user_accounts SET avatar = '$avatar' , name = '$name' , email = '$email' WHERE id = $userId";
$result = $conn->query($sql);
if ($result){
    header('Location: ../pages/profile.php');
    exit;
}

// header('Location: ../pages/profile.php');
// exit;
// Fetch updated user data to confirm changes or redisplay the form
// $userData = getUserProfileData($userId);
// Output or return $userData as needed for your application
?>