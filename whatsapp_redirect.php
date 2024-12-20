<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve necessary booking details
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $car_id = $_POST['car_id'];  // Assuming you have this in the form

    // Start session if not already started
    session_start();

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Retrieve car details from cars table using car_id
        $query = "SELECT car_name, price_per_day, seating_capacity, ac_status, image_url, car_company, car_type, car_model_year, fuel_type, description FROM cars WHERE car_id = '$car_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $car_name = $row['car_name'];
            $price_per_day = $row['price_per_day'];
            $seating_capacity = $row['seating_capacity'];
            $ac_status = $row['ac_status'];
            $image_url = $row['image_url'];
            $car_company = $row['car_company'];
            $car_type = $row['car_type'];
            $car_model_year = $row['car_model_year'];
            $fuel_type = $row['fuel_type'];
            $description = $row['description'];

            // Insert booking into booked_car table
            $query = "INSERT INTO booked_car (car_name, price_per_day, seating_capacity, ac_status, image_url, booking_date, location, start_date, end_date, email, car_company, car_type, car_model_year, fuel_type, description) 
                      VALUES ('$car_name', '$price_per_day', '$seating_capacity', '$ac_status', '$image_url', NOW(), '$location', '$start_date', '$end_date', '$email', '$car_company', '$car_type', '$car_model_year', '$fuel_type', '$description')";
            
            if (mysqli_query($conn, $query)) {
                // Booking successfully inserted, redirect to WhatsApp or another confirmation page
                $whatsapp_message = "Hello, I want to booked a car.%0ACar Name: $car_name%0ALocation: $location%0AStart Date: $start_date%0AEnd Date: $end_date";
                $whatsapp_url = "https://api.whatsapp.com/send?phone=+918328632167&text=$whatsapp_message";
                header("Location: $whatsapp_url");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Car details not found.";
        }
    } else {
        echo "User not authenticated.";  // Handle case where user is not logged in or session expired
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
