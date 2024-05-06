<nav class="navbar">
    <ul>
    <a href="../functions/logout.php">Logout</a>

        <li><a href="../pages/dashboard.php" <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'class="active"'; ?>>Home</a></li>
        <li><a href="../pages/search.php" <?php if(basename($_SERVER['PHP_SELF']) == 'search.php') echo 'class="active"'; ?>>Search</a></li>
        <li><a href="../pages/profile.php" <?php if(basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'class="active"'; ?>>Profile</a></li>
    </ul>
</nav>