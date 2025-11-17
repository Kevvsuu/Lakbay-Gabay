<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to rate a spot.");
}

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$spot_id = intval($_POST['spot_id']);
$rating = intval($_POST['rating']);
$comment = mysqli_real_escape_string($conn, $_POST['comment']);
$is_anonymous = isset($_POST['is_anonymous']) && $_POST['is_anonymous'] == '1' ? 1 : 0;

// Check if user has already rated this spot
$check_sql = "SELECT id FROM ratings WHERE user_id = $user_id AND spot_id = $spot_id";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
    // Update existing rating
    $sql = "UPDATE ratings 
            SET rating = $rating, 
                comment = '$comment', 
                is_anonymous = $is_anonymous,
                created_at = NOW() 
            WHERE user_id = $user_id AND spot_id = $spot_id";
    
    if ($conn->query($sql)) {
        echo "Rating updated successfully!";
    } else {
        echo "Error updating rating: " . $conn->error;
    }
} else {
    // Insert new rating
    $sql = "INSERT INTO ratings (user_id, spot_id, rating, comment, is_anonymous, created_at) 
            VALUES ($user_id, $spot_id, $rating, '$comment', $is_anonymous, NOW())";
    
    if ($conn->query($sql)) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error submitting rating: " . $conn->error;
    }
}

$conn->close();
?>