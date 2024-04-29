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

                <label>Name</label>
                <input type="text" name="name" placeholder="Name" required>
                <label>E-Mail Address</label>
                <input type="text" name="email" placeholder="Email Address" required>
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>
                
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </body>
</html>