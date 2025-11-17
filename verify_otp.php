<?php
session_start();

// Check if there's a pending registration
if (!isset($_SESSION['pending_registration'])) {
    header('Location: registerform.php');
    exit();
}

$servername = "sql103.infinityfree.com";
$username = "if0_39925056";
$password = "CAQpbXykjVsU";
$dbname = "if0_39925056_tourismmap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

// Initialize variables
$error = '';
$success = '';
$pending = $_SESSION['pending_registration'];
$email = $pending['email'] ?? '';

// Handle resend OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resend_otp'])) {
    // Generate new OTP
    $new_otp = sprintf("%06d", mt_rand(1, 999999));
    $new_expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
    
    $_SESSION['pending_registration']['otp_code'] = $new_otp;
    $_SESSION['pending_registration']['otp_expiry'] = $new_expiry;
    
    // Resend email
    require_once 'config/database.php';
    if (sendOTPEmail($pending['email'], $pending['username'], $new_otp)) {
        $success = 'New OTP has been sent to your email!';
    } else {
        $error = 'Failed to resend OTP. Please try again.';
    }
}

// Handle OTP verification
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['otp'])) {
    header('Content-Type: application/json');
    
    $input_otp = $_POST['otp'];
    
    // Check if OTP matches and hasn't expired
    if ($input_otp == $pending['otp_code']) {
        if (strtotime($pending['otp_expiry']) > time()) {

            $user = mysqli_real_escape_string($conn, $pending['username']);
            $email = mysqli_real_escape_string($conn, $pending['email']);
            

            $password_hash = password_hash($pending['password'], PASSWORD_BCRYPT);
            
            // Debug logging (remove after testing)
            error_log("=== OTP VERIFICATION DEBUG ===");
            error_log("Username: " . $user);
            error_log("Email: " . $email);
            error_log("Plain Password Length: " . strlen($pending['password']));
            error_log("Plain Password (first 3): " . substr($pending['password'], 0, 3) . "***");
            error_log("Hashed Password: " . $password_hash);
            
            // Test if password can be verified
            $test_verify = password_verify($pending['password'], $password_hash);
            error_log("Password Verify Test: " . ($test_verify ? 'SUCCESS' : 'FAILED'));
            
            $sql = "INSERT INTO users (username, email, password, is_verified, created_at) 
                    VALUES ('$user', '$email', '$password_hash', 1, NOW())";
            
            if ($conn->query($sql)) {
                $inserted_id = $conn->insert_id;
                
                // Verify the stored password
                $check_query = $conn->query("SELECT password FROM users WHERE id = $inserted_id");
                $check_row = $check_query->fetch_assoc();
                $stored_password = $check_row['password'];
                
                error_log("Stored Password in DB: " . $stored_password);
                error_log("Can Verify After Insert: " . (password_verify($pending['password'], $stored_password) ? 'YES' : 'NO'));
                
                // Clear pending registration
                unset($_SESSION['pending_registration']);
                
                // Don't auto-login - redirect to login page instead
                echo json_encode([
                    'success' => true,
                    'message' => 'Email verified successfully! You can now login.',
                    'redirect' => 'loginform.php'
                ]);
            } else {
                error_log("SQL Error: " . $conn->error);
                echo json_encode([
                    'success' => false,
                    'message' => 'Registration failed. Please try again.'
                ]);
            }
        } else {
            // OTP expired
            unset($_SESSION['pending_registration']);
            echo json_encode([
                'success' => false,
                'message' => 'OTP has expired. Please register again.',
                'redirect' => 'registerform.php'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid OTP code. Please check and try again.'
        ]);
    }
    
    $conn->close();
    exit();
}

// Email sending function
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
                <h2 style='color: #0077be;'>Hello, " . htmlspecialchars($username) . "! </h2>
                
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
                    © 2024 Lakbay Gabay. All rights reserved.
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Lakbay Gabay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ocean-blue: #0077be;
            --turquoise: #40e0d0;
            --alice-blue: #f0f8ff;
        }
        
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f2f1 20%, #40e0d0 40%, #00a8cc 70%, #0077be 100%);
            background-attachment: fixed;
        }
        
        .glass-effect { 
            backdrop-filter: blur(20px); 
            background: rgba(255, 255, 255, 0.95); 
        }
        
        .otp-input {
            width: 50px;
            height: 60px;
            font-size: 24px;
            text-align: center;
            border: 2px solid #40e0d0;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .otp-input:focus {
            border-color: #0077be;
            box-shadow: 0 0 0 3px rgba(0, 119, 190, 0.2);
            outline: none;
            transform: scale(1.05);
        }
        
        /* Success Modal Styles */
        .success-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease-out;
        }
        
        .success-modal-overlay.active {
            display: flex;
        }
        
        .success-modal {
            background: white;
            border-radius: 24px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: modalSlideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }
        
        .success-modal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0077be, #00a8cc, #40e0d0);
        }
        
        .success-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 24px;
            background: linear-gradient(135deg, #0077be, #40e0d0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: successPulse 1s ease-in-out infinite;
        }
        
        .checkmark {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: block;
            stroke-width: 3;
            stroke: white;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px white;
            animation: fillCheck 0.4s ease-in-out 0.4s forwards, scaleCheck 0.3s ease-in-out 0.9s both;
        }
        
        .checkmark-circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 3;
            stroke-miterlimit: 10;
            stroke: white;
            fill: none;
            animation: strokeCheck 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }
        
        .checkmark-check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: strokeCheck 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #ffd700;
            animation: confettiFall 3s linear forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes strokeCheck {
            100% { stroke-dashoffset: 0; }
        }
        
        @keyframes scaleCheck {
            0%, 100% { transform: none; }
            50% { transform: scale3d(1.1, 1.1, 1); }
        }
        
        @keyframes fillCheck {
            100% { box-shadow: inset 0px 0px 0px 30px white; }
        }
        
        @keyframes confettiFall {
            to {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }
        
        .error-shake {
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
        
        @media (max-width: 640px) {
            .otp-input {
                width: 45px;
                height: 55px;
                font-size: 20px;
            }
            
            .success-modal {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Success Modal -->
    <div class="success-modal-overlay" id="successModal">
        <div class="success-modal">
            <div class="success-icon">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-3">Account Verified!</h2>
            <p class="text-gray-600 text-lg mb-2">Your email has been successfully verified.</p>
            <p class="text-gray-500 text-sm">Redirecting to login page...</p>
            <div class="mt-6">
                <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-500 h-2 rounded-full transition-all duration-300" id="progressBar" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full max-w-md mx-auto">
        <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 px-8 py-8 text-center text-white">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-envelope-open-text text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold mb-2">Verify Your Email</h1>
                <p class="text-white/90 text-sm">We've sent a 6-digit code to</p>
                <p class="text-white font-semibold"><?php echo htmlspecialchars($email); ?></p>
            </div>
            
            <div class="p-8">
                <!-- Error Alert -->
                <?php if ($error): ?>
                    <div class="mb-5 bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                            <p class="text-red-800"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Success Alert -->
                <?php if ($success): ?>
                    <div class="mb-5 bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <p class="text-green-800"><?php echo htmlspecialchars($success); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Dynamic Error Message -->
                <div id="errorAlert" class="mb-5 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 hidden">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-exclamation-triangle text-red-500"></i>
                        <p class="text-red-800" id="errorMessage"></p>
                    </div>
                </div>
                
                <form method="POST" action="" id="otpForm">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-4 text-center">Enter Verification Code</label>
                        <div class="flex justify-center gap-2 sm:gap-3" id="otp-inputs">
                            <input type="text" maxlength="1" class="otp-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" maxlength="1" class="otp-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" maxlength="1" class="otp-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" maxlength="1" class="otp-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" maxlength="1" class="otp-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                            <input type="text" maxlength="1" class="otp-input" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <input type="hidden" name="otp" id="otp-hidden">
                    </div>
                    
                    <button type="submit" id="verifyBtn"
                            class="w-full bg-gradient-to-r from-blue-600 to-cyan-500 text-white py-3.5 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all transform hover:scale-[1.02]">
                        <i class="fas fa-check-circle mr-2"></i>Verify Account
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-gray-600 mb-3 text-sm">Didn't receive the code?</p>
                    <form method="POST" action="" class="inline">
                        <button type="submit" name="resend_otp" 
                                class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors">
                            <i class="fas fa-redo mr-1"></i>Resend OTP
                        </button>
                    </form>
                </div>
                
                <div class="mt-4 text-center">
                    <p class="text-gray-500 text-xs flex items-center justify-center space-x-2">
                        <i class="fas fa-clock"></i>
                        <span>Code expires in <span id="timer" class="font-semibold text-blue-600">15:00</span></span>
                    </p>
                </div>
                
                <div class="mt-6 text-center pt-4 border-t border-gray-200">
                    <a href="registerform.php" class="text-gray-600 hover:text-blue-600 text-sm transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i>Back to Registration
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otp-hidden');
        const otpForm = document.getElementById('otpForm');
        const errorAlert = document.getElementById('errorAlert');
        const errorMessage = document.getElementById('errorMessage');
        const verifyBtn = document.getElementById('verifyBtn');
        const successModal = document.getElementById('successModal');
        
        // OTP Input Handling
        otpInputs.forEach((input, index) => {
            if (index === 0) input.focus();
            
            input.addEventListener('input', (e) => {
                // Only allow numbers
                if (!/^\d*$/.test(e.target.value)) {
                    e.target.value = '';
                    return;
                }
                
                // Move to next input
                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
                updateOTPValue();
            });
            
            input.addEventListener('keydown', (e) => {
                // Move to previous input on backspace
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
            
            // Paste handling (only on first input)
            if (index === 0) {
                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').trim().slice(0, 6);
                    
                    if (!/^\d{6}$/.test(pastedData)) {
                        showError('Please paste a valid 6-digit code');
                        return;
                    }
                    
                    pastedData.split('').forEach((char, i) => {
                        if (otpInputs[i]) otpInputs[i].value = char;
                    });
                    updateOTPValue();
                    otpInputs[5].focus();
                });
            }
        });
        
        function updateOTPValue() {
            otpHidden.value = Array.from(otpInputs).map(input => input.value).join('');
        }
        
        function showError(message) {
            errorMessage.textContent = message;
            errorAlert.classList.remove('hidden');
            
            // Add shake animation
            otpInputs.forEach(input => {
                input.classList.add('error-shake');
                setTimeout(() => input.classList.remove('error-shake'), 500);
            });
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                errorAlert.classList.add('hidden');
            }, 5000);
        }
        
        function showSuccessModal() {
            successModal.classList.add('active');
            createConfetti();
            
            // Animate progress bar
            const progressBar = document.getElementById('progressBar');
            let progress = 0;
            const interval = setInterval(() => {
                progress += 2;
                progressBar.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(interval);
                }
            }, 30);
        }
        
        function createConfetti() {
            const colors = ['#ffd700', '#40e0d0', '#0077be', '#00a8cc', '#ff69b4'];
            for (let i = 0; i < 50; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDelay = Math.random() * 0.5 + 's';
                    confetti.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    successModal.appendChild(confetti);
                    
                    setTimeout(() => confetti.remove(), 3000);
                }, i * 30);
            }
        }
        
        // Form submission
        otpForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (otpHidden.value.length !== 6) {
                showError('Please enter the complete 6-digit code');
                otpInputs[0].focus();
                return;
            }
            
            // Disable button and show loading
            const originalContent = verifyBtn.innerHTML;
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('verify_otp.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Show success modal
                    showSuccessModal();
                    
                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = result.redirect || 'loginform.php';
                    }, 2000);
                    
                } else {
                    showError(result.message || 'Verification failed. Please try again.');
                    
                    // Reset form
                    verifyBtn.disabled = false;
                    verifyBtn.innerHTML = originalContent;
                    
                    // Clear inputs
                    otpInputs.forEach(input => input.value = '');
                    otpInputs[0].focus();
                    
                    // Redirect if OTP expired
                    if (result.redirect) {
                        setTimeout(() => {
                            window.location.href = result.redirect;
                        }, 2000);
                    }
                }
                
            } catch (error) {
                console.error('Verification error:', error);
                showError('An error occurred. Please try again.');
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = originalContent;
            }
        });
        
        // Timer functionality
        const TIMER_KEY = 'otp_timer_start';
        const OTP_DURATION = 15 * 60; // 15 minutes in seconds
        
        function initializeTimer() {
            const timerElement = document.getElementById('timer');
            let startTime = sessionStorage.getItem(TIMER_KEY);
            
            if (!startTime) {
                startTime = Date.now();
                sessionStorage.setItem(TIMER_KEY, startTime);
            } else {
                startTime = parseInt(startTime);
            }
            
            function updateTimer() {
                const elapsed = Math.floor((Date.now() - startTime) / 1000);
                const timeLeft = Math.max(0, OTP_DURATION - elapsed);
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    timerElement.textContent = 'EXPIRED';
                    timerElement.classList.add('text-red-500');
                    otpInputs.forEach(input => input.disabled = true);
                    verifyBtn.disabled = true;
                    sessionStorage.removeItem(TIMER_KEY);
                    showError('OTP has expired. Please request a new one.');
                }
            }
            
            updateTimer();
            const countdown = setInterval(updateTimer, 1000);
        }
        
        initializeTimer();
        
        // Reset timer on resend
        const resendBtn = document.querySelector('button[name="resend_otp"]');
        if (resendBtn) {
            resendBtn.addEventListener('click', () => {
                sessionStorage.removeItem(TIMER_KEY);
            });
        }
    </script>
</body>
</html>