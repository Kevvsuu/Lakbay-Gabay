<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Lakbay Gabay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif !important;
        }

        section h1, section h1 span {
            font-family: 'Playfair Display', serif !important;
        }

        body, p, span, a, button, input, select, textarea, label, li, div {
            font-family: 'Inter', sans-serif !important;
        }

        body {
            font-family: 'Inter', sans-serif !important;
        }

        .dropdown-item {
            font-family: 'Inter', sans-serif !important;
        }

        nav a {
            font-family: 'Inter', sans-serif !important;
        }

        .logo a {
            font-family: 'Playfair Display', serif !important;
        }

        footer h3, footer h4 {
            font-family: 'Playfair Display', serif !important;
        }

        section h1, section h2, section h3, section h4 {
            font-family: 'Playfair Display', serif !important;
        }

        .container h3, .container h4 {
            font-family: 'Playfair Display', serif !important;
        }

        .container p, section p {
            font-family: 'Inter', sans-serif !important;
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
            gap: 6px;
        }

        .hamburger-line {
            display: block;
            width: 24px;
            height: 2px;
            background-color: white;
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

        #mobile-menu .border-t {
            border-color: rgba(255, 255, 255, 0.2) !important;
        }

        .account-dropdown {
            position: relative;
            z-index: 50;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translate(-50%, 10px);
            background: rgba(255, 255, 255, 0.65); 
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
            transform: translate(-50%, 0) !important;
            pointer-events: auto;
        }

        @keyframes glassShimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }


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

        .account-link.active::after {
            transform: rotate(180deg);
        }


        .account-link.active {
            color: #40e0d0 !important;
        }


        .account-link {
            color: rgba(255, 255, 255, 0.9) !important;
            transition: color 0.3s ease !important;
        }

        .account-link:not(.active):hover {
            color: rgba(255, 255, 255, 0.9) !important;
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
            <!-- Navigation Menu -->
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

<section class="pt-32 bg-gradient-to-br from-primary-blue via-secondary-blue to-turquoise text-white min-h-[50vh] flex flex-col justify-center">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 font-playfair">
            <span data-translate="about">About</span>
            <span class="text-gold" data-translate="us">Us</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto leading-relaxed" data-translate="about-hero">
            Discover the story behind Lakbay Gabay and our passion for simplifying travel across the Philippines.
        </p>
    </div>
</section>


<section class="py-16 bg-alice-blue">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Mission & Vision -->
            <div class="grid md:grid-cols-2 gap-12 mb-16">
                <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition-transform duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-secondary-blue to-turquoise rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-dark-blue mb-4" data-translate="our-mission">Our Mission</h3>
                    <p class="text-gray-600 leading-relaxed" data-translate="mission-text">
                        At Lakbay Gabay, our mission is to simplify how people explore the Philippines by building a centralized digital platform that gathers verified information about tourist destinations across the country. We strive to make travel planning effortless and accessible through a modern, responsive website that connects users to both famous landmarks and hidden gems that deserve more recognition for their cultural, historical, and natural significance.
                    </p>
                </div>
                <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition-transform duration-300">
                    <div class="w-16 h-16 bg-gradient-to-r from-gold to-yellow-400 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-dark-blue mb-4" data-translate="our-vision">Our Vision</h3>
                    <p class="text-gray-600 leading-relaxed" data-translate="vision-text">
                        We envision a digitally connected Philippines where travelers, whether local or foreign, can easily discover every destination from well-known attractions to underexplored communities through a single reliable platform. Lakbay Gabay seeks to inspire meaningful travel, promote inclusivity, and support the growth of sustainable tourism that uplifts local economies while preserving the country's heritage and environment.
                    </p>
                </div>
            </div>

            <!-- Our Story -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-16">
                <h2 class="text-3xl font-bold text-dark-blue mb-8 text-center" data-translate="our-story">Our Story</h2>
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <p class="text-gray-600 leading-relaxed mb-6" data-translate="story-part1">
                            Lakbay Gabay was developed by two students as part of an academic capstone project. The idea began with a simple observation: it is often a struggle to find complete and trustworthy information because tourism data in the Philippines is scattered across multiple websites.
                        </p>
                        <p class="text-gray-600 leading-relaxed" data-translate="story-part2">
                            To solve this, the team designed a web-based platform that consolidates destination details into one structured and user-friendly system. More than just a research project, Lakbay Gabay represents a practical solution to a real-world challenge helping users plan their trips efficiently while spotlighting lesser-known destinations that contribute to the country's diverse tourism landscape.
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-primary-blue to-turquoise rounded-2xl p-8 text-white text-center">
                        <i class="fas fa-graduation-cap text-4xl mb-4 text-gold"></i>
                        <h4 class="text-xl font-bold mb-2" data-translate="academic-title">Academic Roots</h4>
                        <p class="text-blue-100" data-translate="academic-text">
                            Born from a student capstone project with real-world impact
                        </p>
                    </div>
                </div>
            </div>

            <!-- Values -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-3xl font-bold text-dark-blue mb-8 text-center" data-translate="our-values">Our Values</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center p-6 rounded-xl bg-ocean-light hover:bg-white transition-all duration-300">
                        <div class="w-12 h-12 bg-turquoise rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <h4 class="font-bold text-dark-blue mb-2" data-translate="trust">Trust</h4>
                        <p class="text-gray-600 text-sm" data-translate="trust-text">
                            We ensure accuracy and reliability by sourcing verified tourism data from credible organizations like the Department of Tourism.
                        </p>
                    </div>
                    <div class="text-center p-6 rounded-xl bg-ocean-light hover:bg-white transition-all duration-300">
                        <div class="w-12 h-12 bg-secondary-blue rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-hands-helping text-white"></i>
                        </div>
                        <h4 class="font-bold text-dark-blue mb-2" data-translate="community">Community</h4>
                        <p class="text-gray-600 text-sm" data-translate="community-text">
                            We promote underexplored destinations to support local communities and encourage inclusive, sustainable tourism.
                        </p>
                    </div>
                    <div class="text-center p-6 rounded-xl bg-ocean-light hover:bg-white transition-all duration-300">
                        <div class="w-12 h-12 bg-gold rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <h4 class="font-bold text-dark-blue mb-2" data-translate="excellence">Excellence</h4>
                        <p class="text-gray-600 text-sm" data-translate="excellence-text">
                            We uphold quality through a platform evaluated under the ISO/IEC 25010 standard, ensuring functionality, efficiency, and usability.
                        </p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div class="text-center p-6 rounded-xl bg-ocean-light hover:bg-white transition-all duration-300">
                        <div class="w-12 h-12 bg-primary-blue rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-lightbulb text-white"></i>
                        </div>
                        <h4 class="font-bold text-dark-blue mb-2" data-translate="innovation">Innovation</h4>
                        <p class="text-gray-600 text-sm" data-translate="innovation-text">
                            We use modern web technologies to centralize and simplify access to tourism information across the Philippines.
                        </p>
                    </div>
                    <div class="text-center p-6 rounded-xl bg-ocean-light hover:bg-white transition-all duration-300">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-universal-access text-white"></i>
                        </div>
                        <h4 class="font-bold text-dark-blue mb-2" data-translate="accessibility">Accessibility</h4>
                        <p class="text-gray-600 text-sm" data-translate="accessibility-text">
                            We design with all users in mind, creating a responsive and easy-to-navigate interface accessible on any device.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="fixed bottom-8 right-8 bg-gradient-to-r from-secondary-blue to-turquoise text-white w-12 h-12 rounded-full shadow-lg hover:from-turquoise hover:to-secondary-blue transition-all duration-300 transform hover:scale-110 opacity-0 invisible">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>

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
                <div class="px-2 py-1 text-white/80 text-sm mb-2">
                    Welcome, ${userName}
                </div>
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
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-4 right-4 bg-turquoise text-white px-6 py-4 rounded-2xl shadow-2xl z-50 font-bold';
                    notification.innerHTML = '<i class="fas fa-check mr-2"></i>Logged out successfully!';
                    document.body.appendChild(notification);

                    setTimeout(() => {
                        window.location.href = 'about_us.php';
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
        accountDropdown.container.classList.remove('group');
        

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
        

        accountDropdown.link.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                accountDropdown.link.click();
            } else if (e.key === 'Escape') {
                hideAccountDropdown();
            }
        });
        

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
        

        if (accountDropdown.link) {
            accountDropdown.link.classList.remove('active');
        }
        
        accountDropdown.isOpen = false;
    }
}


document.addEventListener('DOMContentLoaded', function() {
    initializeAccountDropdown();
    checkLoginStatus();
    
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                hamburgerBtn.classList.add('active');
                mobileMenu.classList.remove('hidden');
                document.body.classList.add('mobile-menu-open');
                
                setTimeout(() => {
                    mobileMenu.style.transition = 'all 0.3s ease-out';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                }, 10);
                
            } else {
                hamburgerBtn.classList.remove('active');
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                document.body.classList.remove('mobile-menu-open');
                
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.style.transition = '';
                }, 300);
            }
        });

        document.addEventListener('click', function(e) {
            if (!mobileMenu.classList.contains('hidden') && 
                !hamburgerBtn.contains(e.target) && 
                !mobileMenu.contains(e.target)) {
                
                hamburgerBtn.classList.remove('active');
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                document.body.classList.remove('mobile-menu-open');
                
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.style.transition = '';
                }, 300);
            }
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                hamburgerBtn.classList.remove('active');
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                document.body.classList.remove('mobile-menu-open');
                
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.style.transition = '';
                }, 300);
            });
        });
    }

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
        
        const cacheKey = `${targetLang}:${text}`;
        if (translationCache.has(cacheKey)) {
            return translationCache.get(cacheKey);
        }
        
        try {
            const response = await fetch(`translate.php?text=${encodeURIComponent(text)}&target_lang=${targetLang}`);
            const data = await response.json();
            const translatedText = data.responseData.translatedText || text;
            
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
        
        const languageSelect = document.getElementById('language-select');
        const originalText = languageSelect.options[languageSelect.selectedIndex].text;
        languageSelect.options[languageSelect.selectedIndex].text = 'Translating...';
        
        try {
            const elements = document.querySelectorAll('[data-translate]');
            for (const element of elements) {
                const originalText = element.textContent.trim();
                if (originalText) {
                    element.textContent = await translateText(originalText, lang);
                }
            }
            
            const placeholders = document.querySelectorAll('[data-translate-placeholder]');
            for (const element of placeholders) {
                const originalPlaceholder = element.getAttribute('placeholder');
                if (originalPlaceholder) {
                    element.setAttribute('placeholder', await translateText(originalPlaceholder, lang));
                }
            }
            
            const selectOptions = document.querySelectorAll('option[data-translate]');
            for (const option of selectOptions) {
                const originalText = option.textContent.trim();
                if (originalText) {
                    option.textContent = await translateText(originalText, lang);
                }
            }
        } catch (error) {
            console.error('Translation failed:', error);
        } finally {
            languageSelect.options[languageSelect.selectedIndex].text = originalText;
        }
    }


    document.getElementById('language-select').addEventListener('change', async (e) => {
        const lang = e.target.value;
        localStorage.setItem('preferredLanguage', lang);
        await translatePage(lang);
    });

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

    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
        card.classList.add('animate-fadeInUp');
    });

    const savedLang = localStorage.getItem('preferredLanguage') || 'en';
    document.getElementById('language-select').value = savedLang;
    if (savedLang !== 'en') {
        translatePage(savedLang);
    }
});
    </script>
</body>
</html>