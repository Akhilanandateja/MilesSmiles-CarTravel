<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $rating = $_POST['rating']; // Assuming ratings are from 1 to 5
    $email = $_SESSION['email']; // Assuming the user is logged in and email is stored in session

    // Insert rating into database
    $sql = "INSERT INTO ratings (car_id, email, rating) VALUES ('$car_id', '$email', '$rating')";

    if (mysqli_query($conn, $sql)) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
