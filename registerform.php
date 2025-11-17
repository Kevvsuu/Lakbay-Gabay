<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Lakbay Gabay</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Updated to match index.php exactly -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ocean-blue: #0077be;
            --cyan-blue: #00a8cc;
            --turquoise: #40e0d0;
            --alice-blue: #f0f8ff;
            --dark-blue: #2c3e50;
            --gold-yellow: #ffd700;
            --error-red: #ef4444;
            --success-green: #10b981;
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
        
        /* Updated header styling to match index.php exactly */
        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);
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

        .input-error {
            border-color: var(--error-red) !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
        }

        .input-success {
            border-color: var(--success-green) !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2) !important;
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

        .btn-gradient:disabled {
            background: linear-gradient(135deg, #94a3b8 0%, #64748b 50%, #475569 100%);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .back-btn {
            background: rgba(240, 248, 255, 0.9);
            border: 2px solid var(--turquoise);
            color: var(--ocean-blue);
        }
        
        .back-btn:hover {
            background: var(--turquoise);
            color: white;
            transform: translateX(-3px) translateY(-2px);
            box-shadow: 0 8px 20px rgba(64, 224, 208, 0.4);
        }
        
        .gold-accent {
            color: var(--gold-yellow);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }
        
        .floating-orb {
            background: radial-gradient(circle, rgba(64, 224, 208, 0.6) 0%, rgba(0, 168, 204, 0.3) 50%, transparent 70%);
        }
        
        .form-container {
            background: rgba(240, 248, 255, 0.95);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 215, 0, 0.2);
            transition: all 0.5s ease;
            border-radius: 1rem;
            width: 100%;
            max-width: 32rem;
            min-height: auto;
        }
        
        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0, 119, 190, 0.3), 0 0 0 1px rgba(255, 215, 0, 0.3);
        }

        /* Fixed input field container with proper spacing */
        .input-field-container {
            position: relative;
            width: 100%;
            margin-bottom: 1rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Fixed validation icon positioning */
        .validation-icon {
            position: absolute;
            top: 50%;
            right: 4rem;
            transform: translateY(-50%);
            z-index: 5;
            font-size: 1.25rem;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .validation-icon.error {
            color: var(--error-red);
        }

        .validation-icon.success {
            color: var(--success-green);
        }

        /* Fixed password toggle button positioning */
        .show-password-btn {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            transition: all 0.3s ease;
            cursor: pointer;
            color: var(--ocean-blue);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: transparent;
            border: none;
        }

        .show-password-btn:hover {
            color: var(--turquoise);
            background: rgba(64, 224, 208, 0.1);
            transform: translateY(-50%) scale(1.1);
        }

        /* Message containers with proper spacing - NOT absolutely positioned */
        .message-container {
            margin-top: 0.5rem;
            min-height: 1rem;
            transition: all 0.3s ease;
        }

        .error-message {
            color: var(--error-red);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(239, 68, 68, 0.1);
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
            animation: slideInDown 0.3s ease-out;
        }

        .success-message {
            color: var(--success-green);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.1);
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
            animation: slideInDown 0.3s ease-out;
        }

        .password-strength {
            color: var(--ocean-blue);
            font-size: 0.875rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background: rgba(0, 119, 190, 0.1);
            border: 1px solid rgba(0, 119, 190, 0.2);
            animation: slideInDown 0.3s ease-out;
        }

        .strength-weak {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error-red);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .strength-medium {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .strength-strong {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-green);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        @keyframes slideInDown {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (min-width: 640px) {
            .show-password-btn {
                right: 1.25rem;
                width: 2.5rem;
                height: 2.5rem;
            }

            .validation-icon {
                right: 4.5rem;
            }

            .input-field-container {
                margin-bottom: 1.25rem;
            }
        }

        @keyframes sparkleAnim {
            0% { transform: scale(0) rotate(0deg); opacity: 1; }
            50% { transform: scale(1) rotate(180deg); opacity: 0.8; }
            100% { transform: scale(0) rotate(360deg); opacity: 0; }
        }

        .success-animation {
            animation: successSlideIn 0.8s ease-out, successPulse 2s ease-in-out infinite 0.8s;
        }

        @keyframes successSlideIn {
            0% {
                opacity: 0;
                transform: scale(0.3) translateY(-50px);
            }
            50% {
                transform: scale(1.1) translateY(10px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes successPulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 30px rgba(64, 224, 208, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 50px rgba(64, 224, 208, 0.5);
            }
        }

        .success-checkmark {
            animation: checkmarkDraw 1.2s ease-out 0.5s forwards;
        }

        @keyframes checkmarkDraw {
            0% {
                transform: scale(0) rotate(0deg);
                opacity: 0;
            }
            50% {
                transform: scale(1.2) rotate(180deg);
                opacity: 0.8;
            }
            100% {
                transform: scale(1) rotate(360deg);
                opacity: 1;
            }
        }

        /* Mobile optimizations */
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
            
            .input-focus {
                padding: 1rem 3rem 1rem 3rem;
                font-size: 1rem;
            }
            
            .btn-gradient {
                padding: 1rem 2rem;
                font-size: 1rem;
            }
            
            .form-container:hover {
                transform: translateY(-2px);
            }

            .validation-icon {
                right: 3.5rem;
                font-size: 1.125rem;
            }

            .show-password-btn {
                right: 0.75rem;
                width: 2.25rem;
                height: 2.25rem;
            }

            .input-field-container {
                margin-bottom: 1.5rem;
            }
        }

        /* Tablet optimizations */
        @media (min-width: 641px) and (max-width: 1024px) {
            .form-container {
                margin: 2rem;
                padding: 2.5rem;
                border-radius: 1rem;
            }

            .input-field-container {
                margin-bottom: 1.5rem;
            }
        }

        .translating {
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .translate-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #40e0d0;
            border-radius: 50%;
            animation: pulse 1s infinite;
            margin-left: 4px;
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



      /* Terms and Conditions Modal Styles */
/* Terms Modal Styles - Enhanced Design */
.terms-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(44, 62, 80, 0.95);
    backdrop-filter: blur(15px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.terms-modal.active {
    opacity: 1;
    visibility: visible;
}

.terms-content {
    background: white;
    border-radius: 1.5rem;
    width: 90%;
    max-width: 850px;
    max-height: 85vh;
    overflow: hidden;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.5),
        0 10px 30px rgba(0, 119, 190, 0.2);
    transform: scale(0.9) translateY(20px);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.terms-modal.active .terms-content {
    transform: scale(1) translateY(0);
}

.terms-header {
    background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
    color: white;
    padding: 2rem 2.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0, 119, 190, 0.3);
}

.terms-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.02em;
}

.terms-body {
    padding: 2.5rem;
    max-height: 55vh;
    overflow-y: auto;
    line-height: 1.7;
    color: #4a5568;
}

.terms-footer {
    padding: 2rem 2.5rem;
    border-top: 2px solid #e2e8f0;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    background: linear-gradient(to top, #f7fafc 0%, white 100%);
}

/* Enhanced Button Styles */
.btn-outline,
#decline-terms {
    background: white;
    border: 2px solid #e2e8f0;
    color: #64748b;
    padding: 0.875rem 2rem;
    border-radius: 0.875rem;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-outline:hover,
#decline-terms:hover {
    background: #f1f5f9;
    border-color: #cbd5e1;
    color: #475569;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-outline:active,
#decline-terms:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Enhanced Accept Button */
.btn-accept,
#accept-terms {
    background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
    background-size: 200% 200%;
    border: 2px solid transparent;
    color: white;
    padding: 0.875rem 2.5rem;
    border-radius: 0.875rem;
    font-weight: 700;
    font-size: 0.95rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
    box-shadow: 
        0 4px 20px rgba(0, 119, 190, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

.btn-accept::before,
#accept-terms::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.btn-accept:hover,
#accept-terms:hover {
    background-position: 100% 50%;
    transform: translateY(-3px);
    box-shadow: 
        0 8px 30px rgba(0, 119, 190, 0.5),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.3);
}

.btn-accept:hover::before,
#accept-terms:hover::before {
    left: 100%;
}

.btn-accept:active,
#accept-terms:active {
    transform: translateY(-1px);
    box-shadow: 
        0 4px 15px rgba(0, 119, 190, 0.4),
        inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-accept i,
#accept-terms i {
    margin-right: 0.5rem;
    transition: transform 0.3s ease;
}

.btn-accept:hover i,
#accept-terms:hover i {
    transform: scale(1.2);
}

.close-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-size: 1.5rem;
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
}

.close-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: rotate(90deg) scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.close-btn:active {
    transform: rotate(90deg) scale(0.95);
}

/* Scrollbar Styling */
.terms-body::-webkit-scrollbar {
    width: 10px;
}

.terms-body::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
    margin: 0.5rem 0;
}

.terms-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
    border-radius: 10px;
    border: 2px solid #f1f5f9;
}

.terms-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #005a94 0%, #0077be 50%, #00a8cc 100%);
}

/* Terms Content Styling */
.terms-body h1, 
.terms-body h2, 
.terms-body h3, 
.terms-body h4 {
    color: #2c3e50;
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.terms-body h1 {
    font-size: 2rem;
    background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    padding-bottom: 0.75rem;
    border-bottom: 3px solid #40e0d0;
}

.terms-body h2 {
    font-size: 1.5rem;
    color: #0077be;
    padding-left: 1rem;
    border-left: 4px solid #40e0d0;
}

.terms-body h3 {
    font-size: 1.25rem;
    color: #00a8cc;
}

.terms-body h4 {
    font-size: 1.1rem;
}

.terms-body p {
    margin-bottom: 1.25rem;
    color: #4a5568;
}

.terms-body ul, 
.terms-body ol {
    margin-bottom: 1.25rem;
    padding-left: 2rem;
}

.terms-body li {
    margin-bottom: 0.75rem;
    color: #4a5568;
}

.terms-body a {
    color: #0077be;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.terms-body a:hover {
    color: #00a8cc;
    border-bottom-color: #40e0d0;
}

.terms-body strong {
    color: #2c3e50;
    font-weight: 700;
}

.terms-body em {
    color: #64748b;
    font-style: italic;
}

/* Checkbox in Registration Form - Centered */
.terms-checkbox {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin: 1.5rem 0;
}

.terms-checkbox input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    flex-shrink: 0;
    margin: 0;
    accent-color: #0077be;
}

.terms-checkbox label {
    color: #4a5568;
    font-size: 0.95rem;
    cursor: pointer;
    user-select: none;
    margin: 0;
    line-height: 1.5;
}

.terms-link {
    color: #0077be;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.3s ease;
}

.terms-link:hover {
    color: #00a8cc;
}

/* Responsive Design */
@media (max-width: 768px) {
    .terms-content {
        width: 95%;
        max-height: 90vh;
        border-radius: 1rem;
    }
    
    .terms-header {
        padding: 1.5rem;
    }
    
    .terms-header h2 {
        font-size: 1.5rem;
    }
    
    .terms-body {
        padding: 1.5rem;
        max-height: 60vh;
    }
    
    .terms-footer {
        padding: 1.5rem;
        flex-direction: column;
    }
    
    .btn-outline,
    #decline-terms,
    .btn-accept,
    #accept-terms {
        width: 100%;
        justify-content: center;
        display: flex;
        align-items: center;
    }
    
    .close-btn {
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
    }
}

/* Animation for modal entrance */
@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Focus states for accessibility */
.btn-outline:focus,
#decline-terms:focus,
.btn-accept:focus,
#accept-terms:focus,
.close-btn:focus {
    outline: 3px solid #40e0d0;
    outline-offset: 2px;
}

/* Loading state for accept button (optional) */
.btn-accept.loading,
#accept-terms.loading {
    pointer-events: none;
    opacity: 0.7;
}

.btn-accept.loading::after,
#accept-terms.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    border: 2px solid white;
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}


        /* Add to your existing button styles */

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
<body class="bg-azure text-slate-blue font-inter overflow-x-hidden selection:bg-ocean-cyan/20 gradient-bg min-h-screen">

    <div id="terms-modal" class="terms-modal">
        <div class="terms-content">
            <div class="terms-header">
                <h2>Terms and Conditions</h2>
                <button id="close-terms" class="close-btn">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="terms-body">
                <!-- Your terms and conditions content goes here -->
                <h1>TERMS AND CONDITIONS</h1>
                <p><em>Last updated October 18, 2025</em></p>
                
                <h2>AGREEMENT TO OUR LEGAL TERMS</h2>
                <p>We are Lakbay Gabay ("Company," "we," "us," "our"), a company registered in the Philippines at Old Cagayan Valley Road, Longos, Pulilan, Bulacan 3005.</p>
                
                <p>We operate the website https://lakbay-gabay.page.gd (the "Site"), as well as any other related products and services that refer or link to these legal terms (the "Legal Terms") (collectively, the "Services").</p>
                
                <p>You can contact us by email at lakbaygabayph@gmail.com or by mail to Old Cagayan Valley Road, Longos, Pulilan, Bulacan 3005, Philippines.</p>
                
                <p>These Legal Terms constitute a legally binding agreement made between you, whether personally or on behalf of an entity ("you"), and Lakbay Gabay, concerning your access to and use of the Services. You agree that by accessing the Services, you have read, understood, and agreed to be bound by all of these Legal Terms. IF YOU DO NOT AGREE WITH ALL OF THESE LEGAL TERMS, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SERVICES AND YOU MUST DISCONTINUE USE IMMEDIATELY.</p>
                
                <p>We will provide you with prior notice of any scheduled changes to the Services you are using. The modified Legal Terms will become effective upon posting or notifying you by lakbaygabayph@gmail.com, as stated in the email message. By continuing to use the Services after the effective date of any changes, you agree to be bound by the modified terms.</p>
                
                <p>The Services are intended for users who are at least 13 years of age. All users who are minors in the jurisdiction in which they reside (generally under the age of 18) must have the permission of, and be directly supervised by, their parent or guardian to use the Services. If you are a minor, you must have your parent or guardian read and agree to these Legal Terms prior to you using the Services.</p>
                
                <p>We recommend that you print a copy of these Legal Terms for your records.</p>
                
                <h2>TABLE OF CONTENTS</h2>
                <ol>
                    <li><a href="#services">OUR SERVICES</a></li>
                    <li><a href="#ip">INTELLECTUAL PROPERTY RIGHTS</a></li>
                    <li><a href="#userreps">USER REPRESENTATIONS</a></li>
                    <li><a href="#userreg">USER REGISTRATION</a></li>
                    <li><a href="#prohibited">PROHIBITED ACTIVITIES</a></li>
                    <li><a href="#ugc">USER GENERATED CONTRIBUTIONS</a></li>
                    <li><a href="#license">CONTRIBUTION LICENSE</a></li>
                    <li><a href="#reviews">GUIDELINES FOR REVIEWS</a></li>
                    <li><a href="#sitemanage">SERVICES MANAGEMENT</a></li>
                    <li><a href="#ppyes">PRIVACY POLICY</a></li>
                    <li><a href="#copyrightno">COPYRIGHT INFRINGEMENTS</a></li>
                    <li><a href="#terms">TERM AND TERMINATION</a></li>
                    <li><a href="#modifications">MODIFICATIONS AND INTERRUPTIONS</a></li>
                    <li><a href="#law">GOVERNING LAW</a></li>
                    <li><a href="#disputes">DISPUTE RESOLUTION</a></li>
                    <li><a href="#corrections">CORRECTIONS</a></li>
                    <li><a href="#disclaimer">DISCLAIMER</a></li>
                    <li><a href="#liability">LIMITATIONS OF LIABILITY</a></li>
                    <li><a href="#indemnification">INDEMNIFICATION</a></li>
                    <li><a href="#userdata">USER DATA</a></li>
                    <li><a href="#electronic">ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</a></li>
                    <li><a href="#misc">MISCELLANEOUS</a></li>
                    <li><a href="#contact">CONTACT US</a></li>
                </ol>
                
                <h2 id="services">1. OUR SERVICES</h2>
                <p>The information provided when using the Services is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Services from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.</p>
                
                <h2 id="ip">2. INTELLECTUAL PROPERTY RIGHTS</h2>
                <h3>Our intellectual property</h3>
                <p>We are the owner or the licensee of all intellectual property rights in our Services, including all source code, databases, functionality, software, website designs, audio, video, text, photographs, and graphics in the Services (collectively, the "Content"), as well as the trademarks, service marks, and logos contained therein (the "Marks").</p>
                <p>Our Content and Marks are protected by copyright and trademark laws (and various other intellectual property rights and unfair competition laws) and treaties around the world.</p>
                <p>The Content and Marks are provided in or through the Services "AS IS" for your personal, non-commercial use or internal business purpose only.</p>
                
                <h3>Your use of our Services</h3>
                <p>Subject to your compliance with these Legal Terms, including the "PROHIBITED ACTIVITIES" section below, we grant you a non-exclusive, non-transferable, revocable license to:</p>
                <ul>
                    <li>access the Services; and</li>
                    <li>download or print a copy of any portion of the Content to which you have properly gained access,</li>
                </ul>
                <p>solely for your personal, non-commercial use or internal business purpose.</p>
                <p>Except as set out in this section or elsewhere in our Legal Terms, no part of the Services and no Content or Marks may be copied, reproduced, aggregated, republished, uploaded, posted, publicly displayed, encoded, translated, transmitted, distributed, sold, licensed, or otherwise exploited for any commercial purpose whatsoever, without our express prior written permission.</p>
                <p>If you wish to make any use of the Services, Content, or Marks other than as set out in this section or elsewhere in our Legal Terms, please address your request to: lakbaygabayph@gmail.com. If we ever grant you the permission to post, reproduce, or publicly display any part of our Services or Content, you must identify us as the owners or licensors of the Services, Content, or Marks and ensure that any copyright or proprietary notice appears or is visible on posting, reproducing, or displaying our Content.</p>
                <p>We reserve all rights not expressly granted to you in and to the Services, Content, and Marks.</p>
                <p>Any breach of these Intellectual Property Rights will constitute a material breach of our Legal Terms and your right to use our Services will terminate immediately.</p>
                
                <h3>Your submissions and contributions</h3>
                <p>Please review this section and the "PROHIBITED ACTIVITIES" section carefully prior to using our Services to understand the (a) rights you give us and (b) obligations you have when you post or upload any content through the Services.</p>
                
                <p><strong>Submissions:</strong> By directly sending us any question, comment, suggestion, idea, feedback, or other information about the Services ("Submissions"), you agree to assign to us all intellectual property rights in such Submission. You agree that we shall own this Submission and be entitled to its unrestricted use and dissemination for any lawful purpose, commercial or otherwise, without acknowledgment or compensation to you.</p>
                
                <p><strong>Contributions:</strong> The Services may invite you to chat, contribute to, or participate in blogs, message boards, online forums, and other functionality during which you may create, submit, post, display, transmit, publish, distribute, or broadcast content and materials to us or through the Services, including but not limited to text, writings, video, audio, photographs, music, graphics, comments, reviews, rating suggestions, personal information, or other material ("Contributions"). Any Submission that is publicly posted shall also be treated as a Contribution.</p>
                
                <p>You understand that Contributions may be viewable by other users of the Services.</p>
                
                <p><strong>When you post Contributions, you grant us a license (including use of your name, trademarks, and logos):</strong> By posting any Contributions, you grant us an unrestricted, unlimited, irrevocable, perpetual, non-exclusive, transferable, royalty-free, fully-paid, worldwide right, and license to: use, copy, reproduce, distribute, sell, resell, publish, broadcast, retitle, store, publicly perform, publicly display, reformat, translate, excerpt (in whole or in part), and exploit your Contributions (including, without limitation, your image, name, and voice) for any purpose, commercial, advertising, or otherwise, to prepare derivative works of, or incorporate into other works, your Contributions, and to sublicense the licenses granted in this section. Our use and distribution may occur in any media formats and through any media channels.</p>
                
                <p>This license includes our use of your name, company name, and franchise name, as applicable, and any of the trademarks, service marks, trade names, logos, and personal and commercial images you provide.</p>
                
                <p><strong>You are responsible for what you post or upload:</strong> By sending us Submissions and/or posting Contributions through any part of the Services or making Contributions accessible through the Services by linking your account through the Services to any of your social networking accounts, you:</p>
                <ul>
                    <li>confirm that you have read and agree with our "PROHIBITED ACTIVITIES" and will not post, send, publish, upload, or transmit through the Services any Submission nor post any Contribution that is illegal, harassing, hateful, harmful, defamatory, obscene, bullying, abusive, discriminatory, threatening to any person or group, sexually explicit, false, inaccurate, deceitful, or misleading;</li>
                    <li>to the extent permissible by applicable law, waive any and all moral rights to any such Submission and/or Contribution;</li>
                    <li>warrant that any such Submission and/or Contributions are original to you or that you have the necessary rights and licenses to submit such Submissions and/or Contributions and that you have full authority to grant us the above-mentioned rights in relation to your Submissions and/or Contributions; and</li>
                    <li>warrant and represent that your Submissions and/or Contributions do not constitute confidential information.</li>
                </ul>
                <p>You are solely responsible for your Submissions and/or Contributions and you expressly agree to reimburse us for any and all losses that we may suffer because of your breach of (a) this section, (b) any third party's intellectual property rights, or (c) applicable law.</p>
                
                <p><strong>We may remove or edit your Content:</strong> Although we have no obligation to monitor any Contributions, we shall have the right to remove or edit any Contributions at any time without notice if in our reasonable opinion we consider such Contributions harmful or in breach of these Legal Terms. If we remove or edit any such Contributions, we may also suspend or disable your account and report you to the authorities.</p>
                
                <h3>Copyright infringement</h3>
                <p>We respect the intellectual property rights of others. If you believe that any material available on or through the Services infringes upon any copyright you own or control, please immediately refer to the "COPYRIGHT INFRINGEMENTS" section below.</p>
                
                <h2 id="userreps">3. USER REPRESENTATIONS</h2>
                <p>By using the Services, you represent and warrant that: (1) all registration information you submit will be true, accurate, current, and complete; (2) you will maintain the accuracy of such information and promptly update such registration information as necessary; (3) you have the legal capacity and you agree to comply with these Legal Terms; (4) you are not under the age of 13; (5) you are not a minor in the jurisdiction in which you reside, or if a minor, you have received parental permission to use the Services; (6) you will not access the Services through automated or non-human means, whether through a bot, script or otherwise; (7) you will not use the Services for any illegal or unauthorized purpose; and (8) your use of the Services will not violate any applicable law or regulation.</p>
                <p>If you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Services (or any portion thereof).</p>
                
                <h2 id="userreg">4. USER REGISTRATION</h2>
                <p>You may be required to register to use the Services. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.</p>
                
                <h2 id="prohibited">5. PROHIBITED ACTIVITIES</h2>
                <p>You may not access or use the Services for any purpose other than that for which we make the Services available. The Services may not be used in connection with any commercial endeavors except those that are specifically endorsed or approved by us.</p>
                <p>As a user of the Services, you agree not to:</p>
                <ul>
                    <li>Systematically retrieve data or other content from the Services to create or compile, directly or indirectly, a collection, compilation, database, or directory without written permission from us.</li>
                    <li>Trick, defraud, or mislead us and other users, especially in any attempt to learn sensitive account information such as user passwords.</li>
                    <li>Circumvent, disable, or otherwise interfere with security-related features of the Services, including features that prevent or restrict the use or copying of any Content or enforce limitations on the use of the Services and/or the Content contained therein.</li>
                    <li>Disparage, tarnish, or otherwise harm, in our opinion, us and/or the Services.</li>
                    <li>Use any information obtained from the Services in order to harass, abuse, or harm another person.</li>
                    <li>Make improper use of our support services or submit false reports of abuse or misconduct.</li>
                    <li>Use the Services in a manner inconsistent with any applicable laws or regulations.</li>
                    <li>Engage in unauthorized framing of or linking to the Services.</li>
                    <li>Upload or transmit (or attempt to upload or to transmit) viruses, Trojan horses, or other material, including excessive use of capital letters and spamming (continuous posting of repetitive text), that interferes with any party's uninterrupted use and enjoyment of the Services or modifies, impairs, disrupts, alters, or interferes with the use, features, functions, operation, or maintenance of the Services.</li>
                    <li>Engage in any automated use of the system, such as using scripts to send comments or messages, or using any data mining, robots, or similar data gathering and extraction tools.</li>
                    <li>Delete the copyright or other proprietary rights notice from any Content.</li>
                    <li>Attempt to impersonate another user or person or use the username of another user.</li>
                    <li>Upload or transmit (or attempt to upload or to transmit) any material that acts as a passive or active information collection or transmission mechanism, including without limitation, clear graphics interchange formats ("gifs"), 1×1 pixels, web bugs, cookies, or other similar devices (sometimes referred to as "spyware" or "passive collection mechanisms" or "pcms").</li>
                    <li>Interfere with, disrupt, or create an undue burden on the Services or the networks or services connected to the Services.</li>
                    <li>Harass, annoy, intimidate, or threaten any of our employees or agents engaged in providing any portion of the Services to you.</li>
                    <li>Attempt to bypass any measures of the Services designed to prevent or restrict access to the Services, or any portion of the Services.</li>
                    <li>Copy or adapt the Services' software, including but not limited to Flash, PHP, HTML, JavaScript, or other code.</li>
                    <li>Except as permitted by applicable law, decipher, decompile, disassemble, or reverse engineer any of the software comprising or in any way making up a part of the Services.</li>
                    <li>Except as may be the result of standard search engine or Internet browser usage, use, launch, develop, or distribute any automated system, including without limitation, any spider, robot, cheat utility, scraper, or offline reader that accesses the Services, or use or launch any unauthorized script or other software.</li>
                    <li>Use a buying agent or purchasing agent to make purchases on the Services.</li>
                    <li>Make any unauthorized use of the Services, including collecting usernames and/or email addresses of users by electronic or other means for the purpose of sending unsolicited email, or creating user accounts by automated means or under false pretenses.</li>
                    <li>Use the Services as part of any effort to compete with us or otherwise use the Services and/or the Content for any revenue-generating endeavor or commercial enterprise.</li>
                    <li>Use the Services to advertise or offer to sell goods and services.</li>
                    <li>Sell or otherwise transfer your profile.</li>
                </ul>
                
                <h2 id="ugc">6. USER GENERATED CONTRIBUTIONS</h2>
                <p>The Services may invite you to chat, contribute to, or participate in blogs, message boards, online forums, and other functionality, and may provide you with the opportunity to create, submit, post, display, transmit, perform, publish, distribute, or broadcast content and materials to us or on the Services, including but not limited to text, writings, video, audio, photographs, graphics, comments, suggestions, or personal information or other material (collectively, "Contributions"). Contributions may be viewable by other users of the Services and through third-party websites. As such, any Contributions you transmit may be treated as non-confidential and non-proprietary. When you create or make available any Contributions, you thereby represent and warrant that:</p>
                <ul>
                    <li>The creation, distribution, transmission, public display, or performance, and the accessing, downloading, or copying of your Contributions do not and will not infringe the proprietary rights, including but not limited to the copyright, patent, trademark, trade secret, or moral rights of any third party.</li>
                    <li>You are the creator and owner of or have the necessary licenses, rights, consents, releases, and permissions to use and to authorize us, the Services, and other users of the Services to use your Contributions in any manner contemplated by the Services and these Legal Terms.</li>
                    <li>You have the written consent, release, and/or permission of each and every identifiable individual person in your Contributions to use the name or likeness of each and every such identifiable individual person to enable inclusion and use of your Contributions in any manner contemplated by the Services and these Legal Terms.</li>
                    <li>Your Contributions are not false, inaccurate, or misleading.</li>
                    <li>Your Contributions are not unsolicited or unauthorized advertising, promotional materials, pyramid schemes, chain letters, spam, mass mailings, or other forms of solicitation.</li>
                    <li>Your Contributions are not obscene, lewd, lascivious, filthy, violent, harassing, libelous, slanderous, or otherwise objectionable (as determined by us).</li>
                    <li>Your Contributions do not ridicule, mock, disparage, intimidate, or abuse anyone.</li>
                    <li>Your Contributions are not used to harass or threaten (in the legal sense of those terms) any other person and to promote violence against a specific person or class of people.</li>
                    <li>Your Contributions do not violate any applicable law, regulation, or rule.</li>
                    <li>Your Contributions do not violate the privacy or publicity rights of any third party.</li>
                    <li>Your Contributions do not violate any applicable law concerning child pornography, or otherwise intended to protect the health or well-being of minors.</li>
                    <li>Your Contributions do not include any offensive comments that are connected to race, national origin, gender, sexual preference, or physical handicap.</li>
                    <li>Your Contributions do not otherwise violate, or link to material that violates, any provision of these Legal Terms, or any applicable law or regulation.</li>
                </ul>
                <p>Any use of the Services in violation of the foregoing violates these Legal Terms and may result in, among other things, termination or suspension of your rights to use the Services.</p>
                
                <h2 id="license">7. CONTRIBUTION LICENSE</h2>
                <p>By posting your Contributions to any part of the Services, you automatically grant, and you represent and warrant that you have the right to grant, to us an unrestricted, unlimited, irrevocable, perpetual, non-exclusive, transferable, royalty-free, fully-paid, worldwide right, and license to host, use, copy, reproduce, disclose, sell, resell, publish, broadcast, retitle, archive, store, cache, publicly perform, publicly display, reformat, translate, transmit, excerpt (in whole or in part), and distribute such Contributions (including, without limitation, your image and voice) for any purpose, commercial, advertising, or otherwise, and to prepare derivative works of, or incorporate into other works, such Contributions, and grant and authorize sublicenses of the foregoing. The use and distribution may occur in any media formats and through any media channels.</p>
                <p>This license will apply to any form, media, or technology now known or hereafter developed, and includes our use of your name, company name, and franchise name, as applicable, and any of the trademarks, service marks, trade names, logos, and personal and commercial images you provide. You waive all moral rights in your Contributions, and you warrant that moral rights have not otherwise been asserted in your Contributions.</p>
                <p>We do not assert any ownership over your Contributions. You retain full ownership of all of your Contributions and any intellectual property rights or other proprietary rights associated with your Contributions. We are not liable for any statements or representations in your Contributions provided by you in any area on the Services. You are solely responsible for your Contributions to the Services and you expressly agree to exonerate us from any and all responsibility and to refrain from any legal action against us regarding your Contributions.</p>
                <p>We have the right, in our sole and absolute discretion, (1) to edit, redact, or otherwise change any Contributions; (2) to re-categorize any Contributions to place them in more appropriate locations on the Services; and (3) to pre-screen or delete any Contributions at any time and for any reason, without notice. We have no obligation to monitor your Contributions.</p>
                
                <h2 id="reviews">8. GUIDELINES FOR REVIEWS</h2>
                <p>We may provide you areas on the Services to leave reviews or ratings. When posting a review, you must comply with the following criteria: (1) you should have firsthand experience with the person/entity being reviewed; (2) your reviews should not contain offensive profanity, or abusive, racist, offensive, or hateful language; (3) your reviews should not contain discriminatory references based on religion, race, gender, national origin, age, marital status, sexual orientation, or disability; (4) your reviews should not contain references to illegal activity; (5) you should not be affiliated with competitors if posting negative reviews; (6) you should not make any conclusions as to the legality of conduct; (7) you may not post any false or misleading statements; and (8) you may not organize a campaign encouraging others to post reviews, whether positive or negative.</p>
                <p>We may accept, reject, or remove reviews in our sole discretion. We have absolutely no obligation to screen reviews or to delete reviews, even if anyone considers reviews objectionable or inaccurate. Reviews are not endorsed by us, and do not necessarily represent our opinions or the views of any of our affiliates or partners. We do not assume liability for any review or for any claims, liabilities, or losses resulting from any review. By posting a review, you hereby grant to us a perpetual, non-exclusive, worldwide, royalty-free, fully paid, assignable, and sublicensable right and license to reproduce, modify, translate, transmit by any means, display, perform, and/or distribute all content relating to review.</p>
                
                <h2 id="sitemanage">9. SERVICES MANAGEMENT</h2>
                <p>We reserve the right, but not the obligation, to: (1) monitor the Services for violations of these Legal Terms; (2) take appropriate legal action against anyone who, in our sole discretion, violates the law or these Legal Terms, including without limitation, reporting such user to law enforcement authorities; (3) in our sole discretion and without limitation, refuse, restrict access to, limit the availability of, or disable (to the extent technologically feasible) any of your Contributions or any portion thereof; (4) in our sole discretion and without limitation, notice, or liability, to remove from the Services or otherwise disable all files and content that are excessive in size or are in any way burdensome to our systems; and (5) otherwise manage the Services in a manner designed to protect our rights and property and to facilitate the proper functioning of the Services.</p>
                
                <h2 id="ppyes">10. PRIVACY POLICY</h2>
                <p>We care about data privacy and security. Please review our Privacy Policy: <a href="https://lakbay-gabay.page.gd/privacypolicy.php">https://lakbay-gabay.page.gd/privacypolicy.php</a>. By using the Services, you agree to be bound by our Privacy Policy, which is incorporated into these Legal Terms. Please be advised the Services are hosted in the Netherlands and Philippines. If you access the Services from any other region of the world with laws or other requirements governing personal data collection, use, or disclosure that differ from applicable laws in the Netherlands and Philippines, then through your continued use of the Services, you are transferring your data to the Netherlands and Philippines, and you expressly consent to have your data transferred to and processed in the Netherlands and Philippines.</p>
                
                <h2 id="copyrightno">11. COPYRIGHT INFRINGEMENTS</h2>
                <p>We respect the intellectual property rights of others. If you believe that any material available on or through the Services infringes upon any copyright you own or control, please immediately notify us using the contact information provided below (a "Notification"). A copy of your Notification will be sent to the person who posted or stored the material addressed in the Notification. Please be advised that pursuant to applicable law you may be held liable for damages if you make material misrepresentations in a Notification. Thus, if you are not sure that material located on or linked to by the Services infringes your copyright, you should consider first contacting an attorney.</p>
                
                <h2 id="terms">12. TERM AND TERMINATION</h2>
                <p>These Legal Terms shall remain in full force and effect while you use the Services. WITHOUT LIMITING ANY OTHER PROVISION OF THESE LEGAL TERMS, WE RESERVE THE RIGHT TO, IN OUR SOLE DISCRETION AND WITHOUT NOTICE OR LIABILITY, DENY ACCESS TO AND USE OF THE SERVICES (INCLUDING BLOCKING CERTAIN IP ADDRESSES), TO ANY PERSON FOR ANY REASON OR FOR NO REASON, INCLUDING WITHOUT LIMITATION FOR BREACH OF ANY REPRESENTATION, WARRANTY, OR COVENANT CONTAINED IN THESE LEGAL TERMS OR OF ANY APPLICABLE LAW OR REGULATION. WE MAY TERMINATE YOUR USE OR PARTICIPATION IN THE SERVICES OR DELETE YOUR ACCOUNT AND ANY CONTENT OR INFORMATION THAT YOU POSTED AT ANY TIME, WITHOUT WARNING, IN OUR SOLE DISCRETION.</p>
                <p>If we terminate or suspend your account for any reason, you are prohibited from registering and creating a new account under your name, a fake or borrowed name, or the name of any third party, even if you may be acting on behalf of the third party. In addition to terminating or suspending your account, we reserve the right to take appropriate legal action, including without limitation pursuing civil, criminal, and injunctive redress.</p>
                
                <h2 id="modifications">13. MODIFICATIONS AND INTERRUPTIONS</h2>
                <p>We reserve the right to change, modify, or remove the contents of the Services at any time or for any reason at our sole discretion without notice. However, we have no obligation to update any information on our Services. We will not be liable to you or any third party for any modification, price change, suspension, or discontinuance of the Services.</p>
                <p>We cannot guarantee the Services will be available at all times. We may experience hardware, software, or other problems or need to perform maintenance related to the Services, resulting in interruptions, delays, or errors. We reserve the right to change, revise, update, suspend, discontinue, or otherwise modify the Services at any time or for any reason without notice to you. You agree that we have no liability whatsoever for any loss, damage, or inconvenience caused by your inability to access or use the Services during any downtime or discontinuance of the Services. Nothing in these Legal Terms will be construed to obligate us to maintain and support the Services or to supply any corrections, updates, or releases in connection therewith.</p>
                
                <h2 id="law">14. GOVERNING LAW</h2>
                <p>These Legal Terms shall be governed by and defined following the laws of the Philippines. Lakbay Gabay and yourself irrevocably consent that the courts of the Philippines shall have exclusive jurisdiction to resolve any dispute which may arise in connection with these Legal Terms.</p>
                
                <h2 id="disputes">15. DISPUTE RESOLUTION</h2>
                <h3>Informal Negotiations</h3>
                <p>To expedite resolution and control the cost of any dispute, controversy, or claim related to these Legal Terms (each a "Dispute" and collectively, the "Disputes") brought by either you or us (individually, a "Party" and collectively, the "Parties"), the Parties agree to first attempt to negotiate any Dispute (except those Disputes expressly provided below) informally for at least __________ days before initiating arbitration. Such informal negotiations commence upon written notice from one Party to the other Party.</p>
                
                <h3>Binding Arbitration</h3>
                <p>Any dispute arising out of or in connection with these Legal Terms, including any question regarding its existence, validity, or termination, shall be referred to and finally resolved by the International Commercial Arbitration Court under the European Arbitration Chamber (Belgium, Brussels, Avenue Louise, 146) according to the Rules of this ICAC, which, as a result of referring to it, is considered as the part of this clause. The number of arbitrators shall be __________. The seat, or legal place, or arbitration shall be the Philippines. The language of the proceedings shall be __________. The governing law of these Legal Terms shall be substantive law of the Philippines.</p>
                
                <h3>Restrictions</h3>
                <p>The Parties agree that any arbitration shall be limited to the Dispute between the Parties individually. To the full extent permitted by law, (a) no arbitration shall be joined with any other proceeding; (b) there is no right or authority for any Dispute to be arbitrated on a class-action basis or to utilize class action procedures; and (c) there is no right or authority for any Dispute to be brought in a purported representative capacity on behalf of the general public or any other persons.</p>
                
                <h3>Exceptions to Informal Negotiations and Arbitration</h3>
                <p>The Parties agree that the following Disputes are not subject to the above provisions concerning informal negotiations binding arbitration: (a) any Disputes seeking to enforce or protect, or concerning the validity of, any of the intellectual property rights of a Party; (b) any Dispute related to, or arising from, allegations of theft, piracy, invasion of privacy, or unauthorized use; and (c) any claim for injunctive relief. If this provision is found to be illegal or unenforceable, then neither Party will elect to arbitrate any Dispute falling within that portion of this provision found to be illegal or unenforceable and such Dispute shall be decided by a court of competent jurisdiction within the courts listed for jurisdiction above, and the Parties agree to submit to the personal jurisdiction of that court.</p>
                
                <h2 id="corrections">16. CORRECTIONS</h2>
                <p>There may be information on the Services that contains typographical errors, inaccuracies, or omissions, including descriptions, pricing, availability, and various other information. We reserve the right to correct any errors, inaccuracies, or omissions and to change or update the information on the Services at any time, without prior notice.</p>
                
                <h2 id="disclaimer">17. DISCLAIMER</h2>
                <p>THE SERVICES ARE PROVIDED ON AN AS-IS AND AS-AVAILABLE BASIS. YOU AGREE THAT YOUR USE OF THE SERVICES WILL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE SERVICES AND YOUR USE THEREOF, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE SERVICES' CONTENT OR THE CONTENT OF ANY WEBSITES OR MOBILE APPLICATIONS LINKED TO THE SERVICES AND WE WILL ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (1) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT AND MATERIALS, (2) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE SERVICES, (3) ANY UNAUTHORIZED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (4) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE SERVICES, (5) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE SERVICES BY ANY THIRD PARTY, AND/OR (6) ANY ERRORS OR OMISSIONS IN ANY CONTENT AND MATERIALS OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE SERVICES. WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE SERVICES, ANY HYPERLINKED WEBSITE, OR ANY WEBSITE OR MOBILE APPLICATION FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND ANY THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGMENT AND EXERCISE CAUTION WHERE APPROPRIATE.</p>
                
                <h2 id="liability">18. LIMITATIONS OF LIABILITY</h2>
                <p>IN NO EVENT WILL WE OR OUR DIRECTORS, EMPLOYEES, OR AGENTS BE LIABLE TO YOU OR ANY THIRD PARTY FOR ANY DIRECT, INDIRECT, CONSEQUENTIAL, EXEMPLARY, INCIDENTAL, SPECIAL, OR PUNITIVE DAMAGES, INCLUDING LOST PROFIT, LOST REVENUE, LOSS OF DATA, OR OTHER DAMAGES ARISING FROM YOUR USE OF THE SERVICES, EVEN IF WE HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.</p>
                
                <h2 id="indemnification">19. INDEMNIFICATION</h2>
                <p>You agree to defend, indemnify, and hold us harmless, including our subsidiaries, affiliates, and all of our respective officers, agents, partners, and employees, from and against any loss, damage, liability, claim, or demand, including reasonable attorneys' fees and expenses, made by any third party due to or arising out of: (1) your Contributions; (2) use of the Services; (3) breach of these Legal Terms; (4) any breach of your representations and warranties set forth in these Legal Terms; (5) your violation of the rights of a third party, including but not limited to intellectual property rights; or (6) any overt harmful act toward any other user of the Services with whom you connected via the Services. Notwithstanding the foregoing, we reserve the right, at your expense, to assume the exclusive defense and control of any matter for which you are required to indemnify us, and you agree to cooperate, at your expense, with our defense of such claims. We will use reasonable efforts to notify you of any such claim, action, or proceeding which is subject to this indemnification upon becoming aware of it.</p>
                
                <h2 id="userdata">20. USER DATA</h2>
                <p>We will maintain certain data that you transmit to the Services for the purpose of managing the performance of the Services, as well as data relating to your use of the Services. Although we perform regular routine backups of data, you are solely responsible for all data that you transmit or that relates to any activity you have undertaken using the Services. You agree that we shall have no liability to you for any loss or corruption of any such data, and you hereby waive any right of action against us arising from any such loss or corruption of such data.</p>
                
                <h2 id="electronic">21. ELECTRONIC COMMUNICATIONS, TRANSACTIONS, AND SIGNATURES</h2>
                <p>Visiting the Services, sending us emails, and completing online forms constitute electronic communications. You consent to receive electronic communications, and you agree that all agreements, notices, disclosures, and other communications we provide to you electronically, via email and on the Services, satisfy any legal requirement that such communication be in writing. YOU HEREBY AGREE TO THE USE OF ELECTRONIC SIGNATURES, CONTRACTS, ORDERS, AND OTHER RECORDS, AND TO ELECTRONIC DELIVERY OF NOTICES, POLICIES, AND RECORDS OF TRANSACTIONS INITIATED OR COMPLETED BY US OR VIA THE SERVICES. You hereby waive any rights or requirements under any statutes, regulations, rules, ordinances, or other laws in any jurisdiction which require an original signature or delivery or retention of non-electronic records, or to payments or the granting of credits by any means other than electronic means.</p>
                
                <h2 id="misc">22. MISCELLANEOUS</h2>
                <p>These Legal Terms and any policies or operating rules posted by us on the Services or in respect to the Services constitute the entire agreement and understanding between you and us. Our failure to exercise or enforce any right or provision of these Legal Terms shall not operate as a waiver of such right or provision. These Legal Terms operate to the fullest extent permissible by law. We may assign any or all of our rights and obligations to others at any time. We shall not be responsible or liable for any loss, damage, delay, or failure to act caused by any cause beyond our reasonable control. If any provision or part of a provision of these Legal Terms is determined to be unlawful, void, or unenforceable, that provision or part of the provision is deemed severable from these Legal Terms and does not affect the validity and enforceability of any remaining provisions. There is no joint venture, partnership, employment or agency relationship created between you and us as a result of these Legal Terms or use of the Services. You agree that these Legal Terms will not be construed against us by virtue of having drafted them. You hereby waive any and all defenses you may have based on the electronic form of these Legal Terms and the lack of signing by the parties hereto to execute these Legal Terms.</p>
                
                <h2 id="contact">23. CONTACT US</h2>
                <p>In order to resolve a complaint regarding the Services or to receive further information regarding use of the Services, please contact us at:</p>
                <p><strong>Lakbay Gabay</strong><br>
                Old Cagayan Valley Road<br>
                Longos<br>
                Pulilan, Bulacan 3005<br>
                Philippines<br>
                <a href="mailto:lakbaygabayph@gmail.com">lakbaygabayph@gmail.com</a></p>
            </div>
            <div class="terms-footer">
                <button id="decline-terms" class="btn-outline">Decline</button>
                <button id="accept-terms" class="btn-accept">
                    <i class="fas fa-check mr-2"></i>Accept Terms
                </button>
            </div>
        </div>
    </div>
<!-- Success Animation Modal -->
     <div id="success-animation" class="hidden fixed inset-0 bg-slate-blue/80 backdrop-blur-sm z-[9999] items-center justify-center">
        <div class="success-animation bg-white rounded-3xl p-12 shadow-2xl max-w-md mx-4 text-center">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #10b981 0%, #40e0d0 100%);">
                <i class="fas fa-check text-white text-5xl success-checkmark"></i>
            </div>
            <h3 class="text-3xl font-bold text-slate-blue mb-4">Registration Successful!</h3>
            <p class="text-slate-blue/80 text-lg mb-2">Welcome to Lakbay Gabay!</p>
            <p class="text-slate-blue/60 mb-4">Redirecting to login page...</p>
            
            <!-- Email Notification Badge -->
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-turquoise/30 rounded-xl p-4 mb-4">
                <div class="flex items-center justify-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-ocean-blue to-turquoise rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-white text-lg"></i>
                    </div>
                    <div class="text-left">
                        <p class="text-slate-blue font-bold text-base">Check Your Email!</p>
                        <p class="text-slate-blue/70 text-sm">We've sent you a welcome message</p>
                    </div>
                </div>
                <p class="text-xs text-slate-blue/60 text-center">
                    Don't forget to check your spam folder if you can't find it
                </p>
            </div>
            
            <div class="mt-6 flex justify-center gap-2">
                <div class="w-3 h-3 bg-turquoise rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                <div class="w-3 h-3 bg-turquoise rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                <div class="w-3 h-3 bg-turquoise rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
            </div>
        </div>
    </div>
    
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
     <div class="min-h-screen flex items-center justify-center px-4 pt-32 sm:pt-24 pb-8 relative">
        <!-- Enhanced Floating Decoration Elements - Hidden on mobile -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none hidden sm:block">
            <div class="floating-orb absolute top-1/4 left-1/4 w-32 lg:w-40 h-32 lg:h-40 rounded-full blur-2xl animate-float"></div>
            <div class="floating-orb absolute top-3/4 right-1/4 w-24 lg:w-32 h-24 lg:h-32 rounded-full blur-2xl animate-float" style="animation-delay: -3s;"></div>
            <div class="floating-orb absolute bottom-1/4 left-1/3 w-20 lg:w-28 h-20 lg:h-28 rounded-full blur-2xl animate-float" style="animation-delay: -1.5s;"></div>
            <div class="absolute top-1/2 right-1/3 w-4 lg:w-6 h-4 lg:h-6 bg-gold rounded-full animate-pulse-glow" style="animation-delay: -2s;"></div>
            <div class="absolute top-1/3 left-1/2 w-3 lg:w-4 h-3 lg:h-4 bg-gold rounded-full animate-pulse-glow" style="animation-delay: -4s;"></div>
        </div>
        
        <!-- Register Form Container -->
        <div class="relative w-full max-w-lg">
            <div class="form-container shadow-2xl p-6 sm:p-8 lg:p-10">
                <!-- Welcome Header -->
                <div class="text-center mb-8 sm:mb-10">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 sm:mb-6 rounded-full flex items-center justify-center shadow-2xl animate-pulse-glow" style="background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);">
                        <i class="fas fa-user-plus text-white text-xl sm:text-2xl"></i>
                    </div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2 sm:mb-3 bg-gradient-to-r from-slate-blue via-ocean-blue to-ocean-cyan bg-clip-text text-transparent" data-translate="create-account">Create Account</h2>
                    <p class="text-slate-blue/80 text-sm sm:text-base font-medium">Join us and start exploring the Philippines</p>
                </div>
                
                <!-- Register Form -->
                <form id="register-form">
                    <!-- Username Field -->
                    <div class="input-field-container">
                        <div class="input-wrapper">
                            <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300">
                                <i class="fas fa-user text-ocean-blue/60 text-base sm:text-lg"></i>
                            </div>
                            <input 
                                type="text" 
                                name="username" 
                                id="username"
                                data-translate-placeholder="username" 
                                placeholder="Username"
                                class="input-focus w-full pl-12 sm:pl-14 pr-20 py-4 sm:py-5 border-2 border-turquoise/30 rounded-2xl text-slate-blue placeholder-ocean-blue/50 bg-azure/80 hover:bg-azure focus:bg-azure transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                                required 
                                minlength="6"
                            >
                            <i id="username-validation-icon" class="validation-icon hidden"></i>
                        </div>
                        <div class="message-container">
                            <div id="username-error" class="error-message hidden">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>Username must be at least 6 characters long</span>
                            </div>
                            <div id="username-success" class="success-message hidden">
                                <i class="fas fa-check-circle"></i>
                                <span>Username looks good!</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email Field -->
                    <div class="input-field-container">
                        <div class="input-wrapper">
                            <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300">
                                <i class="fas fa-envelope text-ocean-blue/60 text-base sm:text-lg"></i>
                            </div>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                data-translate-placeholder="email" 
                                placeholder="Email Address"
                                class="input-focus w-full pl-12 sm:pl-14 pr-20 py-4 sm:py-5 border-2 border-turquoise/30 rounded-2xl text-slate-blue placeholder-ocean-blue/50 bg-azure/80 hover:bg-azure focus:bg-azure transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                                required    
                            >
                            <i id="email-validation-icon" class="validation-icon hidden"></i>
                        </div>
                        <div class="message-container">
                            <div id="email-error" class="error-message hidden">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>Please enter a valid email address with @</span>
                            </div>
                            <div id="email-success" class="success-message hidden">
                                <i class="fas fa-check-circle"></i>
                                <span>Email format is correct!</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="input-field-container">
                        <div class="input-wrapper">
                            <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300">
                                <i class="fas fa-lock text-ocean-blue/60 text-base sm:text-lg"></i>
                            </div>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                data-translate-placeholder="password" 
                                placeholder="Password"
                                class="input-focus w-full pl-12 sm:pl-14 pr-20 py-4 sm:py-5 border-2 border-turquoise/30 rounded-2xl text-slate-blue placeholder-ocean-blue/50 bg-azure/80 hover:bg-azure focus:bg-azure transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                                required
                                minlength="8"   
                            >
                            <i id="password-validation-icon" class="validation-icon hidden"></i>
                            <button type="button" id="toggle-password" class="show-password-btn">
                                <i class="fas fa-eye text-base sm:text-lg"></i>
                            </button>
                        </div>
                        <div class="message-container">
                            <div id="password-error" class="error-message hidden">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>Password must be at least 8 characters long</span>
                            </div>
                            <div id="password-strength" class="password-strength hidden">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-shield-alt"></i>
                                    <span id="strength-text">Password strength</span>
                                </div>
                                <div class="mt-2 flex gap-1">
                                    <div id="strength-bar-1" class="h-2 w-full bg-gray-200 rounded"></div>
                                    <div id="strength-bar-2" class="h-2 w-full bg-gray-200 rounded"></div>
                                    <div id="strength-bar-3" class="h-2 w-full bg-gray-200 rounded"></div>
                                    <div id="strength-bar-4" class="h-2 w-full bg-gray-200 rounded"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div class="input-field-container">
                        <div class="input-wrapper">
                            <div class="absolute inset-y-0 left-0 pl-4 sm:pl-5 flex items-center pointer-events-none transition-all duration-300">
                                <i class="fas fa-lock text-ocean-blue/60 text-base sm:text-lg"></i>
                            </div>
                            <input 
                                type="password" 
                                name="confirm_password" 
                                id="confirm-password"
                                data-translate-placeholder="confirm-password" 
                                placeholder="Confirm Password"
                                class="input-focus w-full pl-12 sm:pl-14 pr-20 py-4 sm:py-5 border-2 border-turquoise/30 rounded-2xl text-slate-blue placeholder-ocean-blue/50 bg-azure/80 hover:bg-azure focus:bg-azure transition-all duration-300 outline-none text-base sm:text-lg font-medium shadow-lg"
                                required    
                            >
                            <i id="confirm-password-validation-icon" class="validation-icon hidden"></i>
                            <button type="button" id="toggle-confirm-password" class="show-password-btn">
                                <i class="fas fa-eye text-base sm:text-lg"></i>
                            </button>
                        </div>
                        <div class="message-container">
                            <div id="confirm-password-error" class="error-message hidden">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>Passwords do not match</span>
                            </div>
                            <div id="confirm-password-success" class="success-message hidden">
                                <i class="fas fa-check-circle"></i>
                                <span>Passwords match!</span>
                            </div>
                        </div>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" id="agree-terms" name="agree-terms" required>
                        <label for="agree-terms">
                            I agree to the <span class="terms-link" id="show-terms">Terms and Conditions</span>
                        </label>
                    </div>
                    
                    <!-- Register Button -->
                    <button type="submit" id="register-btn" class="btn-gradient w-full text-white font-bold py-4 sm:py-5 px-6 sm:px-8 rounded-2xl shadow-xl transition-all duration-300 flex items-center justify-center gap-3 sm:gap-4 text-base sm:text-lg border border-gold/20 disabled:opacity-60">
                        <i class="fas fa-user-plus text-lg sm:text-xl"></i>
                        <span data-translate="register">Sign Up</span>
                        <i class="fas fa-sparkles text-gold"></i>
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="my-8 sm:my-10 flex items-center">
                    <div class="flex-1 border-t-2 border-gradient-to-r from-turquoise/30 to-ocean-blue/30"></div>
                    <span class="px-4 sm:px-6 text-sm sm:text-base text-slate-blue/70 font-semibold">or</span>
                    <div class="flex-1 border-t-2 border-gradient-to-r from-ocean-blue/30 to-turquoise/30"></div>
                </div>
                
                <!-- Login Link -->
                <p class="mt-8 sm:mt-10 text-center text-slate-blue/80 text-base sm:text-lg">
                    <span data-translate="have-account">Already have an account?</span> 
                    <a href="loginform.php" class="text-ocean-blue hover:text-turquoise font-bold hover:underline transition-all duration-300 ml-2 text-lg sm:text-xl" data-translate="login-here">Sign In here</a>
                    <i class="fas fa-arrow-right ml-2 text-gold"></i>
                </p>
            </div>
        </div>
        
        <!-- Additional Decorative Elements - Hidden on mobile -->
        <div class="absolute bottom-10 left-10 text-gold/30 animate-pulse pointer-events-none hidden sm:block">
            <i class="fas fa-compass text-3xl sm:text-4xl"></i>
        </div>
        <div class="absolute top-32 right-10 text-turquoise/40 animate-float pointer-events-none hidden sm:block">
            <i class="fas fa-map-marker-alt text-2xl sm:text-3xl"></i>
        </div>
    </div>

    <!-- Translation Loading Indicator -->
    <div id="translation-loading" class="fixed top-20 right-4 bg-ocean-blue text-white px-4 py-2 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50">
        <div class="flex items-center gap-2">
            <div class="translate-indicator"></div>
            <span data-translate="translating">Translating...</span>
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

        // Validation state
        const validationState = {
            username: false,
            email: false,
            password: false,
            confirmPassword: false,
            terms: false
        };

        async function translateText(text, targetLang) {
            if (!text || targetLang === 'en') return text;
            
            // Check cache first
            const cacheKey = `${targetLang}:${text}`;
            if (translationCache.has(cacheKey)) {
                return translationCache.get(cacheKey);
            }
            
            try {
                // Show translation loading indicator
                const loadingIndicator = document.getElementById('translation-loading');
                loadingIndicator.classList.remove('invisible', 'opacity-0');
                loadingIndicator.classList.add('opacity-100');

                const response = await fetch(`translate.php?text=${encodeURIComponent(text)}&target_lang=${targetLang}`);
                const data = await response.json();
                const translatedText = data.responseData.translatedText || text;
                
                // Cache the translation
                translationCache.set(cacheKey, translatedText);
                
                // Hide translation loading indicator
                setTimeout(() => {
                    loadingIndicator.classList.add('invisible', 'opacity-0');
                    loadingIndicator.classList.remove('opacity-100');
                }, 300);
                
                return translatedText;
            } catch (error) {
                console.error('Translation error:', error);
                // Hide loading indicator on error
                const loadingIndicator = document.getElementById('translation-loading');
                loadingIndicator.classList.add('invisible', 'opacity-0');
                loadingIndicator.classList.remove('opacity-100');
                return text;
            }
        }

        async function translatePage(lang) {
            currentLanguage = lang;
            document.getElementById('language-select').value = lang;
            
            // Add translating class to body
            document.body.classList.add('translating');
            
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
            
            // Remove translating class
            document.body.classList.remove('translating');
        }

// Validation functions
function validateUsername(username) {
    return username.length >= 6; // Changed from 3 to 6
}

function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    return password.length >= 8; // Minimum 8 characters
}

function getPasswordStrength(password) {
    // Must be at least 8 characters to even start counting strength
    if (password.length < 8) {
        return { level: 'weak', text: 'Too Short (min. 8 chars)', bars: 0 };
    }
    
    let score = 0;
    const checks = {
        length: password.length >= 12, // Bonus for longer passwords
        lowercase: /[a-z]/.test(password),
        uppercase: /[A-Z]/.test(password),
        numbers: /\d/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
    };
    
    // Count how many criteria are met
    score = Object.values(checks).filter(Boolean).length;
    
    // Adjust bars based on score (1-4 bars)
    if (score <= 1) return { level: 'weak', text: 'Weak', bars: 1 };
    if (score === 2) return { level: 'medium', text: 'Fair', bars: 2 };
    if (score === 3) return { level: 'good', text: 'Good', bars: 3 };
    return { level: 'strong', text: 'Strong', bars: 4 };
}

function updatePasswordStrength(password) {
    const strengthContainer = document.getElementById('password-strength');
    const strengthText = document.getElementById('strength-text');
    const bars = [
        document.getElementById('strength-bar-1'),
        document.getElementById('strength-bar-2'),
        document.getElementById('strength-bar-3'),
        document.getElementById('strength-bar-4')
    ];
    
    if (password.length === 0) {
        strengthContainer.classList.add('hidden');
        return;
    }
    
    strengthContainer.classList.remove('hidden');
    const strength = getPasswordStrength(password);
    
    // Reset bars
    bars.forEach(bar => {
        bar.className = 'h-2 w-full bg-gray-200 rounded';
    });
    
    // Update strength display
    strengthContainer.className = `password-strength strength-${strength.level}`;
    strengthText.textContent = `Password strength: ${strength.text}`;
    
    // Map strength level to bar colors
    const colorMap = {
        'weak': 'bg-red-500',
        'medium': 'bg-yellow-500',
        'good': 'bg-blue-500',
        'strong': 'bg-green-500'
    };
    
    const barColor = colorMap[strength.level] || 'bg-gray-200';
    const barCount = strength.bars || 0;
    
    // Update bars based on strength
    for (let i = 0; i < barCount; i++) {
        bars[i].className = `h-2 w-full ${barColor} rounded transition-all duration-300`;
    }
}

function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(`${fieldId}-error`);
    const successDiv = document.getElementById(`${fieldId}-success`);
    const validationIcon = document.getElementById(`${fieldId}-validation-icon`);
    
    field.classList.add('input-error');
    field.classList.remove('input-success');
    errorDiv.classList.remove('hidden');
    if (successDiv) successDiv.classList.add('hidden');
    
    // Show error icon
    if (validationIcon) {
        validationIcon.className = 'validation-icon error fas fa-exclamation-circle';
        validationIcon.classList.remove('hidden');
    }
}

function showSuccess(fieldId) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(`${fieldId}-error`);
    const successDiv = document.getElementById(`${fieldId}-success`);
    const validationIcon = document.getElementById(`${fieldId}-validation-icon`);
    
    field.classList.add('input-success');
    field.classList.remove('input-error');
    errorDiv.classList.add('hidden');
    if (successDiv) successDiv.classList.remove('hidden');
    
    // Show success icon
    if (validationIcon) {
        validationIcon.className = 'validation-icon success fas fa-check-circle';
        validationIcon.classList.remove('hidden');
    }
}

function clearValidation(fieldId) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.getElementById(`${fieldId}-error`);
    const successDiv = document.getElementById(`${fieldId}-success`);
    const validationIcon = document.getElementById(`${fieldId}-validation-icon`);
    
    field.classList.remove('input-error', 'input-success');
    errorDiv.classList.add('hidden');
    if (successDiv) successDiv.classList.add('hidden');
    
    // Hide validation icon
    if (validationIcon) {
        validationIcon.classList.add('hidden');
    }
}

function updateSubmitButton() {
    const submitBtn = document.getElementById('register-btn');
    const isValid = Object.values(validationState).every(state => state);
    submitBtn.disabled = !isValid;
}

function showSuccessAnimation() {
    const successModal = document.getElementById('success-animation');
    successModal.classList.remove('hidden');
    successModal.classList.add('flex');
    
    // Create sparkles around the success modal
    for (let i = 0; i < 15; i++) {
        setTimeout(() => {
            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;
            createSparkle(x, y);
        }, i * 100);
    }
    
    // Redirect after 3 seconds
    setTimeout(() => {
        window.location.href = 'loginform.php';
    }, 3000);
}

// Event listeners for real-time validation
document.getElementById('username').addEventListener('input', function(e) {
    const username = e.target.value;
    
    if (username.length === 0) {
        clearValidation('username');
        validationState.username = false;
    } else if (validateUsername(username)) {
        showSuccess('username');
        validationState.username = true;
    } else {
        showError('username', 'Username must be at least 6 characters long');
        validationState.username = false;
    }
    updateSubmitButton();
});

document.getElementById('email').addEventListener('input', function(e) {
    const email = e.target.value;
    
    if (email.length === 0) {
        clearValidation('email');
        validationState.email = false;
    } else if (validateEmail(email)) {
        showSuccess('email');
        validationState.email = true;
    } else {
        showError('email', 'Please enter a valid email address with @');
        validationState.email = false;
    }
    updateSubmitButton();
});

document.getElementById('password').addEventListener('input', function(e) {
    const password = e.target.value;
    
    // Update password strength indicator
    updatePasswordStrength(password);
    
    if (password.length === 0) {
        clearValidation('password');
        validationState.password = false;
    } else if (validatePassword(password)) {
        clearValidation('password');
        validationState.password = true;
    } else {
        showError('password', 'Password must be at least 8 characters long');
        validationState.password = false;
    }
    
    // Revalidate confirm password when password changes
    const confirmPassword = document.getElementById('confirm-password').value;
    if (confirmPassword.length > 0) {
        if (password === confirmPassword) {
            showSuccess('confirm-password');
            validationState.confirmPassword = true;
        } else {
            showError('confirm-password', 'Passwords do not match');
            validationState.confirmPassword = false;
        }
    }
    updateSubmitButton();
});

document.getElementById('confirm-password').addEventListener('input', function(e) {
    const confirmPassword = e.target.value;
    const password = document.getElementById('password').value;
    
    if (confirmPassword.length === 0) {
        clearValidation('confirm-password');
        validationState.confirmPassword = false;
    } else if (password === confirmPassword) {
        showSuccess('confirm-password');
        validationState.confirmPassword = true;
    } else {
        showError('confirm-password', 'Passwords do not match');
        validationState.confirmPassword = false;
    }
    updateSubmitButton();
});

// Toggle password visibility
document.getElementById('toggle-password').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.className = 'fas fa-eye-slash text-base sm:text-lg';
    } else {
        passwordField.type = 'password';
        icon.className = 'fas fa-eye text-base sm:text-lg';
    }
});

document.getElementById('toggle-confirm-password').addEventListener('click', function() {
    const confirmPasswordField = document.getElementById('confirm-password');
    const icon = this.querySelector('i');
    
    if (confirmPasswordField.type === 'password') {
        confirmPasswordField.type = 'text';
        icon.className = 'fas fa-eye-slash text-base sm:text-lg';
    } else {
        confirmPasswordField.type = 'password';
        icon.className = 'fas fa-eye text-base sm:text-lg';
    }
});

// Initialize language selector
document.getElementById('language-select').addEventListener('change', async (e) => {
    const lang = e.target.value;
    localStorage.setItem('preferredLanguage', lang);
    await translatePage(lang);
});

        // Handle form submission
 // Handle form submission
// Handle form submission
// Handle form submission
document.getElementById('register-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Check if terms are agreed to
    if (!agreeTermsCheckbox.checked) {
        const termsContainer = agreeTermsCheckbox.closest('.terms-checkbox');
        termsContainer.style.borderColor = 'var(--error-red)';
        termsContainer.style.background = 'rgba(239, 68, 68, 0.05)';
        termsModal.classList.add('active');
        document.body.style.overflow = 'hidden';
        return;
    }
    
    // Final validation check
    const isValid = Object.values(validationState).every(state => state);
    if (!isValid) {
        return;
    }
    
    // Disable submit button and show loading
    const submitBtn = document.getElementById('register-btn');
    const originalContent = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin text-lg sm:text-xl"></i><span>Creating Account...</span>';
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('register.php', {
            method: 'POST',
            body: formData
        });
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server did not return JSON');
        }
        
        const result = await response.json();
        console.log('Server response:', result);
        
        if (result.success) {
            // Clear storage for fresh state
            sessionStorage.clear();
            localStorage.clear();
            
            // Redirect to OTP verification page
            if (result.redirect) {
                window.location.href = result.redirect;
            } else {
                window.location.href = 'verify_otp.php';
            }
        } else {
            // Handle specific errors
            if (result.error === 'email') {
                const emailField = document.getElementById('email');
                const emailError = document.getElementById('email-error');
                const emailSuccess = document.getElementById('email-success');
                const emailValidationIcon = document.getElementById('email-validation-icon');
                
                emailField.classList.add('input-error');
                emailField.classList.remove('input-success');
                emailError.classList.remove('hidden');
                emailSuccess.classList.add('hidden');
                
                emailError.innerHTML = `
                    <i class="fas fa-exclamation-circle"></i>
                    <span>${result.message}</span>
                `;
                
                if (emailValidationIcon) {
                    emailValidationIcon.className = 'validation-icon error fas fa-exclamation-circle';
                    emailValidationIcon.classList.remove('hidden');
                }
                
                validationState.email = false;
                updateSubmitButton();
                
                emailField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                emailField.focus();
                
            } else if (result.error === 'username') {
                const usernameField = document.getElementById('username');
                const usernameError = document.getElementById('username-error');
                const usernameSuccess = document.getElementById('username-success');
                const usernameValidationIcon = document.getElementById('username-validation-icon');
                
                usernameField.classList.add('input-error');
                usernameField.classList.remove('input-success');
                usernameError.classList.remove('hidden');
                usernameSuccess.classList.add('hidden');
                
                usernameError.innerHTML = `
                    <i class="fas fa-exclamation-circle"></i>
                    <span>${result.message}</span>
                `;
                
                if (usernameValidationIcon) {
                    usernameValidationIcon.className = 'validation-icon error fas fa-exclamation-circle';
                    usernameValidationIcon.classList.remove('hidden');
                }
                
                validationState.username = false;
                updateSubmitButton();
                
                usernameField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                usernameField.focus();
                
            } else {
                alert(result.message || 'Registration failed. Please try again.');
            }
            
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        }
        
    } catch (error) {
        console.error('Registration error:', error);
        alert('An error occurred. Please try again.');
        
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalContent;
    }
});
        // Initialize page
        document.addEventListener('DOMContentLoaded', async () => {
            // Initialize navigation components
            initializeAccountDropdown();
            checkLoginStatus();
            
            const savedLang = localStorage.getItem('preferredLanguage') || 'en';
            document.getElementById('language-select').value = savedLang;
            if (savedLang !== 'en') {
                await translatePage(savedLang);
            }
            
            // Initially disable submit button
            updateSubmitButton();
        });

        // Add some interactive sparkle effects
        document.addEventListener('mousemove', (e) => {
            if (Math.random() > 0.97) {
                createSparkle(e.clientX, e.clientY);
            }
        });
       // Terms and Conditions Modal Functionality
        const termsModal = document.getElementById('terms-modal');
        const showTermsBtn = document.getElementById('show-terms');
        const closeTermsBtn = document.getElementById('close-terms');
        const declineTermsBtn = document.getElementById('decline-terms');
        const acceptTermsBtn = document.getElementById('accept-terms');
        const agreeTermsCheckbox = document.getElementById('agree-terms');
        
        // Show terms modal
        showTermsBtn.addEventListener('click', function() {
            termsModal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
        
        // Close terms modal
        function closeTermsModal() {
            termsModal.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        }
        
        closeTermsBtn.addEventListener('click', closeTermsModal);
        declineTermsBtn.addEventListener('click', closeTermsModal);
        
        // Accept terms
        acceptTermsBtn.addEventListener('click', function() {
            agreeTermsCheckbox.checked = true;
            closeTermsModal();
            
            // Trigger validation to update button state
            const event = new Event('change');
            agreeTermsCheckbox.dispatchEvent(event);
        });
        
        // Close modal when clicking outside
        termsModal.addEventListener('click', function(e) {
            if (e.target === termsModal) {
                closeTermsModal();
            }
        });
        agreeTermsCheckbox.addEventListener('change', function() {
            validationState.terms = this.checked;
            updateSubmitButton();
            
            if (this.checked) {
                // Show success indication
                const termsContainer = this.closest('.terms-checkbox');
                termsContainer.style.borderColor = 'var(--success-green)';
                termsContainer.style.background = 'rgba(16, 185, 129, 0.05)';
            } else {
                // Reset styling
                const termsContainer = this.closest('.terms-checkbox');
                termsContainer.style.borderColor = 'rgba(64, 224, 208, 0.3)';
                termsContainer.style.background = 'rgba(240, 248, 255, 0.8)';
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
    </script>
</body>
</html>