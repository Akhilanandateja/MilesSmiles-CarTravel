<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user details
$sql_user = "SELECT firstName, lastName, email FROM users WHERE email = ?";
$stmt_user = $conn->prepare($sql_user);
if ($stmt_user === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();
if (!$user) {
    die("User not found");
}

// Fetch user ratings with car names
$sql_ratings = "SELECT r.rating_id, r.car_id, r.rating, r.rating_date, c.car_name FROM ratings r INNER JOIN cars c ON r.car_id = c.car_id WHERE r.email = ?";
$stmt_ratings = $conn->prepare($sql_ratings);
if ($stmt_ratings === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}
$stmt_ratings->bind_param("s", $email);
$stmt_ratings->execute();
$result_ratings = $stmt_ratings->get_result();

// Fetch user reviews with car names
$sql_reviews = "SELECT rv.id, rv.car_id, rv.review, rv.review_image, rv.review_date, c.car_name FROM reviews rv INNER JOIN cars c ON rv.car_id = c.car_id WHERE rv.email = ?";
$stmt_reviews = $conn->prepare($sql_reviews);
if ($stmt_reviews === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}
$stmt_reviews->bind_param("s", $email);
$stmt_reviews->execute();
$result_reviews = $stmt_reviews->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>User Profile</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: black;
            height: auto;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .profile {
            background-color: black;
            background-position: center;
            height: auto;
            width: 100%;
            padding-left: 80px;
        }

        .profile h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: white;
        }

        .detail {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            color: white;
        }

        .emoji {
            font-size: 20px;
            margin-right: 10px;
        }

        strong {
            font-weight: bold;
            width: 150px; /* Adjust width to create space */
            display: inline-block;
        }

        input[type="text"],
        input[type="password"] {
            padding: 8px;
            width: 100%; /* Full width input */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .link-container {
            width: 30%;
            left: 20%;
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            margin-left: -60px;
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
        }

        .view-profile {
            background-color: #FF4C4C;
        }

        .view-bookings {
            background-color: black;
        }

        hr {
            margin-bottom: 18px;
            margin-top: 20px;
        }

        i {
            color: #B2ACAC;
        }

        .car-image {
            height: 200px;
            width: 200px;
        }

        h2 {
            color: white;
            text-align: center;
        }

        .ratings-reviews {
            margin-top: 20px;
        }

        .ratings-reviews h3 {
            color: white;
            margin-bottom: 10px;
        }

        .rating, .review {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .rating span, .review span {
            color: #FF4C4C;
            font-weight: bold;
        }

        .rating p, .review p {
            color: white;
        }

        .review img {
            max-width: 100px;
            max-height: 100px;
        }

        .rating a, .review a {
            color: white;
            margin-left: 10px;
            text-decoration: underline;
        }

        .rating a:hover, .review a:hover {
            text-decoration: underline;
        }
        p{
            color: #FF4C4C;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="profile">
        <div class="link-container">
            <a href="profile.php" class="view-profile">Profile</a>
            <a href="edit_profile.php" class="edit-profile">Edit Profile</a>
            <a href="booking_details.php" class="view-bookings">Bookings</a>
        </div>
        <br><h2>Profile Details</h2><br>
        <div class="detail">
            <span class="emoji"><i class="fa-solid fa-user"></i></span>
            <strong>First Name:</strong> <?php echo htmlspecialchars($user['firstName']); ?>
        </div>
        <div class="detail">
            <span class="emoji"><i class="fa-solid fa-user"></i></span>
            <strong>Last Name:</strong> <?php echo htmlspecialchars($user['lastName']); ?>
        </div>
        <div class="detail">
            <span class="emoji"><i class="fa-solid fa-at"></i></span>
            <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?>
        </div>
        
        <div class="ratings-reviews">
            <h3>Ratings</h3>
            <?php if ($result_ratings->num_rows === 0) { ?>
                <p>No ratings to display.</p>
            <?php } else { ?>
                <?php while ($rating = $result_ratings->fetch_assoc()) { ?>
                    <div class="rating">
                        <p><span>Car Name:</span> <?php echo htmlspecialchars($rating['car_name']); ?></p>
                        <p><span>Rating:</span> <?php echo htmlspecialchars($rating['rating']); ?></p>
                        <p><span>Date:</span> <?php echo htmlspecialchars($rating['rating_date']); ?></p>
                        <a href="edit_rating.php?id=<?php echo $rating['rating_id']; ?>">Edit</a>
                        <a href="delete_rating.php?id=<?php echo $rating['rating_id']; ?>">Delete</a>
                    </div>
                <?php } ?>
            <?php } ?>

            <h3>Reviews</h3>
            <?php if ($result_reviews->num_rows === 0) { ?>
                <p>No reviews to display.</p>
            <?php } else { ?>
                <?php while ($review = $result_reviews->fetch_assoc()) { ?>
                    <div class="review">
                        <p><span>Car Name:</span> <?php echo htmlspecialchars($review['car_name']); ?></p>
                        <p><span>Review:</span> <?php echo htmlspecialchars($review['review']); ?></p>
                        <?php if ($review['review_image']) { ?>
                            <img src="uploads/<?php echo htmlspecialchars($review['review_image']); ?>" alt="Review Image">
                        <?php } ?>
                        <p><span>Date:</span> <?php echo htmlspecialchars($review['review_date']); ?></p>
                        <a href="edit_review.php?id=<?php echo $review['id']; ?>">Edit</a>
                        <a href="delete_review.php?id=<?php echo $review['id']; ?>">Delete</a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
