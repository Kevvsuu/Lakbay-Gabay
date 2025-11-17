<?php
session_start();
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

if (!isset($_SESSION['user_id'])) {
    die(json_encode(["success" => false, "message" => "You must be logged in to bookmark spots"]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['spot_id'])) {
    $user_id = $_SESSION['user_id'];
    $spot_id = intval($_POST['spot_id']);
    
    $check_sql = "SELECT * FROM user_bookmarks WHERE user_id = ? AND spot_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $user_id, $spot_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Spot is already bookmarked"]);
    } else {

        $insert_sql = "INSERT INTO user_bookmarks (user_id, spot_id) VALUES (?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ii", $user_id, $spot_id);
        
        if ($insert_stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Spot bookmarked successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: " . $insert_stmt->error]);
        }
        
        $insert_stmt->close();
    }
    
    $check_stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}

$conn->close();
?>