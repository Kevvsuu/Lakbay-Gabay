<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="page-title">Privacy Policy - Lakbay Gabay</title>
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

/* Change account link color when dropdown is active - NO HOVER */
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
                <a href="index.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300" data-translate="nav-home">Home</a>
                <a href="map.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300" data-translate="nav-destination">Destination</a>
                <a href="griddestination.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300" data-translate="nav-all-destination">All Destination</a>
                <a href="contact.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300" data-translate="nav-contact">Contact</a>
                <a href="about_us.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300" data-translate="nav-about">About</a>

                <div class="account-dropdown relative" id="account-dropdown-container">
                    <a href="#" class="account-link text-white/90 font-medium transition-colors duration-300 flex items-center gap-1" data-translate="nav-account">
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
                <option value="en" class="bg-ocean-blue text-white" data-translate="lang-en">English (EN)</option>
                <option value="ko" class="bg-ocean-blue text-white" data-translate="lang-ko">Korean (KO)</option>
                <option value="ja" class="bg-ocean-blue text-white" data-translate="lang-ja">Japanese (JA)</option>
                <option value="zh" class="bg-ocean-blue text-white" data-translate="lang-zh">Chinese (ZH)</option>
                <option value="ms" class="bg-ocean-blue text-white" data-translate="lang-ms">Malay (MS)</option>
                <option value="hi" class="bg-ocean-blue text-white" data-translate="lang-hi">Hindi (HI)</option>
                <option value="tl" class="bg-ocean-blue text-white" data-translate="lang-tl">Filipino (TL)</option>
                <option value="ceb" class="bg-ocean-blue text-white" data-translate="lang-ceb">Cebuano (CEB)</option>
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
            <a href="index.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" data-translate="nav-home">Home</a>
            <a href="map.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" data-translate="nav-destination">Destination</a>
            <a href="griddestination.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" data-translate="nav-all-destination">All Destination</a>
            <a href="contact.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" data-translate="nav-contact">Contact</a>
            <a href="about_us.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" data-translate="nav-about">About</a>

            <!-- Mobile Account Dropdown -->
            <div class="border-t border-white/20 pt-3 mt-2">
                <div class="text-white/70 text-sm font-semibold mb-2" data-translate="nav-account">ACCOUNT</div>
                <div class="px-2 py-1 text-white/80 text-sm mb-2">
                    Loading...
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Main Content -->
<main class="min-h-screen py-16 pt-32">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl font-bold font-playfair text-slate-blue mb-6" data-translate="privacy-title">Privacy Policy</h1>
            <p class="text-xl text-ocean-dark max-w-2xl mx-auto" data-translate="privacy-subtitle">
                Your privacy is important to us. Learn how we collect, use, and protect your information.
            </p>
            <div class="mt-6 text-sm text-ocean-blue">
                <i class="fas fa-shield-alt mr-2"></i>
                <span data-translate="privacy-last-updated">Last updated: October 10, 2025</span>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 border border-ocean-cyan/20">
            <!-- Section 1 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-1-title">
                    1. WHAT INFORMATION DO WE COLLECT?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <h4 class="text-xl font-semibold text-ocean-blue mb-3" data-translate="privacy-section-1-sub1">Voluntary Information</h4>
                    <p class="mb-4" data-translate="privacy-section-1-p1">
                        We collect personal information only when you choose to provide it, such as when creating an optional user account or submitting feedback.
                    </p>
                    <p class="mb-4" data-translate="privacy-section-1-p2">
                        This may include:
                    </p>
                    <ul class="list-disc pl-6 mb-6 space-y-2">
                        <li data-translate="privacy-section-1-li1">Email address (required for registration)</li>
                        <li data-translate="privacy-section-1-li2">Username and password (chosen by the user)</li>
                        <li data-translate="privacy-section-1-li3">Feedback or comments voluntarily submitted through forms</li>
                    </ul>
                    
                    <h4 class="text-xl font-semibold text-ocean-blue mb-3" data-translate="privacy-section-1-sub2">Analytics Data</h4>
                    <p class="mb-4" data-translate="privacy-section-1-p3">
                        To improve our platform's performance, we use basic page visit counters that record anonymous metrics such as total visits and page traffic. These counters do not collect personal identifiers, device details, browser types, IP addresses, or location data.
                    </p>
                </div>
            </section>

            <!-- Section 2 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-2-title">
                    2. HOW DO WE PROCESS YOUR INFORMATION?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-2-p1">
                        We use the collected information to:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="privacy-section-2-li1">Create and manage user accounts</li>
                        <li data-translate="privacy-section-2-li2">Display user-generated feedback (if applicable)</li>
                        <li data-translate="privacy-section-2-li3">Improve the website's usability and overall performance</li>
                        <li data-translate="privacy-section-2-li4">Evaluate engagement levels for research and development purposes</li>
                    </ul>
                    <p data-translate="privacy-section-2-p2">
                        All information is handled responsibly and used solely for academic and platform improvement objectives.
                    </p>
                </div>
            </section>

            <!-- Section 3 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-3-title">
                    3. WHAT LEGAL BASES DO WE RELY ON TO PROCESS YOUR PERSONAL INFORMATION?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-3-p1">
                        We process personal information based on:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="privacy-section-3-li1">User consent when you voluntarily register or submit feedback.</li>
                        <li data-translate="privacy-section-3-li2">Legitimate interest to maintain and improve system performance, ensuring that Lakbay Gabay remains functional and user-friendly.</li>
                    </ul>
                </div>
            </section>

            <!-- Section 4 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-4-title">
                    4. WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-4-p1">
                        Lakbay Gabay does not sell, rent, or share your information with third parties.
                    </p>
                    <p class="mb-4" data-translate="privacy-section-4-p2">
                        Access to data is limited to the researchers and developers maintaining the platform.
                    </p>
                    <p data-translate="privacy-section-4-p3">
                        Information may be disclosed only when required by law or to ensure the integrity and security of the system.
                    </p>
                </div>
            </section>

            <!-- Section 5 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-5-title">
                    5. WHAT IS OUR STANCE ON THIRD-PARTY WEBSITES?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-5-p1">
                        Our website does include links to external sources such as accommodation websites, restaurant websites, and local government websites.
                    </p>
                    <p class="mb-4" data-translate="privacy-section-5-p2">
                        We are not responsible for the privacy practices or content of these third-party sites.
                    </p>
                    <p data-translate="privacy-section-5-p3">
                        We encourage you to review their privacy policies before providing any information.
                    </p>
                </div>
            </section>

            <!-- Section 6 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-6-title">
                    6. DO WE USE COOKIES AND OTHER TRACKING TECHNOLOGIES?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-6-p1">
                        We do not use cookies or personalized tracking technologies.
                    </p>
                    <p class="mb-4" data-translate="privacy-section-6-p2">
                        Our system uses only anonymous visit counters to measure site traffic and performance metrics.
                    </p>
                    <p data-translate="privacy-section-6-p3">
                        These counters do not store, share, or identify user information.
                    </p>
                </div>
            </section>

            <!-- Section 8 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-8-title">
                    8. IS YOUR INFORMATION TRANSFERRED INTERNATIONALLY?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-8-p1">
                        Our website is hosted through InfinityFree, which may route data through servers located outside the Philippines.
                    </p>
                    <p data-translate="privacy-section-8-p2">
                        While this may involve international transmission, we ensure that any information handled through our hosting service remains protected by standard security protocols.
                    </p>
                </div>
            </section>

            <!-- Section 9 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-9-title">
                    9. HOW LONG DO WE KEEP YOUR INFORMATION?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-9-p1">
                        We retain personal information only for as long as necessary to fulfill the purposes stated in this policy.
                    </p>
                    <p data-translate="privacy-section-9-p2">
                        User accounts and feedback data are stored until they are deleted by the user or by project administrators upon request. After this period, data is securely deleted or anonymized.
                    </p>
                </div>
            </section>

            <!-- Section 10 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-10-title">
                    10. HOW DO WE KEEP YOUR INFORMATION SAFE?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-10-p1">
                        We use technical and administrative measures to safeguard personal information, including:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="privacy-section-10-li1">Password encryption</li>
                        <li data-translate="privacy-section-10-li2">Secure storage within the hosting environment</li>
                        <li data-translate="privacy-section-10-li3">Restricted access to authorized researchers only</li>
                    </ul>
                    <p data-translate="privacy-section-10-p2">
                        While we take reasonable precautions, no method of data transmission or storage is completely secure.
                    </p>
                </div>
            </section>

            <!-- Section 11 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-11-title">
                    11. DO WE COLLECT INFORMATION FROM MINORS?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-11-p1">
                        Lakbay Gabay is intended for general audiences and is not directed toward children under 13. We do not knowingly collect personal information from minors.
                    </p>
                    <p data-translate="privacy-section-11-p2">
                        If we become aware that we have inadvertently collected such information, we will delete it immediately.
                    </p>
                </div>
            </section>

            <!-- Section 12 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-12-title">
                    12. WHAT ARE YOUR PRIVACY RIGHTS?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-12-p1">
                        You have the right to:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="privacy-section-12-li1">Request access to or correction of your personal data</li>
                        <li data-translate="privacy-section-12-li2">Request deletion of your account or feedback submissions</li>
                    </ul>
                    <p data-translate="privacy-section-12-p2">
                        To exercise these rights, please contact us through the information provided below.
                    </p>
                </div>
            </section>

            <!-- Section 13 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-13-title">
                    13. CONTROLS FOR DO-NOT-TRACK FEATURES
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-13-p1">
                        Our system does not track users across websites and therefore does not respond to Do-Not-Track (DNT) signals.
                    </p>
                    <p data-translate="privacy-section-13-p2">
                        Since we do not use cookies or personalized tracking, all browsing sessions remain anonymous.
                    </p>
                </div>
            </section>

            <!-- Section 16 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-16-title">
                    16. DO WE MAKE UPDATES TO THIS NOTICE?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-16-p1">
                        Yes. We may update this Privacy Policy periodically to reflect improvements, legal requirements, or new system features.
                    </p>
                    <p data-translate="privacy-section-16-p2">
                        Any changes will be posted on this page with an updated "Last Updated" date.
                    </p>
                </div>
            </section>

            <!-- Section 17 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-17-title">
                    17. HOW CAN YOU CONTACT US ABOUT THIS NOTICE?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-17-p1">
                        For questions, feedback, or privacy-related requests, please contact the research and development team at:
                    </p>
                    <p class="text-lg font-semibold text-ocean-blue">
                        lakbaygabayph@gmail.com
                    </p>
                </div>
            </section>

            <!-- Section 18 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="privacy-section-18-title">
                    18. HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="privacy-section-18-p1">
                        If you have created an account or submitted feedback and wish to review, update, or remove your data, please reach out to us through the contact email above.
                    </p>
                    <p data-translate="privacy-section-18-p2">
                        We will respond to your request within a reasonable timeframe.
                    </p>
                </div>
            </section>

            <!-- Contact Information -->
            <div class="mt-16 p-8 bg-gradient-to-r from-ocean-light to-azure rounded-xl border-l-4 border-turquoise">
                <h3 class="text-2xl font-semibold font-playfair text-ocean-blue mb-4">
                    <i class="fas fa-envelope mr-3 text-turquoise"></i>
                    <span data-translate="privacy-contact-title">Contact Us About Privacy</span>
                </h3>
                <p class="text-slate-blue leading-relaxed mb-6" data-translate="privacy-contact-text">
                    If you have any questions about this Privacy Policy or our privacy practices, please contact us:
                </p>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-semibold text-ocean-blue mb-2" data-translate="privacy-contact-team">Research & Development Team</h4>
                        <p class="text-slate-blue">
                            <strong>Email:</strong> lakbaygabayph@gmail.com
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-ocean-blue mb-2" data-translate="privacy-contact-project">Project Information</h4>
                        <p class="text-slate-blue" data-translate="privacy-contact-details">
                            Lakbay Gabay<br>
                            Academic Capstone Project<br>
                            Philippines
                        </p>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-turquoise/10 rounded-lg">
                    <h4 class="font-semibold text-ocean-blue mb-2">
                        <i class="fas fa-clock mr-2"></i>
                        <span data-translate="privacy-response-time">Response Time</span>
                    </h4>
                    <p class="text-slate-blue text-sm" data-translate="privacy-response-text">
                        We aim to respond to all privacy-related inquiries within a reasonable timeframe.
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

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

<!-- Scroll to Top Button -->
<button id="scrollToTop" class="fixed bottom-8 right-8 bg-gradient-to-r from-secondary-blue to-turquoise text-white w-12 h-12 rounded-full shadow-lg hover:from-turquoise hover:to-secondary-blue transition-all duration-300 transform hover:scale-110 opacity-0 invisible">
    <i class="fas fa-chevron-up"></i>
</button>

<script>
// Login status management
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
                        // Show success message
                        const notification = document.createElement('div');
                        notification.className = 'fixed top-4 right-4 bg-turquoise text-white px-6 py-4 rounded-2xl shadow-2xl z-50 font-bold';
                        notification.innerHTML = '<i class="fas fa-check mr-2"></i>Logged out successfully!';
                        document.body.appendChild(notification);

                        setTimeout(() => {
                            window.location.href = 'privacypolicy.php';
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
        // Remove any hover behavior
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
        
        // Update arrow rotation and color
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
        
        // Reset arrow rotation and color
        if (accountDropdown.link) {
            accountDropdown.link.classList.remove('active');
        }
        
        accountDropdown.isOpen = false;
    }
}

// SINGLE DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', function() {
    initializeAccountDropdown();
    checkLoginStatus();
    
    // Mobile hamburger functionality
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const isHidden = mobileMenu.classList.contains('hidden');
            const hamburgerLines = this.querySelectorAll('.hamburger-line');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                document.body.classList.add('mobile-menu-open');
                setTimeout(() => {
                    mobileMenu.style.transition = 'all 0.3s ease-out';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                }, 10);
                
                hamburgerLines[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                hamburgerLines[1].style.opacity = '0';
                hamburgerLines[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
                
            } else {
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                document.body.classList.remove('mobile-menu-open');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.style.transition = '';
                }, 300);
                
                hamburgerLines[0].style.transform = 'none';
                hamburgerLines[1].style.opacity = '1';
                hamburgerLines[2].style.transform = 'none';
            }
        });

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

    // Translation functionality
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

    // Initialize language selector
    document.getElementById('language-select').addEventListener('change', async (e) => {
        const lang = e.target.value;
        localStorage.setItem('preferredLanguage', lang);
        await translatePage(lang);
    });

    // Scroll to top functionality
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

    // Add floating animation to cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
        card.classList.add('animate-fadeInUp');
    });

    // Initialize page with saved language
    const savedLang = localStorage.getItem('preferredLanguage') || 'en';
    document.getElementById('language-select').value = savedLang;
    if (savedLang !== 'en') {
        translatePage(savedLang);
    }
});
</script>
</body>
</html>