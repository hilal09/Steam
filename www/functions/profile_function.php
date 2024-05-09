<?php
session_start();
require 'db_connection.php'; 

$userId = $_POST['userId']; 

if (isset($_POST['delete-account'])){
    $sql = "DELETE FROM user_accounts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        header('Location: ../pages/registration.php');
        exit;
    }
}


$name = $_POST['full_name'];
$email = $_POST['email'];
$avatar = '';

if (isset($_POST['cat1'])) {
    $avatar = "cat1.jpg";
} elseif (isset($_POST['cat2'])) {
    $avatar = "cat2.jpg";
} elseif (isset($_POST['cat3'])) {
    $avatar = "cat3.jpg";
} elseif (isset($_POST['cat4'])) {
    $avatar = "cat4.jpg";
} else {
    if (isset($_SESSION['avatar'])) {
        $avatar = $_SESSION['avatar'];
    }
}

$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE user_accounts SET avatar = ?, name = ?, email = ?, password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $avatar, $name, $email, $hashed_password, $userId);

if ($stmt->execute()) {
    header('Location: ../pages/profile.php');
    exit;
} else {
    // Handle update failure
    echo "Update failed: " . $conn->error;
}

?>
