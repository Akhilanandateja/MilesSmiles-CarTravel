<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs (for security)
    $car_name = mysqli_real_escape_string($conn, $_POST['car_name']);
    $price_per_day = mysqli_real_escape_string($conn, $_POST['price_per_day']);
    $seating_capacity = mysqli_real_escape_string($conn, $_POST['seating_capacity']);
    $ac_status = mysqli_real_escape_string($conn, $_POST['ac_status']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    
    // Retrieve the email from session or wherever it's stored
    session_start(); // Start session if not already started
    $email = $_SESSION['email']; // Replace with actual session variable storing user's email

    // Check if the email exists in the users table (optional, if already validated)
    // $check_email_query = "SELECT email FROM users WHERE email = '$email'";
    // $result = mysqli_query($conn, $check_email_query);
    // if (mysqli_num_rows($result) == 0) {
    //     echo "Error: Email does not exist in the users table.";
    //     exit();
    // }

    // Insert into booked_car table including email
    $query = "INSERT INTO booked_car (car_name, price_per_day, seating_capacity, ac_status, image_url, booking_date, location, start_date, end_date, email) 
              VALUES ('$car_name', '$price_per_day', '$seating_capacity', '$ac_status', '$image_url', NOW(), '$location', '$start_date', '$end_date', '$email')";

    if (mysqli_query($conn, $query)) {
        // Redirect to WhatsApp with prefilled message
        $whatsapp_number = "+918328632167"; // Your WhatsApp number
        $message = urlencode("Booking request for $car_name from $start_date to $end_date at $location.");

        $whatsapp_url = "https://wa.me/$whatsapp_number/?text=$message";
        header("Location: $whatsapp_url");
        exit();
    } else {
        // Handle error
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
