<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $reviewId = $_GET['id'];

    // Delete review
    $sql = "DELETE FROM reviews WHERE id=$reviewId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_reviews.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
