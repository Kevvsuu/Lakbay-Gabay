<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Lakbay Gabay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ocean-blue: #0077be;
            --cyan-blue: #00a8cc;
            --turquoise: #40e0d0;
            --alice-blue: #f0f8ff;
            --dark-blue: #2c3e50;
            --gold-yellow: #ffd700;
            --slate-blue: #2c3e50;
            --ocean-dark: #005a94;
            --azure: #f0f8ff;
            --ocean-cyan: #00a8cc;
        }
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&display=swap');

/* GLOBAL FONT FAMILIES */
body, p, span, a, button, input, select, textarea, label {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

/* HEADINGS USE PLAYFAIR DISPLAY */
h1, h2, h3, h4, h5, h6 {
    font-family: 'Playfair Display', serif !important;
}

/* LOGO - Playfair Display */
.logo a {
    font-family: 'Playfair Display', serif !important;
}

/* HERO SECTION HEADING */
.hero-section h1,
#welcome-message {
    font-family: 'Playfair Display', serif !important;
}

/* SECTION HEADINGS */
.text-gradient {
    font-family: 'Playfair Display', serif !important;
    background: linear-gradient(135deg, var(--dark-blue) 0%, var(--ocean-blue) 50%, var(--turquoise) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* STAT CARD NUMBERS - Use Inter for clarity */
.stat-card h3 {
    font-family: 'Inter', sans-serif !important;
    font-weight: 800;
}

.stat-card p {
    font-family: 'Inter', sans-serif !important;
}

/* BOOKMARK CARD TEXT */
.bookmark-card h3 {
    font-family: 'Playfair Display', serif !important;
    font-weight: 600;
}

.bookmark-card p,
.bookmark-card span {
    font-family: 'Inter', sans-serif !important;
}

/* CATEGORY BADGES - Inter */
.category-badge {
    font-family: 'Inter', sans-serif !important;
    font-weight: 700;
}

/* BUTTONS - Inter */
.btn-primary, 
.btn-secondary, 
.btn-danger, 
.show-more-btn {
    font-family: 'Inter', sans-serif !important;
    font-weight: 600;
}

/* NAVIGATION LINKS - Inter */
nav a {
    font-family: 'Inter', sans-serif !important;
    font-weight: 500;
}

/* MOBILE MENU - Inter */
#mobile-menu a {
    font-family: 'Inter', sans-serif !important;
}

/* LANGUAGE SELECT - Inter */
#language-select,
#language-select option {
    font-family: 'Inter', sans-serif !important;
}

/* EMPTY STATE */
.empty-state h3 {
    font-family: 'Playfair Display', serif !important;
}

.empty-state p {
    font-family: 'Inter', sans-serif !important;
}

/* FOOTER HEADINGS - Playfair Display */
footer h3,
footer h4 {
    font-family: 'Playfair Display', serif !important;
}

/* FOOTER TEXT - Inter */
footer p,
footer a,
footer li {
    font-family: 'Inter', sans-serif !important;
}

/* OVERVIEW TEXT - Inter */
.overview-text {
    font-family: 'Inter', sans-serif !important;
    line-height: 1.6;
}

/* QUICK ACTIONS IN HERO */
.hero-section .btn-secondary span {
    font-family: 'Inter', sans-serif !important;
    font-weight: 600;
}

/* INLINE BADGE IN HERO */
.hero-section .inline-flex span {
    font-family: 'Inter', sans-serif !important;
    font-weight: 600;
}

/* ENSURE GOOGLE FONTS ARE LOADED */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, var(--alice-blue) 0%, #e8f5ff 50%, var(--alice-blue) 100%);
            min-height: 100vh;
        }

        /* HEADER STYLING */
        .header-bg {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--ocean-dark) 50%, var(--dark-blue) 100%);
            backdrop-filter: blur(16px) saturate(180%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--cyan-blue) 50%, var(--turquoise) 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-pattern {
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            position: absolute;
            inset: 0;
            opacity: 0.5;
        }

        .hero-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23f0f8ff'/%3E%3C/svg%3E") no-repeat;
            background-size: cover;
        }

        /* CARD STYLES */
        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(64, 224, 208, 0.2);
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 119, 190, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 119, 190, 0.2);
            border-color: var(--turquoise);
        }

        .bookmark-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
        }

        .bookmark-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 119, 190, 0.15);
            border-color: var(--turquoise);
        }

        .bookmark-card img {
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bookmark-card:hover img {
            transform: scale(1.1);
        }

        /* BUTTON STYLES */
        .btn-primary {
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--cyan-blue) 100%);
            color: white;
            border: none;
            padding: 14px 32px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 119, 190, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--cyan-blue) 0%, var(--turquoise) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 190, 0.4);
        }

        .btn-secondary {
            background: white;
            color: var(--ocean-blue);
            border: 2px solid var(--ocean-blue);
            padding: 14px 32px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--ocean-blue);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        /* STATS CARD */
        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 248, 255, 0.9) 100%);
            backdrop-filter: blur(15px);
            border: 2px solid rgba(64, 224, 208, 0.3);
            border-radius: 20px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0, 119, 190, 0.15);
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 16px;
            background: linear-gradient(135deg, var(--turquoise) 0%, var(--cyan-blue) 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(64, 224, 208, 0.3);
        }

        /* CATEGORY BADGES */
        .category-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* EMPTY STATE */
        .empty-state {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.8) 0%, rgba(240, 248, 255, 0.8) 100%);
            backdrop-filter: blur(15px);
            border: 3px dashed rgba(0, 119, 190, 0.3);
            border-radius: 24px;
            padding: 80px 40px;
            text-align: center;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--alice-blue) 0%, rgba(64, 224, 208, 0.2) 100%);
            border: 3px solid var(--turquoise);
        }

        /* FLOATING ANIMATIONS */
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(64, 224, 208, 0.4); }
            50% { box-shadow: 0 0 40px rgba(64, 224, 208, 0.8); }
        }

        /* LOADING ANIMATION */
        .loading-spinner {
            border: 4px solid rgba(0, 119, 190, 0.1);
            border-top: 4px solid var(--ocean-blue);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* HAMBURGER MENU */
        .hamburger-btn {
            cursor: pointer;
            background: transparent;
            border: none;
            outline: none;
            z-index: 2001;
        }

        .hamburger-line {
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .hamburger-btn.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger-btn.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger-btn.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        #mobile-menu {
            transition: all 0.3s ease-in-out;
            max-height: 0;
            overflow: hidden;
        }

        #mobile-menu.open {
            max-height: 600px;
            overflow-y: auto;
        }

        body.mobile-menu-open {
            overflow: hidden;
        }

        /* TEXT STYLES */
        .text-gradient {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--ocean-blue) 50%, var(--turquoise) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* OVERVIEW TEXT */
        .overview-text {
            transition: all 0.3s ease-in-out;
        }

        .overview-text.collapsed {
            max-height: 4.5em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .show-more-btn {
            background: linear-gradient(135deg, var(--turquoise) 0%, var(--cyan-blue) 100%);
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .show-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(64, 224, 208, 0.4);
        }

        /* FOOTER */
        .bg-pattern-dots {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .bg-pattern {
            opacity: 0.1;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 20px 80px;
            }

            .stat-card {
                padding: 20px;
            }

            .empty-state {
                padding: 60px 30px;
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
                        'cyan-blue': '#00a8cc', 
                        'turquoise': '#40e0d0',
                        'alice-blue': '#f0f8ff',
                        'dark-blue': '#2c3e50',
                        'gold-yellow': '#ffd700',
                        'slate-blue': '#2c3e50',
                        'ocean-dark': '#005a94',
                        'azure': '#f0f8ff',
                        'ocean-cyan': '#00a8cc'
                    }
                }
            }
        }
    </script>
</head>
<body>

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
                    <a href="#" class="logout-link text-white/90 hover:text-turquoise font-medium transition-colors duration-300 flex items-center" onclick="logout()">Logout</a>
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
                
                <button class="hamburger-btn md:hidden flex flex-col justify-center items-center w-8 h-8 relative" id="hamburger-btn">
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
                <a href="#" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" onclick="logout()">Logout</a>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section pt-32 pb-24 relative">
        <div class="hero-pattern"></div>
        <div class="max-w-7xl mx-auto px-4 lg:px-8 relative z-10">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-md px-6 py-3 rounded-full mb-6 border border-white/30">
                    <i class="fas fa-compass text-2xl"></i>
                    <span class="font-semibold text-lg">Your Travel Hub</span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold font-playfair mb-6" id="welcome-message">Welcome, Traveler!</h1>
                <p class="text-xl lg:text-2xl text-white/90 mb-10 max-w-3xl mx-auto">Manage your bookmarked destinations and plan your next adventure</p>
                
                <!-- Quick Actions -->
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="map.php" class="btn-secondary inline-flex items-center gap-3">
                        <i class="fas fa-map text-xl"></i>
                        <span>Explore Map</span>
                    </a>
                    <a href="account_settings.php" class="btn-secondary inline-flex items-center gap-3">
                        <i class="fas fa-user-cog text-xl"></i>
                        <span>Account Settings</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="hero-wave"></div>
    </section>

    <!-- Stats Section -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 -mt-16 mb-16 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto">
                    <i class="fas fa-bookmark"></i>
                </div>
                <h3 class="text-3xl font-bold text-dark-blue mb-2" id="bookmark-count">0</h3>
                <p class="text-ocean-blue font-semibold text-lg">Saved Destinations</p>
            </div>
            
            <div class="stat-card text-center">
                <div class="stat-icon mx-auto" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4a 100%);">
                    <i class="fas fa-globe-asia"></i>
                </div>
                <h3 class="text-3xl font-bold text-dark-blue mb-2">10</h3>
                <p class="text-ocean-blue font-semibold text-lg">Categories Available</p>
            </div>
        </div>
    </section>

    <!-- Bookmarks Section -->
    <section class="max-w-7xl mx-auto px-4 lg:px-8 pb-20">
        <div class="mb-12">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-gradient mb-3">My Bookmarked Destinations</h2>
                    <p class="text-dark-blue/70 text-lg">Your collection of dream destinations</p>
                </div>
                <a href="map.php" class="btn-primary inline-flex items-center gap-3">
                    <i class="fas fa-plus-circle text-xl"></i>
                    <span>Add More</span>
                </a>
            </div>
        </div>

        <div id="bookmarks-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Loading State -->
            <div class="col-span-full flex justify-center items-center py-20">
                <div class="loading-spinner"></div>
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

    <script>
        // Hamburger menu functionality
        document.addEventListener('DOMContentLoaded', async function() {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const header = document.getElementById('header');
            
            // Initialize translation
            const savedLang = localStorage.getItem('preferredLanguage') || 'en';
            document.getElementById('language-select').value = savedLang;
            if (savedLang !== 'en') {
                await translatePage(savedLang);
            }
            
            checkLoginStatus();
            loadBookmarks();

            if (hamburgerBtn && mobileMenu) {
                hamburgerBtn.addEventListener('click', function() {
                    this.classList.toggle('active');
                    mobileMenu.classList.toggle('open');
                    mobileMenu.classList.toggle('hidden');
                    document.body.classList.toggle('mobile-menu-open');
                    
                    if (this.classList.contains('active')) {
                        header.style.background = 'linear-gradient(135deg, #2c3e50 0%, #005a94 100%)';
                    } else {
                        header.style.background = 'linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%)';
                    }
                });

                const mobileLinks = mobileMenu.querySelectorAll('a');
                mobileLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        hamburgerBtn.classList.remove('active');
                        mobileMenu.classList.remove('open');
                        mobileMenu.classList.add('hidden');
                        document.body.classList.remove('mobile-menu-open');
                        header.style.background = 'linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%)';
                    });
                });

                document.addEventListener('click', function(event) {
                    if (!header.contains(event.target) && mobileMenu.classList.contains('open')) {
                        hamburgerBtn.classList.remove('active');
                        mobileMenu.classList.remove('open');
                        mobileMenu.classList.add('hidden');
                        document.body.classList.remove('mobile-menu-open');
                        header.style.background = 'linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%)';
                    }
                });
            }
        });

        function checkLoginStatus() {
            fetch('check_login.php')
                .then(response => response.json())
                .then(data => {
                    if (!data.logged_in) {
                        window.location.href = 'loginform.php';
                    } else {
                        document.getElementById('welcome-message').textContent = `Welcome, ${data.username}!`;
                    }
                })
                .catch(error => {
                    console.error('Error checking login status:', error);
                    window.location.href = 'loginform.php';
                });
        }

        function loadBookmarks() {
            fetch('get_bookmarks.php')
                .then(response => response.json())
                .then(bookmarks => {
                    const container = document.getElementById('bookmarks-container');
                    const bookmarkCount = document.getElementById('bookmark-count');
                    
                    bookmarkCount.textContent = bookmarks.length;
                    
                    if (bookmarks.length === 0) {
                        container.innerHTML = `
                            <div class="col-span-full">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-bookmark text-turquoise text-5xl"></i>
                                    </div>
                                    <h3 class="text-3xl font-bold text-dark-blue mb-4">No Bookmarks Yet</h3>
                                    <p class="text-dark-blue/70 text-lg mb-8 max-w-lg mx-auto">
                                        Start exploring and bookmark your favorite destinations to build your dream travel collection!
                                    </p>
                                    <a href="map.php" class="btn-primary inline-flex items-center gap-3">
                                        <i class="fas fa-map-marked-alt text-xl"></i>
                                        <span>Discover Destinations</span>
                                    </a>
                                </div>
                            </div>
                        `;
                        return;
                    }
                    
                    container.innerHTML = '';
                    
                    bookmarks.forEach((spot, index) => {
                        const spotCard = createSpotCard(spot);
                        container.appendChild(spotCard);
                        
                        setTimeout(() => {
                            spotCard.style.opacity = '1';
                            spotCard.style.transform = 'translateY(0)';
                        }, index * 100);
                    });
                })
                .catch(error => {
                    console.error('Error loading bookmarks:', error);
                    const container = document.getElementById('bookmarks-container');
                    container.innerHTML = `
                        <div class="col-span-full">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-exclamation-triangle text-yellow-500 text-5xl"></i>
                                </div>
                                <h3 class="text-3xl font-bold text-dark-blue mb-4">Unable to Load Bookmarks</h3>
                                <p class="text-dark-blue/70 text-lg mb-8">Please refresh the page or try again later.</p>
                                <button onclick="loadBookmarks()" class="btn-primary inline-flex items-center gap-3">
                                    <i class="fas fa-sync-alt text-xl"></i>
                                    <span>Retry</span>
                                </button>
                            </div>
                        </div>
                    `;
                });
        }

        function createSpotCard(spot) {
            const div = document.createElement('div');
            div.className = 'opacity-0 transform translate-y-8';
            div.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            
            const imageUrl = spot.images && spot.images.length > 0 ? spot.images[0] : 'images/default-spot.jpg';
            
            const filterColors = {
                'Beaches & Islands': '#40E0D0',
                'Nature & Wildlife': '#228B22',
                'Urban & Nightlife': '#A020F0',
                'Adventure & Extreme Sports': '#FFA500',
                'Arts & Culture': '#EA2432',
                'Festivals & Events': '#FFFF00',
                'UNESCO Sites': '#A52A2A',
                'Spiritual & Pilgrimage': '#57B9FF',
                'Hidden Wonders': '#272757',
                'Wellness Retreats and Leisure': '#FF8DA1'
            };
            
            const categories = spot.category ? spot.category.split(',').map(cat => cat.trim()) : [];
            const categoryBadgesHTML = categories.map(category => {
                const categoryColor = filterColors[category] || '#0077be';
                return `<span class="category-badge" style="background-color: ${categoryColor};">
                    ${category}
                </span>`;
            }).join('');
            
            const overview = spot.overview || 'No description available.';
            const needsShowMore = overview.length > 150;
            
            div.setAttribute('data-spot', JSON.stringify(spot));
            div.setAttribute('data-original-overview', overview);
            
            div.innerHTML = `
                <div class="bookmark-card">
                    <div class="relative overflow-hidden h-56">
                        <img src="${imageUrl}" alt="${spot.name}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 flex flex-wrap gap-2 justify-end max-w-[70%]">
                            ${categoryBadgesHTML}
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-dark-blue mb-3 line-clamp-2">${spot.name}</h3>
                        
                        <div class="mb-6">
                            <p class="text-dark-blue/70 text-sm leading-relaxed overview-text ${needsShowMore ? 'collapsed' : ''}">
                                ${overview}
                            </p>
                            ${needsShowMore ? `
                                <button class="show-more-btn" onclick="toggleOverview(this)">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                    <span>Show More</span>
                                </button>
                            ` : ''}
                        </div>
                        
                        <div class="flex gap-3">
                            <button onclick="viewOnMap(this)" class="flex-1 btn-primary text-sm py-3 px-4 inline-flex items-center justify-center gap-2">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>View on Map</span>
                            </button>
                            <button onclick="removeBookmark(${spot.id}, this)" class="btn-danger py-3 px-4 inline-flex items-center justify-center">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            return div;
        }

        function viewOnMap(button) {
            const card = button.closest('[data-spot]');
            const spotData = JSON.parse(card.getAttribute('data-spot'));
            
            sessionStorage.setItem('spotToCenter', JSON.stringify(spotData));
            sessionStorage.setItem('fromDestinationClick', 'true');
            sessionStorage.setItem('skipInitialSpotlight', 'true');
            sessionStorage.setItem('dashboardSpotId', spotData.id.toString());
            
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Opening...</span>';
            button.disabled = true;
            
            setTimeout(() => {
                window.location.href = 'map.php';
            }, 500);
        }

        function removeBookmark(spotId, button) {
            if (confirm('Are you sure you want to remove this bookmark?')) {
                const originalContent = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                button.disabled = true;
                
                fetch('remove_bookmark.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `spot_id=${spotId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const card = button.closest('[data-spot]').parentElement;
                        card.style.transform = 'scale(0.8)';
                        card.style.opacity = '0';
                        
                        setTimeout(() => {
                            card.remove();
                            
                            const bookmarkCount = document.getElementById('bookmark-count');
                            const currentCount = parseInt(bookmarkCount.textContent);
                            bookmarkCount.textContent = Math.max(0, currentCount - 1);
                            
                            if (document.getElementById('bookmarks-container').children.length === 0) {
                                document.getElementById('bookmarks-container').innerHTML = `
                                    <div class="col-span-full">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <i class="fas fa-bookmark text-turquoise text-5xl"></i>
                                            </div>
                                            <h3 class="text-3xl font-bold text-dark-blue mb-4">No Bookmarks Yet</h3>
                                            <p class="text-dark-blue/70 text-lg mb-8 max-w-lg mx-auto">
                                                Start exploring and bookmark your favorite destinations to build your dream travel collection!
                                            </p>
                                            <a href="map.php" class="btn-primary inline-flex items-center gap-3">
                                                <i class="fas fa-map-marked-alt text-xl"></i>
                                                <span>Discover Destinations</span>
                                            </a>
                                        </div>
                                    </div>
                                `;
                            }
                        }, 300);
                        
                        // Show success notification
                        showNotification('Bookmark removed successfully!', 'success');
                    } else {
                        alert('Error removing bookmark: ' + data.message);
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing bookmark. Please try again.');
                    button.innerHTML = originalContent;
                    button.disabled = false;
                });
            }
        }
        
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                fetch('logout.php')
                    .then(response => response.text())
                    .then(message => {
                        showNotification('Logged out successfully!', 'success');
                        setTimeout(() => {
                            window.location.href = 'map.php';
                        }, 1000);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function toggleOverview(button) {
            const overviewContainer = button.parentElement;
            const overviewText = overviewContainer.querySelector('.overview-text');
            const icon = button.querySelector('i');
            const textSpan = button.querySelector('span');
            
            if (overviewText.classList.contains('collapsed')) {
                overviewText.classList.remove('collapsed');
                icon.className = 'fas fa-chevron-up text-xs';
                textSpan.textContent = 'Show Less';
            } else {
                overviewText.classList.add('collapsed');
                icon.className = 'fas fa-chevron-down text-xs';
                textSpan.textContent = 'Show More';
            }
        }

        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'linear-gradient(135deg, #10b981, #059669)' : 'linear-gradient(135deg, #ef4444, #dc2626)';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            notification.style.cssText = `
                position: fixed;
                top: 100px;
                right: 20px;
                background: ${bgColor};
                color: white;
                padding: 16px 24px;
                border-radius: 16px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                font-weight: 600;
                display: flex;
                align-items: center;
                gap: 12px;
                animation: slideIn 0.3s ease-out;
            `;
            
            notification.innerHTML = `
                <i class="fas ${icon} text-xl"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
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
            
            await translateSpotOverviews(lang);
        }

        async function translateSpotOverviews(lang) {
            const overviewElements = document.querySelectorAll('.overview-text');
            for (const element of overviewElements) {
                const originalText = element.textContent.trim();
                if (originalText && originalText !== 'No description available.') {
                    element.textContent = await translateText(originalText, lang);
                }
            }
        }

        document.getElementById('language-select').addEventListener('change', async (e) => {
            const lang = e.target.value;
            localStorage.setItem('preferredLanguage', lang);
            await translatePage(lang);
        });

        // Add CSS for notification animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>