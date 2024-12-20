<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Sanitize the input
    $userId = $conn->real_escape_string($userId);
    
    // Delete user from database
    $sql = "DELETE FROM users WHERE user_id = '$userId'";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
    exit();
}

$conn->close();
?>
