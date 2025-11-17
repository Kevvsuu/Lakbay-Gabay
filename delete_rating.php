<?php

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ratingId = intval($_POST['id']);

// Prepare the delete statement
$sql = "DELETE FROM ratings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ratingId);

// Execute the statement
if ($stmt->execute()) {
    echo "Rating deleted successfully!";
} else {
    echo "Error deleting rating: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>