<?php
// Start output buffering to prevent any accidental output
ob_start();

session_start();

// Database configuration - UPDATE THESE FOR YOUR HOSTING ENVIRONMENT
$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

// Set proper headers
header('Content-Type: application/json; charset=utf-8');

try {
    // Create connection with error reporting
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Set charset
    $conn->set_charset("utf8");
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("User not logged in");
    }
    
    $user_id = $_SESSION['user_id'];
    
    // Validate user_id
    if (!is_numeric($user_id) || $user_id <= 0) {
        throw new Exception("Invalid user ID");
    }
    
    $query = "SELECT spot_info.*, 
              GROUP_CONCAT(spot_images.image_path ORDER BY spot_images.id) AS images,
              GROUP_CONCAT(COALESCE(spot_images.owner_name, 'Unknown Photographer') ORDER BY spot_images.id) AS image_owners
              FROM user_bookmarks 
              JOIN spot_info ON user_bookmarks.spot_id = spot_info.id
              LEFT JOIN spot_images ON spot_info.id = spot_images.spot_id 
              WHERE user_bookmarks.user_id = ?
              GROUP BY spot_info.id";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        throw new Exception("Query preparation failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $user_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Query execution failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    $bookmarks = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Process images and owners
            $row['images'] = !empty($row['images']) ? explode(',', $row['images']) : [];
            $row['image_owners'] = !empty($row['image_owners']) ? explode(',', $row['image_owners']) : [];
            
            $bookmarks[] = $row;
        }
    }
    
    $stmt->close();
    $conn->close();
    
    // Clear any output buffer content and send JSON
    ob_clean();
    echo json_encode($bookmarks, JSON_UNESCAPED_UNICODE);
    
} catch (Exception $e) {
    // Clear any output buffer content
    ob_clean();
    
    // Log error for debugging (optional - remove in production)
    error_log("Bookmarks Error: " . $e->getMessage());
    
    // Return error as JSON
    http_response_code(500);
    echo json_encode([
        "error" => $e->getMessage(),
        "debug" => [
            "session_exists" => isset($_SESSION['user_id']),
            "user_id" => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null
        ]
    ]);
} finally {
    // Close connection if still open
    if (isset($conn) && $conn->ping()) {
        $conn->close();
    }
    
    // End output buffering
    ob_end_flush();
}
?>