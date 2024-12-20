<?php
if(isset($_POST["submit"])) {
    if(isset($_FILES["image"])) {
        $target_dir = "cars_images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) { // 5MB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
                
                // Database connection
                $conn = new mysqli('localhost', 'username', 'password', 'login');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO cars (image, model, capacity, price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssii", $target_file, $model, $capacity, $price);

                // Set parameters and execute
                $model = $_POST["model"];
                $capacity = $_POST["capacity"];
                $price = $_POST["price"];
                $stmt->execute();

                echo "New record created successfully";

                $stmt->close();
                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
} else {
    echo "Form was not submitted.";
}
?>
