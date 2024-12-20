<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect.php';

$loggedIn = false;
$email = '';
$profilePic = 'images/images.png'; // Default profile picture

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $loggedIn = true;

    // Retrieve the user's profile picture from the database
    $stmt = $conn->prepare("SELECT profile_pic FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($profilePicFromDb);
    $stmt->fetch();
    $stmt->close();

    if (!empty($profilePicFromDb)) {
        $profilePic = $profilePicFromDb;
    }
}

// Close database connection
$conn->close();
?>
<style>
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: black;
    color: #fff;
    flex-wrap: wrap;
}

.header video {
    max-width: 100%;
    height: auto;
}

.header nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}

.header nav ul li {
    margin: 0 10px; /* Adds space between each list item */
    align-items: center;
}

.header nav ul li a {
    color: #fff;
    text-decoration: none;
    margin: 20px;
}

.header nav ul li a:hover {
    text-decoration: underline;
    cursor: pointer;
    color: #FF4C4C;
}

.header .user-profile {
    display: flex;
    align-items: center;
    color: none;
}

.header .user-profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: -10px; /* Reduced margin for less gap */
}

.header .dropdown {
    position: relative;
    display: inline-block;
}

.header .dropdown:hover .dropdown-content {
    display: block;
}

.header .dropbtn {
    padding: 10px;
    background-color: black;
    color: #FF4C4C;
    font-weight: bold;
    font-size: 16px;
    border: none;
    cursor: pointer;
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional shadow effect */
    transition: background-color 0.3s ease; /* Smooth transition */
    margin: 20px;
}

.header .dropbtn:hover {
    background-color: #333;
}

.header .dropdown-content {
    display: none;
    position: absolute;
    right: 0;
    background-color: black;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.header .dropdown-content a {
    color: #FF4C4C;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.header .dropdown-content a:hover {
    background-color: #333;
}

@media (max-width: 768px) {
    .header nav ul {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
    }

    .header nav ul li {
        margin: 10px 0; /* Adds space between each list item in vertical layout */
    }

    .header .user-profile {
        justify-content: center;
        width: 100%;
    }

    .header .dropbtn {
        width: 100%;
        text-align: center;
    }
}
</style>
<header class="header">
    <video width="200" height="100" autoplay loop muted>
        <source src="images/ms3.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <nav>
        <ul>
            <?php if ($loggedIn): ?>
                <li><a href="homepage.php">Home</a></li>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] != '1'): ?>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="book_cars.php">Cars</a></li>
                    <li><a href="faq.php">FAQs</a></li>
                <?php else: ?>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="book_cars.php">Cars</a></li>
                    <li><a href="faq.php">FAQs</a></li>
                    <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li><a href="index.php">Sign Up/Sign In</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="user-profile">
        <?php if ($loggedIn): ?>
            <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture">
            <div class="dropdown">
                <button class="dropbtn"><?php echo htmlspecialchars($email); ?></button>
                <div class="dropdown-content">
                    <a href="profile.php">View Profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="index.php">Sign Up/Sign In</a>
        <?php endif; ?>
    </div>
</header>
