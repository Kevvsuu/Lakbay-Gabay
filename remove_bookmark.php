<?php
session_start();
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "message" => "You must be logged in to remove bookmarks"]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['spot_id'])) {
    $user_id = $_SESSION['user_id'];
    $spot_id = intval($_POST['spot_id']);
    
    // Delete bookmark
    $delete_sql = "DELETE FROM user_bookmarks WHERE user_id = ? AND spot_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $user_id, $spot_id);
    
    if ($delete_stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Bookmark removed successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $delete_stmt->error]);
    }
    
    $delete_stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

$conn->close();
?>