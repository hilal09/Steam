<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Steam</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <h1>Steam</h1>

    <div class="container">

        <form action="../functions/login.php" method="POST">
            <h2>Login</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label>E-Mail Address </label>
            <input type="text" name="email" placeholder="Email Address" required><br>
            
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required><br>
            
            <p class="register-link">Didn't sign up yet? <a href="registration.php">Click here to register.</a></p>
            
            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
