<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $bookingId = $_GET['id'];
    
    // Fetch booking details based on booking_id
    $stmt = $conn->prepare("SELECT * FROM booked_car WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $bookingId = $row['booking_id'];
        $bookingDate = $row['booking_date'];
        $carName = $row['car_name'];
        $priceperday = $row['price_per_day'];
        $location = $row['location'];
        $seatingcapacity = $row['seating_capacity'];
        $startDate = $row['start_date'];
        $endDate = $row['end_date'];
        $Email = $row['email'];
        $imageUrl = $row['image_url'];
    } else {
        echo "Booking not found.";
        exit();
    }
} else {
    echo "Booking ID not provided.";
    exit();
}

// Handle form submission for updating booking details
if(isset($_POST['updateBooking'])) {
    $bookingId = $_POST['bookingId'];
    $bookingDate = $_POST['bookingDate'];
    $carName = $_POST['carName'];
    $priceperday = $_POST['priceperday'];
    $location = $_POST['location'];
    $seatingcapacity = $_POST['seatingCapacity'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $Email = $_POST['Email'];
    
    // Update car details
    $stmt = $conn->prepare("UPDATE booked_car SET booking_date=?, car_name=?, price_per_day=?, location=?, seating_capacity=?, start_date=?, end_date=?, email=? WHERE booking_id=?");
    $stmt->bind_param("ssssisssi", $bookingDate, $carName, $priceperday, $location, $seatingcapacity, $startDate, $endDate, $Email, $bookingId);

    if ($stmt->execute()) {
        header("Location: manage_bookings.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Booking</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h2>Edit Booking</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $bookingId; ?>">
        <label for="bookingId">Booking ID:</label>
        <input type="text" id="bookingId" name="bookingId" value="<?php echo $bookingId; ?>" readonly><br><br>
        
        <label for="bookingDate">Booked Date:</label>
        <input type="date" id="bookingDate" name="bookingDate" value="<?php echo $bookingDate; ?>"><br><br>
        
        <label for="carName">Car Name:</label>
        <input type="text" id="carName" name="carName" value="<?php echo $carName; ?>"><br><br>
        
        <label for="priceperday">Price:</label>
        <input type="text" id="priceperday" name="priceperday" value="<?php echo $priceperday; ?>"><br><br>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $location; ?>"><br><br>
        
        <label for="seatingCapacity">Seating Capacity:</label>
        <input type="text" id="seatingCapacity" name="seatingCapacity" value="<?php echo $seatingcapacity; ?>"><br><br>
        
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo $startDate; ?>"><br><br>
        
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" value="<?php echo $endDate; ?>"><br><br>
        
        <label for="Email">Email:</label>
        <input type="text" id="Email" name="Email" value="<?php echo $Email; ?>"><br><br>
        
        <!-- Upload new image -->
        <label for="imageUrl">Image:</label>
        <input type="file" id="imageUrl" name="imageUrl"><br><br>
        
        <input type="submit" name="updateBooking" value="Update Booking">
    </form>
    <a href="manage_bookings.php">Cancel</a>
</body>
</html>
