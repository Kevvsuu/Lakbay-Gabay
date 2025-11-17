<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Lakbay Gabay</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Updated to match registerform.php exactly -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Apply Playfair Display to headings */
        h1, h2, h3, h4, h5, h6,
        .welcome-title,
        .font-playfair {
            font-family: 'Playfair Display', Georgia, 'Times New Roman', serif;
        }

        /* Ensure all other text uses Inter */
        p, span, a, button, input, select, textarea,
        .font-inter {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Updated header styling to match registerform.php exactly */
        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f2f1 20%, #40e0d0 40%, #00a8cc 70%, #0077be 100%);
            min-height: 100vh;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        
        .glass-effect {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(240, 248, 255, 0.95);
            border: 1px solid rgba(64, 224, 208, 0.3);
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
            0%, 100% { box-shadow: 0 0 20px rgba(255, 215, 0, 0.3); }
            50% { box-shadow: 0 0 40px rgba(255, 215, 0, 0.6); }
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.3), 0 8px 25px rgba(0, 168, 204, 0.2);
            border-color: var(--turquoise);
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
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--ocean-blue) 50%, var(--cyan-blue) 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 119, 190, 0.4);
        }
        
        .gold-accent {
            color: var(--gold-yellow);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        .floating-orb {
            background: radial-gradient(circle, rgba(64, 224, 208, 0.6) 0%, rgba(0, 168, 204, 0.3) 50%, transparent 70%);
        }
        
        /* Mobile-first form container design */
        .form-container {
            background: rgba(240, 248, 255, 0.92);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(64, 224, 208, 0.2);
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
            background: linear-gradient(135deg, rgba(240, 248, 255, 0.95) 0%, rgba(224, 242, 241, 0.9) 50%, rgba(240, 248, 255, 0.95) 100%);
            z-index: -1;
            border-radius: inherit;
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 119, 190, 0.3), 0 0 0 1px rgba(255, 215, 0, 0.3);
        }
        
        /* Enhanced validation styles */
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
        
        /* Main error alert styles - Fixed positioning and sizing */
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
            position: relative;
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
        
        .forgot-link {
            color: var(--ocean-blue);
            transition: all 0.3s ease;
        }
        
        .forgot-link:hover {
            color: var(--turquoise);
            text-shadow: 0 0 5px rgba(64, 224, 208, 0.5);
        }
        
        .remember-checkbox:checked {
            background-color: var(--turquoise);
            border-color: var(--turquoise);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        /* Mobile-first responsive design */
        @media (max-width: 640px) {
            .form-container {
                margin: 1rem;
                padding: 2rem 1.5rem;
                border-radius: 0.75rem;
                max-width: calc(100% - 2rem);
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
            
            .divider-spacing {
                margin: 1.5rem 0 !important;
            }
            
            .signup-link {
                margin-top: 1.5rem !important;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 641px) and (max-width: 1024px) {
            .form-container {
                margin: 2rem;
                padding: 2.5rem;
                border-radius: 1rem;
            }
        }

        /* Desktop optimizations */
        @media (min-width: 1025px) {
            .form-container {
                padding: 2.5rem 3rem;
            }
        }
        
        /* Ensure body can scroll properly on mobile and background extends correctly */
        html, body {
            height: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        
        body {
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f2f1 20%, #40e0d0 40%, #00a8cc 70%, #0077be 100%);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }
        
        /* Alert close button improvements */
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

        @keyframes sparkleAnim {
            0% { transform: scale(0) rotate(0deg); opacity: 1; }
            50% { transform: scale(1) rotate(180deg); opacity: 0.8; }
            100% { transform: scale(0) rotate(360deg); opacity: 0; }
        }

        /* Hamburger Button Styles - Perfect X Animation */
        .hamburger-btn {
            cursor: pointer;
            background: transparent;
            border: none;
            outline: none;
            position: relative;
            z-index: 2001;
            width: 30px;
            height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hamburger-line {
            display: block;
            width: 24px;
            height: 2px;
            background-color: white;
            margin: 3px 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center;
            border-radius: 1px;
        }

        /* Perfect X animation */
        .hamburger-btn.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
            width: 24px;
        }

        .hamburger-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }

        .hamburger-btn.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
            width: 24px;
        }

        /* Mobile menu animations */
        #mobile-menu {
            transition: all 0.3s ease-out;
            transform: translateY(-10px);
            opacity: 0;
            max-height: 0;
            overflow: hidden;
        }

        #mobile-menu:not(.hidden) {
            transform: translateY(0);
            opacity: 1;
            max-height: 500px;
        }

        /* Prevent body scroll when mobile menu is open */
        body.mobile-menu-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        /* Mobile menu account section */
        #mobile-menu .border-t {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .account-dropdown {
            position: relative;
            z-index: 50;
        }

        /* Dropdown menu - centered below account link */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, 10px); /* Start slightly below */
            background: rgba(255, 255, 255, 0.65); /* More solid for readability */
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 15px;
            box-shadow: 
                0 8px 32px rgba(0, 119, 190, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                inset 0 -1px 0 rgba(255, 255, 255, 0.1);
            min-width: 220px;
            z-index: 3001;
            overflow: hidden;
            transition: all 0.3s ease; /* Reduced duration */
            margin-top: 12px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255, 255, 255, 0.1), 
                transparent);
            animation: glassShimmer 8s linear infinite;
        }

        .dropdown-menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translate(-50%, 0) !important; /* Remove diagonal movement */
            pointer-events: auto;
        }
                                    
        @keyframes glassShimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        /* Dropdown items */
        .dropdown-item {
            display: block;
            padding: 12px 20px;
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95em;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 119, 190, 0.1), transparent);
            transition: left 0.3s ease;
        }

        .dropdown-item:hover::before {
            left: 100%;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
            color: #0077be;
            transform: translateX(5px);
        }

        .dropdown-item i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
            color: #40e0d0;
        }

        /* Dropdown arrow */
        .account-link::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-left: 8px;
            font-size: 0.8em;
            transition: transform 0.3s ease;
            display: inline-block;
            color: currentColor;
        }

        /* Arrow rotation when dropdown is active */
        .account-link.active::after {
            transform: rotate(180deg);
        }

        /* Change account link color when dropdown is open */
        .account-link.active {
            color: #40e0d0 !important;
        }
/* Success Animation Styles */
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

/* Success animation container entrance */
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
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'playfair': ['Playfair Display', 'serif'],
                    },
                    colors: {
                        'ocean-blue': '#0077be',
                        'ocean-cyan': '#00a8cc', 
                        'turquoise': '#40e0d0',
                        'azure': '#f0f8ff',
                        'slate-blue': '#2c3e50',
                        'gold': '#ffd700',
                        'ocean-dark': '#005a94',
                        'ocean-light': '#e6f7ff',
                    },
                }
            }
        }
    </script>
</head>
<body class="gradient-bg">
    <!-- Header with exact same navigation as contact.php -->
    <div class="fixed top-0 left-0 right-0 header-bg transition-all duration-300 z-50" id="header" style="padding: 16px 32px;">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <div class="logo">
                <a href="index.php" class="text-2xl lg:text-3xl font-bold font-playfair uppercase text-white tracking-wide hover:text-turquoise transition-colors duration-300">
                    Lakbay Gabay
                </a>
            </div>
            <div class="flex items-center gap-6">
                <!-- Navigation Menu -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="index.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">Home</a>
                    <a href="map.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">Destination</a>
                    <a href="griddestination.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">All Destination</a>
                    <a href="contact.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">Contact</a>
                    <a href="about_us.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">About</a>

                    <div class="account-dropdown relative" id="account-dropdown-container">
                        <a href="#" class="account-link text-white/90 hover:text-turquoise font-medium transition-colors duration-300 flex items-center gap-1">
                            Account
                        </a>
                        <div class="dropdown-menu">
                            <!-- Content will be populated by JavaScript -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-slate-blue">Loading...</p>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <!-- Language Selector -->
                <select class="bg-white/10 border border-white/20 text-white rounded-lg px-4 py-2 text-sm cursor-pointer hover:bg-white/20 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-turquoise" id="language-select">
                    <option value="en" class="bg-ocean-blue text-white">English (EN)</option>
                    <option value="ko" class="bg-ocean-blue text-white">Korean (KO)</option>
                    <option value="ja" class="bg-ocean-blue text-white">Japanese (JA)</option>
                    <option value="zh" class="bg-ocean-blue text-white">Chinese (ZH)</option>
                    <option value="ms" class="bg-ocean-blue text-white">Malay (MS)</option>
                    <option value="hi" class="bg-ocean-blue text-white">Hindi (HI)</option>
                    <option value="tl" class="bg-ocean-blue text-white">Filipino (TL)</option>
                    <option value="ceb" class="bg-ocean-blue text-white">Cebuano (CEB)</option>
                </select>
                
                <!-- Hamburger Button for Mobile -->
                <button class="hamburger-btn md:hidden flex flex-col justify-center items-center w-8 h-8 relative z-2001" id="hamburger-btn">
                    <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5 transition-all duration-300"></span>
                    <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5 transition-all duration-300"></span>
                    <span class="hamburger-line block w-6 h-0.5 bg-white transition-all duration-300"></span>
                </button>
            </div>
        </div>
        

        <div class="md:hidden mt-4 pb-4 border-t border-white/20 hidden" id="mobile-menu">
            <nav class="flex flex-col gap-3 mt-4">
                <a href="index.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">Home</a>
                <a href="map.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">Destination</a>
                <a href="griddestination.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">All Destination</a>
                <a href="contact.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">Contact</a>
                <a href="about_us.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">About</a>

                <!-- Mobile Account Dropdown -->
                <div class="border-t border-white/20 pt-3 mt-2">
                    <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                    <div class="px-2 py-1 text-white/80 text-sm mb-2">
                        Loading...
                    </div>
                </div>
            </nav>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center px-4 pt-20 sm:pt-24 pb-8 relative">
        <!-- Enhanced Floating Decoration Elements - Hidden on mobile -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none hidden sm:block">
            <div class="floating-orb absolute top-1/4 left-1/4 w-32 lg:w-40 h-32 lg:h-40 rounded-full blur-2xl animate-float"></div>
            <div class="floating-orb absolute top-3/4 right-1/4 w-24 lg:w-32 h-24 lg:h-32 rounded-full blur-2xl animate-float" style="animation-delay: -3s;"></div>
            <div class="floating-orb absolute bottom-1/4 left-1/3 w-20 lg:w-28 h-20 lg:h-28 rounded-full blur-2xl animate-float" style="animation-delay: -1.5s;"></div>
            <div class="absolute top-1/2 right-1/3 w-4 lg:w-6 h-4 lg:h-6 bg-gold-yellow rounded-full animate-pulse-glow" style="animation-delay: -2s;"></div>
            <div class="absolute top-1/3 left-1/2 w-3 lg:w-4 h-3 lg:h-4 bg-gold-yellow rounded-full animate-pulse-glow" style="animation-delay: -4s;"></div>
        </div>
        
        <!-- Login Form Container -->
        <div class="relative w-full max-w-md">
            <div class="form-container shadow-2xl p-6 sm:p-8 lg:p-10">
                <!-- Welcome Header -->
                <div class="welcome-header text-center mb-6 sm:mb-8">
                    <div class="welcome-icon w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 sm:mb-6 rounded-full flex items-center justify-center shadow-2xl animate-pulse-glow" style="background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);">
                        <i class="fas fa-user text-white text-xl sm:text-2xl"></i>
                    </div>
                    <h2 class="welcome-title text-2xl sm:text-3xl lg:text-4xl font-bold mb-2 sm:mb-3 bg-gradient-to-r from-slate-blue via-ocean-blue to-ocean-cyan bg-clip-text text-transparent font-playfair" data-translate="welcome-back">Welcome Back</h2>
                    <p class="text-dark-blue/80 text-sm sm:text-base font-medium">Sign in to continue your journey</p>
                </div>
                
                <!-- Error Alert -->
                <div id="error-alert" class="error-alert">
                    <i class="fas fa-exclamation-triangle text-lg flex-shrink-0 mt-0.5"></i>
                    <span id="error-message" class="flex-1">Invalid username or password. Please try again.</span>
                    <button onclick="hideError()" class="alert-close hover:text-red-700 transition-colors">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>

                <!-- Success Alert -->
                <div id="success-alert" class="success-alert">
                    <i class="fas fa-check-circle text-lg flex-shrink-0 mt-0.5"></i>
                    <span class="flex-1">Login successful! Redirecting...</span>
                </div>
                
                <!-- Login Form -->
                <form id="login-form" class="space-y-4 sm:space-y-5 form-spacing">
                    <!-- Username Field -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-turquoise">
                            <i class="fas fa-user text-ocean-blue/60 text-base sm:text-lg"></i>
                        </div>
                        <input 
                            type="text" 
                            name="username" 
                            id="username"
                            data-translate-placeholder="username" 
                            placeholder="Username"
                            required
                            class="input-focus w-full pl-12 sm:pl-14 pr-4 sm:pr-5 py-4 sm:py-5 border-2 border-turquoise/30 rounded-2xl text-dark-blue placeholder-ocean-blue/50 bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                        >
                        <div id="username-error" class="error-message">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Username is required
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-turquoise">
                            <i class="fas fa-lock text-ocean-blue/60 text-base sm:text-lg"></i>
                        </div>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            data-translate-placeholder="password" 
                            placeholder="Password"
                            required
                            class="input-focus w-full pl-12 sm:pl-14 pr-4 sm:pr-5 py-4 sm:py-5 border-2 border-turquoise/30 rounded-2xl text-dark-blue placeholder-ocean-blue/50 bg-alice-blue/80 hover:bg-alice-blue focus:bg-alice-blue transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                        >
                        <div id="password-error" class="error-message">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Password is required
                        </div>
                    </div>
                    
                    <!-- Forgot Password -->
                    <div class="flex items-center justify-end text-sm sm:text-base pt-2">
                        <a href="forgot_password.php" class="forgot-link font-semibold hover:underline transition-all duration-300 flex items-center gap-1">
                            <span>Forgot password?</span>
                            <i class="fas fa-key text-xs"></i>
                        </a>
                    </div>
                    
                    <!-- Login Button -->
                    <button type="submit" class="btn-gradient w-full text-white font-bold py-4 sm:py-5 px-6 sm:px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center justify-center gap-3 sm:gap-4 text-base sm:text-lg border border-gold-yellow/20 mt-6 sm:mt-8">
                        <i class="fas fa-sign-in-alt text-lg sm:text-xl"></i>
                        <span data-translate="login">Sign In</span>
                        <i class="fas fa-arrow-right text-gold-yellow"></i>
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="divider-spacing my-6 sm:my-8 lg:my-10 flex items-center">
                    <div class="flex-1 border-t-2 border-gradient-to-r from-turquoise/30 to-ocean-blue/30"></div>
                    <span class="px-4 sm:px-6 text-sm sm:text-base text-dark-blue/70 font-semibold">or</span>
                    <div class="flex-1 border-t-2 border-gradient-to-r from-ocean-blue/30 to-turquoise/30"></div>
                </div>
                
                <!-- Sign Up Link -->
                <p class="signup-link mt-6 sm:mt-8 lg:mt-10 text-center text-dark-blue/80 text-base sm:text-lg">
                    <span data-translate="no-account">Don't have an account?</span> 
                    <a href="registerform.php" class="text-ocean-blue hover:text-turquoise font-bold hover:underline transition-all duration-300 ml-2 text-lg sm:text-xl" data-translate="register-here">Sign Up here</a>
                    <i class="fas fa-user-plus ml-2 text-gold-yellow"></i>
                </p>
            </div>
        </div>
        
        <!-- Additional Decorative Elements - Hidden on mobile -->
        <div class="absolute bottom-10 left-10 text-gold-yellow/30 animate-pulse pointer-events-none hidden sm:block">
            <i class="fas fa-compass text-3xl sm:text-4xl"></i>
        </div>
        <div class="absolute top-32 right-10 text-turquoise/40 animate-float pointer-events-none hidden sm:block">
            <i class="fas fa-map-marker-alt text-2xl sm:text-3xl"></i>
        </div>
        
        <!-- Login Success Animation Container -->
        <div id="success-animation" class="fixed inset-0 bg-gradient-to-r from-turquoise/20 to-ocean-blue/20 backdrop-blur-sm hidden items-center justify-center z-50 px-4">
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl text-center max-w-sm w-full mx-4">
                <div class="checkmark-container mb-4">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-dark-blue font-playfair">Welcome!</h3>
                <p class="text-ocean-blue mt-2">Redirecting you...</p>
            </div>
        </div>
    </div>

    <script>
        // Login status management - Same as contact.php
        let isLoggedIn = false;
        let userName = '';

        async function checkLoginStatus() {
            try {
                const response = await fetch('check_login.php');
                const data = await response.json();
                
                isLoggedIn = data.logged_in || false;
                userName = data.username || '';
                
                updateAccountDropdown();
                updateMobileAccountSection();
            } catch (error) {
                console.error('Error checking login status:', error);
                isLoggedIn = false;
                userName = '';
                updateAccountDropdown();
                updateMobileAccountSection();
            }
        }

        function updateAccountDropdown() {
            const dropdown = document.querySelector('.dropdown-menu');
            if (!dropdown) return;
            
            if (isLoggedIn) {
                dropdown.innerHTML = `
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-slate-blue">Hello, ${userName}</p>
                    </div>
                    <a href="userdashboard.php" class="dropdown-item flex items-center gap-3">
                        <i class="fas fa-tachometer-alt text-ocean-cyan w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="logout.php" class="dropdown-item flex items-center gap-3 border-t border-gray-100">
                        <i class="fas fa-sign-out-alt text-red-500 w-5"></i>
                        <span>Logout</span>
                    </a>
                `;
            } else {
                dropdown.innerHTML = `
                    <a href="loginform.php" class="dropdown-item flex items-center gap-3">
                        <i class="fas fa-sign-in-alt text-ocean-cyan w-5"></i>
                        <span>Login</span>
                    </a>
                    <a href="registerform.php" class="dropdown-item flex items-center gap-3 border-t border-gray-100">
                        <i class="fas fa-user-plus text-green-500 w-5"></i>
                        <span>Register</span>
                    </a>
                `;
            }
        }

        function updateMobileAccountSection() {
            const mobileAccountSection = document.querySelector('#mobile-menu .border-t');
            if (!mobileAccountSection) return;
            
            if (isLoggedIn) {
                mobileAccountSection.innerHTML = `
                    <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                    <div class="px-2 py-1 text-white/80 text-sm mb-2">
                        Welcome, ${userName}
                    </div>
                    <a href="userdashboard.php" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="logout.php" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </a>
                `;
            } else {
                mobileAccountSection.innerHTML = `
                    <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                    <a href="loginform.php" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
                        <i class="fas fa-sign-in-alt w-5"></i>
                        <span>Login</span>
                    </a>
                    <a href="registerform.php" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
                        <i class="fas fa-user-plus w-5"></i>
                        <span>Register</span>
                    </a>
                `;
            }
        }

        let accountDropdown = {
            isOpen: false,
            element: null,
            link: null,
            container: null
        };

        function initializeAccountDropdown() {
            accountDropdown.link = document.querySelector('.account-link');
            accountDropdown.element = document.querySelector('.dropdown-menu');
            accountDropdown.container = document.querySelector('.account-dropdown');
            
            if (accountDropdown.link && accountDropdown.element) {
                // REMOVE HOVER BEHAVIOR - Remove group classes from HTML
                accountDropdown.container.classList.remove('group');
                
                // Handle click on account link
                accountDropdown.link.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Toggle dropdown visibility
                    if (accountDropdown.isOpen) {
                        hideAccountDropdown();
                    } else {
                        showAccountDropdown();
                    }
                });
                
                // Hide dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (accountDropdown.container && !accountDropdown.container.contains(e.target)) {
                        hideAccountDropdown();
                    }
                });
                
                // Handle keyboard navigation
                accountDropdown.link.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        accountDropdown.link.click();
                    } else if (e.key === 'Escape') {
                        hideAccountDropdown();
                    }
                });
                
                // Handle dropdown item clicks
                accountDropdown.element.addEventListener('click', function(e) {
                    const dropdownItem = e.target.closest('.dropdown-item');
                    if (dropdownItem) {
                        setTimeout(() => hideAccountDropdown(), 100);
                    }
                });
            }
        }

        function showAccountDropdown() {
            if (accountDropdown.element) {
                accountDropdown.element.classList.add('show');
                accountDropdown.element.style.opacity = '1';
                accountDropdown.element.style.visibility = 'visible';
                accountDropdown.element.style.transform = 'translate(-50%, 0)';
                
                // Update arrow rotation
                if (accountDropdown.link) {
                    accountDropdown.link.classList.add('active');
                }
                
                accountDropdown.isOpen = true;
            }
        }

        function hideAccountDropdown() {
            if (accountDropdown.element) {
                accountDropdown.element.classList.remove('show');
                accountDropdown.element.style.opacity = '0';
                accountDropdown.element.style.visibility = 'hidden';
                accountDropdown.element.style.transform = 'translate(-50%, 10px)';
                
                // Reset arrow rotation
                if (accountDropdown.link) {
                    accountDropdown.link.classList.remove('active');
                }
                
                accountDropdown.isOpen = false;
            }
        }

        // Mobile menu toggle functionality
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent event bubbling
                
                const isHidden = mobileMenu.classList.contains('hidden');
                const hamburgerLines = this.querySelectorAll('.hamburger-line');
                
                if (isHidden) {
                    // Show menu with animation
                    mobileMenu.classList.remove('hidden');
                    document.body.classList.add('mobile-menu-open');
                    setTimeout(() => {
                        mobileMenu.style.transition = 'all 0.3s ease-out';
                        mobileMenu.style.opacity = '1';
                        mobileMenu.style.transform = 'translateY(0)';
                    }, 10);
                    
                    // Transform hamburger to X
                    hamburgerLines[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                    hamburgerLines[1].style.opacity = '0';
                    hamburgerLines[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
                    
                } else {
                    // Hide menu with animation
                    mobileMenu.style.opacity = '0';
                    mobileMenu.style.transform = 'translateY(-10px)';
                    document.body.classList.remove('mobile-menu-open');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.transition = '';
                    }, 300);
                    
                    // Revert hamburger to original state
                    hamburgerLines[0].style.transform = 'none';
                    hamburgerLines[1].style.opacity = '1';
                    hamburgerLines[2].style.transform = 'none';
                }
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileMenu.classList.contains('hidden') && 
                    !hamburgerBtn.contains(e.target) && 
                    !mobileMenu.contains(e.target)) {
                    
                    mobileMenu.style.opacity = '0';
                    mobileMenu.style.transform = 'translateY(-10px)';
                    document.body.classList.remove('mobile-menu-open');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.transition = '';
                    }, 300);
                    
                    const hamburgerLines = hamburgerBtn.querySelectorAll('.hamburger-line');
                    hamburgerLines[0].style.transform = 'none';
                    hamburgerLines[1].style.opacity = '1';
                    hamburgerLines[2].style.transform = 'none';
                }
            });

            // Close mobile menu when clicking on links (optional)
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.style.opacity = '0';
                    mobileMenu.style.transform = 'translateY(-10px)';
                    document.body.classList.remove('mobile-menu-open');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.transition = '';
                    }, 300);
                    
                    const hamburgerLines = hamburgerBtn.querySelectorAll('.hamburger-line');
                    hamburgerLines[0].style.transform = 'none';
                    hamburgerLines[1].style.opacity = '1';
                    hamburgerLines[2].style.transform = 'none';
                });
            });
        }

        // Header scroll effect
        let lastScrollTop = 0;
        const header = document.getElementById('header');

        if (header) {
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
                lastScrollTop = scrollTop;
            });
        }

        let currentLanguage = 'en';
        const translationCache = new Map();

        async function translateText(text, targetLang) {
            if (!text || targetLang === 'en') return text;
            
            // Check cache first
            const cacheKey = `${targetLang}:${text}`;
            if (translationCache.has(cacheKey)) {
                return translationCache.get(cacheKey);
            }
            
            try {
                const response = await fetch(`translate.php?text=${encodeURIComponent(text)}&target_lang=${targetLang}`);
                const data = await response.json();
                const translatedText = data.responseData.translatedText || text;
                
                // Cache the translation
                translationCache.set(cacheKey, translatedText);
                return translatedText;
            } catch (error) {
                console.error('Translation error:', error);
                return text;
            }
        }

        async function translatePage(lang) {
            currentLanguage = lang;
            document.getElementById('language-select').value = lang;
            
            // Translate all elements with data-translate attribute
            const elements = document.querySelectorAll('[data-translate]');
            for (const element of elements) {
                const originalText = element.textContent.trim();
                if (originalText) {
                    element.textContent = await translateText(originalText, lang);
                }
            }
            
            // Translate all placeholders
            const placeholders = document.querySelectorAll('[data-translate-placeholder]');
            for (const element of placeholders) {
                const originalPlaceholder = element.getAttribute('placeholder');
                if (originalPlaceholder) {
                    element.setAttribute('placeholder', await translateText(originalPlaceholder, lang));
                }
            }
        }

        // Function to show error message
        function showError(message) {
            const errorAlert = document.getElementById('error-alert');
            const errorMessage = document.getElementById('error-message');
            const successAlert = document.getElementById('success-alert');
            
            // Hide success alert if visible
            successAlert.classList.remove('show');
            
            // Set error message and show alert
            errorMessage.textContent = message;
            errorAlert.classList.add('show');
            
            // Add shake effect to form
            const form = document.querySelector('.form-container');
            form.classList.add('shake');
            setTimeout(() => {
                form.classList.remove('shake');
            }, 500);
        }

        // Function to hide error message
        function hideError() {
            const errorAlert = document.getElementById('error-alert');
            errorAlert.classList.remove('show');
        }

        // Function to show success message
        function showSuccess() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            
            // Hide error alert if visible
            errorAlert.classList.remove('show');
            
            // Show success alert
            successAlert.classList.add('show');
        }

        // Enhanced validation with visual feedback
        function validateForm() {
            let isValid = true;
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
            
            // Check username with animation
            if (!username.value.trim()) {
                document.getElementById('username-error').style.display = 'block';
                username.classList.add('input-error');
                username.classList.add('shake');
                setTimeout(() => username.classList.remove('shake'), 500);
                isValid = false;
            }
            
            // Check password with animation
            if (!password.value.trim()) {
                document.getElementById('password-error').style.display = 'block';
                password.classList.add('input-error');
                password.classList.add('shake');
                setTimeout(() => password.classList.remove('shake'), 500);
                isValid = false;
            }
            
            return isValid;
        }

        // Initialize language selector
        document.getElementById('language-select').addEventListener('change', async (e) => {
            const lang = e.target.value;
            localStorage.setItem('preferredLanguage', lang);
            await translatePage(lang);
        });

        // Handle form submission with enhanced feedback and proper error handling
// Handle form submission with enhanced feedback and proper error handling
document.getElementById('login-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    hideError();
    
    if (!validateForm()) {
        return;
    }
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalContent = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-xl"></i><span>Signing In...</span>';
    submitBtn.disabled = true;
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('login.php', {
            method: 'POST',
            body: formData
        });
        
        const contentType = response.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
            const result = await response.json();
            
            if (result.success) {
                // ✅ Set freshLogin flag and clear spotlight
                sessionStorage.setItem('freshLogin', 'true');
                sessionStorage.removeItem('userSeenSpotlight');
                
                // ✅ Store preference modal flag if needed
                if (result.show_preferences_modal) {
                    sessionStorage.setItem('showPreferencesModal', 'true');
                }
                
                showSuccess();
                
                document.getElementById('success-animation').classList.remove('hidden');
                document.getElementById('success-animation').classList.add('flex');
                
                setTimeout(() => {
                    window.location.href = result.redirect || 'map.php';
                }, 1500);
            } else {
                showError(result.message || 'Invalid username or password. Please try again.');
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            }
        } else {
            if (response.ok && response.redirected) {
                // ✅ Set freshLogin flag and clear spotlight
                sessionStorage.setItem('freshLogin', 'true');
                sessionStorage.removeItem('userSeenSpotlight');
                
                showSuccess();
                
                document.getElementById('success-animation').classList.remove('hidden');
                document.getElementById('success-animation').classList.add('flex');
                
                setTimeout(() => {
                    window.location.href = response.url;
                }, 1500);
            } else {
                showError('Invalid username or password. Please try again.');
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            }
        }
    } catch (error) {
        console.error('Login error:', error);
        showError('An error occurred. Please try again.');
        submitBtn.innerHTML = originalContent;
        submitBtn.disabled = false;
    }
});

        // Initialize page with enhanced animations
        document.addEventListener('DOMContentLoaded', async () => {
            // Initialize navigation components
            initializeAccountDropdown();
            checkLoginStatus();
            
            const savedLang = localStorage.getItem('preferredLanguage') || 'en';
            document.getElementById('language-select').value = savedLang;
            if (savedLang !== 'en') {
                await translatePage(savedLang);
            }
            
            // Add smooth entrance animation
            const form = document.querySelector('.form-container');
            form.style.opacity = '0';
            form.style.transform = 'translateY(30px) scale(0.95)';
            
            setTimeout(() => {
                form.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                form.style.opacity = '1';
                form.style.transform = 'translateY(0) scale(1)';
            }, 200);
        });

        // Interactive sparkle effects
        document.addEventListener('mousemove', (e) => {
            if (Math.random() > 0.97) {
                createSparkle(e.clientX, e.clientY);
            }
        });

        function createSparkle(x, y) {
            const sparkle = document.createElement('div');
            sparkle.style.position = 'fixed';
            sparkle.style.left = x + 'px';
            sparkle.style.top = y + 'px';
            sparkle.style.width = '4px';
            sparkle.style.height = '4px';
            sparkle.style.background = '#ffd700';
            sparkle.style.borderRadius = '50%';
            sparkle.style.pointerEvents = 'none';
            sparkle.style.zIndex = '9999';
            sparkle.style.animation = 'sparkleAnim 1s ease-out forwards';
            document.body.appendChild(sparkle);

            setTimeout(() => {
                sparkle.remove();
            }, 1000);
        }

        // Clear input animations on input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => {
                input.classList.remove('input-error', 'shake');
                input.parentElement.querySelector('.error-message').style.display = 'none';
                // Also hide the main error alert when user starts typing
                hideError();
            });
        });

        // Auto-hide error message after 5 seconds
        let errorTimeout;
        function autoHideError() {
            clearTimeout(errorTimeout);
            errorTimeout = setTimeout(() => {
                hideError();
            }, 5000);
        }

        // Update showError function to include auto-hide
        const originalShowError = showError;
        showError = function(message) {
            originalShowError(message);
            autoHideError();
        };
    </script>
</body>
</html>