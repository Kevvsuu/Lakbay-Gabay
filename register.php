<?php
session_start();
require_once 'config/database.php';

// Set JSON header FIRST before any output
header('Content-Type: application/json');

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU"; 
$dbname = "if0_39925056_tourismmap"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode([
        'success' => false, 
        'error' => 'database', 
        'message' => 'Database connection failed'
    ]);
    exit();
}

// Only process if form is submitted and all fields are filled
if ($_SERVER['REQUEST_METHOD'] === 'POST' && 
    !empty($_POST['username']) && 
    !empty($_POST['email']) && 
    !empty($_POST['password'])) {
    
    // ✅ Get user input with trim() - CRITICAL FIX
    $user = mysqli_real_escape_string($conn, trim($_POST['username']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password_plain = trim($_POST['password']); // ✅ TRIM PASSWORD HERE!
    
    // ✅ Validate username length (minimum 6 characters)
    if (strlen($user) < 6) {
        echo json_encode([
            'success' => false,
            'error' => 'username',
            'message' => 'Username must be at least 6 characters long'
        ]);
        $conn->close();
        exit();
    }
    
    // ✅ Validate password length (minimum 8 characters)
    if (strlen($password_plain) < 8) {
        echo json_encode([
            'success' => false,
            'error' => 'password',
            'message' => 'Password must be at least 8 characters long'
        ]);
        $conn->close();
        exit();
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'error' => 'email',
            'message' => 'Please enter a valid email address'
        ]);
        $conn->close();
        exit();
    }
    
    // Check if username already exists
    $checkUser = $conn->query("SELECT * FROM users WHERE username = '$user'");
    
    if ($checkUser->num_rows > 0) {
        echo json_encode([
            'success' => false, 
            'error' => 'username', 
            'message' => 'Username is already taken'
        ]);
        $conn->close();
        exit();
    }
    
    // Check if email already exists
    $checkEmail = $conn->query("SELECT * FROM users WHERE email = '$email'");
    
    if ($checkEmail->num_rows > 0) {
        echo json_encode([
            'success' => false, 
            'error' => 'email', 
            'message' => 'Email is already registered'
        ]);
        $conn->close();
        exit();
    }
    
    // Generate 6-digit OTP
    $otp = sprintf("%06d", mt_rand(1, 999999));
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
    
    // ✅ STORE USER DATA IN SESSION (DON'T INSERT YET)
    $_SESSION['pending_registration'] = [
        'username' => $user,
        'email' => $email,
        'password' => $password_plain, // ✅ Already trimmed above
        'otp_code' => $otp,
        'otp_expiry' => $otp_expiry
    ];
    
    // Debug log (remove after testing)
    error_log("=== REGISTRATION DEBUG ===");
    error_log("Username: " . $user . " (Length: " . strlen($user) . ")");
    error_log("Email: " . $email);
    error_log("Password Length: " . strlen($password_plain));
    error_log("Password (first 3 chars): " . substr($password_plain, 0, 3) . "***");
    
    // Send OTP email
    if (sendOTPEmail($email, $user, $otp)) {
        echo json_encode([
            'success' => true,
            'redirect' => 'verify_otp.php',
            'message' => 'OTP sent to your email'
        ]);
    } else {
        // Clear session if email fails
        unset($_SESSION['pending_registration']);
        echo json_encode([
            'success' => false,
            'error' => 'email',
            'message' => 'Failed to send verification email. Please try again.'
        ]);
    }
    
    $conn->close();
    exit();
    
} else {
    echo json_encode([
        'success' => false, 
        'error' => 'validation', 
        'message' => 'All fields are required'
    ]);
    $conn->close();
    exit();
}

/**
 * Send OTP email to user
 */
function sendOTPEmail($userEmail, $username, $otp) {
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    $subject = "Verify Your Lakbay Gabay Account - OTP Code";
    
    $message = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Verify Your Account</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                line-height: 1.6; 
                color: #333; 
                margin: 0;
                padding: 0;
                background: #f0f8ff;
            }
            .container { 
                max-width: 600px; 
                margin: 20px auto; 
                background: white; 
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 8px 32px rgba(0, 119, 190, 0.15);
            }
            .header { 
                background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
                color: white; 
                padding: 40px 20px; 
                text-align: center;
            }
            .header h1 {
                margin: 0;
                font-size: 32px;
                font-weight: bold;
            }
            .content { 
                padding: 40px 30px;
            }
            .otp-box {
                background: linear-gradient(135deg, #f0f8ff 0%, #e6f7ff 100%);
                border: 2px dashed #40e0d0;
                padding: 30px;
                margin: 25px 0;
                border-radius: 12px;
                text-align: center;
            }
            .otp-code {
                font-size: 42px;
                font-weight: bold;
                color: #0077be;
                letter-spacing: 8px;
                margin: 15px 0;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            }
            .expiry-notice {
                background: #fff3cd;
                border-left: 4px solid #ffd700;
                padding: 15px;
                margin: 20px 0;
                border-radius: 8px;
            }
            .footer { 
                background: #2c3e50;
                color: white;
                padding: 30px 20px;
                text-align: center;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>Verify Your Account</h1>
            </div>
            
            <div class='content'>
                <h2 style='color: #0077be;'>Hello, " . htmlspecialchars($username) . "! 👋</h2>
                
                <p style='font-size: 16px;'>
                    Thank you for registering with <strong>Lakbay Gabay</strong>! 
                    To complete your registration, please verify your email address using the OTP code below:
                </p>
                
                <div class='otp-box'>
                    <p style='margin: 0; font-size: 14px; color: #666;'>Your Verification Code:</p>
                    <div class='otp-code'>" . $otp . "</div>
                    <p style='margin: 10px 0 0 0; font-size: 12px; color: #999;'>
                        Valid for 15 minutes
                    </p>
                </div>
                
                <div class='expiry-notice'>
                    <p style='margin: 0; color: #856404;'>
                        <strong>Important:</strong><br>
                        This code will expire in <strong>15 minutes</strong>. 
                        If you don't verify within this time, you'll need to register again.
                    </p>
                </div>
                
                <p style='font-size: 14px; color: #666;'>
                    Enter this code on the verification page to activate your account and start exploring 
                    the beautiful destinations of the Philippines! 🇵🇭
                </p>
                
                <p style='font-size: 14px; color: #999; margin-top: 30px;'>
                    <em>If you didn't create this account, please ignore this email.</em>
                </p>
            </div>
            
            <div class='footer'>
                <p style='font-weight: bold; margin-bottom: 10px;'>Lakbay Gabay</p>
                <p>Your Trusted Philippine Travel Guide</p>
                <p style='margin-top: 15px; opacity: 0.8;'>
                    © 2025 Lakbay Gabay. All rights reserved.
                </p>
            </div>
        </div>
    </body>
    </html>";
    
    try {
        return EmailConfig::sendEmail($userEmail, $subject, $message);
    } catch (Exception $e) {
        error_log("OTP Email Error: " . $e->getMessage());
        return false;
    }
}
?>