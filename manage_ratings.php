<?php include 'header.php'; ?>
<?php
include 'connect.php';

// Query ratings table and display/manage ratings
$sql = "SELECT * FROM ratings";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Manage Ratings</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
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

        .edit-link, .delete-link {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }

        .edit-link {
            color: green;
            background-color: #c3e6cb;
        }

        .delete-link {
            color: red;
            background-color: #f5c6cb;
        }

        .edit-link:hover, .delete-link:hover {
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .body {
                padding: 10px;
            }
            table {
                font-size: 14px;
            }
        }
        .add-ratings{
            margin-bottom: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }

        .add-ratings:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="body">
    <a href="admin_dashboard.php">&lt;- Back to Dashboard</a>
        <h2>Manage Users</h2>
        <a href="add_rating.php" class="add-ratings">Add New rating</a>  
        <table>
            <thead>
                <tr>
                    <th>Rating ID</th>
                    <th>Car ID</th>
                    <th>Email</th>
                    <th>Rating</th>
                    <th>Rating Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['rating_id'] . "</td>";
                        echo "<td>" . $row['car_id'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['rating'] . "</td>";
                        echo "<td>" . $row['rating_date'] . "</td>";
                        echo "<td><a href='edit_rating_admin.php?id=" . $row['rating_id'] . "' class='edit-link'>Edit</a> | <a href='delete_rating_admin.php?id=" . $row['rating_id'] . "' class='delete-link'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No ratings found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>

<?php
// Update rating logic if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_rating'])) {
    // Handle update operation here
}

$conn->close();
?>
