<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - TravelSpotPH</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
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
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f7fa 20%, #b2ebf2 40%, #00a8cc 70%, #0077be 100%);
            min-height: 100vh;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        
        .glass-effect {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(240, 248, 255, 0.95);
            border: 1px solid rgba(0, 119, 190, 0.3);
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(2deg); }
        }
        
        .animate-pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(0, 168, 204, 0.4); }
            50% { box-shadow: 0 0 40px rgba(64, 224, 208, 0.6); }
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(0, 168, 204, 0.3), 0 8px 25px rgba(64, 224, 208, 0.2);
            border-color: var(--cyan-blue);
            background: rgba(240, 248, 255, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-3px);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--cyan-blue) 50%, var(--turquoise) 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, var(--cyan-blue) 0%, var(--turquoise) 50%, #5ae0d0 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(64, 224, 208, 0.4);
        }
        
        .back-btn {
            background: rgba(240, 248, 255, 0.9);
            border: 2px solid var(--ocean-blue);
            color: var(--ocean-blue);
        }
        
        .back-btn:hover {
            background: var(--ocean-blue);
            color: white;
            transform: translateX(-3px) translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 119, 190, 0.4);
        }
        
        .admin-accent {
            color: var(--turquoise);
            text-shadow: 0 0 10px rgba(64, 224, 208, 0.5);
        }
        
        .floating-orb {
            background: radial-gradient(circle, rgba(64, 224, 208, 0.6) 0%, rgba(0, 168, 204, 0.3) 50%, transparent 70%);
        }
        
        .form-container {
            background: rgba(240, 248, 255, 0.92);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(0, 168, 204, 0.2);
            transition: all 0.5s ease;
            border-radius: 1rem;
            width: 100%;
            max-width: 28rem;
            min-height: auto;
            position: relative;
            overflow: hidden;
        }
        
        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(240, 248, 255, 0.95) 0%, rgba(224, 247, 250, 0.9) 50%, rgba(240, 248, 255, 0.95) 100%);
            z-index: -1;
            border-radius: inherit;
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 168, 204, 0.3), 0 0 0 1px rgba(64, 224, 208, 0.3);
        }
        
        .input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
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
            max-width: 100%;
            word-wrap: break-word;
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
        
        @keyframes successSlideIn {
            from {
                opacity: 0;
                transform: translateY(-15px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        .security-badge {
            background: linear-gradient(135deg, rgba(0, 168, 204, 0.1) 0%, rgba(64, 224, 208, 0.1) 100%);
            border: 1px solid rgba(0, 168, 204, 0.3);
        }
        
        .admin-icon-glow {
            box-shadow: 0 0 30px rgba(64, 224, 208, 0.5);
        }

        @media (max-width: 640px) {
            .form-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
                border-radius: 0.75rem;
                max-width: calc(100% - 2rem);
            }
            
            .back-btn {
                position: fixed;
                top: 4.5rem;
                left: 1rem;
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }
            
            .floating-orb {
                display: none;
            }
            
            .welcome-icon {
                width: 4rem !important;
                height: 4rem !important;
                margin-bottom: 1rem !important;
            }
            
            .welcome-title {
                font-size: 1.875rem !important;
                margin-bottom: 0.75rem !important;
            }
            
            .welcome-header {
                margin-bottom: 2rem !important;
            }
            
            .input-focus {
                padding: 1rem 1.25rem 1rem 3rem;
                font-size: 1rem;
            }
            
            .btn-gradient {
                padding: 1rem 2rem;
                font-size: 1rem;
            }
            
            .form-container:hover {
                transform: translateY(-2px);
            }
            
            .security-info {
                margin-top: 1.5rem !important;
            }

            .security-badge {
                padding: 0.5rem 0.75rem !important;
                font-size: 0.75rem !important;
                gap: 0.5rem !important;
            }

            .security-badge span {
                display: none;
            }

            .security-badge::after {
                content: 'Restricted';
                font-size: 0.75rem;
            }
        }

        @media (min-width: 641px) and (max-width: 1024px) {
            .form-container {
                margin: 2rem;
                padding: 2.5rem;
                border-radius: 1rem;
            }
        }

        @media (min-width: 1025px) {
            .form-container {
                padding: 2.5rem 3rem;
            }
        }
        
        html, body {
            height: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        
        body {
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f7fa 20%, #b2ebf2 40%, #00a8cc 70%, #0077be 100%);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        
        .alert-close {
            flex-shrink: 0;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }
        
        .alert-close:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
/* Success Animation Styles */
.checkmark-container {
    width: 80px;
    height: 80px;
    margin: 0 auto;
}

@media (max-width: 640px) {
    .checkmark-container {
        width: 60px;
        height: 60px;
    }
}

.checkmark {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: block;
    stroke-width: 3;
    stroke: var(--turquoise);
    stroke-miterlimit: 10;
    animation: scale .3s ease-in-out .9s both;
}

.checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 3;
    stroke-miterlimit: 10;
    stroke: var(--turquoise);
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark-check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    stroke: var(--turquoise);
    stroke-width: 3;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }
    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

#success-animation {
    animation: fadeIn 0.3s ease-out;
}

#success-animation > div {
    animation: slideUp 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ocean-blue': '#0077be',
                        'cyan-blue': '#00a8cc',
                        'turquoise': '#40e0d0',
                        'dark-blue': '#2c3e50',
                        'alice-blue': '#f0f8ff',
                        'gold-yellow': '#ffd700'
                    }
                }
            }
        }
    </script>
</head>
<body class="gradient-bg min-h-screen">
    <!-- Header -->
    <header class="header-bg fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 lg:px-8 py-3 sm:py-4 shadow-2xl transition-all duration-300">
        <div class="flex justify-between items-center">
            <div class="logo">
                <a href="#" class="text-lg sm:text-xl lg:text-2xl font-bold uppercase text-white tracking-wide hover:text-gold-yellow transition-all duration-300 drop-shadow-lg admin-accent">
                    🛡️ Admin Portal
                </a>
            </div>
            
            <!-- Security Badge -->
            <div class="security-badge backdrop-blur-sm text-cyan-blue px-2 sm:px-4 py-2 rounded-xl cursor-pointer hover:bg-cyan-blue/10 transition-all duration-300 shadow-lg flex items-center gap-1 sm:gap-2 text-xs sm:text-sm" style="color: var(--ocean-blue);">
                <i class="fas fa-shield-alt" style="color: var(--ocean-blue);"></i>
                <span class="font-medium">Restricted Access</span>
            </div>
        </div>
    </header>
    
    <!-- Back Button -->
    <button onclick="window.location.href='index.php'" class="back-btn fixed top-16 sm:top-20 left-4 sm:left-6 z-40 px-4 sm:px-6 py-2 sm:py-3 rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl flex items-center gap-2 sm:gap-3 font-semibold backdrop-blur-sm text-sm sm:text-base">
        <i class="fas fa-arrow-left text-base sm:text-lg"></i>
        <span class="hidden sm:inline">Back to Home</span>
        <span class="sm:hidden">Back</span>
    </button>
    
    <div class="min-h-screen flex items-center justify-center px-4 pt-20 sm:pt-24 pb-8 relative">
        <!-- Enhanced Floating Decoration Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none hidden sm:block">
            <div class="floating-orb absolute top-1/4 left-1/4 w-32 lg:w-40 h-32 lg:h-40 rounded-full blur-2xl animate-float"></div>
            <div class="floating-orb absolute top-3/4 right-1/4 w-24 lg:w-32 h-24 lg:h-32 rounded-full blur-2xl animate-float" style="animation-delay: -3s;"></div>
            <div class="floating-orb absolute bottom-1/4 left-1/3 w-20 lg:w-28 h-20 lg:h-28 rounded-full blur-2xl animate-float" style="animation-delay: -1.5s;"></div>
            <div class="absolute top-1/2 right-1/3 w-4 lg:w-6 h-4 lg:h-6 rounded-full animate-pulse-glow" style="animation-delay: -2s; background: var(--turquoise);"></div>
            <div class="absolute top-1/3 left-1/2 w-3 lg:w-4 h-3 lg:h-4 rounded-full animate-pulse-glow" style="animation-delay: -4s; background: var(--cyan-blue);"></div>
        </div>
        
        <div class="relative w-full max-w-md">
            <div class="form-container shadow-2xl p-6 sm:p-8 lg:p-10">
                <!-- Admin Header -->
                <div class="welcome-header text-center mb-6 sm:mb-8 lg:mb-10">
                    <div class="welcome-icon w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 sm:mb-6 rounded-full flex items-center justify-center shadow-2xl animate-pulse-glow admin-icon-glow" style="background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--cyan-blue) 50%, var(--turquoise) 100%);">
                        <i class="fas fa-shield-halved text-white text-xl sm:text-2xl"></i>
                    </div>
                    <h2 class="welcome-title text-2xl sm:text-3xl lg:text-4xl font-bold mb-2 sm:mb-3 bg-gradient-to-r from-ocean-blue via-cyan-blue to-turquoise bg-clip-text text-transparent" style="background: linear-gradient(135deg, var(--ocean-blue), var(--cyan-blue), var(--turquoise)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Admin Portal</h2>
                    <p class="font-medium" style="color: var(--ocean-blue); opacity: 0.8;">Authorized Personnel Only 🔐</p>
                </div>
                
                <div id="error-alert" class="error-alert">
                    <i class="fas fa-exclamation-triangle text-lg flex-shrink-0 mt-0.5"></i>
                    <span id="error-message" class="flex-1">Invalid credentials. Access denied.</span>
                    <button onclick="hideError()" class="alert-close hover:text-red-700 transition-colors">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <div id="success-alert" class="success-alert">
                    <i class="fas fa-check-circle text-lg flex-shrink-0 mt-0.5"></i>
                    <span class="flex-1">Access granted! Redirecting to admin panel...</span>
                </div>
                
                <form id="login-form" class="space-y-4 sm:space-y-5 lg:space-y-6">
                    <!-- Username Field -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-cyan-blue">
                            <i class="fas fa-user-shield text-base sm:text-lg" style="color: rgba(0, 168, 204, 0.6);"></i>
                        </div>
                        <input 
                            type="text" 
                            name="username" 
                            id="username"
                            placeholder="Admin Username"
                            required
                            class="input-focus w-full pl-12 sm:pl-14 pr-4 sm:pr-5 py-4 sm:py-5 border-2 rounded-2xl text-dark-blue bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                            style="border-color: rgba(0, 168, 204, 0.3); color: var(--dark-blue);"
                        >
                        <div id="username-error" class="error-message">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Admin username is required
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-cyan-blue">
                            <i class="fas fa-key text-base sm:text-lg" style="color: rgba(0, 168, 204, 0.6);"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            placeholder="Admin Password"
                            required
                            class="input-focus w-full pl-12 sm:pl-14 pr-4 sm:pr-5 py-4 sm:py-5 border-2 rounded-2xl text-dark-blue bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                            style="border-color: rgba(0, 168, 204, 0.3); color: var(--dark-blue);"
                        >
                        <div id="password-error" class="error-message">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Admin password is required
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-gradient w-full text-white font-bold py-4 sm:py-5 px-6 sm:px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center justify-center gap-3 sm:gap-4 text-base sm:text-lg border mt-6 sm:mt-8" style="border-color: rgba(0, 168, 204, 0.2);">
                        <i class="fas fa-shield-halved text-lg sm:text-xl"></i>
                        <span>Access Admin Panel</span>
                        <i class="fas fa-arrow-right text-gold-yellow"></i>
                    </button>
                </form>
                
                <!-- Additional Security Info -->
                <div class="security-info mt-6 sm:mt-8 text-center">
                    <div class="flex items-center justify-center gap-2 sm:gap-3 text-xs sm:text-sm" style="color: rgba(0, 119, 190, 0.7);">
                        <i class="fas fa-lock"></i>
                        <span class="font-medium">256-bit SSL Encrypted</span>
                        <i class="fas fa-eye"></i>
                        <span class="font-medium">Activity Monitored</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-10 animate-pulse pointer-events-none hidden sm:block" style="color: rgba(0, 168, 204, 0.3);">
            <i class="fas fa-server text-3xl sm:text-4xl"></i>
        </div>
        <div class="absolute top-32 right-10 animate-float pointer-events-none hidden sm:block" style="color: rgba(64, 224, 208, 0.4);">
            <i class="fas fa-database text-2xl sm:text-3xl"></i>
        </div>
        
        <div id="success-animation" class="fixed inset-0 backdrop-blur-sm hidden items-center justify-center z-50 px-4" style="background: linear-gradient(135deg, rgba(0, 168, 204, 0.2), rgba(64, 224, 208, 0.2));">
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl text-center max-w-sm w-full mx-4">
                <div class="checkmark-container mb-4">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-dark-blue">Access Granted!</h3>
                <p style="color: var(--ocean-blue);">Loading admin panel...</p>
            </div>
        </div>
    </div>

    <script>
        function showError(message) {
            const errorAlert = document.getElementById('error-alert');
            const errorMessage = document.getElementById('error-message');
            const successAlert = document.getElementById('success-alert');
            
            successAlert.classList.remove('show');
            errorMessage.textContent = message;
            errorAlert.classList.add('show');
            
            const form = document.querySelector('.form-container');
            form.classList.add('shake');
            setTimeout(() => {
                form.classList.remove('shake');
            }, 500);
        }

        function hideError() {
            const errorAlert = document.getElementById('error-alert');
            errorAlert.classList.remove('show');
        }

        function showSuccess() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            errorAlert.classList.remove('show');
            successAlert.classList.add('show');
        }

        function validateForm() {
            let isValid = true;
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            
            document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
            
            if (!username.value.trim()) {
                document.getElementById('username-error').style.display = 'block';
                username.classList.add('input-error', 'shake');
                setTimeout(() => username.classList.remove('shake'), 500);
                isValid = false;
            }
            
            if (!password.value.trim()) {
                document.getElementById('password-error').style.display = 'block';
                password.classList.add('input-error', 'shake');
                setTimeout(() => password.classList.remove('shake'), 500);
                isValid = false;
            }
            
            return isValid;
        }

        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            hideError();
            
            if (!validateForm()) {
                return;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-xl"></i><span>Authenticating...</span>';
            submitBtn.disabled = true;
            
            const username = document.querySelector('input[name="username"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            try {
                const response = await fetch('admin_login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        username: username,
                        password: password
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showSuccess();
                    document.getElementById('success-animation').classList.remove('hidden');
                    document.getElementById('success-animation').classList.add('flex');
                    
                    setTimeout(() => {
                        window.location.href = 'admin.php';
                    }, 2000);
                } else {
                    showError(data.message || 'Access denied. Invalid credentials.');
                    submitBtn.innerHTML = originalContent;
                    submitBtn.disabled = false;
                }
            } catch (error) {
                console.error('Login error:', error);
                showError('Authentication error. Please try again.');
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('.form-container');
            form.style.opacity = '0';
            form.style.transform = 'translateY(30px) scale(0.95)';
            
            setTimeout(() => {
                form.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                form.style.opacity = '1';
                form.style.transform = 'translateY(0) scale(1)';
            }, 200);
        });

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                input.classList.remove('input-error', 'shake');
                input.parentElement.querySelector('.error-message').style.display = 'none';
                hideError();
            });
        });

        let errorTimeout;
        function autoHideError() {
            clearTimeout(errorTimeout);
            errorTimeout = setTimeout(() => {
                hideError();
            }, 7000);
        }

        const originalShowError = showError;
        showError = function(message) {
            originalShowError(message);
            autoHideError();
        };
    </script>
</body>
</html>