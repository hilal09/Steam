<?php
session_start(); // Add session_start() at the beginning

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Redirect the user to the dashboard page if logged in
    header("Location: ../pages/dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Steam</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
    <body>
        <h1>Sign In to Steam</h1>
        <div class="login_register_container">
            <form action="../functions/login_.php" method="POST">
            <!––damit Error-Anzeige auftaucht-->
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
                <label>E-Mail Address </label>
                <input type="text" name="email" placeholder="Email Address" ><br>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" ><br>

                <p class="register-link">Didn't sign up yet? <a href="registration.php">Click here to register.</a></p>

                <button type="submit">Sign In</button>
            </form>
        </div>
    </body>
</html>
