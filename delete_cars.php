<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $carId = $_GET['id'];
    
    // Delete car from database based on car_id
    $sql = "DELETE FROM cars WHERE car_id = $carId"; // Adjust 'car_id' as per your actual column name

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_cars.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Car ID not provided.";
    exit();
}

$conn->close();
?>
