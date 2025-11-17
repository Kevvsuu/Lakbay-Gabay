<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations - Lakbay Gabay</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
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
                        'ocean-blue': '#0077be',
                        'ocean-cyan': '#00a8cc', 
                        'turquoise': '#40e0d0',
                        'azure': '#f0f8ff',
                        'slate-blue': '#2c3e50',
                        'gold': '#ffd700',
                        'ocean-dark': '#005a94',
                        'ocean-light': '#e6f7ff',
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
        }

        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 119, 190, 0.25);
        }

        .glass-morphism {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .text-gradient {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo a:hover {
            color: #40e0d0;
            text-decoration: none;
            transform: scale(1.05);
            text-shadow: 0 0 20px rgba(64, 224, 208, 0.5);
        }

/* Account Dropdown Styles */
.account-dropdown {
    position: relative;
    z-index: 50;
}

/* Dropdown menu - centered below account link */
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
    transition: all 0.3s ease;
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

.dropdown-item:focus {
    outline: 2px solid #40e0d0;
    outline-offset: -2px;
}

.dropdown-item i {
    margin-right: 8px;
    width: 16px;
    text-align: center;
    color: #40e0d0;
}

/* Dropdown arrow - works with Tailwind classes */
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

/* Optional: Change account link color when dropdown is open */
.account-link.active {
    color: #40e0d0 !important;
}

/* Mobile menu account section */
#mobile-menu .border-t {
    border-color: rgba(255, 255, 255, 0.2) !important;
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

/* X animation when active */
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


        body.mobile-menu-open {
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #0077be, #00a8cc);
            color: white;
            transform: scale(1.05);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            overflow-y: auto;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            position: relative;
            background: white;
            margin: 2rem;
            padding: 0;
            border-radius: 24px;
            max-width: 1000px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(50px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-gallery {
            display: flex;
            gap: 1rem;
            overflow-x: auto;
            padding: 1rem 0;
        }

        .image-gallery::-webkit-scrollbar {
            height: 8px;
        }

        .image-gallery::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .image-gallery::-webkit-scrollbar-thumb {
            background: #0077be;
            border-radius: 10px;
        }

        .image-gallery img {
            min-width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .image-gallery img:hover {
            transform: scale(1.05);
        }

        .category-badge {
            display: inline-block;
            padding: 0.375rem 0.75rem;
            background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
            color: #0077be;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0.25rem;
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Named Links List Styles */
        .named-links-list {
            list-style-type: none;
            padding-left: 0;
            margin: 15px 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .named-link-item {
            padding: 16px 18px;
            background: linear-gradient(135deg, rgba(0, 119, 190, 0.04), rgba(64, 224, 208, 0.04));
            border-radius: 10px;
            border-left: 4px solid #40e0d0;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .named-link-item:hover {
            background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 119, 190, 0.15);
            border-left-color: #0077be;
        }

        .link-name {
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.05em;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .link-url {
            color: #0077be;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.92em;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
            background: rgba(0, 119, 190, 0.08);
            width: fit-content;
            max-width: 100%;
            word-break: break-all;
        }

        .link-url:hover {
            color: #ffffff;
            background: linear-gradient(135deg, #0077be, #40e0d0);
            transform: translateY(-2px);
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 119, 190, 0.3);
        }

        .link-url::after {
            content: '\f35d';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.85em;
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .link-url:hover::after {
            opacity: 1;
            transform: translateX(3px);
        }

        /* Official Links List */
        .official-links-list {
            list-style-type: none;
            padding-left: 0;
            margin: 15px 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .official-link-item {
            padding: 14px 16px;
            background: linear-gradient(135deg, rgba(0, 119, 190, 0.04), rgba(64, 224, 208, 0.04));
            border-radius: 10px;
            border-left: 4px solid #0077be;
            transition: all 0.3s ease;
        }

        .official-link-item:hover {
            background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(0, 119, 190, 0.15);
            border-left-color: #40e0d0;
        }

        .official-link-item .link-url {
            font-weight: 600;
            font-size: 0.95em;
        }

        .no-info {
            color: #7f8c8d;
            font-style: italic;
            padding: 12px;
            background: rgba(127, 140, 141, 0.05);
            border-radius: 6px;
            text-align: center;
        }

        .safety-indicator {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            margin: 8px 0;
        }

        .visitors-indicator {
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            margin: 8px 0;
        }

        #carousel-thumbnails {
            scrollbar-width: thin;
            scrollbar-color: rgba(64, 224, 208, 0.5) rgba(255, 255, 255, 0.1);
        }

        #carousel-thumbnails::-webkit-scrollbar {
            height: 6px;
        }

        #carousel-thumbnails::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        #carousel-thumbnails::-webkit-scrollbar-thumb {
            background: rgba(64, 224, 208, 0.5);
            border-radius: 3px;
        }

        #carousel-thumbnails::-webkit-scrollbar-thumb:hover {
            background: rgba(64, 224, 208, 0.8);
        }

        #carousel-modal.flex {
            animation: fadeIn 0.3s ease;
        }

        #carousel-image {
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
/* Local Language Styles - Updated */
.language-box {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
    border-left: 4px solid #0077be;
    border-radius: 12px;
    margin: 8px 0;
    gap: 16px;
    transition: all 0.3s ease;
}

.language-box:hover {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
    box-shadow: 0 4px 12px rgba(0, 119, 190, 0.15);
    transform: translateX(5px);
}

.language-icon {
    font-size: 28px;
    color: #0077be;
    min-width: 40px;
    text-align: center;
    margin-top: 4px;
}

.language-content {
    flex: 1;
}

.language-label {
    font-size: 0.75rem;
    color: #0077be;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 8px;
    display: block;
}

.language-text {
    font-size: 1.1rem;
    color: #2c3e50;
    font-weight: 500;
    line-height: 1.4;
}

/* Multi-language grid for multiple languages */
.multi-language-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 10px;
    margin-top: 0;
}

.language-item {
    padding: 14px 16px;
    background: white;
    border: 2px solid rgba(0, 119, 190, 0.15);
    border-radius: 10px;
    transition: all 0.3s ease;
    text-align: center;
}

.language-item:hover {
    border-color: #0077be;
    background: rgba(0, 119, 190, 0.05);
    box-shadow: 0 3px 10px rgba(0, 119, 190, 0.15);
    transform: translateY(-2px);
}

.language-item-title {
    font-weight: 600;
    color: #0077be;
    font-size: 1rem;
    margin: 0;
}

.language-item-text {
    color: #2c3e50;
    font-size: 0.95rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .multi-language-grid {
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 8px;
    }
    
    .language-item {
        padding: 12px;
    }
    
    .language-item-title {
        font-size: 0.9rem;
    }
}
    </style>
</head>
<body class="bg-azure text-slate-blue font-inter">

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

                    <!-- Account dropdown -->
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
                <button id="hamburger-btn" class="hamburger-btn md:hidden">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden mt-4 pb-4 border-t border-white/20 hidden" id="mobile-menu">
            <nav class="flex flex-col gap-3 mt-4">
                <a href="index.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">Home</a>
                <a href="map.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">Destination</a>
                <a href="griddestination.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">All Destination</a>
                <a href="contact.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">Contact</a>
                <a href="about_us.php" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2">About</a>

                <!-- ONLY ONE ACCOUNT SECTION -->
                <div class="border-t border-white/20 pt-3 mt-2">
                    <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                    <div id="mobile-account-content" class="px-2 py-1 text-white/80 text-sm mb-2">
                        Loading...
                    </div>
                </div>
            </nav>
        </div>	
    </div>

    <!-- Hero Section -->
    <section class="pt-32 pb-16 bg-gradient-to-br from-ocean-blue via-ocean-cyan to-turquoise text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-7xl font-bold font-playfair mb-6">
                Explore <span class="text-gold">All Destinations</span>
            </h1>
            <p class="text-xl md:text-2xl text-azure max-w-3xl mx-auto">
                Discover the beauty of the Philippines from stunning beaches to majestic mountains
            </p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-3 bg-white shadow-lg sticky top-[88px] md:top-[65px] z-40">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Search Bar -->
            <div class="mb-3">
                <div class="relative max-w-2xl mx-auto">
                    <input 
                        type="text" 
                        id="search-input" 
                        placeholder="Search destinations by name, location, or description..." 
                        class="w-full px-4 py-3 pl-12 pr-12 rounded-lg bg-ocean-light/50 border-2 border-ocean-blue/20 focus:outline-none focus:ring-2 focus:ring-ocean-blue focus:border-ocean-blue text-slate-blue placeholder-slate-blue/50 text-sm transition-all"
                    />
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-ocean-blue/60"></i>
                    <button 
                        id="clear-search" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-ocean-blue/60 hover:text-ocean-blue transition-colors hidden"
                        onclick="clearSearch()"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Dropdown Filter -->
            <div class="block md:hidden">
                <select id="mobile-region-filter" class="w-full px-3 py-2.5 rounded-lg bg-ocean-light text-ocean-blue font-semibold border-2 border-ocean-blue/20 focus:outline-none focus:ring-2 focus:ring-ocean-blue text-sm appearance-none bg-no-repeat bg-right pr-8" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27%230077be%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-position: right 0.5rem center; background-size: 1.25rem;">
                    <option value="all">All Regions</option>
                    <option value="NCR">NCR</option>
                    <option value="CAR">CAR</option>
                    <option value="BARMM">BARMM</option>
                    <option value="NIR">NIR</option>
                    <option value="Region-1">Region 1</option>
                    <option value="Region-2">Region 2</option>
                    <option value="Region-3">Region 3</option>
                    <option value="Region-4A">Region 4A</option>
                    <option value="Region-4B">Region 4B</option>
                    <option value="Region-5">Region 5</option>
                    <option value="Region-6">Region 6</option>
                    <option value="Region-7">Region 7</option>
                    <option value="Region-8">Region 8</option>
                    <option value="Region-9">Region 9</option>
                    <option value="Region-10">Region 10</option>
                    <option value="Region-11">Region 11</option>
                    <option value="Region-12">Region 12</option>
                    <option value="Region-13">Region 13</option>
                </select>
            </div>
            
            <!-- Desktop Button Filters -->
            <div class="hidden md:flex flex-wrap gap-2 justify-center items-center">
                <button class="filter-btn active px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="all">All Regions</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="NCR">NCR</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="CAR">CAR</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="BARMM">BARMM</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="NIR">NIR</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-1">Region 1</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-2">Region 2</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-3">Region 3</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-4A">Region 4A</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-4B">Region 4B</option>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-5">Region 5</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-6">Region 6</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-7">Region 7</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-8">Region 8</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-9">Region 9</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-10">Region 10</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-11">Region 11</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-12">Region 12</button>
                <button class="filter-btn px-5 py-2 rounded-full bg-ocean-light text-ocean-blue font-semibold hover:bg-ocean-blue hover:text-white transition-all text-sm" data-region="Region-13">Region 13</button>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-br from-azure via-white to-ocean-light">
        <div class="max-w-7xl mx-auto px-4">
            <div id="destinations-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Loading skeletons -->
                <div class="skeleton rounded-3xl h-96"></div>
                <div class="skeleton rounded-3xl h-96"></div>
                <div class="skeleton rounded-3xl h-96"></div>
            </div>
            
            <!-- No results message -->
            <div id="no-results" class="hidden text-center py-16">
                <i class="fas fa-search text-6xl text-ocean-blue/30 mb-4"></i>
                <h3 class="text-2xl font-bold text-slate-blue mb-2">No destinations found</h3>
                <p class="text-slate-blue/70">Try selecting a different region</p>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="destination-modal" class="modal">
        <div class="modal-content">
            <!-- Modal content will be dynamically inserted here -->
        </div>
    </div>

    <!-- Image Carousel Modal -->
    <div id="carousel-modal" class="fixed inset-0 bg-black/95 z-[2000] hidden items-center justify-center">
        <button onclick="closeCarousel()" class="absolute top-4 right-4 z-50 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <!-- Photo Credits at Top -->
        <div class="absolute top-4 left-1/2 -translate-x-1/2 z-50">
            <p id="carousel-credits" class="text-white/90 text-sm flex items-center justify-center gap-2 bg-black/50 px-6 py-3 rounded-full backdrop-blur-md border border-white/10">
                <i class="fas fa-camera text-turquoise"></i>
                <span id="carousel-credits-text">Photo credit loading...</span>
            </p>
        </div>
        
        <!-- Previous Button -->
        <button onclick="changeCarouselImage(-1)" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all z-50">
            <i class="fas fa-chevron-left text-xl"></i>
        </button>
        
        <!-- Next Button -->
        <button onclick="changeCarouselImage(1)" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all z-50">
            <i class="fas fa-chevron-right text-xl"></i>
        </button>
        
        <!-- Main Image -->
        <div class="max-w-6xl mx-4 flex flex-col items-center">
            <img id="carousel-image" src="" alt="Gallery Image" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
            <div class="text-center mt-4">
                <p class="text-white text-sm">
                    <span id="carousel-counter">1</span> / <span id="carousel-total">1</span>
                </p>
            </div>
        </div>
        
        <!-- Thumbnail Navigation -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 max-w-4xl overflow-x-auto">
            <div id="carousel-thumbnails" class="flex gap-2 p-2"></div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-slate-blue via-ocean-dark to-slate-blue text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern-dots bg-pattern opacity-10"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <h3 class="text-3xl font-bold font-playfair mb-6 text-turquoise">Lakbay Gabay</h3>
                    <p class="text-azure leading-relaxed mb-8 max-w-md">
                        Your trusted companion for discovering the most beautiful destinations across the Philippine archipelago. 
                        Creating unforgettable memories, one island at a time.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-xl font-semibold mb-6 relative text-turquoise">
                        <span>Quick Links</span>
                        <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-ocean-cyan"></span>
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="about_us.php" class="text-azure hover:text-turquoise transition-colors duration-300">About Us</a></li>
                        <li><a href="contact.php" class="text-azure hover:text-turquoise transition-colors duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h4 class="text-xl font-semibold mb-6 relative text-turquoise">
                        <span>Support</span>
                        <span class="absolute bottom-0 left-0 w-8 h-0.5 bg-ocean-cyan"></span>
                    </h4>
                    <ul class="space-y-3">
                        <li><a href="faq.php" class="text-azure hover:text-turquoise transition-colors duration-300">FAQs</a></li>
                        <li><a href="privacypolicy.php" class="text-azure hover:text-turquoise transition-colors duration-300">Privacy Policy</a></li>
                        <li><a href="termservice.php" class="text-azure hover:text-turquoise transition-colors duration-300">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="fixed bottom-6 right-6 w-14 h-14 bg-ocean-cyan hover:bg-turquoise text-white rounded-full flex items-center justify-center cursor-pointer shadow-xl hover:shadow-2xl transition-all duration-300 opacity-0 invisible hover:scale-110 z-50" id="back-to-top">
        <i class="fas fa-chevron-up text-lg"></i>
    </button>




    <script>
        // Store all spots data
        let allSpots = [];
        let currentRegion = 'all';
        let currentSearchQuery = '';
        let carouselImages = [];
        let carouselImageOwners = [];
        let currentCarouselIndex = 0;

        let accountDropdown = {
            isOpen: false,
            element: null,
            link: null,
            container: null
        };

        // Category colors
        const categoryColors = {
            'Beaches & Islands': '#40E0D0',
            'Nature & Wildlife': '#228B22',
            'Urban & Nightlife': '#A020F0',
            'Adventure & Extreme Sports': '#FFA500',
            'Arts & Culture': '#EA2432',
            'Festivals & Events': '#FFFF00',
            'UNESCO Sites': '#A52A2A',
            'Spiritual & Pilgrimage': '#57B9FF',
            'Hidden Wonders': '#272757',
            'Wellness, Retreats, and Leisure': '#FF8DA1'
        };

        // Category icons mapping
        const categoryIcons = {
            'Beaches & Islands': [
                { icon: 'fas fa-water', text: 'Crystal Waters' },
                { icon: 'fas fa-umbrella-beach', text: 'White Sand' },
                { icon: 'fas fa-fish', text: 'Marine Life' },
                { icon: 'fas fa-sun', text: 'Sunny Weather' }
            ],
            'Nature & Wildlife': [
                { icon: 'fas fa-tree', text: 'Lush Forests' },
                { icon: 'fas fa-mountain', text: 'Scenic Views' },
                { icon: 'fas fa-leaf', text: 'Eco-Tourism' },
                { icon: 'fas fa-binoculars', text: 'Wildlife' }
            ],
            'Urban & Nightlife': [
                { icon: 'fas fa-city', text: 'City Life' },
                { icon: 'fas fa-cocktail', text: 'Nightlife' },
                { icon: 'fas fa-shopping-bag', text: 'Shopping' },
                { icon: 'fas fa-utensils', text: 'Dining' }
            ],
            'Adventure & Extreme Sports': [
                { icon: 'fas fa-hiking', text: 'Hiking' },
                { icon: 'fas fa-water', text: 'Water Sports' },
                { icon: 'fas fa-running', text: 'Adventure' },
                { icon: 'fas fa-medal', text: 'Extreme' }
            ],
            'Arts & Culture': [
                { icon: 'fas fa-paint-brush', text: 'Art' },
                { icon: 'fas fa-landmark', text: 'Culture' },
                { icon: 'fas fa-history', text: 'History' },
                { icon: 'fas fa-theater-masks', text: 'Performances' }
            ],
            'Festivals & Events': [
                { icon: 'fas fa-music', text: 'Festivals' },
                { icon: 'fas fa-calendar-alt', text: 'Events' },
                { icon: 'fas fa-users', text: 'Celebrations' },
                { icon: 'fas fa-camera', text: 'Photo Ops' }
            ],
            'UNESCO Sites': [
                { icon: 'fas fa-monument', text: 'Heritage' },
                { icon: 'fas fa-globe-asia', text: 'UNESCO' },
                { icon: 'fas fa-history', text: 'History' },
                { icon: 'fas fa-camera', text: 'Landmarks' }
            ],
            'Spiritual & Pilgrimage': [
                { icon: 'fas fa-place-of-worship', text: 'Spiritual' },
                { icon: 'fas fa-pray', text: 'Pilgrimage' },
                { icon: 'fas fa-peace', text: 'Peaceful' },
                { icon: 'fas fa-history', text: 'Historical' }
            ],
            'Wellness, Retreats, and Leisure': [
                { icon: 'fas fa-spa', text: 'Wellness' },
                { icon: 'fas fa-hotel', text: 'Retreats' },
                { icon: 'fas fa-bed', text: 'Relaxation' },
                { icon: 'fas fa-heart', text: 'Health' }
            ],
            'Hidden Wonders': [
                { icon: 'fas fa-gem', text: 'Hidden Gems' },
                { icon: 'fas fa-map-marked-alt', text: 'Less Crowded' },
                { icon: 'fas fa-exclamation-circle', text: 'Unique' },
                { icon: 'fas fa-camera', text: 'Photography' }
            ]
        };

        // Content formatting functions
// Content formatting functions


        // Fetch spots data on page load
document.addEventListener('DOMContentLoaded', function() {
    fetchSpots();
    initializeHeader();
    initializeBackToTop();
    initializeFilters();
    initializeSearch();
    initializeAccountDropdown();
    checkLoginStatus();
    initializeLanguageSelector();
    
    // Restore saved language preference
    const savedLang = localStorage.getItem('preferredLanguage');
    const languageSelect = document.getElementById('language-select');
    if (savedLang && languageSelect) {
        languageSelect.value = savedLang;
        console.log('Restored language preference:', savedLang);
    }
});


        async function fetchSpots() {
            try {
                const response = await fetch('fetch_spot_data.php');
                const data = await response.json();
                allSpots = data;
                displaySpots(allSpots);
            } catch (error) {
                console.error('Error fetching spots:', error);
                document.getElementById('destinations-container').innerHTML = `
                    <div class="col-span-3 text-center py-16">
                        <i class="fas fa-exclamation-triangle text-6xl text-red-500/30 mb-4"></i>
                        <h3 class="text-2xl font-bold text-slate-blue mb-2">Error loading destinations</h3>
                        <p class="text-slate-blue/70">Please try again later</p>
                    </div>
                `;
            }
        }

        // Display spots in grid
 function displaySpots(spots) {
    const container = document.getElementById('destinations-container');
    const noResults = document.getElementById('no-results');
    
    if (spots.length === 0) {
        container.innerHTML = '';
        noResults.classList.remove('hidden');
        return;
    }
    
    noResults.classList.add('hidden');
    
    container.innerHTML = spots.map(spot => {
        const mainImage = spot.images && spot.images.length > 0 ? spot.images[0] : 'images/placeholder.jpg';
        const categories = spot.categories || [];
        const primaryCategory = categories[0];
        const categoryColor = getCategoryColor(primaryCategory);
        
        return `
            <div class="glass-morphism rounded-3xl overflow-hidden shadow-xl card-hover cursor-pointer" onclick="openModal(${spot.id})">
                <div class="relative h-64 overflow-hidden">
                    <img src="${mainImage}" alt="${spot.name}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    ${primaryCategory ? `
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-white text-xs font-bold shadow-lg" style="background-color: ${categoryColor};">
                                ${primaryCategory}
                            </span>
                        </div>
                    ` : ''}
                    <div class="absolute bottom-4 left-4 right-4">
                        <h3 class="text-2xl font-bold text-white mb-1">${spot.name}</h3>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 bg-ocean-blue/10 text-ocean-blue rounded-full text-sm font-semibold">
                            ${spot.region}
                        </span>
                        <span class="px-3 py-1 bg-turquoise/10 text-turquoise rounded-full text-sm font-semibold">
                            ${spot.province}
                        </span>
                    </div>
                    <p class="text-slate-blue/80 line-clamp-3 mb-4">
                        ${spot.overview || 'Discover the beauty of this amazing destination...'}
                    </p>
                    ${categories.length > 0 ? `
                        <div class="flex flex-wrap gap-2">
                            ${categories.slice(0, 2).map(cat => `
                                <span class="px-3 py-1 rounded-full text-white text-xs font-semibold" style="background-color: ${getCategoryColor(cat)};">
                                    ${cat}
                                </span>
                            `).join('')}
                            ${categories.length > 2 ? `<span class="px-3 py-1 bg-slate-blue/10 text-slate-blue rounded-full text-xs font-semibold">+${categories.length - 2} more</span>` : ''}
                        </div>
                    ` : ''}
                    ${getCategoryIconsHTML(categories)}
                </div>
            </div>
        `;
    }).join('');
}

const formatContent = {
    namedLinks(content, defaultText = 'No information available') {
        if (!content) return `<p class="no-info">${defaultText}</p>`;
        
        const items = content.split('\n').filter(item => item.trim() !== '');
        if (items.length === 0) return `<p class="no-info">${defaultText}</p>`;
        
        return `<ul class="named-links-list">${
            items.map(item => {
                const trimmedItem = item.trim();
                const colonIndex = trimmedItem.indexOf(':');
                
                if (colonIndex === -1) {
                    const fullUrl = trimmedItem.startsWith('http://') || trimmedItem.startsWith('https://') 
                        ? trimmedItem 
                        : `https://${trimmedItem}`;
                    
                    let displayText = trimmedItem;
                    try {
                        const url = new URL(fullUrl);
                        displayText = url.hostname.replace('www.', '');
                    } catch(e) {}
                    
                    return `<li class="named-link-item">
                        <a href="${fullUrl}" target="_blank" rel="noopener" class="link-url">${displayText}</a>
                    </li>`;
                }
                
                const name = trimmedItem.substring(0, colonIndex).trim();
                const urlPart = trimmedItem.substring(colonIndex + 1).trim();
                
                const fullUrl = urlPart.startsWith('http://') || urlPart.startsWith('https://') 
                    ? urlPart 
                    : `https://${urlPart}`;
                
                let displayUrl = urlPart;
                try {
                    const url = new URL(fullUrl);
                    displayUrl = url.hostname.replace('www.', '');
                } catch(e) {}
                
                return `<li class="named-link-item">
                    <div class="link-name">${name}</div>
                    <a href="${fullUrl}" target="_blank" rel="noopener" class="link-url">${displayUrl}</a>
                </li>`;
            }).join('')
        }</ul>`;
    },

// Updated localLanguage function in formatContent object
localLanguage(languages) {
    if (!languages) return `<p class="no-info">No language information available</p>`;

    const langList = languages.split(',').map(lang => lang.trim()).filter(lang => lang !== '');

    if (langList.length === 0) return `<p class="no-info">No language information available</p>`;

    if (langList.length === 1) {
        return `
            <div class="language-box">
                <div class="language-content">
                    <div class="language-text">${langList[0]}</div>
                </div>
            </div>
        `;
    }

    return `
        <div class="language-box">
            <div class="language-content">
                <div class="multi-language-grid">
                    ${langList.map((lang) => `
                        <div class="language-item">
                            <div class="language-item-title">${lang}</div>
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>
    `;
},

    links(links) {
        if (!links) return `<p class="no-info">No official links available</p>`;
        
        const items = links.split('\n').filter(item => item.trim() !== '');
        return items.length > 0
            ? `<ul class="official-links-list">${
                items.map(link => {
                    const processedLink = link.trim();
                    const fullUrl = processedLink.startsWith('http://') || processedLink.startsWith('https://') 
                        ? processedLink 
                        : `https://${processedLink}`;
                    
                    let displayText = processedLink;
                    try {
                        const url = new URL(fullUrl);
                        displayText = url.hostname.replace('www.', '');
                    } catch(e) {}
                    
                    return `<li class="official-link-item">
                        <a href="${fullUrl}" target="_blank" rel="noopener" class="link-url">${displayText}</a>
                    </li>`;
                }).join('')
            }</ul>`
            : `<p class="no-info">No official links available</p>`;
    },
    
    safetyLevel(level) {
        if (!level) return '';
        
        const levels = {
            'safe': { text: 'Safe to Visit', color: '#4CAF50', icon: 'fa-check-circle' },
            'caution': { text: 'Visit with Caution', color: '#FFC107', icon: 'fa-exclamation-triangle' },
            'dangerous': { text: 'Dangerous', color: '#F44336', icon: 'fa-exclamation-circle' }
        };
        
        const safety = levels[level.toLowerCase()] || levels['safe'];
        
        return `
            <div class="safety-indicator" style="background-color: ${safety.color}20; border-left: 4px solid ${safety.color};">
                <i class="fas ${safety.icon}" style="color: ${safety.color}; margin-right: 8px;"></i>
                <span style="color: ${safety.color}; font-weight: 600;">${safety.text}</span>
            </div>
        `;
    },
    
    annualVisitors(count) {
        if (!count || count === 0) return '';
        
        const formattedCount = count.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        return `
            <div class="visitors-indicator" style="background-color: #e8f5e8; border-left: 4px solid #4CAF50;">
                <i class="fas fa-users" style="color: #4CAF50; margin-right: 8px;"></i>
                <span style="color: #2E7D32; font-weight: 600;">${formattedCount} visitors annually</span>
            </div>
        `;
    }
};
// Open modal with spot details - FINAL CORRECTED ORDER
async function openModal(spotId) {
    const modal = document.getElementById('destination-modal');
    const modalContent = modal.querySelector('.modal-content');
    
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    
    // Show loading state
    modalContent.innerHTML = `
        <div class="p-8 text-center">
            <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-ocean-blue mx-auto mb-4"></div>
            <p class="text-slate-blue">Loading destination details...</p>
        </div>
    `;
    
    try {
        const response = await fetch(`get_spot.php?id=${spotId}`);
        
        if (!response.ok) {
            throw new Error(`Server returned ${response.status}: ${response.statusText}`);
        }
        
        const contentType = response.headers.get("content-type");
        if (!contentType || !contentType.includes("application/json")) {
            const text = await response.text();
            console.error('Non-JSON response received:', text.substring(0, 500));
            throw new Error('Server did not return JSON data. Check console for details.');
        }
        
        const spot = await response.json();
        
        if (spot.error) {
            throw new Error(spot.error);
        }
        
        const images = spot.images || [];
        const categories = spot.categories || [];
        const imageOwners = spot.image_owners || [];
        const primaryCategory = categories[0];
        const categoryColor = getCategoryColor(primaryCategory);
        
        // Store images and owners globally for carousel access
        window.currentSpotImages = images;
        window.currentSpotImageOwners = imageOwners;
        
        modalContent.innerHTML = `
            <button onclick="closeModal()" class="absolute top-4 right-4 z-50 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-slate-blue hover:bg-ocean-light transition-all">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <div class="relative h-96 overflow-hidden rounded-t-3xl cursor-pointer group" onclick="openCarouselFromMain()">
                <img src="${images[0] || 'images/placeholder.jpg'}" alt="${spot.name}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center">
                    <i class="fas fa-search-plus text-white text-4xl opacity-0 group-hover:opacity-100 transition-all"></i>
                </div>
                ${primaryCategory ? `
                    <div class="absolute top-8 left-8">
                        <span class="px-4 py-2 rounded-full text-white text-sm font-bold shadow-lg" style="background-color: ${categoryColor};">
                            ${primaryCategory}
                        </span>
                    </div>
                ` : ''}
                <div class="absolute bottom-8 left-8 right-8">
                    <h2 class="text-4xl md:text-5xl font-bold font-playfair text-white mb-2">${spot.name}</h2>
                </div>
            </div>
            
            <div class="p-8">
                <!-- Region and Province -->
                <div class="flex flex-wrap gap-3 mb-6">
                    <span class="px-4 py-2 bg-ocean-blue text-white rounded-full font-semibold">
                        ${spot.region}
                    </span>
                    <span class="px-4 py-2 bg-turquoise text-white rounded-full font-semibold">
                        ${spot.province}
                    </span>
                </div>
                
                <!-- Categories -->
                ${categories.length > 0 ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-tags text-ocean-cyan"></i>
                            Categories
                        </h3>
                        <div class="flex flex-wrap gap-2 mb-4">
                            ${categories.map(cat => `
                                <span class="px-4 py-2 rounded-full text-white font-semibold" style="background-color: ${getCategoryColor(cat)};">
                                    ${cat}
                                </span>
                            `).join('')}
                        </div>
                        
                        <!-- Category Icons Grid -->
                        ${primaryCategory && categoryIcons[primaryCategory] ? `
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-ocean-light/30 rounded-xl">
                                ${categoryIcons[primaryCategory].map(item => `
                                    <div class="flex flex-col items-center text-center gap-2 p-3 bg-white rounded-lg shadow-sm">
                                        <i class="${item.icon} text-2xl" style="color: ${categoryColor};"></i>
                                        <span class="text-sm font-medium text-slate-blue">${item.text}</span>
                                    </div>
                                `).join('')}
                            </div>
                        ` : ''}
                    </div>
                ` : ''}
                
                <!-- Image Gallery -->
                ${images.length > 1 ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-images text-ocean-cyan"></i>
                            Gallery (${images.length} photos)
                        </h3>
                        <div class="image-gallery">
                            ${images.map((img, idx) => `
                                <div class="relative group">
                                    <img src="${img}" 
                                         alt="${spot.name} - Image ${idx + 1}" 
                                         class="cursor-pointer hover:ring-4 hover:ring-ocean-cyan transition-all"
                                         onclick="openCarouselFromGallery(${idx})">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center">
                                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-all"></i>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                        ${spot.image_owners && spot.image_owners.length > 0 ? `
                            <p class="text-sm text-slate-blue/60 mt-2">
                                <i class="fas fa-camera text-ocean-cyan"></i>
                                Photo credits: ${spot.image_owners.join(', ')}
                            </p>
                        ` : ''}
                    </div>
                ` : ''}
                
                <!-- Safety Level -->
                ${spot.safety_level ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-shield-alt text-ocean-cyan"></i>
                            Safety Level
                        </h3>
                        ${formatContent.safetyLevel(spot.safety_level)}
                    </div>
                ` : ''}
                
                <!-- Annual Visitors -->
                ${spot.annual_visitors ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-chart-line text-ocean-cyan"></i>
                            Visitor Statistics
                        </h3>
                        ${formatContent.annualVisitors(spot.annual_visitors)}
                    </div>
                ` : ''}
                
                <!-- Local Languages -->
                ${spot.local_languages ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-language text-ocean-cyan"></i>
                            Local Languages
                        </h3>
                        ${formatContent.localLanguage(spot.local_languages)}
                    </div>
                ` : ''}
                
                <!-- Overview -->
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                        <i class="fas fa-info-circle text-ocean-cyan"></i>
                        Overview
                    </h3>
                    <p class="text-slate-blue/80 leading-relaxed whitespace-pre-line">
                        ${spot.overview || 'No overview available.'}
                    </p>
                </div>
                
                <!-- Things to Do -->
                ${spot.things_to_do ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-hiking text-ocean-cyan"></i>
                            Things to Do
                        </h3>
                        <p class="text-slate-blue/80 leading-relaxed whitespace-pre-line">
                            ${spot.things_to_do}
                        </p>
                    </div>
                ` : ''}
                
                <!-- Operating Hours -->
                ${spot.operating_hours ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-clock text-ocean-cyan"></i>
                            Operating Hours
                        </h3>
                        <p class="text-slate-blue/80 leading-relaxed whitespace-pre-line">
                            ${spot.operating_hours}
                        </p>
                    </div>
                ` : ''}
                
                <!-- Nearby Accommodations -->
                ${spot.nearby_accommodations ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-hotel text-ocean-cyan"></i>
                            Nearby Accommodations
                        </h3>
                        ${formatContent.namedLinks(spot.nearby_accommodations, 'No accommodations listed')}
                    </div>
                ` : ''}
                
                <!-- Nearby Restaurants -->
                ${spot.nearby_restaurants ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-utensils text-ocean-cyan"></i>
                            Nearby Restaurants
                        </h3>
                        ${formatContent.namedLinks(spot.nearby_restaurants, 'No restaurants listed')}
                    </div>
                ` : ''}
                
                <!-- Official Links (MOVED HERE - after restaurants) -->
                ${spot.official_links ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-link text-ocean-cyan"></i>
                            Official Links
                        </h3>
                        ${formatContent.links(spot.official_links)}
                    </div>
                ` : ''}
                
                <!-- Contact Information (MOVED HERE - after official links) -->
                ${spot.contact_information ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-phone text-ocean-cyan"></i>
                            Contact Information
                        </h3>
                        <p class="text-slate-blue/80 leading-relaxed whitespace-pre-line">
                            ${spot.contact_information}
                        </p>
                    </div>
                ` : ''}
                
                <!-- Transportation (MOVED HERE - last section before button) -->
                ${spot.transportation ? `
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-blue mb-3 flex items-center gap-2">
                            <i class="fas fa-bus text-ocean-cyan"></i>
                            How to Get There
                        </h3>
                        <p class="text-slate-blue/80 leading-relaxed whitespace-pre-line">
                            ${spot.transportation}
                        </p>
                    </div>
                ` : ''}
                
                <!-- View on Map Button -->
                <div class="mt-8 flex justify-center">
                    <a href="map.php?spot=${spot.id}" 
                       class="px-8 py-4 bg-gradient-to-r from-ocean-blue to-ocean-cyan text-white font-bold rounded-full hover:shadow-xl transition-all duration-300 flex items-center gap-3 hover:scale-105">
                        <i class="fas fa-map-marked-alt"></i>
                        View on Interactive Map
                    </a>
                </div>
            </div>
        `;        
    } catch (error) {
        console.error('Error loading spot details:', error);
        modalContent.innerHTML = `
            <div class="p-6 md:p-8 text-center min-h-screen md:min-h-0 flex flex-col items-center justify-center">
                <i class="fas fa-exclamation-triangle text-5xl md:text-6xl text-red-500/30 mb-4"></i>
                <h3 class="text-xl md:text-2xl font-bold text-slate-blue mb-2">Error loading destination</h3>
                <p class="text-sm md:text-base text-slate-blue/70 mb-4 px-4">${error.message}</p>
                <p class="text-xs md:text-sm text-slate-blue/50 mb-6">Please check your connection and try again</p>
                <button onclick="closeModal()" class="px-6 py-3 bg-ocean-blue text-white rounded-full hover:bg-ocean-dark transition-all">
                    Close
                </button>
            </div>
        `;
    }
}

        // Helper functions for carousel
        function openCarouselFromMain() {
            openCarousel(window.currentSpotImages, window.currentSpotImageOwners, 0);
        }

        function openCarouselFromGallery(index) {
            openCarousel(window.currentSpotImages, window.currentSpotImageOwners, index);
        }

        // Close modal
        function closeModal() {
            const modal = document.getElementById('destination-modal');
            modal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('destination-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize filters
        function initializeFilters() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const mobileFilter = document.getElementById('mobile-region-filter');
            
            // Desktop filter buttons
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(b => b.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Get region
                    currentRegion = this.getAttribute('data-region');
                    
                    // Apply filters
                    applyFilters();
                    
                    // Scroll to destinations
                    window.scrollTo({
                        top: document.getElementById('destinations-container').offsetTop - 200,
                        behavior: 'smooth'
                    });
                });
            });
            
            // Mobile filter dropdown
            if (mobileFilter) {
                mobileFilter.addEventListener('change', function() {
                    currentRegion = this.value;
                    
                    // Apply filters
                    applyFilters();
                    
                    // Scroll to destinations
                    window.scrollTo({
                        top: document.getElementById('destinations-container').offsetTop - 200,
                        behavior: 'smooth'
                    });
                });
            }
        }

        // Initialize header
        function initializeHeader() {
            // Hamburger menu
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            hamburgerBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                document.body.classList.toggle('mobile-menu-open');

                // 🔥 Toggle the 'active' class to trigger the X animation
                hamburgerBtn.classList.toggle('active');
            });

            // Account dropdown
            const accountLink = document.querySelector('.account-link');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            if (accountLink && dropdownMenu) {
                accountLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdownMenu.classList.toggle('show');
                    accountLink.classList.toggle('active');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!accountLink.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                        accountLink.classList.remove('active');
                    }
                });
            }

            // Check login status
            checkLoginStatus();
        }


        // Check login status

        // Initialize back to top button
        function initializeBackToTop() {
            const backToTop = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    backToTop.style.opacity = '1';
                    backToTop.style.visibility = 'visible';
                } else {
                    backToTop.style.opacity = '0';
                    backToTop.style.visibility = 'hidden';
                }
            });
            
            backToTop.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Initialize search
        function initializeSearch() {
            const searchInput = document.getElementById('search-input');
            const clearButton = document.getElementById('clear-search');
            
            // Real-time search as user types
            searchInput.addEventListener('input', function(e) {
                currentSearchQuery = e.target.value.toLowerCase().trim();
                
                // Show/hide clear button
                if (currentSearchQuery) {
                    clearButton.classList.remove('hidden');
                } else {
                    clearButton.classList.add('hidden');
                }
                
                // Apply filters
                applyFilters();
            });
            
            // Search on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyFilters();
                }
            });
        }

        // Clear search function
        function clearSearch() {
            const searchInput = document.getElementById('search-input');
            const clearButton = document.getElementById('clear-search');
            
            searchInput.value = '';
            currentSearchQuery = '';
            clearButton.classList.add('hidden');
            
            applyFilters();
        }

        // Apply filters
// Apply filters
function applyFilters() {
    // Use translated spots if available, otherwise use original
    const spotsToFilter = translatedSpots.length > 0 ? translatedSpots : allSpots;
    let filtered = [...spotsToFilter];
    
    // Apply region filter
    if (currentRegion !== 'all') {
        filtered = filtered.filter(spot => spot.region === currentRegion);
    }
    
    // Apply search filter
    if (currentSearchQuery) {
        filtered = filtered.filter(spot => {
            const searchableText = `
                ${spot.name || ''} 
                ${spot.region || ''}
                ${spot.province || ''} 
                ${spot.municipality || ''}
                ${spot.overview || ''} 
                ${spot.categories ? spot.categories.join(' ') : ''}
            `.toLowerCase();
            
            // Also check if search query matches region directly
            const regionMatch = (spot.region || '').toLowerCase().includes(currentSearchQuery);
            
            return searchableText.includes(currentSearchQuery) || regionMatch;
        });
    }
    
    displaySpots(filtered);
    
    // Update no results message
    const noResults = document.getElementById('no-results');
    if (filtered.length === 0 && currentSearchQuery) {
        noResults.querySelector('h3').textContent = 'No destinations found';
        noResults.querySelector('p').textContent = `No results for "${document.getElementById('search-input').value}"`;
    } else if (filtered.length === 0) {
        noResults.querySelector('h3').textContent = 'No destinations found';
        noResults.querySelector('p').textContent = 'Try selecting a different region';
    }
}
        // Helper function to get category color
        function getCategoryColor(category) {
            return categoryColors[category] || '#0077be';
        }

        // Helper function to get category icons
        function getCategoryIconsHTML(categories) {
            if (!categories || categories.length === 0) return '';
            
            const primaryCategory = categories[0];
            const icons = categoryIcons[primaryCategory];
            const categoryColor = getCategoryColor(primaryCategory);
            
            if (!icons) return '';
            
            return `
                <div class="grid grid-cols-2 gap-2 mt-4 pt-4 border-t border-slate-blue/10">
                    ${icons.map(item => `
                        <div class="flex items-center justify-center gap-2 text-center">
                            <i class="${item.icon} text-sm" style="color: ${categoryColor};"></i>
                            <span class="text-xs text-slate-blue/70">${item.text}</span>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        // Carousel functions
        function openCarousel(images, imageOwners = [], startIndex = 0) {
            carouselImages = images;
            carouselImageOwners = imageOwners;
            currentCarouselIndex = startIndex;
            
            const carouselModal = document.getElementById('carousel-modal');
            carouselModal.classList.remove('hidden');
            carouselModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            updateCarouselImage();
            createThumbnails();
        }

        function closeCarousel() {
            const carouselModal = document.getElementById('carousel-modal');
            carouselModal.classList.add('hidden');
            carouselModal.classList.remove('flex');
            // Don't reset body overflow as modal is still open
        }

        function changeCarouselImage(direction) {
            currentCarouselIndex += direction;
            
            if (currentCarouselIndex < 0) {
                currentCarouselIndex = carouselImages.length - 1;
            } else if (currentCarouselIndex >= carouselImages.length) {
                currentCarouselIndex = 0;
            }
            
            updateCarouselImage();
        }

        function goToCarouselImage(index) {
            currentCarouselIndex = index;
            updateCarouselImage();
        }

        function updateCarouselImage() {
            const carouselImage = document.getElementById('carousel-image');
            const carouselCounter = document.getElementById('carousel-counter');
            const carouselTotal = document.getElementById('carousel-total');
            const carouselCreditsText = document.getElementById('carousel-credits-text');
            const carouselCreditsContainer = document.getElementById('carousel-credits');
            
            carouselImage.src = carouselImages[currentCarouselIndex];
            carouselCounter.textContent = currentCarouselIndex + 1;
            carouselTotal.textContent = carouselImages.length;
            
            // Update photo credits - make sure it's always visible when there are credits
            if (carouselImageOwners && carouselImageOwners.length > currentCarouselIndex && carouselImageOwners[currentCarouselIndex]) {
                carouselCreditsText.textContent = `Photo by ${carouselImageOwners[currentCarouselIndex]}`;
                carouselCreditsContainer.style.display = 'flex';
            } else {
                carouselCreditsText.textContent = 'Photo credit not available';
                carouselCreditsContainer.style.display = 'flex';
            }
            
            updateThumbnailsActive();
        }

        function createThumbnails() {
            const thumbnailsContainer = document.getElementById('carousel-thumbnails');
            thumbnailsContainer.innerHTML = carouselImages.map((img, index) => `
                <div class="carousel-thumbnail cursor-pointer transition-all ${index === currentCarouselIndex ? 'ring-2 ring-turquoise' : 'opacity-60 hover:opacity-100'}" 
                     onclick="goToCarouselImage(${index})">
                    <img src="${img}" alt="Thumbnail ${index + 1}" class="w-16 h-16 object-cover rounded">
                </div>
            `).join('');
        }

        function updateThumbnailsActive() {
            const thumbnails = document.querySelectorAll('.carousel-thumbnail');
            thumbnails.forEach((thumb, index) => {
                if (index === currentCarouselIndex) {
                    thumb.classList.add('ring-2', 'ring-turquoise');
                    thumb.classList.remove('opacity-60');
                } else {
                    thumb.classList.remove('ring-2', 'ring-turquoise');
                    thumb.classList.add('opacity-60');
                }
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const carouselModal = document.getElementById('carousel-modal');
            const destinationModal = document.getElementById('destination-modal');
            
            // Carousel navigation
            if (carouselModal && !carouselModal.classList.contains('hidden')) {
                if (e.key === 'ArrowLeft') {
                    changeCarouselImage(-1);
                } else if (e.key === 'ArrowRight') {
                    changeCarouselImage(1);
                } else if (e.key === 'Escape') {
                    closeCarousel();
                }
            }
            // Close destination modal
            else if (destinationModal && destinationModal.classList.contains('show') && e.key === 'Escape') {
                closeModal();
            }
        });

function initializeAccountDropdown() {
    accountDropdown.link = document.querySelector('.account-link');
    accountDropdown.element = document.querySelector('.dropdown-menu');
    accountDropdown.container = document.querySelector('.account-dropdown');
    
    if (accountDropdown.link && accountDropdown.element) {
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
                if (!dropdownItem.getAttribute('onclick')) {
                    setTimeout(() => hideAccountDropdown(), 100);
                }
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
            <a href="userdashboard.php" class="dropdown-item">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
            <a href="#" onclick="logout(); return false;" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        `;
    } else {
        dropdown.innerHTML = `
            <a href="loginform.php" class="dropdown-item">
                <i class="fas fa-sign-in-alt"></i>Sign In
            </a>
            <a href="registerform.php" class="dropdown-item">
                <i class="fas fa-user-plus"></i>Create Account
            </a>
        `;
    }
}

function updateMobileAccountSection() {
    const mobileAccountContent = document.getElementById('mobile-account-content');
    if (!mobileAccountContent) return;
    
    if (isLoggedIn) {
        mobileAccountContent.innerHTML = `
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
        mobileAccountContent.innerHTML = `
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
                    window.location.href = 'griddestination.php';
                }, 1500);
            })
            .catch(error => console.error('Error:', error));
    }
}
        console.log('Script loaded successfully');


// COMPLETE PAGE TRANSLATION SYSTEM
// Translates: Header, Hero, Filters, Cards, Footer, and All UI Text

const translationCache = new Map();
let currentLanguage = 'en';
let translatedSpots = [];
let isTranslating = false;

// Language code mapping
const languageMap = {
    'en': 'en-US',
    'ko': 'ko-KR',
    'ja': 'ja-JP',
    'zh': 'zh-CN',
    'ms': 'ms-MY',
    'hi': 'hi-IN',
    'tl': 'tl-PH',
    'ceb': 'ceb-PH'
};

// Static UI text translations (pre-defined for better UX)
const uiTranslations = {
    'en': {
        // Header
        'Home': 'Home',
        'Destination': 'Destination',
        'All Destination': 'All Destination',
        'Contact': 'Contact',
        'About': 'About',
        'Account': 'Account',
        'Dashboard': 'Dashboard',
        'Logout': 'Logout',
        'Sign In': 'Sign In',
        'Create Account': 'Create Account',
        
        // Hero
        'Explore': 'Explore',
        'All Destinations': 'All Destinations',
        'Discover the beauty of the Philippines - from stunning beaches to majestic mountains': 'Discover the beauty of the Philippines - from stunning beaches to majestic mountains',
        
        // Search
        'Search destinations by name, location, or description...': 'Search destinations by name, location, or description...',
        
        // Filters
        '🌏 All Regions': '🌏 All Regions',
        '🏙️ NCR': '🏙️ NCR',
        '⛰️ CAR': '⛰️ CAR',
        '🕌 BARMM': '🕌 BARMM',
        '🏝️ NIR': '🏝️ NIR',
        
        // Messages
        'No destinations found': 'No destinations found',
        'Try selecting a different region': 'Try selecting a different region',
        'No results for': 'No results for',
        'Loading destination details...': 'Loading destination details...',
        'Error loading destination': 'Error loading destination',
        
        // Footer
        'Your trusted companion for discovering the most beautiful destinations across the Philippine archipelago. Creating unforgettable memories, one island at a time.': 'Your trusted companion for discovering the most beautiful destinations across the Philippine archipelago. Creating unforgettable memories, one island at a time.',
        'Quick Links': 'Quick Links',
        'Support': 'Support',
        'About Us': 'About Us',
        'FAQs': 'FAQs',
        'Privacy Policy': 'Privacy Policy',
        'Terms of Service': 'Terms of Service',
        
        // Notifications
        'Starting translation...': 'Starting translation...',
        'Translating...': 'Translating...',
        'Translation complete!': 'Translation complete!',
        'Translation failed': 'Translation failed',
        'Switched to English': 'Switched to English',
        'Already in this language': 'Already in this language',
        'Translation in progress...': 'Translation in progress...'
    }
    // Other languages will be auto-translated
};

// Translate single text
async function translateText(text, targetLang) {
    if (!text || targetLang === 'en') return text;
    
    const cacheKey = `${text.substring(0, 50)}_${targetLang}`;
    if (translationCache.has(cacheKey)) {
        return translationCache.get(cacheKey);
    }
    
    const maxLength = 500;
    const textToTranslate = text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    
    try {
        await new Promise(resolve => setTimeout(resolve, 200));
        
        const sourceLang = languageMap['en'];
        const targetLangCode = languageMap[targetLang] || targetLang;
        const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(textToTranslate)}&langpair=${sourceLang}|${targetLangCode}`;
        
        const response = await fetch(url);
        const data = await response.json();
        
        if (data.responseStatus === 200 && data.responseData) {
            const translatedText = data.responseData.translatedText;
            translationCache.set(cacheKey, translatedText);
            return translatedText;
        }
        
        return text;
    } catch (error) {
        console.error('Translation error:', error);
        return text;
    }
}

// Get UI translation (use pre-defined or translate)
async function getUITranslation(text, targetLang) {
    if (targetLang === 'en') return text;
    
    // Check if we have pre-translated UI text
    if (uiTranslations[targetLang] && uiTranslations[targetLang][text]) {
        return uiTranslations[targetLang][text];
    }
    
    // Otherwise translate it
    return await translateText(text, targetLang);
}

// Translate page header
async function translateHeader(targetLang) {
    // Navigation links
    const navLinks = document.querySelectorAll('nav a');
    for (const link of navLinks) {
        const originalText = link.textContent.trim();
        if (originalText) {
            link.textContent = await getUITranslation(originalText, targetLang);
        }
    }
    
    // Mobile menu links
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    for (const link of mobileLinks) {
        const originalText = link.textContent.trim();
        if (originalText) {
            link.textContent = await getUITranslation(originalText, targetLang);
        }
    }
}

// Translate hero section
async function translateHero(targetLang) {
    const heroTitle = document.querySelector('section.pt-32 h1');
    if (heroTitle) {
        const exploreText = await getUITranslation('Explore', targetLang);
        const destinationsText = await getUITranslation('All Destinations', targetLang);
        heroTitle.innerHTML = `${exploreText} <span class="text-gold">${destinationsText}</span>`;
    }
    
    const heroDesc = document.querySelector('section.pt-32 p');
    if (heroDesc) {
        heroDesc.textContent = await getUITranslation('Discover the beauty of the Philippines - from stunning beaches to majestic mountains', targetLang);
    }
}

// Translate search placeholder
async function translateSearch(targetLang) {
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.placeholder = await getUITranslation('Search destinations by name, location, or description...', targetLang);
    }
}

// Translate filter buttons (keep region codes, translate labels)
async function translateFilters(targetLang) {
    const filterButtons = document.querySelectorAll('.filter-btn');
    for (const btn of filterButtons) {
        const originalText = btn.textContent.trim();
        if (originalText) {
            btn.textContent = await getUITranslation(originalText, targetLang);
        }
    }
    
    // Mobile filter dropdown
    const mobileFilter = document.getElementById('mobile-region-filter');
    if (mobileFilter) {
        const options = mobileFilter.querySelectorAll('option');
        for (const option of options) {
            const originalText = option.textContent.trim();
            if (originalText) {
                option.textContent = await getUITranslation(originalText, targetLang);
            }
        }
    }
}

// Translate footer
async function translateFooter(targetLang) {
    const footerTexts = document.querySelectorAll('footer p, footer h3, footer h4, footer a');
    for (const element of footerTexts) {
        const originalText = element.textContent.trim();
        if (originalText && originalText.length > 0) {
            const translated = await getUITranslation(originalText, targetLang);
            element.textContent = translated;
        }
    }
}

// Translate "No results" message
async function translateNoResults(targetLang) {
    const noResults = document.getElementById('no-results');
    if (noResults) {
        const h3 = noResults.querySelector('h3');
        const p = noResults.querySelector('p');
        
        if (h3) {
            h3.textContent = await getUITranslation('No destinations found', targetLang);
        }
        if (p) {
            p.textContent = await getUITranslation('Try selecting a different region', targetLang);
        }
    }
}

// Translate spot data
async function translateSpotData(spot, targetLang) {
    if (targetLang === 'en') return spot;
    
    const translatedSpot = { ...spot };
    const fieldsToTranslate = ['name', 'overview', 'things_to_do', 'operating_hours', 'contact_information', 'transportation'];
    
    for (const field of fieldsToTranslate) {
        if (translatedSpot[field]) {
            translatedSpot[field] = await translateText(translatedSpot[field], targetLang);
        }
    }
    
    if (translatedSpot.categories && Array.isArray(translatedSpot.categories)) {
        translatedSpot.categories = await Promise.all(
            translatedSpot.categories.map(cat => translateText(cat, targetLang))
        );
    }
    
    return translatedSpot;
}

// Translate entire page
async function translatePage(targetLang) {
    if (isTranslating) return false;
    
    isTranslating = true;
    showNotification('Starting translation...', 'info');
    
    try {
        // Translate UI elements
        await translateHeader(targetLang);
        await translateHero(targetLang);
        await translateSearch(targetLang);
        await translateFilters(targetLang);
        await translateFooter(targetLang);
        await translateNoResults(targetLang);
        
        // Translate destination spots in batches
        const batchSize = 5;
        const totalSpots = allSpots.length;
        const translatedResults = [];
        
        for (let i = 0; i < totalSpots; i += batchSize) {
            const batch = allSpots.slice(i, i + batchSize);
            const batchTranslations = await Promise.all(
                batch.map(spot => translateSpotData(spot, targetLang))
            );
            translatedResults.push(...batchTranslations);
            
            const progress = Math.round(((i + batchSize) / totalSpots) * 100);
            updateTranslationProgress(Math.min(progress, 100));
        }
        
        translatedSpots = translatedResults;
        applyFilters();
        
        return true;
    } catch (error) {
        console.error('Page translation error:', error);
        return false;
    } finally {
        isTranslating = false;
    }
}

// Reset page to English
function resetToEnglish() {
    location.reload(); // Simple but effective
}

// Update progress notification
function updateTranslationProgress(progress) {
    const notification = document.getElementById('translation-notification');
    if (notification) {
        notification.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i>Translating... ${progress}%`;
    }
}

// Show notification
function showNotification(message, type = 'info') {
    const existingNotification = document.getElementById('translation-notification');
    if (existingNotification) existingNotification.remove();
    
    const colors = { 'info': 'bg-ocean-blue', 'success': 'bg-turquoise', 'error': 'bg-red-500' };
    const icons = { 'info': 'fa-spinner fa-spin', 'success': 'fa-check', 'error': 'fa-times' };
    
    const notification = document.createElement('div');
    notification.id = 'translation-notification';
    notification.className = `fixed top-20 right-4 ${colors[type]} text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999] transition-all`;
    notification.innerHTML = `<i class="fas ${icons[type]} mr-2"></i>${message}`;
    document.body.appendChild(notification);
    
    if (type !== 'info') {
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 2000);
    }
}

// Initialize language selector
function initializeLanguageSelector() {
    const languageSelect = document.getElementById('language-select');
    if (!languageSelect) {
        console.error('Language selector not found');
        return;
    }
    
    languageSelect.addEventListener('change', async function() {
        const selectedLang = this.value;
        
        // Save preference to localStorage
        localStorage.setItem('preferredLanguage', selectedLang);
        console.log('Language preference saved:', selectedLang);
        
        // Visual feedback
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 150);
        
        if (isTranslating) {
            showNotification('Translation in progress...', 'info');
            return;
        }
        
        if (selectedLang === 'en') {
            currentLanguage = 'en';
            showNotification('Switching to English...', 'info');
            setTimeout(() => resetToEnglish(), 500);
            return;
        }
        
        if (selectedLang === currentLanguage && translatedSpots.length > 0) {
            showNotification('Already in this language', 'info');
            return;
        }
        
        currentLanguage = selectedLang;
        const success = await translatePage(selectedLang);
        
        if (success) {
            showNotification('Translation complete!', 'success');
        } else {
            showNotification('Translation failed', 'error');
            currentLanguage = 'en';
            translatedSpots = [];
            languageSelect.value = 'en';
            localStorage.setItem('preferredLanguage', 'en'); // Also save on failure
            resetToEnglish();
        }
    });
    
    console.log('Language selector initialized');
}

// Clear cache utility
function clearTranslationCache() {
    translationCache.clear();
    translatedSpots = [];
    currentLanguage = 'en';
    const langSelect = document.getElementById('language-select');
    if (langSelect) langSelect.value = 'en';
    resetToEnglish();
}
    </script>
</body>
</html>