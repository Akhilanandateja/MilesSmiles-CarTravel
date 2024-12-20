<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $ratingId = $_GET['id'];
    
    // Fetch rating details based on ID
    $sql = "SELECT * FROM ratings WHERE rating_id = $ratingId";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $rating = $row['rating'];
    } else {
        echo "Rating not found.";
        exit();
    }
} else {
    echo "Rating ID not provided.";
    exit();
}

if(isset($_POST['updateRating'])) {
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $ratingId = $_POST['rating_id'];
    
    // Update rating details
    $sql = "UPDATE ratings SET email='$email', rating='$rating' WHERE rating_id=$ratingId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_ratings.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rating</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type=text], input[type=email], input[type=password], select {
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
    <h2>Edit Rating</h2>
    <form method="POST">
        <input type="hidden" name="rating_id" value="<?php echo $ratingId; ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
        <label for="rating">Rating:</label>
        <select id="rating" name="rating">
            <option value="1" <?php if ($rating == 1) echo 'selected'; ?>>1 Star</option>
            <option value="2" <?php if ($rating == 2) echo 'selected'; ?>>2 Stars</option>
            <option value="3" <?php if ($rating == 3) echo 'selected'; ?>>3 Stars</option>
            <option value="4" <?php if ($rating == 4) echo 'selected'; ?>>4 Stars</option>
            <option value="5" <?php if ($rating == 5) echo 'selected'; ?>>5 Stars</option>
        </select><br><br>
        <input type="submit" name="updateRating" value="Update Rating">
    </form>
    <a href="manage_ratings.php">Cancel</a>
</body>
</html>
