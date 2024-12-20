<?php include 'header.php'; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'connect.php';

$loggedIn = false;
$email = '';

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $loggedIn = true;
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:black;
            color:white;
            margin: 0;
            padding: 0;
            min-height: 100vh; /* Ensure full height even if content is short */
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 40px;
        }

        .container1 {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            margin-top: 20px;
            padding:10px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: calc(33.33% - 20px); /* Adjust width as per your layout */
            text-align: center;
            transition: transform 0.3s ease, background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .card:nth-child(3n+1) .card-header {
            background-color: #007bff; /* Primary color for the first card in each row */
        }

        .card:nth-child(3n+2) .card-header {
            background-color: #ffc107; /* Warning color for the second card in each row */
        }

        .card:nth-child(3n+0) .card-header {
            background-color: #28a745; /* Success color for the third card in each row */
        }

        .card:nth-child(3n+3) .card-header {
            background-color: #6f42c1; /* Purple color for the fourth card in the second row */
        }

        .card:nth-child(3n+4) .card-header {
            background-color: #17a2b8; /* Teal color for the fifth card in the second row */
        }

        .card:hover {
            transform: scale(1.05);
            background-color: #f7f7f7;
        }

        .card a {
            text-decoration: underline;
            color: white;
            display: block;
            padding: 20px;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        .card a:hover {
            color: #FF4C4C;
        }

        .card-header {
            padding: 20px;
            font-size: 22px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-footer {
            padding: 10px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        @media (max-width: 1200px) {
            .card {
                width: calc(50% - 20px); /* Adjust width for smaller screens */
            }
        }

        @media (max-width: 768px) {
            .container1 {
                flex-direction: column;
                align-items: center;
            }
            .card {
                width: calc(100% - 20px); /* Full width on smaller screens */
                margin-bottom: 20px;
            }
        }
        h1{
            color:white;
        }
    </style>
</head>
<body>
    <h1>Welcome, Admin!</h1>

    <div class="container1">
        <div class="card">
            <div class="card-header"style="background-color:  #0000FF;color: white;">Manage Users</div>
            <div class="card-footer"style="background-color: #ADD8E6;"><a href="manage_users.php">View Details</a></div>
        </div>

        <div class="card">
            <div class="card-header"style="background-color:  #FFD700;color: white;">Manage Cars</div>
            <div class="card-footer"style="background-color: #FFFF00;"><a href="manage_cars.php">View Details</a></div>
        </div>

        <div class="card">
            <div class="card-header"style="background-color: #8A2BE2;color: white;">Manage Bookings</div>
            <div class="card-footer"style="background-color: #EE82EE;"><a href="manage_bookings.php">View Details</a></div>
        </div>

        <div class="card">
            <div class="card-header" style="background-color: #FF0000;color: white;">Manage Ratings</div>
            <div class="card-footer"style="background-color: #FF6347;"><a href="manage_ratings.php">View Details</a></div>
        </div>

        <div class="card">
            <div class="card-header"style="background-color: #000000;color: white;">Manage Reviews</div>
            <div class="card-footer"style="background-color: #333333;"><a href="manage_reviews.php">View Details</a></div>
        </div>
        <div class="card">
            <div class="card-header"style="background-color: #008000;color: white;">Manage Reviews</div>
            <div class="card-footer"style="background-color: #00FF00;"><a href="manage_reviews.php">View Details</a></div>
        </div>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
