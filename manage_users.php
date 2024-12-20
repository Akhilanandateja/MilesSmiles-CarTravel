<?php include 'header.php'; ?>
<?php
include 'connect.php';

// Query users table and display/manage users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/1b91071d81.js" crossorigin="anonymous"></script>
    <title>Manage Users</title>
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

        .add-user {
            margin-bottom: 20px;
            display: block;
            text-align: center;
            text-decoration: none;
            color: #007bff;
            font-size: 18px;
        }

        .add-user:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow-x: auto; /* Enable horizontal scrolling on smaller screens */
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
        <h2>Manage Users</h2>
        <a href="add_user.php" class="add-user">Add New User</a>  
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>*****</td>"; // Display password securely
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";
                        echo "<select name='is_admin' class='status-dropdown'>";
                        echo "<option value='0'" . ($row['is_admin'] == 0 ? ' selected' : '') . ">User</option>";
                        echo "<option value='1'" . ($row['is_admin'] == 1 ? ' selected' : '') . ">Admin</option>";
                        echo "</select>";
                        echo "<button type='submit' name='update_role' class='btn btn-primary'>Update</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td><a href='edit_user.php?id=" . $row['user_id'] . "' class='edit-link'>Edit</a> | <a href='delete_user.php?id=" . $row['user_id'] . "' class='delete-link'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
<?php
// Update user role if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $is_admin = $_POST['is_admin'];
    
    // Update role in database
    $update_sql = "UPDATE users SET is_admin = $is_admin WHERE user_id = $user_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Role updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating role');</script>";
    }
}
$conn->close();
?>
