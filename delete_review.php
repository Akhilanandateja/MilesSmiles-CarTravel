<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$review_id = $_GET['id'];

$sql = "DELETE FROM reviews WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . htmlspecialchars($conn->error));
}
$stmt->bind_param("i", $review_id);
$stmt->execute();

header("Location: profile.php");
exit();
?>
