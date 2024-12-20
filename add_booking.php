<?php include 'header.php'; ?>
<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Booking</title>
    <link rel="stylesheet" href="style.css">
    <style>
         .body {
            padding: 40px;
            max-width: 800px;
            margin: auto;
            font-family: 'Courier New', Courier, monospace;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: inline-block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #FF4C4C;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #e43c3c;
        }
        h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: blue;
            text-decoration: none;
        }
        .back-link:hover {
            color:  #FF4C4C;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function showModal(message) {
            var modal = document.getElementById("myModal");
            var modalMessage = document.getElementById("modalMessage");
            modalMessage.textContent = message;
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</head>
<body>
<a href="manage_bookings.php" class="back-link"><-Back to Manage Bookings</a>
    <div class="container">
        <h2>Add New Booking</h2>
        <form action="add_booking.php" method="post">
            <div>
            <label for="booking_id">Booking ID:</label>
            <input type="text" id="booking_id" name="booking_id" required>
    </div>
    <div>
            <label for="booking_date">Booked Date:</label>
            <input type="text" id="booking_date" name="booking_date" required>
    </div>
    <div>
            <label for="car_name">Car Name:</label>
            <input type="text" id="car_name" name="car_name" required>
    </div>
    <div>
            <label for="price_per_day">Price per day:</label>
            <input type="number" id="price_per_day" name="price_per_day" required>
    </div>
    <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
    </div>
    <div>
            <label for="seating_capacity">Passengers:</label>
            <input type="number" id="seating_capacity" name="seating_capacity" required>
    </div>
    <div>
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
    </div>
    <div>
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
    </div>
    <div>
            <label for="email">User Email:</label>
            <input type="email" id="email" name="email" required>
    </div>
    <div>
    <label for="image_url">Image:</label>
    <input type="text" id="image_url" name="image_url" accept="image/*" required value="images/">
            </div>
<div>
            <input type="submit" value="Add Booking">
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookingId = $_POST['booking_id'];
    $bookingDate = $_POST['booking_date'];
    $carName = $_POST['car_name'];
    $priceperday = $_POST['price_per_day'];
    $location = $_POST['location'];
    $seatingcapacity = $_POST['seating_capacity'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $Email = $_POST['email'];

    $sql = "INSERT INTO booked_car (booking_id, booking_date, car_name, price_per_day, location, seating_capacity, start_date, end_date, email) 
    VALUES ('$bookingId','$bookingDate', '$carName', '$priceperday', '$location', '$seatingcapacity', '$startDate', '$endDate', '$Email')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>showModal('New booking added successfully');</script>";
    } else {
        echo "<script>showModal('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

$conn->close();
?>
