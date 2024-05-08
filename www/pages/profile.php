<?php
session_start();
require '../functions/db_connection.php';
$user_ID = $_SESSION['user_id'];
$sql = "SELECT * FROM user_accounts WHERE id = $user_ID";

//$stmt = $conn->prepare($sql);
//$stmt->bind_param("d", 1);
// $stmt->execute();
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $user_ID = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
        $avatar = $row['avatar'];
        //echo $user_ID." ". $name." ". $email." ". $avatar." ";
    }
}
?>

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
                    <img src="../uploads/avatars/<?php echo $avatar ?>"  alt="User Avatar">
                </div>
                <div class="profile-user-info">
                    <h2><?php echo $name; ?></h2>
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
                <form class="account-form" action="../functions/profile_function.php" method="POST" enctype="multipart/form-data">
                    <!--
                        Calling the actual user data from the database.
                     -->
                    <input type="hidden" name="userId" value="<?php echo $user_ID ?>">
                    <div class="form-group">
                        <label for="full-name">Name</label>
                        <input type="text" id="full-name" name="full_name" value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <ul>
                        <li><input type="radio" name="cat1" id="cb1" />
                            <label for="cb1"><img src="../uploads/avatars/cat1.jpg" /></label>
                        </li>
                        <li><input type="radio" name="cat2" id="cb2" />
                            <label for="cb2"><img src="../uploads/avatars/cat2.jpg" /></label>
                        </li>
                        <li><input type="radio" name="cat3" id="cb3" />
                            <label for="cb3"><img src="../uploads/avatars/cat3.jpg" /></label>
                        </li>
                        <li><input type="radio" name="cat4" id="cb4" />
                            <label for="cb4"><img src="../uploads/avatars/cat4.jpg" /></label>
                        </li>
                        </ul>
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
                        <input type="email" id="current-email" name="current_email" value="<?php echo $email ?>">
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

