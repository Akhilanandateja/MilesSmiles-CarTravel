<?php include 'header.php'; ?>
<?php
include 'connect.php';

// Function to update car status
function updateCarStatus($car_id, $status) {
    global $conn;
    $sql = "UPDATE cars SET status = '$status' WHERE car_id = $car_id";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if form is submitted for status update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $car_id = $_POST['car_id'];
    $status = $_POST['status'];
    
    if (updateCarStatus($car_id, $status)) {
        echo "<script>alert('Status updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating status');</script>";
    }
}

// Query cars table and display/manage cars
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Manage Cars</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .body {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h2 {
            font-size: 40px;
            text-align: center;
            margin-top: 0;
        }

        .add-car {
            margin-bottom: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }

        .add-car:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto; /* Enable horizontal scroll on smaller screens */
            display: block; /* Ensure table is displayed as block for scrolling */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            white-space: nowrap; /* Prevent text wrapping */
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        a.edit-link, a.delete-link {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        a.edit-link {
            color: green;
            background-color: #c3e6cb;
        }

        a.delete-link {
            color: red;
            background-color: #f5c6cb;
        }

        a.edit-link:hover, a.delete-link:hover {
            text-decoration: none;
        }

        .status-dropdown {
            width: 100px; /* Adjust width as needed */
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #fff;
            color: #333;
            font-size: 14px;
        }

        .status-dropdown option {
            padding: 5px;
        }

        @media (max-width: 768px) {
            .body {
                padding: 10px;
            }
            table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="body">
        <a href="admin_dashboard.php">&lt;- Back to Dashboard</a>
        <h2>Manage Cars</h2>
        <a href="add_car.php" class="add-car">Add New Car</a>
        
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Car ID</th>
                        <th>Car Name</th>
                        <th>Price per Day</th>
                        <th>Seating Capacity</th>
                        <th>AC Status</th>
                        <th>Image</th>
                        <th>Car Company</th>
                        <th>Car Type</th>
                        <th>Model Year</th>
                        <th>Fuel Type</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Featured Images</th>
                        <th>Reviews</th>
                        <th>Average Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['car_id'] . "</td>";
                            echo "<td>" . $row['car_name'] . "</td>";
                            echo "<td>" . $row['price_per_day'] . "</td>";
                            echo "<td>" . $row['seating_capacity'] . "</td>";
                            echo "<td>" . $row['ac_status'] . "</td>";
                            echo "<td><img src='" . $row['image_url'] . "' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td>" . $row['car_company'] . "</td>";
                            echo "<td>" . $row['car_type'] . "</td>";
                            echo "<td>" . $row['car_model_year'] . "</td>";
                            echo "<td>" . $row['fuel_type'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            
                            // Dropdown for status with current status selected
                            echo "<td>";
                            echo "<form method='post' action=''>";
                            echo "<input type='hidden' name='car_id' value='" . $row['car_id'] . "'>";
                            echo "<select name='status' class='status-dropdown'>";
                            echo "<option value='booked'" . ($row['status'] == 'booked' ? ' selected' : '') . ">Booked</option>";
                            echo "<option value='completed'" . ($row['status'] == 'completed' ? ' selected' : '') . ">Completed</option>";
                            echo "</select>";
                            echo "<button type='submit' name='update_status' class='btn btn-primary'>Update</button>";
                            echo "</form>";
                            echo "</td>";
                            
                            echo "<td>" . $row['featured_images'] . "</td>";
                            echo "<td>" . $row['reviews'] . "</td>";
                            echo "<td>" . $row['average_rating'] . "</td>";
                            echo "<td><a href='edit_cars.php?id=" . $row['car_id'] . "' class='edit-link'>Edit</a> | <a href='delete_cars.php?id=" . $row['car_id'] . "' class='delete-link'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='16'>No cars found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>

<?php
$conn->close();
?>
