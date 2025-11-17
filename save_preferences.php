<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

require_once 'db_connection.php';
$database = new Database();
$conn = $database->getConnection();

$user_id = $_SESSION['user_id'];
$preferences = $_POST['preferences'] ?? '';

try {
    // Check if user preferences record exists
    $stmt = $conn->prepare("SELECT id FROM user_preferences WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing preferences
        $stmt = $conn->prepare("UPDATE user_preferences SET preferences = ?, preferences_set = 1, updated_at = NOW() WHERE user_id = ?");
        $stmt->bind_param("si", $preferences, $user_id);
    } else {
        // Insert new preferences
        $stmt = $conn->prepare("INSERT INTO user_preferences (user_id, preferences, preferences_set) VALUES (?, ?, 1)");
        $stmt->bind_param("is", $user_id, $preferences);
    }
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Preferences saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save preferences']);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}

$conn->close();
?>