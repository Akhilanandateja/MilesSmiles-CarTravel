<?php
session_start(); // Start or resume a session

include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
// Fetch booked cars details for the user including booking_date, location, start_date, end_date
$sql_booked_cars = "SELECT booking_id, car_name, price_per_day, seating_capacity, ac_status, image_url, booking_date, location, start_date, end_date, car_company, car_type, car_model_year, fuel_type, description FROM booked_car WHERE email = ?";
$stmt_booked_cars = $conn->prepare($sql_booked_cars);
if ($stmt_booked_cars === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}

$stmt_booked_cars->bind_param("s", $email);
$stmt_booked_cars->execute();
$result_booked_cars = $stmt_booked_cars->get_result();
$booked_cars = $result_booked_cars->fetch_all(MYSQLI_ASSOC);

$stmt_booked_cars->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: black;
            color: white;
        }
        .container1 {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            margin-bottom: 30px;
            padding: 20px;
        }
        .booking-details {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            padding: 20px;
            border-bottom:1px solid white;
            line-height: 2.5;
        }
        .col-section {
            flex: 1;
            padding: 0 10px;
        }
        .col-section img {
            max-width: 100%;
            height: auto;
        }
        .detail {
            margin-bottom: 10px;
        }
        i {
            color: #FF3333;
            font-size: 20px;
        }
        .car-image{
            height:250px;
            width:250px;
        }
        h2{
           text-align: center;
        }
        .link-container {
    width: 30%;
    left: 20%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.link-container a {
    text-decoration: none;
    color: white;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
    width: 48%;
    text-align: center;
  /* Set the background color */
   clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%); /* Create a rhombus shape */
}

.edit-profile {
            background-color: black;
    
        }.view-profile{
            background-color:black;
        }

        .view-bookings {
            background-color: #FF4C4C;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="link-container">
        <a href="profile.php" class="view-profile">Profile</a>
            <a href="edit_profile.php" class="edit-profile">Edit Profile</a>
            <a href="booking_details.php" class="view-bookings">Bookings</a>
        </div>
    <br><h2>Booked Cars Details</h2>
    <br>
    <div class="container1">
  
        <?php if (!empty($booked_cars)): ?>
            <?php foreach ($booked_cars as $car): ?>
                <div class="booking-details">
                    <div class="col-section">
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-hashtag"></i></span>
                            <strong>Booking ID:</strong> <?php echo htmlspecialchars($car['booking_id']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-calendar-days"></i></span>
                            <strong>Booked Date:</strong> <?php echo htmlspecialchars($car['booking_date']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-car"></i></span>
                            <strong>Car Name:</strong> <?php echo htmlspecialchars($car['car_name']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-money-bill-1-wave"></i></span>
                            <strong>Price per Day:</strong> ₹<?php echo htmlspecialchars($car['price_per_day']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-users"></i></span>
                            <strong>Seating Capacity:</strong> <?php echo htmlspecialchars($car['seating_capacity']); ?> persons
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-fan"></i></span>
                            <strong>AC Status:</strong> <?php echo htmlspecialchars($car['ac_status']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-location-dot"></i></span>
                            <strong>Location:</strong> <?php echo htmlspecialchars($car['location']); ?>
                        </div>
                        
                    </div>
                    <div class="col-section">
                    <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-calendar-days"></i></span>
                            <strong>Start Date:</strong> <?php echo htmlspecialchars($car['start_date']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-calendar-days"></i></span>
                            <strong>End Date:</strong> <?php echo htmlspecialchars($car['end_date']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-building"></i></span>
                            <strong>Car Company:</strong> <?php echo htmlspecialchars($car['car_company']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-car"></i></span>
                            <strong>Car Type:</strong> <?php echo htmlspecialchars($car['car_type']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-calendar"></i></span>
                            <strong>Car Model Year:</strong> <?php echo htmlspecialchars($car['car_model_year']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-gas-pump"></i></span>
                            <strong>Fuel Type:</strong> <?php echo htmlspecialchars($car['fuel_type']); ?>
                        </div>
                        <div class="detail">
                            <span class="emoji"><i class="fa-solid fa-file-lines"></i></span>
                            <strong>Description:</strong> <?php echo htmlspecialchars($car['description']); ?>
                        </div>
                    </div>
                    <div class="col-section">
                        <span class="emoji"><i class="fa-solid fa-image"></i></span>
                        <strong>Car Image:</strong>
                        <img src="<?php echo htmlspecialchars($car['image_url']); ?>" alt="<?php echo htmlspecialchars($car['car_name']); ?>" class="car-image">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No cars booked yet.</p>
        <?php endif; ?>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
