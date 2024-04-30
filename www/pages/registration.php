<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Steam</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
    <body>
        <h1>Sign Up to Steam</h1>

        <div class="login_register_container">
            <form action="../functions/register.php" method="POST">
                <!-- Damit Error angezeigt wird -->
                <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <label>Name</label>
                <input type="text" name="name" placeholder="Name">
                <label>E-Mail Address</label>
                <input type="text" name="email" placeholder="Email Address">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
                
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </body>
</html>