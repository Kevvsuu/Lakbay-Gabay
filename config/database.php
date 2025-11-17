<?php
// config/database.php - Improved Email Configuration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Database {
    private $host = 'sql103.infinityfree.com';
    private $db_name = 'if0_39925056_tourismmap';
    private $username = 'if0_39925056';
    private $password = 'CAQpbXykjVsU';
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
        } catch(PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            throw new Exception("Database connection failed");
        }

        return $this->conn;
    }
}

class EmailConfig {
    const ADMIN_EMAIL = 'lakbaygabayph@gmail.com';
    const SITE_NAME = 'Lakbay Gabay';
    
    // Gmail SMTP settings
    const SMTP_HOST = 'smtp.gmail.com';
    const SMTP_USERNAME = 'lakbaygabayph@gmail.com';
    const SMTP_PASSWORD = 'ujpp cmfq jfgk drda';  // Your Gmail App Password
    const SMTP_PORT = 587;
    
    public static function sendEmail($to, $subject, $message, $replyTo = null) {
        // Always try to send via SMTP first, even on localhost
        if (self::sendViaSMTP($to, $subject, $message, $replyTo)) {
            return true;
        }
        
        // Fallback: save as file for debugging
        return self::saveEmailAsFile($to, $subject, $message);
    }
    
    private static function sendViaSMTP($to, $subject, $message, $replyTo = null) {
        // Load PHPMailer
        if (!self::loadPHPMailer()) {
            error_log("PHPMailer could not be loaded");
            return false;
        }
        
        $mail = new PHPMailer(true);
        
        try {
            // Enable debug for troubleshooting (set to 0 for production)
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = function($str, $level) {
                error_log("PHPMailer Debug: $str");
            };
            
            // Server settings
            $mail->isSMTP();
            $mail->Host = self::SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = self::SMTP_USERNAME;
            $mail->Password = self::SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = self::SMTP_PORT;
            
            // Important: Additional SMTP options to prevent Gmail blocking
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            // Set timeout and other options
            $mail->Timeout = 60;
            $mail->SMTPKeepAlive = true;
            
            // Recipients - IMPORTANT: Use proper headers to avoid spam
            $mail->setFrom(self::SMTP_USERNAME, self::SITE_NAME);
            $mail->addAddress($to);
            $mail->addReplyTo($replyTo ?? self::ADMIN_EMAIL, self::SITE_NAME);
            
            // IMPORTANT: Set proper headers to avoid spam folder
            $mail->addCustomHeader('X-Mailer', 'Lakbay Gabay Contact System');
            $mail->addCustomHeader('X-Priority', '3');
            $mail->addCustomHeader('Importance', 'normal');
            
            // Content settings
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = strip_tags(str_replace('<br>', "\n", $message));
            
            // IMPORTANT: Add message ID to prevent threading issues
            $mail->MessageID = '<' . md5(uniqid()) . '@lakbaygabay.com>';
            
            // Send the email
            $result = $mail->send();
            $mail->smtpClose();
            
            if ($result) {
                error_log("✅ Email sent successfully to: $to");
                error_log("📧 Subject: $subject");
                return true;
            } else {
                error_log("❌ Email sending failed to: $to - " . $mail->ErrorInfo);
                return false;
            }
            
        } catch (Exception $e) {
            error_log("❌ PHPMailer Exception: " . $e->getMessage());
            error_log("❌ Error Info: " . $mail->ErrorInfo);
            
            // Log more details for debugging
            error_log("SMTP Debug Info:");
            error_log("- Host: " . self::SMTP_HOST);
            error_log("- Port: " . self::SMTP_PORT);
            error_log("- Username: " . self::SMTP_USERNAME);
            error_log("- To: $to");
            error_log("- Subject: $subject");
            
            return false;
        }
    }
    
    private static function loadPHPMailer() {
        // Based on your project structure: TOURISMMAP/PHPMailer/src/
        $paths = [
            __DIR__ . '/../PHPMailer/src/PHPMailer.php',  // From config folder to root/PHPMailer/src
            __DIR__ . '/../../PHPMailer/src/PHPMailer.php' // Alternative path
        ];
        
        foreach ($paths as $path) {
            if (file_exists($path)) {
                // Manual include for your PHPMailer installation
                $dir = dirname($path);
                if (file_exists($dir . '/Exception.php') && 
                    file_exists($dir . '/PHPMailer.php') && 
                    file_exists($dir . '/SMTP.php')) {
                    require_once $dir . '/Exception.php';
                    require_once $dir . '/PHPMailer.php';
                    require_once $dir . '/SMTP.php';
                    error_log("PHPMailer loaded from: $path");
                    return true;
                }
            }
        }
        
        error_log("PHPMailer not found. Checked paths: " . implode(', ', $paths));
        return false;
    }
    
    private static function saveEmailAsFile($to, $subject, $message) {
        try {
            // Create emails directory
            $emailDir = __DIR__ . '/../emails/';
            if (!file_exists($emailDir)) {
                mkdir($emailDir, 0755, true);
            }
            
            $filename = $emailDir . 'email_' . date('YmdHis') . '_' . preg_replace('/[^a-zA-Z0-9@.]/', '_', $to) . '.html';
            
            $fullEmailContent = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>$subject</title>
                <style>
                    .debug-info { 
                        background: #fff3cd; 
                        border: 1px solid #ffc107; 
                        padding: 15px; 
                        margin: 20px 0; 
                        border-radius: 5px;
                        font-family: monospace;
                    }
                    .email-content {
                        border: 1px solid #ddd;
                        margin-top: 20px;
                    }
                </style>
            </head>
            <body>
                <div class='debug-info'>
                    <h3>EMAIL DEBUG INFORMATION</h3>
                    <p><strong>To:</strong> $to</p>
                    <p><strong>Subject:</strong> $subject</p>
                    <p><strong>Generated:</strong> " . date('Y-m-d H:i:s') . "</p>
                    <p><strong>Server:</strong> " . ($_SERVER['HTTP_HOST'] ?? 'Unknown') . "</p>
                    <p><strong>Status:</strong> This email was saved as a file because SMTP sending failed or we're in development mode.</p>
                    <p><strong>Action Needed:</strong> Check your PHPMailer configuration and Gmail App Password.</p>
                </div>
                
                <div class='email-content'>
                    <h3>EMAIL CONTENT:</h3>
                    $message
                </div>
            </body>
            </html>";
            
            $success = file_put_contents($filename, $fullEmailContent);
            
            if ($success) {

                return true;
            } else {

                return false;
            }
            
        } catch (Exception $e) {

            return false;
        }
    }
}
?>