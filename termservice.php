<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="page-title">Terms of Service - Lakbay Gabay</title>
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
            <h1 class="text-5xl font-bold font-playfair text-slate-blue mb-6" data-translate="terms-title">Terms of Service</h1>
            <p class="text-xl text-ocean-dark max-w-2xl mx-auto" data-translate="terms-subtitle">
                Please read these terms carefully before using Lakbay Gabay services
            </p>
            <div class="mt-6 text-sm text-ocean-blue">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span data-translate="terms-last-updated">Last updated: October 10, 2025</span>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 border border-ocean-cyan/20">
            <!-- Section 1 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-1-title">
                    1. ABOUT LAKBAY GABAY
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-1-p1">
                        Lakbay Gabay is a non-commercial, academic web-based system created by student researchers in the Philippines.
                    </p>
                    <p class="mb-4" data-translate="terms-section-1-p2">
                        Its purpose is to provide centralized, verified, and accessible information about tourist destinations across the country.
                    </p>
                    <p data-translate="terms-section-1-p3">
                        The website is intended for educational and informational use only and does not serve as a commercial travel or booking service.
                    </p>
                </div>
            </section>

            <!-- Section 2 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-2-title">
                    2. USER ACCOUNTS
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-2-p1">
                        Registration on Lakbay Gabay is optional.
                    </p>
                    <p class="mb-4" data-translate="terms-section-2-p2">
                        Users who choose to register may:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="terms-section-2-li1">Create an account using an email address, username, and password</li>
                        <li data-translate="terms-section-2-li2">Submit ratings and written reviews for listed destinations</li>
                        <li data-translate="terms-section-2-li3">Bookmark destinations for personal reference</li>
                    </ul>
                    <p class="mb-4" data-translate="terms-section-2-p3">
                        You are responsible for maintaining the confidentiality of your account credentials.
                    </p>
                    <p data-translate="terms-section-2-p4">
                        You agree not to share your password or access your account through unauthorized means.
                    </p>
                </div>
            </section>

            <!-- Section 3 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-3-title">
                    3. FEEDBACK AND USER CONTRIBUTIONS
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-3-p1">
                        Users may submit feedback through forms available on the website. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-3-p2">
                        Providing a name and email address for feedback is optional. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-3-p3">
                        All feedback submissions are visible only to the project administrators (the researchers) and are used solely to improve the system and evaluate user experience.
                    </p>
                    <p class="mb-4" data-translate="terms-section-3-p4">
                        Reviews and ratings submitted by registered users may be publicly visible.
                    </p>
                    <p class="mb-4" data-translate="terms-section-3-p5">
                        By submitting a review, you agree to:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="terms-section-3-li1">Share only truthful and relevant experiences</li>
                        <li data-translate="terms-section-3-li2">Avoid offensive, defamatory, or inappropriate content</li>
                        <li data-translate="terms-section-3-li3">Grant Lakbay Gabay permission to display, edit, or remove your content for moderation or research purposes</li>
                    </ul>
                </div>
            </section>

            <!-- Section 4 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-4-title">
                    4. CONTENT OWNERSHIP AND USAGE
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-4-p1">
                        All written content on Lakbay Gabay, including destination descriptions, is authored or rewritten by the research team using verified public information from credible sources. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-4-p2">
                        Media such as images are obtained from free stock libraries and used in accordance with their respective licenses. Proper attribution is provided whenever required. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-4-p3">
                        All materials on this website are provided for educational and research purposes only. 
                    </p>
                    <p data-translate="terms-section-4-p4">
                        Users may view, share, and cite content from Lakbay Gabay for personal or academic use, but commercial reproduction or redistribution is prohibited.
                    </p>
                </div>
            </section>

            <!-- Section 5 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-5-title">
                    5. ACCURACY AND INFORMATION DISCLAIMER
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-5-p1">
                        While the research team strives to provide accurate and up-to-date information, Lakbay Gabay does not guarantee absolute accuracy, completeness, or timeliness of any data published on the website. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-5-p2">
                        Tourism information may change without notice due to local developments, weather conditions, or policy updates. 
                    </p>
                    <p data-translate="terms-section-5-p3">
                        Lakbay Gabay and its developers are not liable for any loss, inconvenience, or misunderstanding that may result from reliance on the content provided.
                    </p>
                </div>
            </section>

            <!-- Section 6 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-6-title">
                    6. LIMITATION OF LIABILITY
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-6-p1">
                        Lakbay Gabay is an academic platform, and the information presented is for informational use only.
                    </p>
                    <p class="mb-4" data-translate="terms-section-6-p2">
                        We are not responsible for:
                    </p>
                    <ul class="list-disc pl-6 mb-4 space-y-2">
                        <li data-translate="terms-section-6-li1">Errors or omissions in destination details</li>
                        <li data-translate="terms-section-6-li2">Outdated or third-party information sources</li>
                        <li data-translate="terms-section-6-li3">Any damages arising from website access, use, or temporary unavailability</li>
                    </ul>
                    <p data-translate="terms-section-6-p3">
                        Users are encouraged to verify travel details directly with official tourism offices or local authorities.
                    </p>
                </div>
            </section>

            <!-- Section 7 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-7-title">
                    7. INTELLECTUAL PROPERTY
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-7-p1">
                        All text, design elements, and system features of Lakbay Gabay are the intellectual property of the developers and are protected under applicable laws. 
                    </p>
                    <p data-translate="terms-section-7-p2">
                        Logos, trademarks, and external content referenced belong to their respective owners.
                    </p>
                </div>
            </section>

            <!-- Section 8 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-8-title">
                    8. THIRD-PARTY LINKS
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-8-p1">
                        The website may contain links to third-party sites, such as official tourism agencies or travel resources. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-8-p2">
                        These are provided for reference and convenience. 
                    </p>
                    <p class="mb-4" data-translate="terms-section-8-p3">
                        Lakbay Gabay does not control or endorse the content, policies, or services of these external websites. 
                    </p>
                    <p data-translate="terms-section-8-p4">
                        Users are encouraged to review the terms and privacy policies of third-party sites they visit.
                    </p>
                </div>
            </section>

            <!-- Section 9 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-9-title">
                    9. GOVERNING LAW
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-9-p1">
                        These Terms shall be governed by and construed in accordance with the laws of the Republic of the Philippines. 
                    </p>
                    <p data-translate="terms-section-9-p2">
                        Any disputes arising from or relating to the use of this website shall be handled within the jurisdiction of Philippine courts.
                    </p>
                </div>
            </section>

            <!-- Section 10 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-10-title">
                    10. CHANGES TO THESE TERMS
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p class="mb-4" data-translate="terms-section-10-p1">
                        We may update these Terms of Service periodically to reflect system updates, feature changes, or new research requirements. 
                    </p>
                    <p data-translate="terms-section-10-p2">
                        The revised version will be posted on this page with an updated "Last Updated" date. Continued use of Lakbay Gabay after changes are posted constitutes acceptance of the revised terms.
                    </p>
                </div>
            </section>

            <!-- Section 11 -->
            <section class="mb-12">
                <h2 class="text-3xl font-semibold font-playfair text-ocean-blue mb-6 pb-3 border-b-2 border-turquoise" data-translate="terms-section-11-title">
                    11. CONTACT INFORMATION
                </h2>
                <div class="prose max-w-none text-slate-blue leading-relaxed">
                    <p data-translate="terms-section-11-p1">
                        For questions, feedback, or concerns regarding these Terms, you may contact the research and development team at: lakbaygabayph@gmail.com
                    </p>
                </div>
            </section>

            <!-- Contact Information -->
            <div class="mt-16 p-8 bg-gradient-to-r from-ocean-light to-azure rounded-xl border-l-4 border-turquoise">
                <h3 class="text-2xl font-semibold font-playfair text-ocean-blue mb-4">
                    <i class="fas fa-envelope mr-3 text-turquoise"></i>
                    <span data-translate="terms-contact-title">Contact Us</span>
                </h3>
                <p class="text-slate-blue leading-relaxed" data-translate="terms-contact-text">
                    If you have any questions about these Terms of Service, please contact us at:
                    <br><br>
                    <strong>Email:</strong> lakbaygabayph@gmail.com<br>
                    <strong>Address:</strong> Philippines<br>
                </p>
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
            <a href="dashboard.php" class="dropdown-item flex items-center gap-3">
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
            <a href="dashboard.php" class="flex items-center gap-3 text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">
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