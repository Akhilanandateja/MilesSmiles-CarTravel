<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating_id = $_POST['rating_id'];
    $rating = $_POST['rating'];

    $sql = "UPDATE ratings SET rating = ? WHERE rating_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ii", $rating, $rating_id);
    $stmt->execute();
    header("Location: profile.php");
    exit();
}

$rating_id = $_GET['id'];
$sql = "SELECT r.rating, c.car_name FROM ratings r JOIN cars c ON r.car_id = c.car_id WHERE r.rating_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $rating_id);
$stmt->execute();
$result = $stmt->get_result();
$rating = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rating</title>
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
        input[type="number"] {
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Rating</h2>
        <div class="car-name">Car: <?php echo htmlspecialchars($rating['car_name']); ?></div>
        <form method="POST">
            <input type="hidden" name="rating_id" value="<?php echo $rating_id; ?>">
            <label for="rating">Rating:</label>
            <input type="number" name="rating" value="<?php echo htmlspecialchars($rating['rating']); ?>" min="1" max="5" required>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
