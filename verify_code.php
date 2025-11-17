<?php
session_start();

// Redirect if no email in session
if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['code'])) {
    $entered_code = $_POST['code'];
    
    // Check if code matches and hasn't expired
    if (isset($_SESSION['reset_code']) && 
        $entered_code == $_SESSION['reset_code'] &&
        time() < strtotime($_SESSION['reset_expires'])) {
        
        // Code is valid, redirect to reset password page
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "Invalid or expired verification code.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code - Lakbay Gabay</title>
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
        
        .code-input {
            letter-spacing: 0.5em;
            font-size: 1.5rem;
            text-align: center;
            padding: 0.5rem;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="glass-effect rounded-3xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full flex items-center justify-center shadow-2xl" style="background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold mb-3 bg-gradient-to-r from-dark-blue via-ocean-blue to-cyan-blue bg-clip-text text-transparent">Verification Code</h2>
                <p class="text-dark-blue/80">Enter the 6-digit code sent to your email</p>
                <p class="text-sm text-ocean-blue mt-2"><?php echo substr($_SESSION['reset_email'], 0, 3) . '***' . strstr($_SESSION['reset_email'], '@'); ?></p>
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
                    <input 
                        type="text" 
                        name="code" 
                        id="code"
                        placeholder="000000"
                        maxlength="6"
                        required
                        class="code-input input-focus w-full pl-5 pr-5 py-4 border-2 border-turquoise/30 rounded-2xl text-dark-blue placeholder-ocean-blue/50 bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none font-medium shadow-lg"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,6)"
                    >
                </div>
                
                <button type="submit" class="btn-gradient w-full text-white font-bold py-4 px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center justify-center gap-3 text-base border border-gold-yellow/20">
                    <i class="fas fa-check-circle"></i>
                    <span>Verify Code</span>
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="forgot_password.php" class="text-ocean-blue hover:text-turquoise font-semibold transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Back to Email Entry
                </a>
            </div>
        </div>
    </div>

    <script>
        // Auto-focus and auto-tab between inputs (if using multiple inputs)
        document.getElementById('code').focus();
    </script>
</body>
</html>