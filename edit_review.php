<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $review_id = $_POST['review_id'];
    $review = $_POST['review'];
    $review_image = $_FILES['review_image'];

    if ($review_image['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($review_image["name"]);
        move_uploaded_file($review_image["tmp_name"], $target_file);

        $sql = "UPDATE reviews SET review = ?, review_image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("ssi", $review, $target_file, $review_id);
    } else {
        $sql = "UPDATE reviews SET review = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("si", $review, $review_id);
    }
    $stmt->execute();
    header("Location: profile.php");
    exit();
}

$review_id = $_GET['id'];
$sql = "SELECT r.review, r.review_image, c.car_name FROM reviews r JOIN cars c ON r.car_id = c.car_id WHERE r.id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $review_id);
$stmt->execute();
$result = $stmt->get_result();
$review = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
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
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #222;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            color: white;
        }
        h2 {
            color: #FF4C4C;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #FF4C4C;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff3333;
        }
        .car-name {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: white;
        }
        .current-image {
            display: block;
            margin-bottom: 10px;
            text-align: center;
        }
        .current-image img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Review</h2>
        <div class="car-name">Car: <?php echo htmlspecialchars($review['car_name']); ?></div>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="review_id" value="<?php echo $review_id; ?>">
            <label for="review">Review:</label>
            <input type="text" name="review" value="<?php echo htmlspecialchars($review['review']); ?>" required>
            <label for="review_image">Upload Image:</label>
            <input type="file" name="review_image" accept="image/*">
            <?php if ($review['review_image']): ?>
                <div class="current-image">
                    <label>Current Image:</label>
                    <img src="<?php echo htmlspecialchars($review['review_image']); ?>" alt="Review Image">
                </div>
            <?php endif; ?>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
