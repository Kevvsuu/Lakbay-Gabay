<?php
session_start();
require_once 'config/database.php';

// Redirect if no email or code in session
if (!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_code'])) {
    header("Location: forgot_password.php");
    exit();
}

// Check if code has expired
if (time() > strtotime($_SESSION['reset_expires'])) {
    session_destroy();
    header("Location: forgot_password.php?error=Code expired");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validate passwords
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Update password in database
        $database = new Database();
        $db = $database->getConnection();
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];
        
        $query = "UPDATE users SET password = :password WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        
        if ($stmt->execute()) {
            // Clear session and redirect to login
            session_destroy();
            header("Location: loginform.php?success=Password reset successfully");
            exit();
        } else {
            $error = "Failed to reset password. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - TravelSpotPH</title>
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
        
        .password-toggle {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .password-toggle:hover {
            color: var(--turquoise);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full flex items-center justify-center shadow-2xl" style="background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);">
                    <i class="fas fa-lock text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold mb-3 bg-gradient-to-r from-dark-blue via-ocean-blue to-cyan-blue bg-clip-text text-transparent">New Password</h2>
                <p class="text-dark-blue/80">Create a new password for your account</p>
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
                        <i class="fas fa-lock text-ocean-blue/60 text-lg"></i>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="New password"
                        required
                        minlength="6"
                        class="input-focus w-full pl-14 pr-12 py-4 border-2 border-turquoise/30 rounded-2xl text-dark-blue placeholder-ocean-blue/50 bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base font-medium shadow-lg"
                    >
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center">
                        <i class="password-toggle fas fa-eye text-ocean-blue/60 hover:text-turquoise" onclick="togglePassword('password')"></i>
                    </div>
                </div>
                
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-turquoise">
                        <i class="fas fa-lock text-ocean-blue/60 text-lg"></i>
                    </div>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        id="confirm_password"
                        placeholder="Confirm new password"
                        required
                        minlength="6"
                        class="input-focus w-full pl-14 pr-12 py-4 border-2 border-turquoise/30 rounded-2xl text-dark-blue placeholder-ocean-blue/50 bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base font-medium shadow-lg"
                    >
                    <div class="absolute inset-y-0 right-0 pr-5 flex items-center">
                        <i class="password-toggle fas fa-eye text-ocean-blue/60 hover:text-turquoise" onclick="togglePassword('confirm_password')"></i>
                    </div>
                </div>
                
                <button type="submit" class="btn-gradient w-full text-white font-bold py-4 px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center justify-center gap-3 text-base border border-gold-yellow/20">
                    <i class="fas fa-sync-alt"></i>
                    <span>Reset Password</span>
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
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.parentElement.querySelector('.password-toggle');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Password validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match');
                return false;
            }
            
            if (password.length < 6) {
                e.preventDefault();
                alert('Password must be at least 6 characters long');
                return false;
            }
        });
    </script>
</body>
</html>