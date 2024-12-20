<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $car_id = $_POST['car_id'];
    $review = mysqli_real_escape_string($conn, $_POST['review']);
    $email = $_SESSION['email']; // Assuming the user is logged in and email is stored in session
    $review_image = '';

    // Check and create the uploads directory if it doesn't exist
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Handle file upload
    if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] == 0) {
        $allowed_ext = array('png', 'jpg', 'jpeg');
        $file_ext = pathinfo($_FILES['review_image']['name'], PATHINFO_EXTENSION);

        if (in_array($file_ext, $allowed_ext)) {
            $review_image = uniqid() . '.' . $file_ext;
            if (move_uploaded_file($_FILES['review_image']['tmp_name'], 'uploads/' . $review_image)) {
                // File uploaded successfully
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file extension.";
        }
    }

    // Insert review into database
    $sql = "INSERT INTO reviews (car_id, email, review, review_image) VALUES ('$car_id', '$email', '$review', '$review_image')";
    if (mysqli_query($conn, $sql)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
