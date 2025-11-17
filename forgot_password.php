<?php
session_start();
require_once 'config/database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Check if email exists in database
    $database = new Database();
    $db = $database->getConnection();
    
    $query = "SELECT id, username FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Generate verification code
        $verification_code = rand(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Store code in session (or database for more security)
        $_SESSION['reset_email'] = $email;
        $_SESSION['reset_code'] = $verification_code;
        $_SESSION['reset_expires'] = $expires_at;
        
        // Send email with verification code
        $subject = "Password Reset Verification Code";
        $message = "
            <h2>Password Reset Request</h2>
            <p>Hello {$user['username']},</p>
            <p>You have requested to reset your password. Your verification code is:</p>
            <h3 style='background-color: #f0f8ff; padding: 10px; border-radius: 5px; display: inline-block;'>{$verification_code}</h3>
            <p>This code will expire in 1 hour.</p>
            <p>If you didn't request this reset, please ignore this email.</p>
        ";
        
        // Use your existing EmailConfig class
        if (EmailConfig::sendEmail($email, $subject, $message)) {
            $_SESSION['message'] = "Verification code sent to your email.";
            header("Location: verify_code.php");
            exit();
        } else {
            $error = "Failed to send verification email. Please try again.";
        }
    } else {
        $error = "Email not found in our system.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - TravelSpotPH</title>
    <!-- Use the same styling as your login form -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* Copy the same styles from your login form */
        :root {
            --ocean-blue: #0077be;
            --cyan-blue: #00a8cc;
            --turquoise: #40e0d0;
            --alice-blue: #f0f8ff;
            --dark-blue: #2c3e50;
            --gold-yellow: #ffd700;
        }
        
        body { 
            font-family: 'Montserrat', Arial, sans-serif;
        }
        
        .header-bg {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--ocean-blue) 50%, var(--cyan-blue) 100%);
            box-shadow: 0 4px 20px rgba(0, 119, 190, 0.3);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--alice-blue) 0%, var(--turquoise) 30%, var(--cyan-blue) 70%, var(--ocean-blue) 100%);
        }
        
        .glass-effect {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(240, 248, 255, 0.95);
            border: 1px solid rgba(64, 224, 208, 0.3);
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.3), 0 8px 25px rgba(0, 168, 204, 0.2);
            border-color: var(--turquoise);
            background: rgba(240, 248, 255, 1);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--cyan-blue) 50%, var(--turquoise) 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--ocean-blue) 50%, var(--cyan-blue) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 119, 190, 0.4);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
            font-weight: 500;
        }
        
        .error-alert {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #ef4444;
            color: #dc2626;
            padding: 0.875rem 1rem;
            border-radius: 1rem;
            margin-bottom: 1.25rem;
            display: none;
            align-items: flex-start;
            gap: 0.75rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.2);
            animation: errorSlideIn 0.5s ease-out;
            font-size: 0.875rem;
            line-height: 1.4;
        }
        
        .error-alert.show {
            display: flex;
        }
        
        @keyframes errorSlideIn {
            from {
                opacity: 0;
                transform: translateY(-15px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .success-alert {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border: 2px solid #22c55e;
            color: #16a34a;
            padding: 0.875rem 1rem;
            border-radius: 1rem;
            margin-bottom: 1.25rem;
            display: none;
            align-items: flex-start;
            gap: 0.75rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.2);
            animation: successSlideIn 0.5s ease-out;
            font-size: 0.875rem;
            line-height: 1.4;
        }
        
        .success-alert.show {
            display: flex;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full flex items-center justify-center shadow-2xl" style="background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);">
                    <i class="fas fa-key text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold mb-3 bg-gradient-to-r from-dark-blue via-ocean-blue to-cyan-blue bg-clip-text text-transparent">Reset Password</h2>
                <p class="text-dark-blue/80">Enter your email to receive a verification code</p>
            </div>
            
            <?php if (isset($error)): ?>
            <div class="error-alert show">
                <i class="fas fa-exclamation-triangle text-lg flex-shrink-0 mt-0.5"></i>
                <span class="flex-1"><?php echo $error; ?></span>
                <button onclick="this.parentElement.classList.remove('show')" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <?php endif; ?>
            
            <form method="POST" class="space-y-5">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-turquoise">
                        <i class="fas fa-envelope text-ocean-blue/60 text-lg"></i>
                    </div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        placeholder="Enter your email"
                        required
                        class="input-focus w-full pl-14 pr-5 py-4 border-2 border-turquoise/30 rounded-2xl text-dark-blue placeholder-ocean-blue/50 bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base font-medium shadow-lg"
                    >
                </div>
                
                <button type="submit" class="btn-gradient w-full text-white font-bold py-4 px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center justify-center gap-3 text-base border border-gold-yellow/20">
                    <i class="fas fa-paper-plane"></i>
                    <span>Send Verification Code</span>
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="loginform.php" class="text-ocean-blue hover:text-turquoise font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
        // Basic form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            if (!email) {
                e.preventDefault();
                alert('Please enter your email address');
            }
        });
    </script>
</body>
</html>