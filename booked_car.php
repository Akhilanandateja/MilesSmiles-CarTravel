<?php
session_start(); // Start or resume a session

include 'connect.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

$user_email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs if necessary
    $car_name = isset($_POST['car_name']) ? $_POST['car_name'] : '';
    $price_per_day = isset($_POST['price_per_day']) ? $_POST['price_per_day'] : 0;
    $seating_capacity = isset($_POST['seating_capacity']) ? $_POST['seating_capacity'] : 0;
    $ac_status = isset($_POST['ac_status']) ? $_POST['ac_status'] : '';
    $image_url = isset($_POST['image_url']) ? $_POST['image_url'] : '';

    // Prepare the message for WhatsApp
    $whatsapp_message = "Hi! I would like to book the following car:\n";
    $whatsapp_message .= "Car Name: $car_name\n";
    $whatsapp_message .= "Price per Day: ₹$price_per_day\n";
    $whatsapp_message .= "Seating Capacity: $seating_capacity persons\n";
    $whatsapp_message .= "AC Status: $ac_status\n";
    $whatsapp_message .= "Image URL: $image_url";

    // URL encode the message for inclusion in the WhatsApp URL
    $encoded_message = rawurlencode($whatsapp_message);

    // Construct the WhatsApp URL with the pre-filled message
    $whatsapp_url = "https://api.whatsapp.com/send?phone=+918328632167&text=$encoded_message";

    // Insert into booked_car table
    $query = "INSERT INTO booked_car (car_name, price_per_day, seating_capacity, ac_status, image_url, email)
              VALUES ('$car_name', $price_per_day, $seating_capacity, '$ac_status', '$image_url', '$user_email')";

    if (mysqli_query($conn, $query)) {
        // Redirect to WhatsApp or any other page after successful booking
        header("Location: $whatsapp_url");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
