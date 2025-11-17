<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once '../../config/database.php';

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON data received');
    }
    
    error_log("=== REPLY HANDLER DEBUG ===");
    error_log("Input data: " . json_encode($input));
    
    // Validate required fields
    if (empty($input['message_id'])) {
        throw new Exception('Message ID is required');
    }
    
    if (empty($input['reply_message'])) {
        throw new Exception('Reply message is required');
    }

    $message_id = (int)$input['message_id'];
    $reply_subject = trim($input['subject'] ?? 'Reply from Lakbay Gabay');
    $reply_message = trim($input['reply_message']);
    $admin_name = trim($input['admin_name'] ?? 'Lakbay Gabay Team');

    // Get original message from database
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM contact_messages WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $message_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $original_message = $stmt->fetch();
    
    if (!$original_message) {
        throw new Exception('Original message not found with ID: ' . $message_id);
    }

    error_log("Original message found:");
    error_log("Customer Name: " . $original_message['first_name']);
    error_log("Customer Email: " . $original_message['email']);

    $customer_email = trim($original_message['email']);
    $customer_name = trim($original_message['first_name']);
    
    // Validate email
    if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid customer email: ' . $customer_email);
    }

    // Create email HTML
    $email_html = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Reply from Lakbay Gabay</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background: #f4f4f4; }
            .container { max-width: 600px; margin: 0 auto; background: white; padding: 0; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            .header { background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%); color: white; padding: 30px; text-align: center; }
            .header h1 { margin: 0; font-size: 28px; }
            .content { padding: 30px; }
            .reply-box { background: #f0f8ff; padding: 20px; border-left: 4px solid #0077be; margin: 20px 0; border-radius: 5px; }
            .original-msg { background: #f9f9f9; padding: 20px; margin: 20px 0; border: 1px solid #ddd; border-radius: 5px; }
            .footer { border-top: 2px solid #eee; padding: 20px 30px; font-size: 12px; color: #666; text-align: center; }
            .btn { display: inline-block; padding: 12px 30px; background: #0077be; color: white; text-decoration: none; border-radius: 5px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Lakbay Gabay</h1>
                <p style='margin: 5px 0 0 0;'>Travel Guide Philippines</p>
            </div>
            
            <div class='content'>
                <p>Hello <strong>" . htmlspecialchars($customer_name) . "</strong>,</p>
                
                <p>Thank you for contacting Lakbay Gabay! We've received your inquiry and here's our response:</p>
                
                <div class='reply-box'>
                    <strong style='color: #0077be; font-size: 16px;'>Our Reply:</strong><br><br>
                    " . nl2br(htmlspecialchars($reply_message)) . "
                </div>
                
                <p>If you have any more questions or need further assistance, feel free to contact us again!</p>
                
                <div class='original-msg'>
                    <strong style='color: #666;'>Your Original Message:</strong><br>
                    <strong>Subject:</strong> " . htmlspecialchars($original_message['subject']) . "<br>
                    <strong>Date:</strong> " . date('M j, Y g:i A', strtotime($original_message['created_at'])) . "<br><br>
                    <strong>Message:</strong><br>
                    " . nl2br(htmlspecialchars($original_message['message'])) . "
                </div>
            </div>
            
            <div class='footer'>
                <p style='margin: 0 0 10px 0;'><strong>" . htmlspecialchars($admin_name) . "</strong><br>
                Lakbay Gabay Customer Support</p>
                <p style='margin: 0;'>Email: " . EmailConfig::ADMIN_EMAIL . "<br>
                Website: lakbaygabay.com</p>
                <p style='margin: 15px 0 0 0; color: #999;'>© 2025 Lakbay Gabay. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>";

    error_log("=== ATTEMPTING EMAIL SEND ===");
    error_log("TO: $customer_email");
    error_log("SUBJECT: $reply_subject");
    
    // Send email using your existing EmailConfig
    $email_sent = EmailConfig::sendEmail($customer_email, $reply_subject, $email_html, EmailConfig::ADMIN_EMAIL);
    
    error_log("Email send result: " . ($email_sent ? "SUCCESS" : "FAILED"));

    if ($email_sent) {
        // Insert reply into message_replies table
        $insert_reply = "INSERT INTO message_replies (message_id, admin_name, reply_subject, reply_message) 
                        VALUES (:message_id, :admin_name, :reply_subject, :reply_message)";
        $insert_stmt = $db->prepare($insert_reply);
        $insert_stmt->execute([
            ':message_id' => $message_id,
            ':admin_name' => $admin_name,
            ':reply_subject' => $reply_subject,
            ':reply_message' => $reply_message
        ]);
        
        // Update message status to 'replied'
        $update_query = "UPDATE contact_messages SET status = 'replied', updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $update_stmt = $db->prepare($update_query);
        $update_stmt->execute([':id' => $message_id]);
        
        error_log("Database updated successfully");
        
        echo json_encode([
            'success' => true,
            'message' => 'Reply sent successfully!',
            'debug_info' => [
                'customer_email' => $customer_email,
                'customer_name' => $customer_name,
                'subject' => $reply_subject,
                'sent_at' => date('Y-m-d H:i:s')
            ]
        ]);

    } else {
        throw new Exception('Email could not be sent. Please check server logs.');
    }

} catch (Exception $e) {
    error_log("=== REPLY HANDLER ERROR ===");
    error_log("Error: " . $e->getMessage());
    
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'debug' => [
            'line' => $e->getLine(),
            'file' => basename($e->getFile()),
            'timestamp' => date('Y-m-d H:i:s')
        ]
    ]);
}
?>