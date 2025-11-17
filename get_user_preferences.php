<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false, 
        'message' => 'Not logged in'
    ]);
    exit();
}

// Check if request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        'success' => false, 
        'message' => 'Invalid request method'
    ]);
    exit();
}

// Database connection
require_once 'db_connection.php';

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    $user_id = $_SESSION['user_id'];
    
    // Fetch user preferences
    $stmt = $conn->prepare("SELECT preferences, preferences_set FROM user_preferences WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Check if preferences are set and not empty
        if ($row['preferences_set'] == 1 && !empty($row['preferences'])) {
            echo json_encode([
                'success' => true,
                'preferences' => $row['preferences'],
                'message' => 'Preferences found'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No preferences set'
            ]);
        }
    } else {
        // No record found - user needs to set preferences
        echo json_encode([
            'success' => false,
            'message' => 'No preferences found'
        ]);
    }
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>