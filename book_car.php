<?php
// Include the database connection file
include 'connect.php';

// Start the session and get the user's email
session_start();
$user_email = $_SESSION['email']; // assuming email is stored in session

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $car_name = $_POST['car_name'];
    $price_per_day = $_POST['price_per_day'];
    $seating_capacity = $_POST['seating_capacity'];
    $ac_status = $_POST['ac_status'];
    $user_email = $_POST['user_email']; // Get user email from form data

    // Insert the booking details into the 'bookings' table
    $query = "INSERT INTO car_bookings (car_name, price_per_day, seating_capacity, ac_status, user_email) VALUES ('$car_name', '$price_per_day', '$seating_capacity', '$ac_status', '$user_email')";

    if (mysqli_query($conn, $query)) {
        // Return success message
        echo 'success';
    } else {
        // Return error message
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid request method';
}
?>
