<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Lakbay Gabay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                        'playfair': ['Playfair Display', 'serif'],
                    },
                    colors: {
                        'primary-blue': '#0077be',
                        'secondary-blue': '#00a8cc',
                        'turquoise': '#40e0d0',
                        'alice-blue': '#f0f8ff',
                        'dark-blue': '#2c3e50',
                        'gold': '#ffd700',
                        'ocean-blue': '#0077be',
                        'ocean-cyan': '#00a8cc', 
                        'azure': '#f0f8ff',
                        'slate-blue': '#2c3e50',
                        'ocean-dark': '#005a94',
                        'ocean-light': '#e6f7ff',
                    }
                }
            }
        }
    </script>
    <style>
        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .notification {
            transition: transform 0.3s ease;
        }

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

        .hamburger-btn.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
            transform: scale(0);
        }

        .hamburger-btn.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

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

        body.mobile-menu-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        .account-dropdown {
            position: relative;
            z-index: 50;
        }

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
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.08), rgba(64, 224, 208, 0.08));
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

/* Change account link color when dropdown is open - NO HOVER */
.account-link.active {
    color: #40e0d0 !important;
}

/* Remove hover effect for account link - click only */
.account-link {
    color: rgba(255, 255, 255, 0.9) !important;
    transition: color 0.3s ease !important;
}

.account-link:not(.active):hover {
    color: rgba(255, 255, 255, 0.9) !important; /* Keep same color on hover */
}

        .login-prompt-box {
            background: linear-gradient(135deg, #f0f8ff 0%, #e0f2fe 100%);
            border: 2px solid #40e0d0;
        }
    </style>
</head>
<body class="font-inter">

<!-- Header -->
<div class="fixed top-0 left-0 right-0 header-bg transition-all duration-300 z-50" id="header" style="padding: 16px 32px;">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="logo">
            <a href="index.php" class="text-2xl lg:text-3xl font-bold font-playfair uppercase text-white tracking-wide hover:text-turquoise transition-colors duration-300">
                Lakbay Gabay
            </a>
        </div>
        <div class="flex items-center gap-6">
            <nav class="hidden md:flex items-center gap-6">
                <a href="index.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">Home</a>
                <a href="map.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">Destination</a>
                <a href="griddestination.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">All Destination</a>
                <a href="contact.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">Contact</a>
                <a href="about_us.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300">About</a>

                <div class="account-dropdown relative" id="account-dropdown-container">
                    <a href="#" class="account-link text-white/90 font-medium transition-colors duration-300 flex items-center gap-1">
                        Account
                    </a>
                    <div class="dropdown-menu">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-slate-blue">Loading...</p>
                        </div>
                    </div>
                </div>
            </nav>
            
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
            
            <button class="hamburger-btn md:hidden" id="hamburger-btn">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
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

            <div class="border-t border-white/20 pt-3 mt-2">
                <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                <div class="px-2 py-1 text-white/80 text-sm mb-2">Loading...</div>
            </div>
        </nav>
    </div>
</div>

<!-- Hero Section -->
<section class="pt-32 bg-gradient-to-br from-primary-blue via-secondary-blue to-turquoise text-white min-h-[50vh] flex flex-col justify-center">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 font-playfair">
            <span data-translate="get-in">Get in</span>
            <span class="text-gold" data-translate="touch">Touch</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed" data-translate="contact-hero">
            Ready to discover the magic of the Philippines? We're here to help you plan your perfect island adventure.
        </p>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-16 bg-alice-blue">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition-transform duration-300" id="contactFormContainer">
                    <h2 class="text-3xl font-bold text-dark-blue mb-6" data-translate="send-message">Send us a Message</h2>
                    
                    <!-- Login Prompt (shown when not logged in) -->
                    <div id="loginPrompt" class="hidden login-prompt-box rounded-2xl p-8 text-center animate-fadeInUp">
                        <div class="w-20 h-20 bg-gradient-to-r from-secondary-blue to-turquoise rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-lock text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-dark-blue mb-4">Login Required</h3>
                        <p class="text-gray-600 mb-6 text-lg">
                            You need to be logged in to send us a message. Please login or create an account to continue.
                        </p>
                        <div class="flex gap-4 justify-center flex-wrap">
                            <a href="loginform.php" class="bg-gradient-to-r from-secondary-blue to-turquoise text-white font-bold py-3 px-8 rounded-lg hover:from-turquoise hover:to-secondary-blue transform hover:scale-105 transition-all duration-300 shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login
                            </a>
                            <a href="registerform.php" class="bg-white border-2 border-turquoise text-turquoise font-bold py-3 px-8 rounded-lg hover:bg-turquoise hover:text-white transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-user-plus mr-2"></i>
                                Register
                            </a>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-shield-alt text-turquoise mr-2"></i>
                                Your privacy is important to us. We'll only use your information to respond to your inquiry.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Actual Form (shown when logged in) -->
                    <div id="contactFormSection" class="hidden">
                        <!-- User Info Display (Read-only) -->
                        <div class="bg-gradient-to-r from-ocean-light to-azure rounded-lg p-4 mb-6 border-l-4 border-turquoise">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-user-circle text-3xl text-ocean-blue"></i>
                                <div>
                                    <p class="text-sm text-gray-600" data-translate="logged-in-as">Logged in as:</p>
                                    <p class="text-lg font-bold text-dark-blue" id="displayUsername">Loading...</p>
                                </div>
                            </div>
                        </div>

                        <!-- ADD THESE TWO FIELDS HERE -->
                        <div class="space-y-6 mb-6">
                            <!-- First Name (Optional) -->
                            <div>
                                <label class="block text-dark-blue font-semibold mb-2">
                                    First Name <span class="text-sm text-gray-500 font-normal">(Optional)</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="firstNameField" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-turquoise focus:outline-none transition-colors"
                                    placeholder="Enter your first name">
                            </div>

                            <!-- Last Name (Optional) -->
                            <div>
                                <label class="block text-dark-blue font-semibold mb-2">
                                    Last Name <span class="text-sm text-gray-500 font-normal">(Optional)</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="lastNameField" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-turquoise focus:outline-none transition-colors"
                                    placeholder="Enter your last name">
                            </div>

                            <!-- Phone (Optional) -->
                            <div>
                                <label class="block text-dark-blue font-semibold mb-2">
                                    Phone <span class="text-sm text-gray-500 font-normal">(Optional)</span>
                                </label>
                                <input 
                                    type="tel" 
                                    id="phoneField" 
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-turquoise focus:outline-none transition-colors"
                                    placeholder="Enter your phone number"
                                    inputmode="numeric"
                                    maxlength="11">
                            </div>
                        </div>

                        <form class="space-y-6" id="contactForm">
                            <div>
                                <label class="block text-dark-blue font-semibold mb-2" data-translate="subject">Subject *</label>
                                <select class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-turquoise focus:outline-none transition-colors" id="subjectField" required>
                                    <option value="" data-translate="select-topic">Select a topic</option>
                                    <option value="destinations" data-translate="destination-info">Destination Information</option>
                                    <option value="support" data-translate="customer-support">Customer Support</option>
                                    <option value="partnership" data-translate="partnership">Partnership</option>
                                    <option value="other" data-translate="other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-dark-blue font-semibold mb-2" data-translate="message">Message *</label>
                                <textarea rows="8" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:border-turquoise focus:outline-none transition-colors resize-none" id="messageField" data-translate-placeholder="tell-us-about" placeholder="Tell us about your inquiry..." required></textarea>
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-secondary-blue to-turquoise text-white font-bold py-4 px-8 rounded-lg hover:from-turquoise hover:to-secondary-blue transform hover:scale-105 transition-all duration-300 shadow-lg" id="submitButton">
                                <i class="fas fa-paper-plane mr-2"></i>
                                <span data-translate="send-message-btn">Send Message</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-8">
                    <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition-transform duration-300">
                        <h3 class="text-2xl font-bold text-dark-blue mb-6" data-translate="contact-information">Contact Information</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-secondary-blue to-turquoise rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-map-marker-alt text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark-blue" data-translate="address">Address</h4>
                                    <p class="text-gray-600">Longos, Pulilan</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-r from-secondary-blue to-turquoise rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-envelope text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark-blue" data-translate="email">Email</h4>
                                    <p class="text-gray-600">lakbaygabayph@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-question-circle text-4xl text-ocean-cyan mb-4"></i>
                        <h3 class="text-xl font-bold text-slate-blue mb-2" data-translate="have-questions">Have Questions?</h3>
                        <p class="text-ocean-dark/80 mb-4" data-translate="check-faq">Check out our frequently asked questions for quick answers.</p>
                        <button 
                            class="bg-turquoise text-white px-6 py-2 rounded-lg hover:bg-ocean-cyan transition-all duration-300"
                            data-translate="view-faq"
                            onclick="window.location.href='faq.php';">
                            View FAQ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Footer -->
<footer class="bg-gradient-to-br from-slate-blue via-ocean-dark to-slate-blue text-white py-20 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-pattern-dots bg-pattern opacity-10"></div>
    
    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Company Info -->
            <div class="lg:col-span-2">
                <h3 class="text-3xl font-bold font-playfair mb-6 text-turquoise" data-translate="site-title">Lakbay Gabay</h3>
                <p class="text-azure leading-relaxed mb-8 max-w-md" data-translate="footer-description">
                    Your trusted companion for discovering the most beautiful destinations across the Philippine archipelago. 
                    Creating unforgettable memories, one island at a time.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-xl font-semibold mb-6 text-turquoise">
                    <span data-translate="footer-quick-links">Quick Links</span>
                </h4>
                <ul class="space-y-3">
                    <li><a href="about_us.php" class="text-azure hover:text-turquoise transition-colors duration-300" data-translate="footer-about-us">About Us</a></li>
                    <li><a href="contact.php" class="text-azure hover:text-turquoise transition-colors duration-300" data-translate="footer-contact">Contact</a></li>
                </ul>
            </div>
            
            <!-- Support -->
            <div>
                <h4 class="text-xl font-semibold mb-6 text-turquoise">
                    <span data-translate="footer-support">Support</span>
                </h4>
                <ul class="space-y-3">
                    <li><a href="faq.php" class="text-azure hover:text-turquoise transition-colors duration-300" data-translate="footer-safety">FAQs</a></li>
                    <li><a href="privacypolicy.php" class="text-azure hover:text-turquoise transition-colors duration-300" data-translate="footer-privacy">Privacy Policy</a></li>
                    <li><a href="termservice.php" class="text-azure hover:text-turquoise transition-colors duration-300" data-translate="footer-terms">Terms of Service</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<button id="scrollToTop" class="fixed bottom-8 right-8 bg-gradient-to-r from-secondary-blue to-turquoise text-white w-12 h-12 rounded-full shadow-lg hover:from-turquoise hover:to-secondary-blue transition-all duration-300 transform hover:scale-110 opacity-0 invisible">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
let isLoggedIn = false;
let userName = '';
let userEmail = '';
let userId = null;

async function checkLoginStatus() {
    try {
        const response = await fetch('check_login.php');
        const data = await response.json();
        
        isLoggedIn = data.logged_in || false;
        userName = data.username || '';
        userEmail = data.email || '';
        userId = data.user_id || null;
        
        updateAccountDropdown();
        updateMobileAccountSection();
        handleContactFormAccess();
    } catch (error) {
        console.error('Error checking login status:', error);
        isLoggedIn = false;
        handleContactFormAccess();
    }
}

function handleContactFormAccess() {
    const loginPrompt = document.getElementById('loginPrompt');
    const formSection = document.getElementById('contactFormSection');
    const displayUsername = document.getElementById('displayUsername');
    
    if (!isLoggedIn) {
        // Show login prompt, hide form
        loginPrompt.classList.remove('hidden');
        formSection.classList.add('hidden');
    } else {
        // Show form, hide login prompt
        loginPrompt.classList.add('hidden');
        formSection.classList.remove('hidden');
        displayUsername.textContent = userName;
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
            <a href="#" onclick="logout(); return false;" class="dropdown-item flex items-center gap-3 border-t border-gray-100">
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
            <div class="px-2 py-1 text-white/80 text-sm mb-2">Welcome, ${userName}</div>
            <a href="userdashboard.php" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" onclick="logout(); return false;" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
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

function logout() {
    if (confirm('Are you sure you want to logout?')) {
        fetch('logout.php')
            .then(response => response.text())
            .then(message => {
                showNotification('Logged out successfully!', 'success');
                setTimeout(() => {
                    window.location.href = 'contact.php';
                }, 1500);
            })
            .catch(error => console.error('Error:', error));
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
        accountDropdown.link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (accountDropdown.isOpen) {
                hideAccountDropdown();
            } else {
                showAccountDropdown();
            }
        });
        
        document.addEventListener('click', function(e) {
            if (accountDropdown.container && !accountDropdown.container.contains(e.target)) {
                hideAccountDropdown();
            }
        });
    }
}

function showAccountDropdown() {
    if (accountDropdown.element) {
        accountDropdown.element.classList.add('show');
        if (accountDropdown.link) {
            accountDropdown.link.classList.add('active');
        }
        accountDropdown.isOpen = true;
    }
}

function hideAccountDropdown() {
    if (accountDropdown.element) {
        accountDropdown.element.classList.remove('show');
        if (accountDropdown.link) {
            accountDropdown.link.classList.remove('active');
        }
        accountDropdown.isOpen = false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initializeAccountDropdown();
    checkLoginStatus();
  
    const phoneField = document.getElementById('phoneField');
    if (phoneField) {
        phoneField.addEventListener('input', function(e) {
            // Remove any non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        // Prevent paste of non-numeric content
        phoneField.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const numericOnly = pastedText.replace(/[^0-9]/g, '');
            this.value = numericOnly;
        });
    }

    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const isHidden = mobileMenu.classList.contains('hidden');
if (isHidden) {
                mobileMenu.classList.remove('hidden');
                document.body.classList.add('mobile-menu-open');
                hamburgerBtn.classList.add('active');
            } else {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('mobile-menu-open');
                hamburgerBtn.classList.remove('active');
            }
        });
    }

// Form submission
document.getElementById('contactForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    if (!isLoggedIn) {
        showNotification('Please login to send a message', 'error');
        return;
    }



    const submitButton = document.getElementById('submitButton');
    const originalButtonText = submitButton.innerHTML;
    
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
    submitButton.disabled = true;
    
    try {
        const formData = {
            user_id: userId,
            username: userName,
            email: userEmail,
            first_name: document.getElementById('firstNameField').value.trim() || null,
            last_name: document.getElementById('lastNameField').value.trim() || null,
            phone: document.getElementById('phoneField').value.trim() || null,
            subject: document.getElementById('subjectField').value,
            message: document.getElementById('messageField').value
        };
        
        if (!formData.subject || !formData.message) {
            throw new Error('Please fill in all required fields');
        }
        
        const response = await fetch('contact_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });
        
        if (!response.ok) {
            throw new Error(`Server error: ${response.status}`);
        }
        
        const data = await response.json();
        
        if (data.success) {
            showNotification("Thank you for your message! We'll get back to you soon.", 'success');
            document.getElementById('contactForm').reset();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            throw new Error(data.message || 'Failed to send message');
        }
        
    } catch (error) {
        console.error('Form submission error:', error);
        showNotification(error.message, 'error');
    } finally {
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;
    }
});

    // Scroll to top
    const scrollToTopBtn = document.getElementById('scrollToTop');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'invisible');
            scrollToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            scrollToTopBtn.classList.add('opacity-0', 'invisible');
            scrollToTopBtn.classList.remove('opacity-100', 'visible');
        }
    });
    
    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

function showNotification(message, type = 'info') {
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
    
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <span>${message}</span>
            </div>
        `;
    } else if (type === 'error') {
        notification.className += ' bg-red-500 text-white';
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                <span>${message}</span>
            </div>
        `;
    } else {
        notification.className += ' bg-blue-500 text-white';
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-3"></i>
                <span>${message}</span>
            </div>
        `;
    }
    
    const closeButton = document.createElement('button');
    closeButton.innerHTML = '<i class="fas fa-times ml-3"></i>';
    closeButton.onclick = () => hideNotification(notification);
    notification.querySelector('div').appendChild(closeButton);
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        hideNotification(notification);
    }, 5000);
}

function hideNotification(notification) {
    notification.classList.add('translate-x-full');
    setTimeout(() => {
        notification.remove();
    }, 300);
}
</script>
</body>
</html>