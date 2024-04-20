<nav class="navbar">
    <ul>
        <li><a href="../pages/dashboard.php" <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'class="active"'; ?>>Home</a></li>
        <li><a href="../pages/search.php" <?php if(basename($_SERVER['PHP_SELF']) == 'search.php') echo 'class="active"'; ?>>Search</a></li>
        <li><a href="../pages/watchlist.php" <?php if(basename($_SERVER['PHP_SELF']) == 'watchlist.php') echo 'class="active"'; ?>>Watchlist</a></li>
        <li><a href="../pages/watchedlist.php" <?php if(basename($_SERVER['PHP_SELF']) == 'watchedlist.php') echo 'class="active"'; ?>>Watchedlist</a></li>
        <li><a href="../pages/profile.php" <?php if(basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'class="active"'; ?>>Profile</a></li>
    </ul>
    <!-- suche nur auf search page test test -->
    <?php if(basename($_SERVER['PHP_SELF']) == 'search.php'): ?>
        <form action="../functions/search_handler.php" method="GET">
            <input type="text" name="query" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    <?php endif; ?>
</nav>