<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user details
$sql_user = "SELECT firstName, lastName,password, email FROM users WHERE email = ?";
$stmt_user = $conn->prepare($sql_user);
if ($stmt_user === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}

$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

if (!$user) {
    die("User not found");
}

$stmt_user->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    
    <title>Edit Profile</title>
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: black;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 20px;
        }

        .wrapper {
            width: 100%;
            margin-top: -50px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 80px;
            padding-top: 10px;
        }

        .profile {
            background-color: black;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
            text-align: center;
        }

        .detail {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            color: white;
        }

        .emoji {
            font-size: 20px;
            margin-right: 10px;
        }

        strong {
            font-weight: bold;
            width: 150px; /* Adjust width to create space */
            display: inline-block;
        }

        input[type="text"],
        input[type="password"] {
            padding: 8px;
            width: calc(100% - 32px); /* Adjust width for the eye icon */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-right: 8px; /* Space between input and eye icon */
        }

        /* Button styles */
        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .update-button button,
        .cancel-button button {
            color: #FF4C4C;
            text-decoration: underline;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%; /* Ensure button takes full width */
            background-color: black;
        }

        .update-button button:hover,
        .cancel-button button:hover {
            color: #FF4C4C;
        }

        hr {
            margin-bottom: 18px;
            margin-top: 20px;
        }

        .link-container {
    width: 30%;
    left: 20%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.link-container a {
    text-decoration: none;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
    width: 48%;
    text-align: center;
  /* Set the background color */
   clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%); /* Create a rhombus shape */
}

        .edit1-profile {
            background-color: #FF4C4C;
        }

        .view-profile {
            background-color: black;
        }

        .view-bookings {
            background-color: black;
        }

        .password-toggle {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle input {
            width: 100%;
            padding-right: 32px; /* Space for the eye icon */
        }

        .toggle-password {
            position: absolute;
            right: 8px;
            cursor: pointer;
        }
        .toggle-password i{
            color:black;
            font-size: 15px;
        }
    </style>
    <script>
        function confirmCancel() {
            var confirmation = confirm("Do you want to cancel the process or keep editing?");
            if (confirmation) {
                window.location.href = "profile.php";
            }
        }
function togglePassword(inputId) {
    var input = document.getElementById(inputId);
    var icon = input.nextElementSibling.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="link-container">
        <a href="profile.php" class="view-profile">Profile</a>
            <a href="edit_profile.php" class="edit1-profile">Edit Profile</a>
            <a href="booking_details.php" class="view-bookings">Bookings</a>
        </div>
<br><br>
    <div class="wrapper">
        <div class="profile edit-profile">
            <h2>Edit Profile</h2><br><br>
            <form action="update_profile.php" method="post">
                <div class="detail">
                    <span class="emoji"><i class="fa-solid fa-user"></i></span>
                    <strong>First Name:</strong>
                    <input type="text" name="firstName" value="<?php echo htmlspecialchars($user['firstName']); ?>" required>
                </div>
                <div class="detail">
                    <span class="emoji"><i class="fa-solid fa-user"></i></span>
                    <strong>Last Name:</strong>
                    <input type="text" name="lastName" value="<?php echo htmlspecialchars($user['lastName']); ?>" required>
                </div>
                <div class="detail">
                    <span class="emoji"><i class="fa-solid fa-lock"></i></span>
                    <strong>Current Password:</strong>
                    <div class="password-toggle">
                        <input type="password" name="password" id="currentPassword" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                        <span class="toggle-password" onclick="togglePassword('currentPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="detail">
                    <span class="emoji"><i class="fa-solid fa-lock"></i></span>
                    <strong>New Password:</strong>
                    <div class="password-toggle">
                        <input type="password" name="newPassword" id="newPassword" required>
                        <span class="toggle-password" onclick="togglePassword('newPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="detail">
                    <span class="emoji"><i class="fa-solid fa-lock"></i></span>
                    <strong>Confirm New Password:</strong>
                    <div class="password-toggle">
                        <input type="password" name="confirmNewPassword" id="confirmNewPassword" required>
                        <span class="toggle-password" onclick="togglePassword('confirmNewPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="button-container">
                    <div class="cancel-button">
                        <button type="submit">Update</button>
                        <button type="button" onclick="confirmCancel()">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
    <?php include 'footer.php'; ?>
    </div>
</body>
</html>
