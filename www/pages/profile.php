<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <?php include "../functions/navigation.php"; ?>
    <div class="profile-container">
        <aside class="profile-sidebar">
            <div class="profile-user-card">
                <div class="profile-user-avatar">
                    <img src="path_to_avatar.jpg" alt="User Avatar">
                </div>
                <div class="profile-user-info">
                    <h2>Anna Muller</h2>
                </div>
            </div>
            <nav class="profile-navigation">
                <ul>
                    <li><a href="#profile-section" class="nav-link active"><span class="icon icon-user"></span> My Account</a></li>
                    <li><a href="#settings-section" class="nav-link"><span class="icon icon-cog"></span> Settings</a></li>
                    <li><a href="#logout-section" class="nav-link"><span class="icon icon-sign-out"></span> Log out</a></li>
                </ul>
            </nav>
        </aside>
        <main class="profile-main">
            <section id="profile-section" class="profile-content active">
                <h1>My Account</h1>
                <form class="account-form" action="profile_update.php" method="POST" enctype="multipart/form-data">
                    <div class="account-profile-picture">
                        <img src="<?php echo $userData['avatar'] ?? 'path_to_default_avatar.jpg'; ?>" alt="Profile Picture" class="profile-picture">
                        <input type="file" name="avatar" accept="image/*">
                        <button type="submit" class="change-photo-button">Upload Photo</button>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Full Name</label>
                        <input type="text" id="full-name" name="full_name" value="Anna Muller">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="anna.muller@email.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <button type="submit" class="save-changes-button">Save Changes</button>
                </form>
            </section>
            <section id="settings-section" class="profile-content">
                <h1>Settings</h1>
                <form class="settings-form">
                    <div class="form-group">
                        <h2>Change Email</h2>
                        <label for="current-email">Current email</label>
                        <input type="email" id="current-email" name="current_email" value="anna.muller@email.com">
                        <label for="new-email">New Email</label>
                        <input type="email" id="new-email" name="new_email">
                        <button type="button" class="btn-confirm">Confirm</button>
                    </div>
                    <div class="form-group">
                        <h2>Change Password</h2>
                        <label for="current-password">Current password</label>
                        <input type="password" id="current-password" name="current_password">
                        <label for="new-password">New password</label>
                        <input type="password" id="new-password" name="new_password">
                        <button type="button" class="btn-confirm">Confirm</button>
                    </div>
                    <div class="form-group">
                        <h2>Account Removal</h2>
                        <button type="button" class="btn-delete-account">Delete my account</button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <script>
        // JavaScript for toggling the active section based on the navigation link clicked
        document.addEventListener('DOMContentLoaded', (event) => {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('.profile-content');

            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    
                    // Remove active class from all links and sections
                    navLinks.forEach(link => link.classList.remove('active'));
                    sections.forEach(section => section.classList.remove('active'));
                    
                    // Add active class to clicked link and corresponding section
                    link.classList.add('active');
                    const activeSection = document.querySelector(link.getAttribute('href'));
                    if (activeSection) {
                        activeSection.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>

