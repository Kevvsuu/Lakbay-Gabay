<?php
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$spot_id = $_POST['spot_id'];
$image_id = $_POST['image_id'];
$image_path = $_POST['image_path'];

// Delete image from the database using image_id
$sql = "DELETE FROM spot_images WHERE id = ? AND spot_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $image_id, $spot_id);

if ($stmt->execute()) {
    // Delete the image file from the server - FIXED PATH
    $physical_path = '../' . $image_path; // Add ../ to get the physical path
    if (file_exists($physical_path)) {
        unlink($physical_path);
        echo "Image deleted successfully.";
    } else {
        echo "Image file not found at: " . $physical_path;
    }
} else {
    echo "Error deleting image from database.";
}

$conn->close();
?>