

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lakbay Gabay - Home Page</title>
    <!-- Tailwind CSS -->
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
                        'ocean-blue': '#0077be',
                        'ocean-cyan': '#00a8cc', 
                        'turquoise': '#40e0d0',
                        'azure': '#f0f8ff',
                        'slate-blue': '#2c3e50',
                        'gold': '#ffd700',
                        'ocean-dark': '#005a94',
                        'ocean-light': '#e6f7ff',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'slide-in': 'slideIn 0.8s ease-out forwards',
                        'fade-up': 'fadeUp 0.8s ease-out forwards',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'gradient-shift': 'gradientShift 8s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        fadeUp: {
                            '0%': { transform: 'translateY(30px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        bounceGentle: {
                            '0%, 20%, 50%, 80%, 100%': { transform: 'translateY(0)' },
                            '40%': { transform: 'translateY(-10px)' },
                            '60%': { transform: 'translateY(-5px)' },
                        },
                        gradientShift: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        }
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                        'pattern-dots': 'radial-gradient(circle, rgba(0, 119, 190, 0.1) 1px, transparent 1px)',
                    },
                    backgroundSize: {
                        'pattern': '20px 20px',
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 30%, #40e0d0 70%, #f0f8ff 100%);
            background-size: 200% 200%;
            animation: gradientShift 8s ease-in-out infinite;
        }

        .glass-morphism {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(240, 248, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .glass-dark {
            backdrop-filter: blur(16px) saturate(180%);
            background-color: rgba(0, 119, 190, 0.85);
            border: 1px solid rgba(64, 224, 208, 0.3);
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

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .text-gradient {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
        }

        .carousel-item {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            flex: 0 0 auto;
        }

        .carousel-item.active {
            display: block;
            opacity: 1;
        }
        
        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .image-placeholder {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .ocean-wave {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 30%, #40e0d0 70%);
        }

        .feature-card {
            background: linear-gradient(135deg, rgba(240, 248, 255, 0.9) 0%, rgba(255, 255, 255, 0.8) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(64, 224, 208, 0.2);
        }
#fullscreen-carousel {
    transition: opacity 0.3s ease;
    z-index: 9999;
}

#carousel-image-fullscreen {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

#fullscreen-carousel.hidden {
    opacity: 0;
    pointer-events: none;
}

#fullscreen-carousel:not(.hidden) {
    opacity: 1;
}

.hero-text-animation h1 {
    overflow: visible !important;
}

.hero-text-animation h1 .block {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
}
.cursor-zoom-in {
    cursor: zoom-in;
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
                                     
.hamburger-btn {
    cursor: pointer;
    background: transparent;
    border: none;
    outline: none;
}

.hamburger-line {
    transition: all 0.3s ease;
}

/* Prevent body scroll when mobile menu is open */
/* Prevent body scroll when mobile menu is open */
body.mobile-menu-open {
    overflow: hidden;
    position: fixed;
    width: 100%;
    height: 100%;
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
    color: currentColor; /* Use the text color from Tailwind */
}

/* Arrow rotation when dropdown is active */
.account-link.active::after {
    transform: rotate(180deg);
}

/* Optional: Change account link color when dropdown is open */
.account-link.active {
    color: #40e0d0 !important; /* Override Tailwind's text color when active */
}


        .logo a {
          font-family: 'Playfair Display', serif;
          font-size: 31px !important;
        }

@media (min-width: 1024px) {
    .logo a {
        font-size: 2.25rem; /* text-3xl equivalent for lg and up */
    }
}

.logo a:hover {
    color: #40e0d0; /* turquoise */
    text-decoration: none;
    transform: scale(1.05);
    text-shadow: 0 0 20px rgba(64, 224, 208, 0.5);
}


/* Mobile menu account section */
#mobile-menu .border-t {
    border-color: rgba(255, 255, 255, 0.2) !important;
}
/* Smooth carousel transitions */
#featured-locations-container {
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

/* Stagger animation for individual cards */
#featured-locations-container > div {
    animation: slideInCard 0.5s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

#featured-locations-container > div:nth-child(1) {
    animation-delay: 0.1s;
}

#featured-locations-container > div:nth-child(2) {
    animation-delay: 0.2s;
}

#featured-locations-container > div:nth-child(3) {
    animation-delay: 0.3s;
}

@keyframes slideInCard {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced button hover effects */
#carousel-prev, #carousel-next {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#carousel-prev:hover, #carousel-next:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 10px 25px rgba(0, 102, 204, 0.3);
}

#carousel-prev:active, #carousel-next:active {
    transform: translateY(-50%) scale(0.95);
}

    #carousel-image-fullscreen {
        transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
        transform: translateX(0);
    }
    
    /* Ensure container doesn't overflow during slide */
    #fullscreen-carousel .relative {
        overflow: hidden;
    }

    </style>
</head>
<body class="bg-azure text-slate-blue font-inter overflow-x-hidden selection:bg-ocean-cyan/20">

    <!-- Header with Background -->
<div class="fixed top-0 left-0 right-0 header-bg transition-all duration-300 z-50" id="header" style="padding: 16px 32px;">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="logo">
            <a href="index.php" 
               class="font-bold font-playfair uppercase text-white tracking-wide hover:text-turquoise transition-colors duration-300"
               style="font-size: 30px !important; line-height: 1.2;">
                Lakbay Gabay
            </a>
        </div>

        <div class="flex items-center gap-6">
            <!-- Navigation Menu -->
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


            <div class="border-t border-white/20 pt-3 mt-2">
                <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                <div class="px-2 py-1 text-white/80 text-sm mb-2">
                    Loading...
                </div>
            </div>
        </nav>
    </div>
</div>

    <!-- Hero Section -->
       <!-- Hero Section -->
  <section class="relative min-h-screen flex items-center justify-center overflow-hidden" id="hero">
        <!-- Static Image Background with Auto Rotation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 ease-in-out" 
                 id="hero-bg-current" 
                 style="background-image: url('images/background/1.jpg');"></div>
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 ease-in-out" 
                 id="hero-bg-next" 
                 style="background-image: url('image/background/2.jpg');"></div>
        </div>
        
        <!-- Overlay for better text readability -->
        <div class="absolute inset-0 bg-black/30"></div>
        
        <!-- Enhanced Animated Background Elements -->
        <div class="absolute inset-0 bg-pattern-dots bg-pattern opacity-30"></div>
        <div class="absolute top-20 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl floating-elements"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-turquoise/20 rounded-full blur-3xl parallax-element" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/4 w-48 h-48 bg-ocean-cyan/10 rounded-full blur-2xl floating-elements" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-1/3 right-1/3 w-64 h-64 bg-gold/10 rounded-full blur-3xl parallax-element" style="animation-delay: 6s;"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center">
            <!-- Enhanced Main Heading -->
<div class="hero-text-animation">
                <h1 class="font-bold font-playfair text-white mb-6 leading-tight overflow-visible">
                    <span class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl inline-block mr-3" data-translate="hero-discover">Discover</span>
                    <span class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-8xl inline-block" data-translate="hero-the">the</span>
                    <span class="block text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl text-transparent bg-clip-text bg-gradient-to-r from-gold to-yellow-400 mt-4 mb-2" data-translate="hero-philippines">
                        Philippines
                    </span>
                </h1>
                <div class="w-32 h-1 bg-gradient-to-r from-gold to-yellow-400 mx-auto rounded-full animate-pulse mt-4"></div>
            </div>
            
            <!-- Enhanced Subtitle -->
            <div class="hero-subtext-animation">
                <p class="text-xl md:text-2xl text-azure max-w-4xl mx-auto leading-relaxed mb-12 font-light" data-translate="hero-subtitle">
                    Embark on an extraordinary journey through pristine beaches, ancient rice terraces, and vibrant cultures across 7,641 islands of paradise.
                </p>
            </div>
            
            <!-- Enhanced CTA Button -->
            <div class="hero-button-animation">
                <a href="map.php" class="group relative px-8 py-4 bg-white text-ocean-blue font-semibold rounded-full hover:bg-azure transition-all duration-500 shadow-xl hover:shadow-2xl transform hover:scale-110 flex items-center gap-3 inline-flex">
                    <i class="fas fa-map-marked-alt group-hover:rotate-12 transition-transform duration-300 text-ocean-cyan"></i>
                    <span class="relative overflow-hidden">
                        <span class="inline-block transition-transform duration-300 group-hover:-translate-y-full" data-translate="hero-button-primary">Explore Interactive Map</span>
                        <span class="absolute top-full left-0 inline-block transition-transform duration-300 group-hover:-translate-y-full" data-translate="hero-button-secondary">Discover Paradise</span>
                    </span>
                    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-turquoise to-ocean-cyan opacity-0 group-hover:opacity-10 transition-opacity duration-500"></div>
                </a>
            </div>
            


            <div class="hero-stats-static">
                <div class="grid grid-cols-3 gap-8 max-w-2xl mx-auto mt-16">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">7,641</div>
                        <div class="text-azure text-sm md:text-base" data-translate="stats-islands">Islands</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">300+</div>
                        <div class="text-azure text-sm md:text-base" data-translate="stats-languages">Languages</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2">∞</div>
                        <div class="text-azure text-sm md:text-base" data-translate="stats-adventures">Adventures</div>
                    </div>
                </div>
            </div>
        </div>
        

        
        <!-- Floating Particles Effect -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-2 h-2 bg-white/30 rounded-full animate-float" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
            <div class="absolute w-1 h-1 bg-turquoise/40 rounded-full animate-float" style="top: 60%; left: 80%; animation-delay: 2s;"></div>
            <div class="absolute w-3 h-3 bg-gold/20 rounded-full animate-float" style="top: 80%; left: 20%; animation-delay: 4s;"></div>
            <div class="absolute w-1.5 h-1.5 bg-ocean-cyan/30 rounded-full animate-float" style="top: 30%; left: 70%; animation-delay: 1s;"></div>
            <div class="absolute w-2 h-2 bg-white/20 rounded-full animate-float" style="top: 70%; left: 60%; animation-delay: 3s;"></div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-24 bg-gradient-to-br from-azure via-white to-ocean-light relative overflow-hidden" id="destinations">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-turquoise/10 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-block">
                    <span class="text-ocean-cyan font-semibold text-lg tracking-wide uppercase" data-translate="destinations-label">Destinations</span>
                    <h2 class="text-4xl md:text-6xl font-bold font-playfair text-slate-blue mt-4 mb-6">
                        <span data-translate="featured">Featured</span> <span class="text-gradient" data-translate="locations">Locations</span>
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-ocean-blue to-turquoise mx-auto rounded-full"></div>
                </div>
                <p class="text-xl text-slate-blue/80 max-w-3xl mx-auto mt-6 leading-relaxed" data-translate="destinations-description">
                    From pristine beaches to mystical mountains, discover the most breathtaking destinations 
                    that make the Philippines a world-class travel paradise.
                </p>
            </div>
            
            <!-- Enhanced Destination Carousel Container -->
            <div class="relative">
                <!-- Carousel Navigation Buttons -->
                <button id="carousel-prev" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-14 h-14 bg-white/90 hover:bg-white rounded-full shadow-xl flex items-center justify-center text-ocean-blue hover:text-ocean-cyan transition-all duration-300 opacity-80 hover:opacity-100 backdrop-blur-sm border border-turquoise/20">
                    <i class="fas fa-chevron-left text-lg"></i>
                </button>
                
                <button id="carousel-next" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-14 h-14 bg-white/90 hover:bg-white rounded-full shadow-xl flex items-center justify-center text-ocean-blue hover:text-ocean-cyan transition-all duration-300 opacity-80 hover:opacity-100 backdrop-blur-sm border border-turquoise/20">
                    <i class="fas fa-chevron-right text-lg"></i>
                </button>
                
                <!-- Enhanced Destination Cards Container -->
                <div class="overflow-hidden rounded-3xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 transition-transform duration-500 ease-in-out p-4" id="featured-locations-container">
                        <!-- Loading state will be shown initially -->
                        <div class="col-span-3 flex justify-center items-center py-16">
                            <div class="flex items-center gap-4">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-ocean-blue"></div>
                                <span class="text-ocean-blue font-medium" data-translate="loading-destinations">Loading amazing destinations...</span>
                            </div>
                        </div>
                    </div>
                </div>
                            
                <!-- Enhanced Carousel Indicators -->
                <div class="flex justify-center mt-10 space-x-3" id="carousel-indicators">
                    <!-- Indicators will be added dynamically -->
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Philippines Section -->

    <!-- Why Choose Philippines Section -->
    <section class="py-24 bg-gradient-to-br from-slate-blue via-ocean-dark to-slate-blue text-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-pattern-dots bg-pattern opacity-20"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-ocean-cyan/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-72 h-72 bg-turquoise/20 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="text-turquoise font-semibold text-lg tracking-wide uppercase" data-translate="why-philippines">Why Philippines</span>
                <h2 class="text-4xl md:text-6xl font-bold font-playfair mt-4 mb-6">
                    <span data-translate="paradise">Paradise</span> <span class="text-transparent bg-clip-text bg-gradient-to-r from-gold to-yellow-400" data-translate="awaits">Awaits</span>
                </h2>
                <p class="text-xl text-azure max-w-3xl mx-auto leading-relaxed" data-translate="paradise-description">
                    Discover what makes the Philippines one of the world's most extraordinary travel destinations
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Enhanced Feature Cards -->
                <div class="feature-card rounded-3xl p-8 hover:scale-105 transition-all duration-300 border border-turquoise/20 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-ocean-blue to-ocean-cyan rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-map-marked-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-blue" data-translate="feature-islands-title">7,641 Islands</h3>
                    <p class="text-slate-blue/80 leading-relaxed" data-translate="feature-islands-desc">
                        Each island offers unique experiences, from pristine beaches to hidden lagoons and mystical caves.
                    </p>
                </div>
                
                <div class="feature-card rounded-3xl p-8 hover:scale-105 transition-all duration-300 border border-turquoise/20 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-turquoise to-ocean-cyan rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-blue" data-translate="feature-hospitality-title">Warm Hospitality</h3>
                    <p class="text-slate-blue/80 leading-relaxed" data-translate="feature-hospitality-desc">
                        Experience the genuine warmth of Filipino culture with smiling faces and welcoming hearts everywhere.
                    </p>
                </div>
                
                <div class="feature-card rounded-3xl p-8 hover:scale-105 transition-all duration-300 border border-turquoise/20 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-gold to-yellow-500 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-utensils text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-blue" data-translate="feature-cuisine-title">Incredible Cuisine</h3>
                    <p class="text-slate-blue/80 leading-relaxed" data-translate="feature-cuisine-desc">
                        Savor diverse flavors from adobo to lechon, fresh tropical fruits, and street food adventures.
                    </p>
                </div>
                
                <div class="feature-card rounded-3xl p-8 hover:scale-105 transition-all duration-300 border border-turquoise/20 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-ocean-cyan to-turquoise rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-dollar-sign text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-blue" data-translate="feature-value-title">Great Value</h3>
                    <p class="text-slate-blue/80 leading-relaxed" data-translate="feature-value-desc">
                        Enjoy luxury experiences and authentic adventures at incredibly affordable prices.
                    </p>
                </div>
                
                <div class="feature-card rounded-3xl p-8 hover:scale-105 transition-all duration-300 border border-turquoise/20 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-turquoise rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-leaf text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-blue" data-translate="feature-biodiversity-title">Rich Biodiversity</h3>
                    <p class="text-slate-blue/80 leading-relaxed" data-translate="feature-biodiversity-desc">
                        Explore diverse ecosystems from coral reefs to rainforests, home to unique wildlife species.
                    </p>
                </div>
                
                <div class="feature-card rounded-3xl p-8 hover:scale-105 transition-all duration-300 border border-turquoise/20 shadow-xl">
                    <div class="w-16 h-16 bg-gradient-to-br from-gold to-orange-400 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-slate-blue" data-translate="feature-weather-title">Year-Round Sunshine</h3>
                    <p class="text-slate-blue/80 leading-relaxed" data-translate="feature-weather-desc">
                        Enjoy tropical weather perfect for beach days, outdoor adventures, and island exploration.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
 <section id="about" class="py-24 bg-gradient-to-br from-azure via-white to-turquoise/10 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-20 right-10 w-72 h-72 bg-ocean-blue/10 rounded-full blur-3xl animate-float"></div>
    <div class="absolute bottom-20 left-10 w-96 h-96 bg-turquoise/10 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <div class="glass-morphism rounded-3xl p-12 md:p-16 shadow-2xl border border-turquoise/20" style="overflow: visible;">
            <h2 class="text-4xl md:text-6xl font-bold font-playfair mb-6" style="overflow: visible; padding: 20px 0;">
                <span data-translate="cta-ready" style="display: inline-block; padding: 5px 0;">Ready for Your</span>
                <span class="text-gradient block mt-4" data-translate="cta-adventure" style="padding: 15px 0; line-height: 1.3; overflow: visible; -webkit-box-decoration-break: clone; box-decoration-break: clone;">Philippine Adventure?</span>
            </h2>
            <p class="text-xl text-slate-blue/80 mb-12 max-w-3xl mx-auto leading-relaxed" data-translate="cta-description">
                Join thousands of travelers who have discovered the magic of the Philippine islands. 
                Start planning your unforgettable journey today.
            </p>
            
            <!-- Enhanced CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="registerform.php" class="group relative px-10 py-4 bg-gradient-to-r from-ocean-blue via-ocean-cyan to-turquoise hover:from-ocean-dark hover:to-ocean-blue text-white font-bold rounded-full transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 flex items-center gap-3">
                    <i class="fas fa-user-plus group-hover:rotate-12 transition-transform duration-300"></i>
                    <span data-translate="create-account">Create Account</span>
                    <div class="absolute inset-0 rounded-full bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="loginform.php" class="group relative px-10 py-4 bg-transparent border-2 border-ocean-blue text-ocean-blue hover:bg-ocean-blue hover:text-white font-bold rounded-full transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 flex items-center gap-3">
                    <i class="fas fa-sign-in-alt group-hover:translate-x-1 transition-transform duration-300"></i>
                    <span data-translate="sign-in">Sign In</span>
                </a>
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

    <div id="fullscreen-carousel" class="fixed inset-0 z-[9999] hidden bg-black/95 backdrop-blur-xl">
        <!-- Close button -->
        <button id="close-carousel" 
                class="absolute top-6 right-6 z-[10000] w-12 h-12 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 cursor-pointer"
                type="button">
            <i class="fas fa-times text-xl pointer-events-none"></i>
        </button>
        
        <!-- Previous button -->
        <button id="carousel-prev-fullscreen" 
                class="absolute left-6 top-1/2 -translate-y-1/2 z-[10000] w-14 h-14 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 cursor-pointer"
                type="button">
            <i class="fas fa-chevron-left text-xl pointer-events-none"></i>
        </button>
        
        <!-- Next button -->
        <button id="carousel-next-fullscreen" 
                class="absolute right-6 top-1/2 -translate-y-1/2 z-[10000] w-14 h-14 bg-white/10 hover:bg-white/20 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 cursor-pointer"
                type="button">
            <i class="fas fa-chevron-right text-xl pointer-events-none"></i>
        </button>
        
        <!-- Image container -->
        <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
            <img id="carousel-image-fullscreen" 
                 class="max-w-full max-h-full object-contain rounded-lg shadow-2xl transition-opacity duration-300 pointer-events-none" 
                 src="" 
                 alt="">
        </div>
        
        <!-- Info container -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white text-center pointer-events-none z-[9999]">
            <p id="carousel-counter-fullscreen" class="text-lg font-semibold mb-2">1/3</p>
            <p id="carousel-location-name" class="text-xl font-bold text-turquoise mb-2"></p>
            <p id="carousel-owner-credit" class="text-sm text-white/80" data-translate="photo-by">Photo by: Unknown Photographer</p>
        </div>
 
 </div>



    <!-- Enhanced Back to Top Button -->
    <button class="fixed bottom-6 right-6 w-14 h-14 bg-ocean-cyan hover:bg-turquoise text-white rounded-full flex items-center justify-center cursor-pointer shadow-xl hover:shadow-2xl transition-all duration-300 opacity-0 invisible hover:scale-110 z-50" id="back-to-top">
        <i class="fas fa-chevron-up text-lg"></i>
    </button>

    <!-- Translation Loading Indicator -->
    <div id="translation-loading" class="fixed top-20 right-4 bg-ocean-blue text-white px-4 py-2 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50">
        <div class="flex items-center gap-2">
            <div class="translate-indicator"></div>
            <span data-translate="translating">Translating...</span>
        </div>
    </div>

<script src="index.js"></script>
<script src="translationindex.js"></script>


