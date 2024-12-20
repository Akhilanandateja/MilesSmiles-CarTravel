<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $bookingId = $_GET['id'];
    
    // Prepare and bind
    $stmt = $conn->prepare("DELETE FROM booked_car WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingId);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        header("Location: manage_bookings.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Booking ID not provided.";
    exit();
}

$conn->close();
?>
