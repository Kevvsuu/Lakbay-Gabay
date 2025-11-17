<?php
ob_start();
session_start();

// Your hosting database credentials
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

header('Content-Type: application/json; charset=utf-8');

try {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("You must be logged in to bookmark spots");
    }
    
    // Check if required data is provided
    if (!isset($_POST['spot_id']) || !isset($_POST['action'])) {
        throw new Exception("Missing required parameters");
    }
    
    $user_id = $_SESSION['user_id'];
    $spot_id = intval($_POST['spot_id']);
    $action = $_POST['action'];
    
    // Validate input
    if ($spot_id <= 0) {
        throw new Exception("Invalid spot ID");
    }
    
    if (!in_array($action, ['add', 'remove'])) {
        throw new Exception("Invalid action");
    }
    
    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    
    if ($action === 'add') {
        // Check if bookmark already exists
        $check_stmt = $conn->prepare("SELECT id FROM user_bookmarks WHERE user_id = ? AND spot_id = ?");
        $check_stmt->bind_param("ii", $user_id, $spot_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            throw new Exception("Spot is already bookmarked");
        }
        
        // Add bookmark
        $stmt = $conn->prepare("INSERT INTO user_bookmarks (user_id, spot_id, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ii", $user_id, $spot_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to add bookmark: " . $stmt->error);
        }
        
        $message = "Bookmark added successfully";
        
    } else { // remove
        // Remove bookmark
        $stmt = $conn->prepare("DELETE FROM user_bookmarks WHERE user_id = ? AND spot_id = ?");
        $stmt->bind_param("ii", $user_id, $spot_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Failed to remove bookmark: " . $stmt->error);
        }
        
        if ($stmt->affected_rows === 0) {
            throw new Exception("Bookmark not found");
        }
        
        $message = "Bookmark removed successfully";
    }
    
    $conn->close();
    
    ob_clean();
    echo json_encode([
        'success' => true,
        'message' => $message,
        'action' => $action,
        'spot_id' => $spot_id
    ]);
    
} catch (Exception $e) {
    if (isset($conn)) {
        $conn->close();
    }
    
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage(),
        'success' => false
    ]);
}

ob_end_flush();
?>