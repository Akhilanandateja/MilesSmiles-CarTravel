<?php
// Include the database connection file
include 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $car_id = $_POST['car_id'];
    $user_email = $_POST['user_email'];

    // Query to fetch specific car details from 'cars' table
    $query_car = "SELECT car_name, price_per_day, seating_capacity, ac_status FROM cars WHERE car_id = $car_id";
    $result_car = mysqli_query($conn, $query_car);

    if ($result_car && mysqli_num_rows($result_car) > 0) {
        // Fetch car details
        $row_car = mysqli_fetch_assoc($result_car);
        $car_name = $row_car['car_name'];
        $price_per_day = $row_car['price_per_day'];
        $seating_capacity = $row_car['seating_capacity'];
        $ac_status = $row_car['ac_status'];

        // Insert into 'cars_bookings' table
        $insert_query = "INSERT INTO cars_bookings (car_name, price_per_day, seating_capacity, ac_status, user_email) 
                         VALUES ('$car_name', $price_per_day, $seating_capacity, '$ac_status', '$user_email')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Redirect after successful booking
            header("Location: https://example.com/thank-you.php"); // Replace with your actual thank you page URL
            exit();
        } else {
            // Handle query error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // No car found with the given ID
        echo "Error: Car not found";
    }
}
?>
