<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title data-translate="page-title">Frequently Asked Questions - Lakbay Gabay</title>
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

/* FAQ specific styles */
.faq-category {
    margin-bottom: 3rem;
}

.faq-question {
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-left: 4px solid #40e0d0;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

.faq-question:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.faq-question h3 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
}

.faq-question h3 i {
    color: #40e0d0;
    margin-right: 0.75rem;
    font-size: 1.25rem;
}

.faq-answer {
    color: #4a5568;
    line-height: 1.6;
}

.faq-search {
    background: linear-gradient(135deg, #f0f8ff 0%, #e6f7ff 100%);
    border: 2px solid #e2e8f0;
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 3rem;
}

.faq-search h2 {
    color: #2c3e50;
    margin-bottom: 1rem;
    text-align: center;
}

.search-box {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
}

.search-box input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid #cbd5e0;
    border-radius: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: #40e0d0;
    box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.1);
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #718096;
}

.category-icon {
    background: linear-gradient(135deg, #40e0d0 0%, #00a8cc 100%);
    color: white;
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    font-size: 1.25rem;
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
            <h1 class="text-5xl font-bold font-playfair text-slate-blue mb-6" data-translate="faq-title">FAQs</h1>
            <p class="text-xl text-ocean-dark max-w-2xl mx-auto" data-translate="faq-subtitle">
                Find answers to common questions about traveling in the Philippines
            </p>
            <div class="mt-6 text-sm text-ocean-blue">
                <i class="fas fa-info-circle mr-2"></i>
                <span data-translate="faq-guide-text">Your guide to exploring the Philippines with confidence</span>
            </div>
        </div>

        <!-- Search Section -->
        <div class="faq-search">
            <h2 class="text-2xl font-semibold font-playfair text-ocean-blue">
                <i class="fas fa-search mr-2"></i>
                <span data-translate="faq-search-title">Search for Answers</span>
            </h2>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="faq-search" placeholder="Type your question here..." data-translate-placeholder="faq-search-placeholder">
            </div>
        </div>

        <!-- FAQ Content -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 border border-ocean-cyan/20">
            <!-- General Information -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-1">1. General Information</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q1-1">What makes the Philippines a great place to visit?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a1-1">The Philippines is known for its stunning natural landscapes such as our beaches, mountains, islands, and coral reefs plus rich cultural heritage, warm hospitality, and many unique travel experiences. Lakbay Gabay helps you discover both well-known and under-explored spots, with its Spotlight feature highlighting destinations that are especially "explore-worthy."</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q1-2">When is the best time to visit the Philippines?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a1-2">Generally, the dry season (December through May) offers the most favorable weather for travel since there is less rain, clearer skies, and more outdoor-friendly conditions. Keep in mind, however, that weather can vary by region. Rainy or "typhoon" seasons (roughly June to November) may still offer travel opportunities but require flexibility.</p>
                    </div>
                </div>
            </div>

            <!-- Transportation & Travel -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-2">2. Transportation and Travel Around the Philippines</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q2-1">How can I get between islands or remote destinations?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a2-1">Transportation between islands is commonly done by ferry (Ro-Ro or passenger ferries) and by domestic flights. Some areas also use seaplanes. Travel times can vary significantly. It's recommended to check schedules in advance, and if you're using Lakbay Gabay, use the destination profiles to see what transport options are listed for each spot.</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q2-2">What local transport options are available once I'm in a place?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a2-2">Depending on location, local transport includes jeepneys, tricycles, buses, and vans. Larger cities have taxis and ride-hail services. Lakbay Gabay's Spotlight destinations often include notes on how to get around locally.</p>
                    </div>
                </div>
            </div>

            <!-- Money & Costs -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-3">3. Money and Costs</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q3-1">What currency is used, and can I use credit/debit cards?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a3-1">The currency is the Philippine Peso (PHP). Credit and debit cards are accepted in many hotels, restaurants, and major stores, especially in urban and tourist areas. But in remote or rural areas cash is usually necessary.</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q3-2">Where can I exchange money and what should I watch out for?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a3-2">You can exchange foreign currency at banks, airports, and authorized money changers. Rates at airports are often less favorable. Always check for official licensing (often signage "Authorized Money Changer") and avoid exchanging money on the street. Keep receipts in case verification is needed.</p>
                    </div>
                </div>
            </div>

            <!-- Health & Safety -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-4">4. Health and Safety</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q4-1">Are vaccinations or other health precautions needed?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a4-1">Routine vaccinations (e.g. tetanus, hepatitis A/B) are recommended. Depending on your itinerary, you may also consider vaccination or prevention measures for mosquito-borne diseases (such as dengue). Bring insect repellent, drink bottled or purified water in places where water safety is uncertain, and maintain proper hygiene.</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q4-2">What safety tips should I know when traveling in the Philippines?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a4-2">Stay updated on weather conditions (especially in the rainy/typhoon seasons). In crowded areas, safeguard personal belongings and avoid isolated places at night. Also, respect local laws and customs. Always check local travel advisories for the region you plan to visit.</p>
                    </div>
                </div>
            </div>

            <!-- Attractions & Activities -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-5">5. Attractions and Activities</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q5-1">What kinds of activities or experiences can I discover via Lakbay Gabay's Spotlight feature?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a5-1">The Spotlight feature highlights destinations with special appeal, hidden beaches, cultural heritage sites, and natural adventures. Using this, you'll find profiles showcasing what activities are best in each destination (snorkeling, trekking, shopping, etc.).</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q5-2">Do I need permits for national parks or protected areas?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a5-2">Yes, in many cases entry permits or environmental fees are required for protected areas, marine parks, or natural reserves.</p>
                    </div>
                </div>
            </div>

            <!-- Food & Culture -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-6">6. Food and Culture</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q6-1">What local foods should I try in the Philippines?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a6-1">Some must-try Filipino dishes are adobo, sinangag, lechon, sinigang, halo-halo, and kinilaw. Each region has specialties, for example, "laing" in Bicol, "lomi" in Batangas, and "piaya" in Negros.</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q6-2">What cultural etiquette should visitors observe?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a6-2">Filipinos are known for their hospitality and respect for elders. It's polite to use "po" and "opo" in conversation when speaking with older people. Remove shoes before entering homes or religious sites. Ask permission before photographing people, especially in more conservative or rural communities.</p>
                    </div>
                </div>
            </div>

            <!-- Events & Festivals -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-7">7. Events and Festivals</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q7-1">What are some major festivals in the Philippines, and when are they held?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a7-1">Major festivals include Sinulog (Cebu, January), Ati-Atihan (Kalibo, January), Pahiyas (Lucban, May), Panagbenga (Baguio, February), MassKara (Bacolod, October). These events are colorful, vibrant cultural celebrations drawing both locals and tourists.</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q7-2">How can I find out if a festival or event is happening in a destination I plan to visit?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a7-2">Lakbay Gabay includes a filter for Festival & Events on destination profiles. When you view a destination, you can check if there are upcoming festivals or events tied to that place. It's a good idea to check local tourism office websites or social media for last-minute schedule changes.</p>
                    </div>
                </div>
            </div>

            <!-- Accessibility & Special Needs -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-universal-access"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-8">8. Accessibility and Special Needs</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q8-1">Are tourist destinations accessible for people with mobility or sensory disabilities?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a8-1">Accessibility varies greatly depending on the destination. Urban hotels and major tourist sites may have ramps, accessible washrooms, and other facilities. Remote or natural sites may be more challenging. Lakbay Gabay destination details aim to note accessibility features when known, but it's best to contact accommodations or local tourism offices in advance to confirm.</p>
                    </div>
                </div>
            </div>

            <!-- Visas, Entry & Customs -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-passport"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-9">9. Visas, Entry and Customs</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q9-1">Can I enter the Philippines without a visa, and for how long?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a9-1">Many foreign nationals can enter the Philippines visa-free for up to 30 days for tourism, subject to possessing a valid passport (often with at least six months validity) and return or onward ticket. Requirements differ by country, so always check with the Philippine Department of Foreign Affairs or your local Philippine Embassy.</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q9-2">What customs regulations should I be aware of when entering the country?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a9-2">Typical customs rules include declaring certain goods (like large amounts of cash, controlled items) and restrictions on bringing in fresh food, plants, or animals without permits. Items for personal use are usually allowed. Be sure to check current rules as they may vary and change.</p>
                    </div>
                </div>
            </div>

            <!-- Accommodations & Stays -->
            <div class="faq-category">
                <div class="flex items-center mb-6 pb-3 border-b-2 border-turquoise">
                    <div class="category-icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <h2 class="text-3xl font-semibold font-playfair text-ocean-blue" data-translate="faq-category-10">10. Accommodations and Stays</h2>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q10-1">Are there accredited hotels in the Philippines? How can I trust if a hotel is legitimate?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a10-1">Yes. The Department of Tourism (DOT) has lists of accredited hotels and lodging establishments which meet certain quality and safety standards. When booking, check if the hotel is DOT-accredited (this information is often displayed on the hotel's website or DOT's official listings).</p>
                    </div>
                </div>
                
                <div class="faq-question">
                    <h3><i class="fas fa-question-circle"></i> <span data-translate="faq-q10-2">What should I look for when choosing where to stay, especially in less developed areas?</span></h3>
                    <div class="faq-answer">
                        <p data-translate="faq-a10-2">Look for things like location (proximity to attractions or transport), amenities (water supply, power, security), reviews from previous guests, and whether the hotel or lodging is accredited or recognized. Also check whether the accommodation has accessibility features if that is required.</p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mt-16 p-8 bg-gradient-to-r from-ocean-light to-azure rounded-xl border-l-4 border-turquoise">
                <h3 class="text-2xl font-semibold font-playfair text-ocean-blue mb-4">
                    <i class="fas fa-envelope mr-3 text-turquoise"></i>
                    <span data-translate="faq-contact-title">Still Have Questions?</span>
                </h3>
                <p class="text-slate-blue leading-relaxed" data-translate="faq-contact-text">
                    If you couldn't find the answer to your question, feel free to contact us directly:
                    <br><br>
                    <strong>Email:</strong> lakbaygabaypht@gmail.com<br>
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
                            window.location.href = 'faq.php';
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

// FAQ Search Functionality
function initializeFAQSearch() {
    const searchInput = document.getElementById('faq-search');
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            faqQuestions.forEach(question => {
                const questionText = question.textContent.toLowerCase();
                const category = question.closest('.faq-category');
                
                if (searchTerm === '') {
                    question.style.display = 'block';
                    category.style.display = 'block';
                } else if (questionText.includes(searchTerm)) {
                    question.style.display = 'block';
                    category.style.display = 'block';
                } else {
                    question.style.display = 'none';
                    
                    // Hide category if no questions are visible
                    const visibleQuestions = category.querySelectorAll('.faq-question[style="display: block"]');
                    if (visibleQuestions.length === 0) {
                        category.style.display = 'none';
                    }
                }
            });
        });
    }
}

// SINGLE DOMContentLoaded event listener
document.addEventListener('DOMContentLoaded', function() {
    initializeAccountDropdown();
    checkLoginStatus();
    initializeFAQSearch();
    
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