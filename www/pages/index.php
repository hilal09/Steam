<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Steam</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
        <h2>Login to Steam</h2>
        <form action="your-login-script.php" method="POST">
            <input type="text" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <p class="register-link">Didn't sign up yet? <a href="registration.php">Click here to register.</a></p>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
