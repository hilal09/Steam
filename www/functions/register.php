<?php
include 'db_connection.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate inputs
if (empty($name) || empty($email) || empty($password)) {
    header("Location: ../pages/registration.php?error=Please fill in the fields.");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../pages/registration.php?error=Invalid e-mail.");
    exit();
}

// Check if the email is already registered
$sql = "SELECT id FROM user_accounts WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Email already exists
    header("Location: ../pages/registration.php?error=E-mail taken.");
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user into the database
$sql = "INSERT INTO user_accounts (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $hashed_password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    // Get the ID of the newly inserted user
    $user_id = $stmt->insert_id;

    // Insert three playlists for the user
    $playlist_names = array("Watched", "Currently watching", "Wishlist");
    foreach ($playlist_names as $playlist_name) {
        $sql = "INSERT INTO my_playlists (user_id, playlist_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $playlist_name);
        $stmt->execute();
    }

    // Redirect to dashboard page
    header("Location: ../pages/dashboard.php");
    exit();
} else {
    // Registration failed
    header("Location: ../pages/registration.php?error=registrationfailed");
    exit();
}


$stmt->close();
$conn->close();
?>
