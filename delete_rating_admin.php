<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $ratingId = $_GET['id'];
    
    // Delete rating based on ID
    $sql = "DELETE FROM ratings WHERE rating_id = $ratingId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_ratings.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Rating ID not provided.";
    exit();
}

$conn->close();
?>
