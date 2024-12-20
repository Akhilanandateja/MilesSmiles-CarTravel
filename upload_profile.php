<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Check if a file was uploaded
if ($_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['profile_pic']['tmp_name'];
    $file_name = basename($_FILES['profile_pic']['name']);
    $upload_dir = 'profile_pics/'; // Directory where images will be stored
    $upload_path = $upload_dir . $file_name; // Path to save in database

    // Move the uploaded file to the desired directory
    if (move_uploaded_file($file_tmp, $upload_path)) {
        // Update the users table with the profile picture path
        $sql_update = "UPDATE users SET profile_pic = ? WHERE email = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ss", $upload_path, $email);
        
        if ($stmt_update->execute()) {
            // Profile picture updated successfully
            header("Location: profile.php"); // Redirect to profile page
            exit();
        } else {
            die("Error updating profile picture: " . htmlspecialchars($stmt_update->error));
        }
    } else {
        die("Error uploading file.");
    }
} else {
    die("Error: " . $_FILES['profile_pic']['error']);
}

$stmt_update->close();
$conn->close();
?>
