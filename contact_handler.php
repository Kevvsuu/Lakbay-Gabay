<?php
session_start();
header('Content-Type: application/json');
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to send a message']);
    exit();
}

try {
    $database = new Database();
    $conn = $database->getConnection();
    
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate required fields
    if (empty($data['subject']) || empty($data['message'])) {
        echo json_encode(['success' => false, 'message' => 'Subject and message are required']);
        exit();
    }
    
    // Get user info from session
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    
    // Get user email from database
    $stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'User not found']);
        exit();
    }
    
    $email = $user['email'];
    
    // Get optional fields - use username as fallback for first_name if not provided
    $first_name = !empty($data['first_name']) ? $data['first_name'] : $username;
    $last_name = !empty($data['last_name']) ? $data['last_name'] : null;
    
    $subject = $data['subject'];
    $message = $data['message'];
    $phone = $data['phone'] ?? null;
    
    // Get user's IP and User Agent
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
    
    // Insert message into database
    $sql = "INSERT INTO contact_messages (user_id, first_name, last_name, email, phone, subject, message, status, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'unread', ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $first_name, $last_name, $email, $phone, $subject, $message, $ip_address, $user_agent]);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Message sent successfully! We will get back to you soon.'
    ]);
    
} catch (Exception $e) {
    error_log("Contact handler error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to send message. Please try again later.'
    ]);
}
?>