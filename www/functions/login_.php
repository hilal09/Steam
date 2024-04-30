<?php
include "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../pages/index.php?error=E-Mail required.");
        exit();
    }

    // Prepare and execute SQL statement with prepared statements
    $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE email = ?");
    $stmt->bind_param("s", $email); //s bedeutet, dass die Email ein String ist
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];

            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            // Incorrect password
            header("Location: ../pages/index.php?error=Invalid e-mail or password.");
            exit();
        }
    } else {
        // User not found
        header("Location: ../pages/index.php?error=Invalid e-mail or password.");
        exit();
    }
} else {
    header("Location: ../pages/index.php");
    exit();
}
?>
