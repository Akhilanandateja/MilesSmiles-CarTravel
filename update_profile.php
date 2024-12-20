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
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$newPassword = $_POST['newPassword'];
$confirmNewPassword = $_POST['confirmNewPassword'];

// Check if new passwords match
if ($newPassword !== $confirmNewPassword) {
    die("New passwords do not match");
}

// Hash new password
$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

// Update user details
$sql_update = "UPDATE users SET firstName = ?, lastName = ?, password = ? WHERE email = ?";
$stmt_update = $conn->prepare($sql_update);
if ($stmt_update === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}

$stmt_update->bind_param("ssss", $firstName, $lastName, $newPasswordHash, $email);
$stmt_update->execute();

$stmt_update->close();
$conn->close();

header("Location: profile.php");
exit();
?>
