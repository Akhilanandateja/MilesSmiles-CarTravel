<?php include 'header.php'; ?>
<?php include 'connect.php'; ?>

<?php
// Initialize variables
$email = '';
$review = '';
$review_image = '';
$review_date = date('Y-m-d H:i:s');
$errors = array();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_review'])) {
    // Validate inputs
    $email = $_POST['email'];
    $review = $_POST['review'];

    // Validate email (simple check for demonstration)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Process review image upload
    if (isset($_FILES['review_image'])) {
        $file_name = $_FILES['review_image']['name'];
        $file_size = $_FILES['review_image']['size'];
        $file_tmp = $_FILES['review_image']['tmp_name'];
        $file_type = $_FILES['review_image']['type'];
        $tmp = explode('.', $_FILES['review_image']['name']);
        $file_ext = end($tmp);
        $extensions = array("jpeg", "jpg", "png");

        if (!in_array($file_ext, $extensions)) {
            $errors[] = "Extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152) { // 2MB in bytes
            $errors[] = 'File size must be less than 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "review_images/" . $file_name);
            $review_image = "review_images/" . $file_name;
        } else {
            print_r($errors);
        }
    }

    // Insert review into database if no errors
    if (empty($errors)) {
        $sql = "INSERT INTO reviews (car_id, email, review, review_image, review_date) 
                VALUES ('" . $_SESSION['car_id'] . "', '$email', '$review', '$review_image', '$review_date')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Review added successfully');</script>";
        } else {
            echo "<script>alert('Error adding review: " . $conn->error . "');</script>";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Review</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your CSS styles here */
        .body {
            padding: 40px;
            max-width: 800px;
            margin: auto;
            font-family: 'Courier New', Courier, monospace;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: inline-block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
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
        h2 {
            text-align: center;
            font-size: 40px;
            margin-bottom: 20px;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: blue;
            text-decoration: none;
        }
        .back-link:hover {
            color:  #FF4C4C;
        }
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
    </style>
    <script>
        function showModal(message) {
            var modal = document.getElementById("myModal");
            var modalMessage = document.getElementById("modalMessage");
            modalMessage.textContent = message;
            modal.style.display = "block";
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <a href="manage_reviews.php" class="back-link"><-Back to Manage Reviews</a>
    <div class="container">
        <h2>Add New Review</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="review">Review:</label>
                <textarea id="review" name="review" required><?php echo htmlspecialchars($review); ?></textarea>
            </div>
            <div class="form-group">
                <label for="review_image">Upload Image:</label>
                <input type="file" id="review_image" name="review_image">
            </div>
            <input type="submit" name="add_review" value="Add Review">
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // PHP handling after form submission can be added here if needed
    }
    ?>

</body>
</html>

<?php include 'footer.php'; ?>
