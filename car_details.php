<?php include 'header.php'; ?>
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
        .card {
            background-color: black;
            border-style: none !important;
            padding: 20px;
        }
        .img-top {
            margin-right: 20px; /* Adjusted margin */
            padding: 10px;
            width: 100%;
            height: auto;
            max-width: 300px;
            transition: transform .5s;
        }
        .img-top:hover {
            transform: scale(1.1);
        }
        .card-body {
            padding: 20px;
        }
        .booking-form {
            background-color: transparent;
            padding: 20px;
            border-radius: 8px;
        }
        .booking-form label {
            font-weight: bold;
            color: #FF4C4C;
        }
        .booking-form input[type="text"],
        .booking-form input[type="date"],
        .booking-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .booking-form button {
            background-color: #FF4C4C;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .booking-form button:hover {
            background-color: black;
        }
        .container1 {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px; /* Added margin */
            padding: 20px;
        }
        .col-section {
            flex: 1;
            padding: 0 10px;
        }
        .col-section1 {
            flex: 1;
            padding: 30px;
        }
        .car-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .car-card {
            background-color: black;
            border: 1px solid #FF4C4C;
            border-radius: 10px;
            overflow: hidden;
            width: calc(20% - 20px); /* Adjust based on gap */
            text-align: center;
        }
        .car-card img {
            width: 100%;
            height: auto;
        }
        i {
            color: #FF3333;
            font-size: 20px;
        }
        .reviews-section {
            padding: 50px 0;
            background-color: black;
            color: white;
        }
        .review-form {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 50px;
        }
        .review-form h3 {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #FF4C4C;
        }
        .form-group textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #444;
            color: white;
        }
        .form-group input[type="file"] {
            display: block;
            color: white;
        }
        button[type="submit"] {
            background-color: #FF4C4C;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #e63939;
        }
        .reviews-list {
            margin-top: 50px;
        }
        .review-item {
            display: flex;
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .review-item img {
    max-width: 80px;
    border-radius: 0; /* Remove the circular border-radius */
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%); /* Create a square shape */
    margin-right: 20px;
}

        .review-content {
            flex: 1;
        }
        .review-content h4 {
            margin: 0;
            color: #FF4C4C;
        }
        .review-content p {
            margin: 10px 0;
        }
        .review-content small {
            color: #777;
        }
        /* Ratings Section Styles */
 .rating {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .rating input[type="radio"] {
            display: none; /* Hide the radio buttons */
        }
        .rating label {
            font-size: 30px;
            color: #FF4C4C;
            cursor: pointer;
            transition: color 0.3s;
        }
        .rating label:hover,
        .rating input:checked ~ label {
            color: gold; /* Change color on hover and when checked */
        }
        .rating label:before {
            content: '\2605'; /* Unicode star character */
        }
.rating-display{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
    margin-left:-290px;
}
.popup {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        z-index: 1000;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .popup.success {
        background-color: #4CAF50;
        color: white;
    }

    .popup.error {
        background-color: #f44336;
        color: white;
    }

    </style>
    <script>
    // Function to show a pop-up message
    function showMessage(message, isError) {
        const popup = document.createElement('div');
        popup.className = `popup ${isError ? 'error' : 'success'}`;
        popup.textContent = message;

        document.body.appendChild(popup);

        // Close the popup after 3 seconds (adjust as needed)
        setTimeout(() => {
            popup.remove();
        }, 3000); // 3000 milliseconds = 3 seconds
    }
</script>
</head>
<body>

<div class="container1">
        <?php
        include 'connect.php';

        if (isset($_GET['car_id'])) {
            $car_id = $_GET['car_id'];
            $query = "SELECT * FROM cars WHERE car_id = '$car_id'";
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
                $status = $row['status'];
                $featured_images = explode(',', $row['featured_images']);

                echo '<div class="col-section">';
                echo '<h3><i class="fa-solid fa-check-double"></i>&nbspImage of Selected Car</h3>';
                echo '<img src="' . $image_url . '" class="img-top" alt="' . $car_name . '">';
                echo '<br>';
                echo '<br>';
                       // Calculate and display average rating
            $rating_query = "SELECT AVG(rating) AS average_rating FROM ratings WHERE car_id = '$car_id'";
            $rating_result = mysqli_query($conn, $rating_query);
            $rating_row = mysqli_fetch_assoc($rating_result);
            $average_rating = number_format($rating_row['average_rating'], 1);

            echo '<div class="rating-display">';
            echo '<p class="rating"><i class="fa-solid fa-star"></i>Rating:' .  $average_rating  . '</p>';
            echo '</div>'; // close rating
                echo '</div>'; // close col-section

                echo '<div class="col-section">';
                echo '<h3><i class="fa-solid fa-check-double"></i>&nbspDetails of Selected Car</h3>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><i class="fa-solid fa-car"></i>&nbsp' . $car_name . '</h5>';
                echo '<p class="card-text"><i class="fa-solid fa-fan"></i>&nbsp&nbsp' . $ac_status . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-money-bill-1"></i>&nbsp&nbsp₹' . $price_per_day . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-users"></i>&nbsp&nbsp ' . $seating_capacity . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-industry"></i>&nbsp&nbsp ' . $car_company . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-car-side"></i>&nbsp&nbsp ' . $car_type . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-gear"></i>&nbsp&nbsp ' . $car_model_year . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-gas-pump"></i>&nbsp&nbsp ' . $fuel_type . '</p>';
                echo '<p class="card-text"><i class="fa-solid fa-info-circle"></i>&nbsp&nbsp ' . $description . '</p>';
         

            echo '</div>'; // close card-body
            echo '</div>'; // close col-section
        } else {
            echo '<p>No car found with the given ID.</p>';
        }
    } else {
        echo '<p>No car ID specified.</p>';
    }
    ?>
        
        <!-- Featured Images Section -->
        

        <?php
        if ($status != 'booked') {
            echo '<div class="col-section">';
            echo '<h3><i class="fa-solid fa-check"></i> Select Details</h3>';
            echo '<div class="booking-form">';
            echo '<form action="whatsapp_redirect.php" method="POST">';
            echo '<input type="hidden" name="car_id" value="' . $car_id . '">';
            echo '<div class="form-group">';
            echo '<label for="location">Choose Location:</label>';
            echo '<select id="location" name="location" required>';
            echo '<option value="" selected disabled>Popular places near you</option>';
            echo '<option value="vijayawada">Vijayawada</option>';
            echo '<option value="hyderabad">Hyderabad</option>';
            echo '<option value="vizag">Vizag</option>';
            echo '<option value="guntur">Guntur</option>';
            echo '</select>';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="start_date">Start Date:</label>';
            echo '<input type="date" id="start_date" name="start_date" required min="' . date('Y-m-d') . '">';
            echo '</div>';
            echo '<div class="form-group">';
            echo '<label for="end_date">End Date:</label>';
            echo '<input type="date" id="end_date" name="end_date" required min="' . date('Y-m-d') . '">';
            echo '</div>';
            echo '<button type="submit">Book Now</button>';
            echo '</form>';
            echo '</div>'; // close booking-form
            echo '</div>'; // close col-section
        } else {
            echo '<h2 style="color: #ff4c4c;">This car is already booked.</h2>';
        }
        ?>

    </div>
</div>
<div class="col-section1">
            <h3><i class="fa-regular fa-images"></i></i> Featured Images</h3>
            <div class="car-grid">
                <?php foreach ($featured_images as $img): ?>
                    <div class="car-card">
                        <img src="<?php echo $img; ?>" alt="Featured Image">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-section">
    <h3><i class="fa-solid fa-star"></i> Rate This Car</h3>
    <form action="submit_rating.php" method="POST">
        <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
        <div class="rating">
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1"></label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2"></label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3"></label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4"></label>
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5"></label>
        </div>
        <button type="submit">Submit Rating</button>
    </form>
</div>




<div class="reviews-section">
    <div class="container">
        <div class="review-form">
            <h3>Leave a Review</h3>
            <form action="submit_review.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="car_id" value="<?php echo $car_id; ?>">
                <div class="form-group">
                    <label for="review">Review:</label>
                    <textarea id="review" name="review" required></textarea>
                </div>
                <div class="form-group">
                    <label for="review_image">Upload Image (PNG, JPG):</label>
                    <input type="file" id="review_image" name="review_image" accept=".png, .jpg">
                </div>
                <button type="submit">Submit Review</button>
            </form>
        </div>
        <div class="reviews-list">
            <h3>Customer Reviews</h3>
            <?php
            // Fetch reviews from database and display
            $review_query = "SELECT r.*, u.firstname, u.email FROM reviews r JOIN users u ON r.email = u.email WHERE r.car_id = '$car_id'";
            $review_result = mysqli_query($conn, $review_query);

            if ($review_result && mysqli_num_rows($review_result) > 0) {
                while ($review_row = mysqli_fetch_assoc($review_result)) {
                    $review_text = $review_row['review'];
                    $review_image = $review_row['review_image'];
                    $review_date = $review_row['review_date'];
                    $reviewer_name = ''.$review_row['firstname'] . ', ' . $review_row['email'];

                    echo '<div class="review-item">';
                    
                    
                    echo '<div class="review-content">';
                    echo '<h4>' . $reviewer_name . '</h4>';
                    echo '<p>' . $review_text . '</p>';
                    echo '<small>','Reviewed On:'. $review_date . '</small>';
                    echo '</div>';
                    if ($review_image) {
                        echo '<img src="uploads/' . $review_image . '" alt="Review Image">';
                    }
                    echo '</div>';
                }
                
            } else {
                echo '<p>No reviews yet. Be the first to leave a review!</p>';
            }

            mysqli_free_result($review_result);
            mysqli_close($conn); // Close the connection here
            ?>
        </div>
    </div>
</div>


</body>
</html>
<?php include 'footer.php'; ?>
