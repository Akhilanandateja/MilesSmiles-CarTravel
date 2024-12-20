<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $reviewId = $_GET['id'];
    
    // Fetch review details based on ID
    $sql = "SELECT * FROM reviews WHERE id = $reviewId";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $carId = $row['car_id'];
        $email = $row['email'];
        $review = $row['review'];
        $reviewImage = $row['review_image'];
        $reviewDate = $row['review_date'];
    } else {
        echo "Review not found.";
        exit();
    }
} else {
    echo "Review ID not provided.";
    exit();
}

if(isset($_POST['updateReview'])) {
    $reviewId = $_POST['id'];
    $carId = $_POST['car_id'];
    $email = $_POST['email'];
    $review = $_POST['review'];
    $reviewDate = $_POST['review_date'];
    
    // Update review details
    $sql = "UPDATE reviews SET car_id='$carId', email='$email', review='$review', review_date='$reviewDate' WHERE id=$reviewId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_reviews.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if(isset($_POST['deleteReview'])) {
    $reviewId = $_POST['id'];

    // Delete review
    $sql = "DELETE FROM reviews WHERE id=$reviewId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_reviews.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type=text], input[type=email], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Edit Review</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $reviewId; ?>">
        <label for="carId">Car ID:</label>
        <input type="text" id="carId" name="car_id" value="<?php echo $carId; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
        <label for="review">Review:</label>
        <textarea id="review" name="review"><?php echo $review; ?></textarea><br><br>
        <label for="reviewDate">Review Date:</label>
        <input type="text" id="reviewDate" name="review_date" value="<?php echo $reviewDate; ?>"><br><br>
        <input type="submit" name="updateReview" value="Update Review">
        <input type="submit" name="deleteReview" value="Delete Review" class="delete-button">
    </form>
    <a href="manage_reviews.php">Cancel</a>
</body>
</html>
