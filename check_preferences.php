<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

require_once 'db_connection.php';
$database = new Database();
$conn = $database->getConnection();

$user_id = $_SESSION['user_id'];

try {
    $stmt = $conn->prepare("SELECT preferences_set FROM user_preferences WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'preferences_set' => (bool)$row['preferences_set']
        ]);
    } else {
        // No record exists, preferences not set
        echo json_encode([
            'success' => true,
            'preferences_set' => false
        ]);
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$conn->close();
?>