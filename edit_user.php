<?php
session_start();

include 'connect.php';

if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Fetch user details based on ID
    $sql = "SELECT * FROM users WHERE user_id = $userId";
    $result = $conn->query($sql);

    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $firstName = $row['firstname'];
        $lastName = $row['lastname'];
        $email = $row['email'];
        // Note: Avoid displaying the password in plain text for security reasons.
        // The password field in the form will be separate for updating.
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

if(isset($_POST['updateUser'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password']; // New password input
    $userId = $_POST['user_id'];
    
    // Update user details
    if (!empty($password)) {
        // If password field is not empty, update including password change
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the new password
        $sql = "UPDATE users SET firstname='$firstName', lastname='$lastName', email='$email', password='$hashedPassword' WHERE user_id=$userId";
    } else {
        // If password field is empty, update without changing the password
        $sql = "UPDATE users SET firstname='$firstName', lastname='$lastName', email='$email' WHERE user_id=$userId";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_users.php");
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
    <title>Edit User</title>
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
        input[type=text], input[type=email], input[type=password] {
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
    <h2>Edit User</h2>
    <form method="POST">
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
        <label for="fName">First Name:</label>
        <input type="text" id="fName" name="fName" value="<?php echo $firstName; ?>"><br><br>
        <label for="lName">Last Name:</label>
        <input type="text" id="lName" name="lName" value="<?php echo $lastName; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" placeholder="Leave blank to keep current password"><br><br>
        <input type="submit" name="updateUser" value="Update User">
    </form>
    <a href="manage_users.php">Cancel</a>
</body>
</html>
