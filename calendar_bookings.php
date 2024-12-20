<?php
session_start(); // Start session if not already started
include 'connect.php'; // Include your database connection script

if(isset($_POST['book'])){
    // Fetch user email based on session or authentication mechanism
    if(isset($_SESSION['email'])){ // Assuming you store email in session
        $email = $_SESSION['email'];
        
        // Sanitize and validate input
        $location = $conn->real_escape_string($_POST['location']);
        $passengers = intval($_POST['passengers']); // Ensure passengers is an integer
        $start_date = date('Y-m-d', strtotime($_POST['start_date'])); // Format start_date as YYYY-MM-DD
        $departure_date = date('Y-m-d', strtotime($_POST['departure_date'])); // Format departure_date as YYYY-MM-DD

        // Check if user's email exists in users table
        $checkUserQuery = "SELECT id FROM users WHERE email = ?";
        $stmtCheckUser = $conn->prepare($checkUserQuery);
        $stmtCheckUser->bind_param("s", $email);
        $stmtCheckUser->execute();
        $resultCheckUser = $stmtCheckUser->get_result();

        if($resultCheckUser->num_rows > 0) {
            $row = $resultCheckUser->fetch_assoc();
            $user_id = $row['id'];

            // Prepare the SQL statement with parameterized query
            $insertQuery = "INSERT INTO bookings (location, passengers, start_date, departure_date, user_id, user_email) 
                            VALUES (?, ?, ?, ?, ?, ?)";
            
            // Prepare and bind parameters
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sissis", $location, $passengers, $start_date, $departure_date, $user_id, $email);

            // Execute the statement
            if($stmt->execute()){
                header("Location: book_cars.php"); // Replace with your actual success page URL
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error: User with email $email not found."; // Handle case where email is not found in users table
        }

        // Close statement and connection
        $stmtCheckUser->close();
        $conn->close();
    } else {
        echo "Error: User session not found. Please log in."; // Handle case where user session is not found
    }
} else {
    echo "Error: 'book' parameter is not set in POST data."; // Handle case where 'book' parameter is not set in POST
}
?>
