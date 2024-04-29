<nav class="navbar">
    <ul>
        <li><a href="../pages/dashboard.php" <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'class="active"'; ?>>Home</a></li>
        <li><a href="../pages/search.php" <?php if(basename($_SERVER['PHP_SELF']) == 'search.php') echo 'class="active"'; ?>>Search</a></li>
        <li><a href="../pages/watching.php" <?php if(basename($_SERVER['PHP_SELF']) == 'watching.php') echo 'class="active"'; ?>>Watching</a></li>
        <li><a href="../pages/watchedlist.php" <?php if(basename($_SERVER['PHP_SELF']) == 'watchedlist.php') echo 'class="active"'; ?>>Watched</a></li>
        <li><a href="../pages/wishlist.php" <?php if(basename($_SERVER['PHP_SELF']) == 'wishlist.php') echo 'class="active"'; ?>>Wishlist</a></li>
        <li><a href="../pages/profile.php" <?php if(basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'class="active"'; ?>>Profile</a></li>
    </ul>
</nav>