<?php
session_start();

include 'connect.php';

// Fetch car details based on car_id
if(isset($_GET['id'])) {
    $carId = $_GET['id'];
    
    $sql = "SELECT * FROM cars WHERE car_id = $carId";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $carName = $row['car_name'];
        $pricePerDay = $row['price_per_day'];
        $seatingCapacity = $row['seating_capacity'];
        $acStatus = $row['ac_status'];
        $imageUrl = $row['image_url'];
        $carCompany = $row['car_company'];
        $carType = $row['car_type'];
        $modelYear = $row['car_model_year'];
        $fuelType = $row['fuel_type'];
        $description = $row['description'];
        $status = $row['status'];
        $featuredImages = $row['featured_images'];
        $reviews = $row['reviews'];
        $averageRating = $row['average_rating'];
    } else {
        echo "Car not found.";
        exit();
    }
} else {
    echo "Car ID not provided.";
    exit();
}

// Update car details
if(isset($_POST['updateCar'])) {
    $carName = $_POST['carName'];
    $pricePerDay = $_POST['pricePerDay'];
    $seatingCapacity = $_POST['seatingCapacity'];
    $acStatus = $_POST['acStatus'];
    $imageUrl = $_POST['imageUrl'];
    $carCompany = $_POST['carCompany'];
    $carType = $_POST['carType'];
    $modelYear = $_POST['modelYear'];
    $fuelType = $_POST['fuelType'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $featuredImages = $_POST['featuredImages'];
    $reviews = $_POST['reviews'];
    $averageRating = $_POST['averageRating'];
    $carId = $_POST['car_id'];
    
    $sql = "UPDATE cars SET 
            car_name='$carName', 
            price_per_day='$pricePerDay', 
            seating_capacity='$seatingCapacity', 
            ac_status='$acStatus', 
            image_url='$imageUrl', 
            car_company='$carCompany', 
            car_type='$carType', 
            car_model_year='$modelYear', 
            fuel_type='$fuelType', 
            description='$description', 
            status='$status', 
            featured_images='$featuredImages', 
            reviews='$reviews', 
            average_rating='$averageRating' 
            WHERE car_id=$carId";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_cars.php");
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
    <title>Edit Car</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }

        .body {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        h2 {
            font-size: 40px;
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="password"], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
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

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="body">
        <h2>Edit Car</h2>
        <form method="POST">
            <input type="hidden" name="car_id" value="<?php echo $carId; ?>">
            <label for="carName">Car Name:</label>
            <input type="text" id="carName" name="carName" value="<?php echo $carName; ?>"><br><br>
            <label for="pricePerDay">Price Per Day:</label>
            <input type="text" id="pricePerDay" name="pricePerDay" value="<?php echo $pricePerDay; ?>"><br><br>
            <label for="seatingCapacity">Seating Capacity:</label>
            <input type="text" id="seatingCapacity" name="seatingCapacity" value="<?php echo $seatingCapacity; ?>"><br><br>
            <label for="acStatus">AC Status:</label>
            <input type="text" id="acStatus" name="acStatus" value="<?php echo $acStatus; ?>"><br><br>
            <label for="imageUrl">Image URL:</label>
            <input type="text" id="imageUrl" name="imageUrl" value="<?php echo $imageUrl; ?>"><br><br>
            <label for="carCompany">Car Company:</label>
            <input type="text" id="carCompany" name="carCompany" value="<?php echo $carCompany; ?>"><br><br>
            <label for="carType">Car Type:</label>
            <input type="text" id="carType" name="carType" value="<?php echo $carType; ?>"><br><br>
            <label for="modelYear">Model Year:</label>
            <input type="text" id="modelYear" name="modelYear" value="<?php echo $modelYear; ?>"><br><br>
            <label for="fuelType">Fuel Type:</label>
            <input type="text" id="fuelType" name="fuelType" value="<?php echo $fuelType; ?>"><br><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $description; ?></textarea><br><br>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" value="<?php echo $status; ?>"><br><br>
            <label for="featuredImages">Featured Images:</label>
            <input type="text" id="featuredImages" name="featuredImages" value="<?php echo $featuredImages; ?>"><br><br>
            <label for="reviews">Reviews:</label>
            <input type="text" id="reviews" name="reviews" value="<?php echo $reviews; ?>"><br><br>
            <label for="averageRating">Average Rating:</label>
            <input type="text" id="averageRating" name="averageRating" value="<?php echo $averageRating; ?>"><br><br>
            <input type="submit" name="updateCar" value="Update Car">
        </form>
        <a href="manage_cars.php">&lt;- Back to Manage Cars</a>
    </div>
</body>
</html>
