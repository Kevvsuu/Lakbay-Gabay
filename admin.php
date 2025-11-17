<?php 
// Rename this file to admin.php to enable PHP processing
require_once 'check_admin_session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Lakbay Gabay </title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
         integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
         crossorigin=""/>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
         integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
         crossorigin=""></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'ocean-blue': '#0077be',
                        'sky-blue': '#00a8cc',
                        'turquoise': '#40e0d0',
                        'ice-blue': '#f0f8ff',
                        'navy': '#2c3e50',
                        'gold': '#ffd700',
                        primary: {
                            50: '#f0f8ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0077be',
                            600: '#00a8cc',
                            700: '#0077be',
                            800: '#075985',
                            900: '#2c3e50',
                        },
                        accent: {
                            light: '#40e0d0',
                            gold: '#ffd700',
                        }
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'Arial', 'sans-serif'],
                    },
                    backgroundImage: {
                        'gradient-ocean': 'linear-gradient(135deg, #0077be 0%, #00a8cc 50%, #40e0d0 100%)',
                        'gradient-accent': 'linear-gradient(135deg, #40e0d0 0%, #00a8cc 100%)',
                        'gradient-dark': 'linear-gradient(135deg, #2c3e50 0%, #0077be 100%)',
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <!-- Replace the existing Chart.js script with this -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <style>



        /* Typography - Apply Playfair Display to all headings */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif !important;
        }

        /* Ensure body text uses Inter */
        body, p, span, a, button, input, select, textarea, label, li, td, th {
            font-family: 'Inter', sans-serif !important;
        }

        /* Override Montserrat with Inter */
        body {
            font-family: 'Inter', sans-serif !important;
        }

        /* Table headers use Playfair */
        thead th {
            font-family: 'Playfair Display', serif !important;
        }

        /* Table body uses Inter */
        tbody td {
            font-family: 'Inter', sans-serif !important;
        }

        /* Dropdown items use Inter */
        .dropdown-item {
            font-family: 'Inter', sans-serif !important;
        }

        /* Navigation links use Inter */
        nav a, header a {
            font-family: 'Inter', sans-serif !important;
        }

        /* Logo uses Playfair for elegance */
        .logo a {
            font-family: 'Playfair Display', serif !important;
        }

        /* Gradient text headings use Playfair */
        .gradient-text {
            font-family: 'Playfair Display', serif !important;
        }

        /* Stats numbers can stay Inter for clarity */
        .stats-number {
            font-family: 'Inter', sans-serif !important;
        }

        /* Button text uses Inter */
        .btn-ocean, .btn-outline-ocean, button {
            font-family: 'Inter', sans-serif !important;
        }

        /* Form labels use Inter */
        label {
            font-family: 'Inter', sans-serif !important;
        }

        /* Tab buttons use Inter */
        .tab {
            font-family: 'Inter', sans-serif !important;
        }

        /* Footer headings use Playfair */
        footer h3, footer h4 {
            font-family: 'Playfair Display', serif !important;
        }

        /* Footer text uses Inter */
        footer p, footer a {
            font-family: 'Inter', sans-serif !important;
        }
        .admin-pin {
            position: absolute;
            width: 32px;
            height: 32px;
            background-image: url('images/pins/underrated.png');
            background-size: contain;
            background-repeat: no-repeat;
            transform: translate(-50%, -100%);
            display: none;
            pointer-events: none;
            z-index: 100;
        }
        
        .position-modal {
            display: none;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .preview-image {
            max-width: 200px;
            max-height: 150px;
            object-fit: cover;
        }

        #admin-pin {
            position: absolute;
            pointer-events: none;
            transition: all 0.2s ease-out;
            transform-origin: bottom center;
            z-index: 1000;
        }

        #admin-pin img, #admin-pin svg {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .header-bg {
            background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%);
            backdrop-filter: blur(16px) saturate(180%);
        }

        .card-glass {
            background: rgba(240, 248, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(64, 224, 208, 0.2);
        }

        .btn-ocean {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);
            border: 2px solid transparent;
            background-clip: padding-box;
            transition: all 0.3s ease;
        }

        .btn-ocean:hover {
            background: linear-gradient(135deg, #00a8cc 0%, #40e0d0 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
        }

        .btn-outline-ocean {
            background: transparent;
            border: 2px solid #0077be;
            color: #0077be;

        }

        .btn-outline-ocean:hover {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);
            color: white;
            transform: translateY(-2px);
        }

        .tab.active {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);
            color: white;
            border-color: #0077be;
        }

        .input-ocean:focus {
            border-color: #40e0d0;
            box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.1);
        }

        .gold-accent {
            color: #ffd700;
        }

        .navy-text {
            color: #2c3e50;
        }

        .gradient-text {
            background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }


        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .shimmer {
            position: relative;
            overflow: hidden;
        }

        .shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }


<--       .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 119, 190, 0.2);
        }  -->
/* Message status styling */
.status-unread {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.status-read {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
}

.status-replied {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

/* Chart container styling */
.chart-container {
    position: relative;
    height: 400px;
    margin-bottom: 2rem;
}

.stats-card {
    background: linear-gradient(135deg, rgba(240, 248, 255, 0.9) 0%, rgba(224, 242, 254, 0.9) 100%);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(64, 224, 208, 0.3);
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 119, 190, 0.1);
}

.stats-number {
    font-size: 2.5rem;
    font-weight: bold;
    background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.tab.active {
    background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%) !important;
    border-color: #40e0d0 !important;
    color: white !important;
    box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
}

.tab.active i {
    color: #f8d619 !important;
}

/* Optional: Enhance inactive tab hover color */



.admin-custom-marker {
    cursor: move;
}

#admin-leaflet-map {
    cursor: crosshair;
}

/* Remove hover effects from all form inputs, selects, and textareas */
#edit-form input,
#edit-form select,
#edit-form textarea,
#add-spot-form input,
#add-spot-form select,
#add-spot-form textarea {
    transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
}

#edit-form input:hover,
#edit-form select:hover,
#edit-form textarea:hover,
#add-spot-form input:hover,
#add-spot-form select:hover,
#add-spot-form textarea:hover {
    border-color: inherit !important;
    box-shadow: none !important;
    transform: none !important;
}

/* Keep only focus effects */
#edit-form input:focus,
#edit-form select:focus,
#edit-form textarea:focus,
#add-spot-form input:focus,
#add-spot-form select:focus,
#add-spot-form textarea:focus {
    border-color: #40e0d0 !important;
    box-shadow: 0 0 0 2px rgba(64, 224, 208, 0.15) !important;
}

/* Force disabled button styling */
button[disabled], button:disabled {
    opacity: 0.6 !important;
    cursor: not-allowed !important;
    pointer-events: none !important;
}

/* Prevent button hover when disabled */
button[disabled]:hover, button:disabled:hover {
    transform: none !important;
    box-shadow: none !important;
}
    </style>
</head>
<body class="min-h-screen text-gray-800" style="background: linear-gradient(135deg, 
#f0f8ff 0%, 
#e0f2fe 50%, 
#bae6fd 100%);">
    <!-- Header with ocean gradient -->
    <header class="header-bg fixed top-0 left-0 right-0 z-50 shadow-2xl px-8 py-4 flex justify-between items-center">
        <div class="logo">
            <a href="#" class="text-white text-3xl font-bold uppercase tracking-wider hover:text-accent-light transition-all duration-300 drop-shadow-lg">
                <i class="fas fa-compass mr-3 gold-accent"></i>
                Lakbay Gabay
            </a>
        </div>
        <div class="flex items-center gap-6">
            <span class="text-white text-sm hidden md:block font-medium">
                <i class="fas fa-user-crown mr-2 gold-accent"></i>
                Welcome, <span class="gold-accent font-semibold"><?php echo $_SESSION['admin_username']; ?></span>
            </span>
            <button id="logout-btn" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 pt-32 pb-16">
        <!-- Back to Home Button -->
        <div class="mb-8">
<!--             <a href="index.html" class="inline-flex items-center btn-outline-ocean px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                <i class="fas fa-home mr-3"></i> Back to Home
            </a> -->
        </div>

        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-bold gradient-text mb-4">
                <i class="fas fa-cog mr-4 text-accent-gold"></i>
                Admin Control Panel
            </h1>
            <p class="text-navy text-xl font-medium">Manage your travel destinations with elegance</p>
            <div class="w-32 h-1 bg-gradient-ocean mx-auto mt-6 rounded-full"></div>
        </div>
        <!-- Tabs -->

        <div class="flex flex-wrap justify-center border-b-2 border-accent-light/30 mb-8">
           <button class="tab active px-8 py-4 card-glass text-white border-2 border-ocean-blue rounded-t-xl font-semibold mr-2 mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1 shimmer" data-tab="statistics">
                <i class="fas fa-chart-bar mr-3 text-purple-500"></i> Statistics
            </button>
            
            <button class="tab px-8 py-4 card-glass text-navy border-2 border-gray-300 rounded-t-xl font-semibold mr-2 mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1" data-tab="add">
                <i class="fas fa-plus-circle mr-3 text-accent-gold"></i> Add Spots
            </button>
            <button class="tab px-8 py-4 card-glass text-navy border-2 border-gray-300 rounded-t-xl font-semibold mr-2 mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1" data-tab="manage">
                <i class="fas fa-edit mr-3 text-sky-blue"></i> Manage Spots
            </button>
            <button class="tab px-8 py-4 card-glass text-navy border-2 border-gray-300 rounded-t-xl font-semibold mr-2 mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1" data-tab="users">
                <i class="fas fa-users mr-3 text-turquoise"></i> Manage Users
            </button>
            <button class="tab px-8 py-4 card-glass text-navy border-2 border-gray-300 rounded-t-xl font-semibold mr-2 mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1" data-tab="ratings">
                <i class="fas fa-star mr-3 text-gold"></i> Manage Ratings
            </button>
            <button class="tab px-8 py-4 card-glass text-navy border-2 border-gray-300 rounded-t-xl font-semibold mr-2 mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1" data-tab="messages">
                <i class="fas fa-envelope mr-3 text-blue-500"></i> Messages
            </button>

            <button class="tab px-8 py-4 card-glass text-navy border-2 border-gray-300 rounded-t-xl font-semibold mb-2 transition-all duration-300 hover:shadow-xl hover:scale-105 hover:-translate-y-1" data-tab="featured">
                <i class="fas fa-crown mr-3 text-gold"></i> Featured Spots
            </button>
        </div>
        <!-- Message Alert -->
        <div class="message hidden rounded-xl px-6 py-4 mb-8 text-center font-semibold shadow-lg" id="message"></div>
<!-- Statistics Tab - Updated with Chart Note -->
        <div class="tab-content active card-glass rounded-2xl shadow-2xl p-8 mb-10" id="statistics-tab">
            <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
                <i class="fas fa-chart-bar mr-3 text-purple-500"></i>
                Analytics & Statistics
                <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
            </h2>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="stats-card text-center ">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-map-marker-alt text-3xl text-turquoise"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <h3 class="text-lg font-semibold navy-text">Total Destinations</h3>
                </div>

                <div class="stats-card text-center ">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-users text-3xl text-ocean-blue"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <h3 class="text-lg font-semibold navy-text">Registered Users</h3>
                </div>

                <div class="stats-card text-center ">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-star text-3xl text-gold"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <h3 class="text-lg font-semibold navy-text">Total Reviews</h3>
                </div>

                <div class="stats-card text-center ">
                    <div class="flex items-center justify-center mb-4">
                        <i class="fas fa-envelope text-3xl text-blue-500"></i>
                    </div>
                    <div class="stats-number">0</div>
                    <h3 class="text-lg font-semibold navy-text">Contact Messages</h3>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Destinations by Category Chart - UPDATED -->
                <div class="stats-card">
                    <h3 class="text-xl font-bold navy-text mb-4 text-center">
                        <i class="fas fa-chart-pie mr-2 text-turquoise"></i>
                        Destinations by Category
                    </h3>
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                    <!-- Explanatory note for multiple categories -->
                    <div class="mt-4 px-4 py-3 rounded-lg" style="background: linear-gradient(135deg, rgba(64, 224, 208, 0.1), rgba(0, 168, 204, 0.05)); border-left: 4px solid #40e0d0;">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-info-circle mt-0.5" style="color: #0077be; font-size: 14px; flex-shrink: 0;"></i>
                            <div style="font-size: 13px; color: #2c3e50; line-height: 1.5;">
                                <strong style="color: #0077be;">Note:</strong>
                                <span>Destinations with multiple categories are counted in each category separately. For example, a spot tagged as "Nature & Wildlife, Hidden Wonders" appears in both categories.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Registration Trend Chart -->
                <div class="stats-card">
                    <h3 class="text-xl font-bold navy-text mb-4 text-center">
                        <i class="fas fa-chart-line mr-2 text-ocean-blue"></i>
                        User Registration Trend
                    </h3>
                    <div class="chart-container">
                        <canvas id="userTrendChart"></canvas>
                    </div>
                </div>

                <!-- Rating Distribution Chart -->
                <div class="stats-card">
                    <h3 class="text-xl font-bold navy-text mb-4 text-center">
                        <i class="fas fa-chart-bar mr-2 text-gold"></i>
                        Rating Distribution
                    </h3>
                    <div class="chart-container">
                        <canvas id="ratingChart"></canvas>
                    </div>
                </div>

                <!-- Regional Distribution Chart -->
                <div class="stats-card">
                    <h3 class="text-xl font-bold navy-text mb-4 text-center">
                        <i class="fas fa-map mr-2 text-purple-500"></i>
                        Regional Distribution
                    </h3>
                    <div class="chart-container">
                        <canvas id="regionalChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Tab -->
		<div class="tab-content card-glass rounded-2xl shadow-2xl p-8 mb-10" id="add-tab">
            <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
                <i class="fas fa-map-marker-alt mr-3 text-turquoise"></i>
                Add New Tourist Spot
                <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
            </h2>

            <form id="add-spot-form" enctype="multipart/form-data" class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="name" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map-marker-alt mr-3 text-turquoise"></i> Destination Name:
                        </label>
                        <input type="text" id="name" name="name" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                    </div>
                    <div class="space-y-2">
                        <label for="categories" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-tag mr-3 text-gold"></i> Categories (Select Multiple):
                        </label>
                        <select id="categories" name="categories[]" multiple size="10" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                            <option value="Beaches & Islands">🏝️ Beaches & Islands</option>
                            <option value="Nature & Wildlife">🌿 Nature & Wildlife</option>
                            <option value="Urban & Nightlife">🌃 Urban & Nightlife</option>
                            <option value="Adventure & Extreme Sports">⚡ Adventure & Extreme Sports</option>
                            <option value="Arts & Culture">🎨 Arts & Culture</option>
                            <option value="Festivals & Events">🎉 Festivals & Events</option>
                            <option value="UNESCO Sites">🏛️ UNESCO Sites</option>
                            <option value="Spiritual & Pilgrimage">⛩️ Spiritual & Pilgrimage</option>
                            <option value="Wellness Retreats and Leisure">🧘 Wellness Retreats and Leisure</option>
                            <option value="Hidden Wonders">💎 Hidden Wonders</option>
                        </select>
                        <p class="text-sm text-navy/70 mt-2 italic">Hold Ctrl (or Cmd on Mac) to select multiple categories</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="overview" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-info-circle mr-3 text-ocean-blue"></i> Overview:
                    </label>
                    <textarea id="overview" name="overview" rows="5" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required placeholder="Describe this amazing destination..."></textarea>
                </div>
                <div class="space-y-2">
                    <label for="things_to_do" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-list-ul mr-3 text-sky-blue"></i> Things to Do:
                    </label>
                    <textarea id="things_to_do" name="things_to_do" rows="5" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required placeholder="List exciting activities and attractions..."></textarea>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="operating_hours" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-clock mr-3 text-turquoise"></i> Operating Hours:
                        </label>
                        <textarea id="operating_hours" name="operating_hours" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="When is this place open?"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label for="transportation" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-bus mr-3 text-ocean-blue"></i> Transportation:
                        </label>
                        <textarea id="transportation" name="transportation" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="How to get there..."></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="nearby_accommodations" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-bed mr-3 text-gold"></i> Nearby Accommodations:
                        </label>
                        <textarea id="nearby_accommodations" name="nearby_accommodations" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="Where to stay nearby..."></textarea>
                    </div>
                    <div class="space-y-2">
                        <label for="nearby_restaurants" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-utensils mr-3 text-sky-blue"></i> Nearby Restaurants:
                        </label>
                        <textarea id="nearby_restaurants" name="nearby_restaurants" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="Best dining options nearby..."></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="contact_information" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-phone-alt mr-3 text-turquoise"></i> Contact Information:
                        </label>
                        <textarea id="contact_information" name="contact_information" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="Phone, email, website..."></textarea>
                    </div>
                    <div class="space-y-2">
                        <label for="official_links" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-link mr-3 text-ocean-blue"></i> Official Links:
                        </label>
                        <textarea id="official_links" name="official_links" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="Official websites and social media..."></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="region" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map mr-3 text-gold"></i> Region:
                        </label>
                        <select id="region" name="region" onchange="loadProvinces('add')" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                            <option value="" disabled selected>🗺️ Select Region</option>
                            <option value="NCR">🏙️ National Capital Region</option>
                            <option value="CAR">⛰️ Cordillera Administrative Region</option>
                            <option value="BARMM">🕌 Bangsamoro</option>
                            <option value="NIR">🏝️ Negros Island Region</option>
                            <option value="Region-1">🌾 Region 1 - Ilocos Region</option>
                            <option value="Region-2">🌄 Region 2 - Cagayan Valley</option>
                            <option value="Region-3">🏭 Region 3 - Central Luzon</option>
                            <option value="Region-4A">🌺 Region 4A - Calabarzon</option>
                            <option value="Region-4B">🏖️ Region 4B - Mimaropa</option>
                            <option value="Region-5">🌋 Region 5 - Bicol Region</option>
                            <option value="Region-6">⛵ Region 6 - Western Visayas</option>
                            <option value="Region-7">🏛️ Region 7 - Central Visayas</option>
                            <option value="Region-8">🌊 Region 8 - Eastern Visayas</option>
                            <option value="Region-9">🐚 Region 9 - Zamboanga Peninsula</option>
                            <option value="Region-10">🌿 Region 10 - Northern Mindanao</option>
                            <option value="Region-11">🦅 Region 11 - Davao Region</option>
                            <option value="Region-12">🎣 Region 12 - Socksargen</option>
                            <option value="Region-13">🌴 Region 13 - Caraga</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="province" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map-signs mr-3 text-turquoise"></i> Province:
                        </label>
                        <select id="province" name="province" onchange="loadMunicipalities('add')" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                            <option value="" disabled selected>📍 Select Province</option>
                        </select>
                    </div>


                    <div class="space-y-2">
                        <label for="municipality" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-city mr-3 text-sky-blue"></i> Municipality/City:
                        </label>
                        <select id="municipality" name="municipality" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
                            <option value="" disabled selected>🏘️ Select Municipality/City</option>
                        </select>
                    </div>
                </div>
                    <div class="space-y-2">
                        <label for="local_languages" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-language mr-3 text-purple-500"></i> Local Languages:
                        </label>
                        <textarea id="local_languages" name="local_languages" rows="3" 
                                  class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" 
                                  placeholder="e.g., Tagalog, English, Cebuano, Ilocano"></textarea>
                        <p class="text-sm text-navy/70 mt-2 italic">List the commonly spoken languages in this area</p>
                    </div>

                <div class="space-y-2">
                    <label for="safety_level" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-shield-alt mr-3 text-green-500"></i> Safety Level:
                    </label>
                    <select id="safety_level" name="safety_level" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                        <option value="safe" selected>✅ Safe (Green)</option>
                        <option value="caution">⚠️ Visit with Caution (Yellow)</option>
                        <option value="dangerous">🚫 Dangerous (Red)</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="annual_visitors" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-users mr-3 text-gold"></i> Annual Visitors:
                    </label>
                    <input type="number" id="annual_visitors" name="annual_visitors" min="0" 
                           class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" 
                           placeholder="📊 Enter number of annual visitors">
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="latitude" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map-marker-alt mr-3 text-turquoise"></i> Latitude:
                        </label>
                        <input type="number" step="0.000001" id="latitude" name="latitude" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required placeholder="Click 'Position Pin on Map' or enter manually">
                    </div>
                    <div class="space-y-2">
                        <label for="longitude" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map-marker-alt mr-3 text-ocean-blue"></i> Longitude:
                        </label>
                        <input type="number" step="0.000001" id="longitude" name="longitude" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required placeholder="Click 'Position Pin on Map' or enter manually">
                        <button type="button" id="position-pin-btn" class="mt-4 btn-outline-ocean px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-map-marker-alt mr-3"></i> Position Pin on Map
                        </button>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="images" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-images mr-3 text-sky-blue"></i> Upload Images:
                    </label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                    <div id="image-preview-container" class="mt-6 relative">
                        <div id="image-preview" class="flex flex-wrap gap-4"></div>
                        <button type="button" id="remove-image" class="hidden absolute top-2 right-2 bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-red-600 transition-all duration-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="image_owners" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-user mr-3 text-turquoise"></i> Image Owners (in same order as images):
                    </label>
                    <textarea id="image_owners" name="image_owners" rows="3" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" placeholder="📝 Enter owner names separated by commas, in the same order as the uploaded images"></textarea>
                    <p class="text-sm text-navy/70 mt-2 italic">List the owners of each image in the same order as the uploaded images, separated by commas.</p>
                </div>
                <div class="flex justify-center pt-8">
                    <button type="submit" class="btn-ocean px-12 py-4 text-white font-bold text-lg rounded-xl shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-3 text-gold"></i> Add New Destination
                    </button>
                </div>
            </form>
        </div>
<!-- Management Tab -->
        <div class="tab-content card-glass rounded-2xl shadow-2xl p-8 mb-10" id="manage-tab">
            <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
                <i class="fas fa-edit mr-3 text-sky-blue"></i>
                Manage Tourism Spots
                <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
            </h2>

            <form id="edit-form" enctype="multipart/form-data" class="mt-10 space-y-8 hidden card-glass rounded-2xl p-8 shadow-xl">
                <h3 class="text-2xl font-bold text-center mb-8 navy-text">
                    <i class="fas fa-edit mr-3 text-turquoise"></i>
                    Edit Tourism Spot
                    <div class="w-20 h-1 bg-gradient-accent mx-auto mt-4 rounded-full"></div>
                </h3>
                <input type="hidden" id="edit-id" name="id">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="edit-name" class="block font-bold mb-3 navy-text text-lg">Name:</label>
                        <input type="text" id="edit-name" name="name" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                    </div>
                    <div class="space-y-2">
                        <label for="edit-categories" class="block font-bold mb-3 navy-text text-lg">Categories (Select Multiple):</label>
                        <select id="edit-categories" name="categories[]" multiple size="10" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                            <option value="Beaches & Islands">🏝️ Beaches & Islands</option>
                            <option value="Nature & Wildlife">🌿 Nature & Wildlife</option>
                            <option value="Urban & Nightlife">🌃 Urban & Nightlife</option>
                            <option value="Adventure & Extreme Sports">⚡ Adventure & Extreme Sports</option>
                            <option value="Arts & Culture">🎨 Arts & Culture</option>
                            <option value="Festivals & Events">🎉 Festivals & Events</option>
                            <option value="UNESCO Sites">🏛️ UNESCO Sites</option>
                            <option value="Spiritual & Pilgrimage">⛩️ Spiritual & Pilgrimage</option>
                            <option value="Wellness Retreats and Leisure">🧘 Wellness Retreats and Leisure</option>
                            <option value="Hidden Wonders">💎 Hidden Wonders</option>
                        </select>
                        <p class="text-sm text-navy/70 mt-2 italic">Hold Ctrl (or Cmd on Mac) to select multiple categories</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="edit-overview" class="block font-bold mb-3 navy-text text-lg">Overview:</label>
                    <textarea id="edit-overview" name="overview" rows="5" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required></textarea>
                </div>
                <div class="space-y-2">
                    <label for="edit-things_to_do" class="block font-bold mb-3 navy-text text-lg">Things to Do:</label>
                    <textarea id="edit-things_to_do" name="things_to_do" rows="5" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required></textarea>
                </div>
                <div class="space-y-2">
                    <label for="edit-operating_hours" class="block font-bold mb-3 navy-text text-lg">Operating Hours:</label>
                    <textarea id="edit-operating_hours" name="operating_hours" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80"></textarea>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="edit-nearby_accommodations" class="block font-bold mb-3 navy-text text-lg">Nearby Accommodations:</label>
                        <textarea id="edit-nearby_accommodations" name="nearby_accommodations" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label for="edit-nearby_restaurants" class="block font-bold mb-3 navy-text text-lg">Nearby Restaurants:</label>
                        <textarea id="edit-nearby_restaurants" name="nearby_restaurants" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80"></textarea>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="edit-contact_information" class="block font-bold mb-3 navy-text text-lg">Contact Information:</label>
                        <textarea id="edit-contact_information" name="contact_information" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label for="edit-official_links" class="block font-bold mb-3 navy-text text-lg">Official Links:</label>
                        <textarea id="edit-official_links" name="official_links" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80"></textarea>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="edit-transportation" class="block font-bold mb-3 navy-text text-lg">Transportation:</label>
                    <textarea id="edit-transportation" name="transportation" rows="4" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80"></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="edit-region" class="block font-bold mb-3 navy-text text-lg">Region:</label>
                        <select id="edit-region" name="region" onchange="loadProvinces('edit')" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                            <option value="" disabled selected>Select Region</option>
                            <option value="NCR">🏙️ National Capital Region</option>
                            <option value="CAR">⛰️ Cordillera Administrative Region</option>
                            <option value="BARMM">🕌 Bangsamoro</option>
                            <option value="NIR">🏝️ Negros Island Region</option>
                            <option value="Region-1">🌾 Region 1 - Ilocos Region</option>
                            <option value="Region-2">🌄 Region 2 - Cagayan Valley</option>
                            <option value="Region-3">🏭 Region 3 - Central Luzon</option>
                            <option value="Region-4A">🌺 Region 4A - Calabarzon</option>
                            <option value="Region-4B">🏖️ Region 4B - Mimaropa</option>
                            <option value="Region-5">🌋 Region 5 - Bicol Region</option>
                            <option value="Region-6">⛵ Region 6 - Western Visayas</option>
                            <option value="Region-7">🏛️ Region 7 - Central Visayas</option>
                            <option value="Region-8">🌊 Region 8 - Eastern Visayas</option>
                            <option value="Region-9">🐚 Region 9 - Zamboanga Peninsula</option>
                            <option value="Region-10">🌿 Region 10 - Northern Mindanao</option>
                            <option value="Region-11">🦅 Region 11 - Davao Region</option>
                            <option value="Region-12">🎣 Region 12 - Socksargen</option>
                            <option value="Region-13">🌴 Region 13 - Caraga</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="edit-province" class="block font-bold mb-3 navy-text text-lg">Province:</label>
                        <select id="edit-province" name="province" onchange="loadMunicipalities('edit')" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                            <option value="" disabled selected>Select Province</option>
                        </select>
                    </div>


                    
                    <div class="space-y-2">
                        <label for="edit-municipality" class="block font-bold mb-3 navy-text text-lg">Municipality/City:</label>
                        <select id="edit-municipality" name="municipality" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
                            <option value="" disabled selected>Select Municipality/City</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-user mr-3 text-turquoise"></i> Image Owners:
                    </label>
                    <div id="image-owners-container" class="space-y-3 mb-6 min-h-[80px] p-6 border-2 border-sky-blue/30 rounded-xl bg-white/50">
                        <!-- Image owner fields will be dynamically added here -->
                    </div>
                </div>
                
                    <div class="space-y-2">
                        <label for="edit-local_languages" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-language mr-3 text-purple-500"></i> Local Languages:
                        </label>
                        <textarea id="edit-local_languages" name="local_languages" rows="3" 
                                  class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" 
                                  placeholder="e.g., Tagalog, English, Cebuano, Ilocano"></textarea>
                        <p class="text-sm text-navy/70 mt-2 italic">List the commonly spoken languages in this area</p>
                    </div>

                <div class="space-y-2">
                    <label for="new_image_owner" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-user-plus mr-3 text-gold"></i> Owner for New Images:
                    </label>
                    <input type="text" id="new_image_owner" name="new_image_owner" 
                           class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" 
                           placeholder="Enter owner name for new images">
                </div>

                <div class="space-y-2">
                    <label class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-images mr-3 text-sky-blue"></i> Current Images:
                    </label>
                    <div id="current-images-container" class="flex flex-wrap gap-6 mb-6 min-h-[120px] p-6 border-2 border-sky-blue/30 rounded-xl bg-white/50">
                        <!-- Current images will be displayed here -->
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="edit-safety_level" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-shield-alt mr-3 text-green-500"></i> Safety Level:
                    </label>
                    <select id="edit-safety_level" name="safety_level" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required>
                        <option value="safe">Safe (Green)</option>
                        <option value="caution">Visit with Caution (Yellow)</option>
                        <option value="dangerous">Dangerous (Red)</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="edit-annual_visitors" class="block font-bold mb-3 navy-text text-lg">
                        <i class="fas fa-users mr-3 text-gold"></i> Annual Visitors:
                    </label>
                    <input type="number" id="edit-annual_visitors" name="annual_visitors" min="0" 
                           class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" 
                           placeholder="Enter number of annual visitors">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="edit-latitude" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map-marker-alt mr-3 text-turquoise"></i> Latitude:
                        </label>
                        <input type="number" step="0.000001" id="edit-latitude" name="latitude" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required placeholder="Click 'Position Pin on Map' or enter manually">
                    </div>
                    <div class="space-y-2">
                        <label for="edit-longitude" class="block font-bold mb-3 navy-text text-lg">
                            <i class="fas fa-map-marker-alt mr-3 text-ocean-blue"></i> Longitude:
                        </label>
                        <input type="number" step="0.000001" id="edit-longitude" name="longitude" class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80" required placeholder="Click 'Position Pin on Map' or enter manually">
                        <button type="button" id="edit-position-pin-btn" class="mt-4 btn-outline-ocean px-6 py-3 rounded-xl font-semibold transition-colors shadow-lg">
                            <i class="fas fa-map-marker-alt mr-3"></i> Position Pin on Map
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="edit-new-images" class="block font-bold mb-3 navy-text text-lg">Upload New Images (leave empty to keep current images):</label>
                    <input type="file" id="edit-new-images" name="new_images[]" accept="image/*" multiple class="w-full px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
                    <div id="edit-image-preview-container" class="mt-6 relative">
                        <div id="edit-image-preview" class="flex flex-wrap gap-4"></div>
                        <button type="button" id="remove-edit-image" class="hidden absolute top-2 right-2 bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-red-600 transition-all duration-300">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <div class="flex justify-center gap-6 pt-8">
                    <button type="submit" class="btn-ocean px-10 py-4 text-white font-bold text-lg rounded-xl shadow-xl transition-colors">
                        <i class="fas fa-save mr-3 text-gold"></i> Update Spot
                    </button>
                    <button type="button" id="cancel-edit" class="btn-outline-ocean px-10 py-4 font-bold text-lg rounded-xl shadow-xl transition-colors">
                        <i class="fas fa-times mr-3"></i> Cancel
                    </button>
                </div>
            </form>

			<br>   
            <!-- Search and Filter Section -->
            <div class="flex flex-col gap-6 mb-8">
                <!-- Search Row -->
                <div class="flex flex-col lg:flex-row gap-4">
                    <input type="text" id="search-input" placeholder="🔍 Search by name, region, province..." 
                           class="flex-grow px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
                    <button id="search-button" class="btn-ocean px-8 py-4 text-white font-semibold rounded-xl transition-colors shadow-lg whitespace-nowrap">
                        <i class="fas fa-search mr-3"></i> Search
                    </button>
                </div>
        
        <!-- Filter Row -->
                <div class="flex flex-col lg:flex-row gap-4">
                    <select id="category-filter" class="flex-grow px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
                        <option value="">🏷️ All Categories</option>
                        <option value="Beaches & Islands">🏝️ Beaches & Islands</option>
                        <option value="Nature & Wildlife">🌿 Nature & Wildlife</option>
                        <option value="Urban & Nightlife">🌃 Urban & Nightlife</option>
                        <option value="Adventure & Extreme Sports">⚡ Adventure & Extreme Sports</option>
                        <option value="Arts & Culture">🎨 Arts & Culture</option>
                        <option value="Festivals & Events">🎉 Festivals & Events</option>
                        <option value="UNESCO Sites">🏛️ UNESCO Sites</option>
                        <option value="Spiritual & Pilgrimage">⛩️ Spiritual & Pilgrimage</option>
                        <option value="Wellness Retreats and Leisure">🧘 Wellness Retreats and Leisure</option>
                        <option value="Hidden Wonders">💎 Hidden Wonders</option>
                    </select>
                    <button id="clear-filters" class="btn-outline-ocean px-8 py-4 rounded-xl font-semibold transition-colors shadow-lg whitespace-nowrap">
                        <i class="fas fa-times mr-3"></i> Clear Filters
                    </button>
                </div>
            </div>

            <div id="spots-table-container" class="overflow-x-auto rounded-xl shadow-xl">
                <table id="spots-table" class="w-full bg-white/90 rounded-xl overflow-hidden">
                    <thead style="background: linear-gradient(135deg, #2c3e50 0%, #0077be 100%);">
                        <tr class="text-left">
                            <th class="px-6 py-4 font-bold text-white">ID</th>
                            <th class="px-6 py-4 font-bold text-white">Name</th>
                            <th class="px-6 py-4 font-bold text-white">Category</th>
                            <th class="px-6 py-4 font-bold text-white">Address</th>
                            <th class="px-6 py-4 font-bold text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="spots-list" class="divide-y divide-gray-200">
                        <!-- Data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Users Tab -->
        <div class="tab-content card-glass rounded-2xl shadow-2xl p-8 mb-10" id="users-tab">
            <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
                <i class="fas fa-users mr-3 text-turquoise"></i>
                Manage Users
                <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
            </h2>
            <div class="overflow-x-auto rounded-xl shadow-xl">
                <table id="users-table" class="w-full bg-white/90 rounded-xl overflow-hidden">
                    <thead style="background: linear-gradient(135deg, #2c3e50 0%, #0077be 100%);">
                        <tr class="text-left">
                            <th class="px-6 py-4 font-bold text-white">ID</th>
                            <th class="px-6 py-4 font-bold text-white">Username</th>
                            <th class="px-6 py-4 font-bold text-white">Email</th>
                            <th class="px-6 py-4 font-bold text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Users will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ratings Tab -->
        <div class="tab-content card-glass rounded-2xl shadow-2xl p-8 mb-10" id="ratings-tab">
            <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
                <i class="fas fa-star mr-3 text-gold"></i>
                Manage Ratings
                <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
            </h2>
            <div class="overflow-x-auto rounded-xl shadow-xl">
                <table id="ratings-table" class="w-full bg-white/90 rounded-xl overflow-hidden">
                    <thead style="background: linear-gradient(135deg, #2c3e50 0%, #0077be 100%);">
                        <tr class="text-left">
                            <th class="px-6 py-4 font-bold text-white">ID</th>
                            <th class="px-6 py-4 font-bold text-white">User</th>
                            <th class="px-6 py-4 font-bold text-white">Spot</th>
                            <th class="px-6 py-4 font-bold text-white">Rating</th>
                            <th class="px-6 py-4 font-bold text-white">Comment</th>
                            <th class="px-6 py-4 font-bold text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Ratings will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>

<!-- Messages Tab -->
<div class="tab-content card-glass rounded-2xl shadow-2xl p-8 mb-10" id="messages-tab">
    <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
        <i class="fas fa-envelope mr-3 text-blue-500"></i>
        Contact Messages
        <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
    </h2>
    
    <div class="flex flex-col lg:flex-row gap-6 mb-8">
        <input type="text" id="message-search" placeholder="🔍 Search messages..." class="flex-grow px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
        <select id="message-status-filter" class="px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
            <option value="">All Status</option>
            <option value="unread">Unread</option>
            <option value="read">Read</option>
            <option value="replied">Replied</option>
        </select>
        <button id="message-search-btn" class="btn-ocean px-8 py-4 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
            <i class="fas fa-search mr-3"></i> Search
        </button>
        <button id="message-clear-search" class="btn-outline-ocean px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
            <i class="fas fa-times mr-3"></i> Clear
        </button>
    </div>
    
    <div class="overflow-x-auto rounded-xl shadow-xl">
        <table class="w-full bg-white/90 rounded-xl overflow-hidden">
            <thead style="background: linear-gradient(135deg, #2c3e50 0%, #0077be 100%);">
                <tr class="text-left">
                    <th class="px-6 py-4 font-bold text-white">ID</th>
                    <th class="px-6 py-4 font-bold text-white">Name</th>
                    <th class="px-6 py-4 font-bold text-white">Email</th>
                    <th class="px-6 py-4 font-bold text-white">Subject</th>
                    <th class="px-6 py-4 font-bold text-white">Date</th>
                    <th class="px-6 py-4 font-bold text-white">Status</th>
                    <th class="px-6 py-4 font-bold text-white">Actions</th>
                </tr>
            </thead>
            <tbody id="messages-list" class="divide-y divide-gray-200">
                <!-- Messages will be populated here -->
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-envelope-open-text text-4xl mb-4 text-gray-300"></i>
                        <p class="text-lg">No messages available yet</p>
                        <p class="text-sm mt-2">Messages from the contact form will appear here</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Statistics Tab -->

        <!-- Featured Tab -->
        <div class="tab-content card-glass  rounded-2xl shadow-2xl p-8 mb-10" id="featured-tab">
            <h2 class="text-3xl font-bold text-center mb-8 relative navy-text">
                <i class="fas fa-crown mr-3 text-gold"></i>
                Manage Featured Destinations
                <div class="w-24 h-1 bg-gradient-accent mx-auto mt-6 rounded-full"></div>
            </h2>
            
            <div class="mb-8 card-glass rounded-xl p-6">
                <p class="text-navy text-lg mb-6 font-medium">Select which destinations should appear as featured on the homepage. The spots will be displayed.</p>
                <div class="flex flex-col lg:flex-row gap-6 mb-6">
                    <input type="text" id="featured-search" placeholder="🔍 Search spots..." class="flex-grow px-6 py-4 border-2 border-sky-blue/30 rounded-xl focus:ring-4 focus:ring-turquoise/20 focus:border-turquoise transition-all duration-300 input-ocean bg-white/80">
                    <button id="featured-search-btn" class="btn-ocean px-8 py-4 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-search mr-3"></i> Search
                    </button>
                    <button id="featured-clear-search" class="btn-outline-ocean px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-times mr-3"></i> Clear
                    </button>
                </div>
            </div>
            
            <div class="overflow-x-auto rounded-xl shadow-xl">
                <table class="w-full bg-white/90 rounded-xl overflow-hidden">
                    <thead style="background: linear-gradient(135deg, #2c3e50 0%, #0077be 100%);">
                        <tr class="text-left">
                            <th class="px-6 py-4 font-bold text-white">Featured</th>
                            <th class="px-6 py-4 font-bold text-white">ID</th>
                            <th class="px-6 py-4 font-bold text-white">Name</th>
                            <th class="px-6 py-4 font-bold text-white">Category</th>
                            <th class="px-6 py-4 font-bold text-white">Annual Visitors</th>
                        </tr>
                    </thead>
                    <tbody id="featured-spots-list" class="divide-y divide-gray-200">
                        <!-- Featured spots will be populated here -->
                    </tbody>
                </table>
            </div>
            
            <div class="mt-10 flex justify-center">
                <button id="save-featured-btn" class="btn-ocean px-12 py-4 text-white font-bold text-lg rounded-xl shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-3 text-gold"></i> Save Featured Selection
                </button>
            </div>
        </div>

        <!-- Position Pin Modal -->
        <div id="position-pin-modal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm hidden">
            <div class="relative bg-white rounded-2xl w-full max-w-5xl h-[85vh] mx-auto my-[7.5vh] p-8 flex flex-col shadow-2xl">
                <button id="close-position-modal" class="absolute top-6 right-6 text-3xl text-gray-800 hover:text-red-500 transition-colors duration-300 z-10">
                    <i class="fas fa-times"></i>
                </button>
                <h3 class="text-2xl font-bold mb-6 navy-text text-center">
                    <i class="fas fa-map-marker-alt mr-3 text-turquoise"></i>
                    Click on the map to position the pin
                </h3>

                <!-- Leaflet Map Container -->
                <div class="flex-1 relative border-2 border-turquoise/30 rounded-xl shadow-inner overflow-hidden">
                    <div id="admin-leaflet-map" style="width: 100%; height: 100%;"></div>
                </div>

                <div class="position-coordinates text-center my-6 font-bold text-lg navy-text bg-gradient-accent/20 rounded-xl p-4">
                    <span class="inline-flex items-center mr-6">
                        <i class="fas fa-map-marker-alt mr-2 text-turquoise"></i>
                        Latitude: <span id="current-lat" class="text-ocean-blue ml-2 font-mono">0</span>
                    </span>
                    <span class="inline-flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-sky-blue"></i>
                        Longitude: <span id="current-lng" class="text-ocean-blue ml-2 font-mono">0</span>
                    </span>
                </div>
                <button id="save-position-btn" class="btn-ocean px-10 py-4 text-white font-bold text-lg rounded-xl self-center shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-save mr-3 text-gold"></i> Save Position
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-dark text-white py-8 mt-16">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center items-center mb-4">
                <i class="fas fa-compass mr-3 text-gold text-2xl"></i>
                <h3 class="text-2xl font-bold">Lakbay Gabay Admin</h3>
            </div>
            <p class="text-ice-blue/80 mb-4">Manage your Philippine travel destinations with elegance and precision</p>
            <div class="flex justify-center gap-6 mb-4">
            </div>
            <div class="w-32 h-1 bg-gradient-accent mx-auto mb-4 rounded-full"></div>
            <p class="text-sm text-ice-blue/60">© 2025 Lakbay Gabay. Crafted with passion for Philippine tourism.</p>
        </div>
    </footer>


    <script src="admin.js"></script>
    
    <!-- Additional JavaScript for enhanced UX -->
    <script>
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs and reset their styling
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active', 'text-white', 'border-ocean-blue');
                t.classList.add('text-navy', 'border-gray-300');
                // Remove shimmer animation from all tabs
                t.classList.remove('shimmer');
                // Clear any inline styles
                t.style.background = '';
                t.style.color = '';
                t.style.borderColor = '';
            });
            
            // Add active class to clicked tab
            this.classList.add('active');
            this.classList.remove('text-navy', 'border-gray-300');
            this.classList.add('text-white', 'border-ocean-blue');
            // Add shimmer animation to active tab
            this.classList.add('shimmer');
            
            // Handle tab content visibility
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById(this.dataset.tab + '-tab').classList.add('active');
            
            // Clear any messages
            const message = document.getElementById('message');
            message.textContent = '';
            message.className = 'message hidden';
            
            // Load data for specific tabs if needed
            if (this.dataset.tab === 'manage') {
                loadSpots();
            } else if (this.dataset.tab === 'featured') {
                if (document.getElementById('featured-spots-list').children.length === 0) {
                    loadFeaturedSpots();
                }
            }
        });
    });

    // Add shimmer effect to buttons on hover
    const buttons = document.querySelectorAll('.btn-ocean, .btn-outline-ocean');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.classList.add('shimmer');
        });
        button.addEventListener('mouseleave', function() {
            this.classList.remove('shimmer');
        });
    });

    // Enhanced form validation with visual feedback
    const inputs = document.querySelectorAll('input[required], textarea[required], select[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.style.borderColor = '#ef4444';
                this.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            } else {
                this.style.borderColor = '#40e0d0';
                this.style.boxShadow = '0 0 0 3px rgba(64, 224, 208, 0.1)';
            }
        });
    });

    // Add loading states to form submissions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = this.querySelector('button[type="submit"]');
            if (submitButton) {
                const originalText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
                submitButton.disabled = true;
                
                // Re-enable after 3 seconds (adjust based on your needs)
                setTimeout(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 3000);
            }
        });
    });

    // Enhanced hover effects for cards
    const cards = document.querySelectorAll('.card-hover');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
            this.style.boxShadow = '0 25px 50px rgba(0, 119, 190, 0.25)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
        });
    });

    // Floating animation for logo
    const logo = document.querySelector('.floating-animation');
    if (logo) {
        setInterval(() => {
            logo.style.transform = 'translateY(-5px)';
            setTimeout(() => {
                logo.style.transform = 'translateY(0px)';
            }, 3000);
        }, 6000);
    }

    // Add ripple effect to buttons
    function addRippleEffect(element) {
        element.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    }

    // Apply ripple effect to all buttons
    document.querySelectorAll('button').forEach(addRippleEffect);

    // Add CSS for ripple effect - only if it doesn't exist already
    if (!document.querySelector('style[data-ripple-style]')) {
        const rippleCSS = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.6);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            button {
                position: relative;
                overflow: hidden;
            }
        `;
        
        const style = document.createElement('style');
        style.textContent = rippleCSS;
        style.setAttribute('data-ripple-style', 'true');
        document.head.appendChild(style);
    }

    // Initialize placeholder charts for statistics


// Add this to your existing admin.js file

// Global chart instances
// Global chart instances
let categoryChart = null;
let userTrendChart = null;
let ratingChart = null;
let regionalChart = null;

// Initialize charts with real data
function initializeChartsWithData() {
    fetch('get_statistics.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Statistics error:', data.error);
                // Initialize with empty data if error
                createCategoryChart([]);
                createRegionalChart([]);
                return;
            }
            
            // Update stat cards
            updateStatCards(data);
            
            // Initialize charts with real data
            createCategoryChart(data.categories || []);
            createRegionalChart(data.regions || []);
            createUserTrendChart(data.user_trend || []);
            createRatingChart(data.ratings || []);
        })
        .catch(error => {
            console.error('Error loading statistics:', error);
            // Initialize with empty data if fetch fails
            createCategoryChart([]);
            createRegionalChart([]);
            createUserTrendChart([]);
            createRatingChart([]);
        });
}

// Update stat cards
function updateStatCards(data) {
    const statElements = document.querySelectorAll('.stats-number');
    if (statElements.length >= 4) {
        statElements[0].textContent = data.total_destinations || 0;
        statElements[1].textContent = data.total_users || 0;
        statElements[2].textContent = data.total_reviews || 0;
        statElements[3].textContent = data.total_messages || 0;
    }
}

// Category Chart (Doughnut) - Enhanced with better styling and data handling
// Category Chart (Doughnut) - Updated for Multiple Categories (Option 1)
function createCategoryChart(categories) {
    const ctx = document.getElementById('categoryChart');
    if (!ctx) return;
    
    // Destroy existing chart if it exists
    if (categoryChart) {
        categoryChart.destroy();
    }
    
    // Handle empty data
    if (!categories || categories.length === 0) {
        const labels = ['No Destinations Yet'];
        const data = [1];
        const colors = ['#e5e7eb'];
        
        categoryChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#f3f4f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: { size: 12 },
                            color: '#6b7280'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'No data available';
                            }
                        }
                    }
                }
            }
        });
        return;
    }
    
    // OPTION 1: Split multiple categories and count individually
    const categoryCounts = {};
    
    // Process categories - split combinations and count each separately
    categories.forEach(item => {
        // Split by comma to handle multiple categories
        const categoryList = item.category.split(',').map(cat => cat.trim());
        const count = parseInt(item.count);
        
        categoryList.forEach(singleCategory => {
            if (categoryCounts[singleCategory]) {
                categoryCounts[singleCategory] += count;
            } else {
                categoryCounts[singleCategory] = count;
            }
        });
    });
    
    // Convert to arrays for Chart.js
    const processedCategories = Object.entries(categoryCounts).map(([category, count]) => ({
        category: category,
        count: count
    }));
    
    // Sort by count descending
    processedCategories.sort((a, b) => b.count - a.count);
    
    // Enhanced color palette for tourism categories (your original colors)
    const filterColors = {
        'Beaches & Islands': '#40E0D0',         // turquoise
        'Nature & Wildlife': '#228B22',         // forest green
        'Urban & Nightlife': '#A020F0',         // purple
        'Adventure & Extreme Sports': '#FFA500', // orange
        'Arts & Culture': '#EA2432',            // red
        'Festivals & Events': '#FFFF00',        // yellow
        'UNESCO Sites': '#A52A2A',              // brown
        'Spiritual & Pilgrimage': '#57B9FF',    // light blue
        'Hidden Wonders': '#272757',            // dark blue
        'Wellness Retreats and Leisure': '#FF8DA1' // pink
    };
    
    // Shorten category names for better display
    const shortNames = {
        'Beaches & Islands': 'Beaches',
        'Nature & Wildlife': 'Nature',
        'Urban & Nightlife': 'Urban',
        'Adventure & Extreme Sports': 'Adventure',
        'Arts & Culture': 'Arts',
        'Festivals & Events': 'Festivals',
        'UNESCO Sites': 'UNESCO',
        'Spiritual & Pilgrimage': 'Spiritual',
        'Wellness Retreats and Leisure': 'Wellness',
        'Hidden Wonders': 'Hidden'
    };
    
    const labels = processedCategories.map(c => shortNames[c.category] || c.category);
    const data = processedCategories.map(c => c.count);
    const colors = processedCategories.map(c => filterColors[c.category] || '#6B7280');
    
    categoryChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: colors,
                borderWidth: 3,
                borderColor: '#fff',
                hoverBorderWidth: 4,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%', // Makes it a proper donut
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: { 
                            size: 13,
                            weight: '500'
                        },
                        color: '#374151',
                        generateLabels: function(chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map((label, i) => {
                                    const value = data.datasets[0].data[i];
                                    const fullLabel = processedCategories[i].category;
                                    return {
                                        text: `${label}: ${value}`,
                                        fillStyle: data.datasets[0].backgroundColor[i],
                                        hidden: false,
                                        index: i,
                                        // Store full category name for tooltip
                                        fullCategory: fullLabel
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#40e0d0',
                    borderWidth: 1,
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        title: function(context) {
                            return processedCategories[context[0].dataIndex].category;
                        },
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                            const plural = context.parsed === 1 ? 'destination' : 'destinations';
                            return `${context.parsed} ${plural} (${percentage}%)`;
                        },
                        afterLabel: function(context) {
                            return '\n💡 Spots with multiple categories are counted in each';
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1500,
                easing: 'easeOutQuart'
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

// Regional Distribution Chart (Horizontal Bar) - Enhanced for Philippine regions
function createRegionalChart(regions) {
    const ctx = document.getElementById('regionalChart');
    if (!ctx) return;
    
    if (regionalChart) {
        regionalChart.destroy();
    }
    
    // Handle empty data
    if (!regions || regions.length === 0) {
        const labels = ['No Regional Data'];
        const data = [0];
        
        regionalChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Destinations',
                    data: data,
                    backgroundColor: ['#e5e7eb'],
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function() {
                                return 'No data available';
                            }
                        }
                    }
                },
                scales: {
                    x: { beginAtZero: true },
                    y: { grid: { display: false } }
                }
            }
        });
        return;
    }
    
    // Process real data - sort by count descending and take top 10
    const sortedRegions = [...regions]
        .sort((a, b) => parseInt(b.count) - parseInt(a.count))
        .slice(0, 10);
    
    const labels = sortedRegions.map(r => {
        // Shorten region names for better display
        const regionShortNames = {
            'National Capital Region': 'NCR',
            'Cordillera Administrative Region': 'CAR',
            'Bangsamoro': 'BARMM',
            'Negros Island Region': 'NIR',
            'Region 1 - Ilocos Region': 'Region 1',
            'Region 2 - Cagayan Valley': 'Region 2', 
            'Region 3 - Central Luzon': 'Region 3',
            'Region 4A - Calabarzon': 'Region 4A',
            'Region 4B - Mimaropa': 'Region 4B',
            'Region 5 - Bicol Region': 'Region 5',
            'Region 6 - Western Visayas': 'Region 6',
            'Region 7 - Central Visayas': 'Region 7',
            'Region 8 - Eastern Visayas': 'Region 8',
            'Region 9 - Zamboanga Peninsula': 'Region 9',
            'Region 10 - Northern Mindanao': 'Region 10',
            'Region 11 - Davao Region': 'Region 11',
            'Region 12 - Socksargen': 'Region 12',
            'Region 13 - Caraga': 'Region 13'
        };
        return regionShortNames[r.region] || r.region;
    });
    
    const data = sortedRegions.map(r => parseInt(r.count));
    
    // Create gradient colors based on data values
    const maxValue = Math.max(...data);
    const backgroundColors = data.map(value => {
        const intensity = value / maxValue;
        // Gradient from light blue to dark blue based on value
        const red = Math.floor(64 + (224 - 64) * (1 - intensity));
        const green = Math.floor(224 + (224 - 224) * (1 - intensity));
        const blue = Math.floor(208 + (208 - 208) * (1 - intensity));
        return `rgb(${red}, ${green}, ${blue})`;
    });
    
    regionalChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Destinations',
                data: data,
                backgroundColor: backgroundColors,
                borderRadius: 8,
                borderSkipped: false,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawBorder: false
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#6b7280',
                        font: { size: 12 }
                    },
                    title: {
                        display: true,
                        text: 'Number of Destinations',
                        color: '#374151',
                        font: { size: 14, weight: 'bold' }
                    }
                },
                y: {
                    grid: { display: false },
                    ticks: {
                        color: '#374151',
                        font: { size: 12, weight: '500' }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#40e0d0',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: {
                        title: function(context) {
                            return context[0].label;
                        },
                        label: function(context) {
                            const value = context.parsed.x;
                            const plural = value === 1 ? 'destination' : 'destinations';
                            return `${value} ${plural}`;
                        }
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

// User Trend Chart (Line) - Placeholder for now
function createUserTrendChart(userTrend) {
    const ctx = document.getElementById('userTrendChart');
    if (!ctx) return;
    
    if (userTrendChart) {
        userTrendChart.destroy();
    }
    
    const labels = userTrend.length > 0 ? userTrend.map(u => u.month) : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
    const data = userTrend.length > 0 ? userTrend.map(u => parseInt(u.count)) : [0, 0, 0, 0, 0, 0];
    
    userTrendChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'New Users',
                data: data,
                borderColor: '#0077be',
                backgroundColor: 'rgba(0, 119, 190, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#0077be',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.1)' }
                },
                x: {
                    grid: { color: 'rgba(0, 0, 0, 0.1)' }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
}

// Rating Chart (Bar) - Enhanced with better colors
function createRatingChart(ratings) {
    const ctx = document.getElementById('ratingChart');
    if (!ctx) return;
    
    if (ratingChart) {
        ratingChart.destroy();
    }
    
    // Create array for all ratings 1-5, filling in missing ratings with 0
    const ratingData = [];
    const labels = ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'];
    const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#10b981'];
    
    for (let i = 1; i <= 5; i++) {
        const found = ratings.find(r => parseInt(r.rating) === i);
        ratingData.push(found ? parseInt(found.count) : 0);
    }
    
    ratingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Number of Reviews',
                data: ratingData,
                backgroundColor: colors,
                borderRadius: 8,
                borderSkipped: false,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.1)' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        title: function(context) {
                            return context[0].label;
                        },
                        label: function(context) {
                            const value = context.parsed.y;
                            const plural = value === 1 ? 'review' : 'reviews';
                            return `${value} ${plural}`;
                        }
                    }
                }
            }
        }
    });
}

// Initialize charts when statistics tab is clicked
document.addEventListener('DOMContentLoaded', function() {
    const statisticsTab = document.querySelector('[data-tab="statistics"]');
    if (statisticsTab) {
        let chartsInitialized = false;
        
        statisticsTab.addEventListener('click', function() {
            if (!chartsInitialized) {
                setTimeout(() => {
                    initializeChartsWithData();
                    chartsInitialized = true;
                }, 150);
            }
        });
    }
});

// Refresh statistics function (can be called when needed)
function refreshStatistics() {
    initializeChartsWithData();
}

let messagesData = [];
let currentPage = 1;
const messagesPerPage = 10;

// Initialize messages tab
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('messages-tab')) {
        console.log('Messages tab found, loading messages...');
        loadMessages();
        setupMessageEventListeners();
    }
});

function setupMessageEventListeners() {
    const searchBtn = document.getElementById('message-search-btn');
    const clearSearchBtn = document.getElementById('message-clear-search');
    const searchInput = document.getElementById('message-search');
    const statusFilter = document.getElementById('message-status-filter');

    searchBtn?.addEventListener('click', () => {
        currentPage = 1;
        loadMessages();
    });

    clearSearchBtn?.addEventListener('click', () => {
        searchInput.value = '';
        statusFilter.value = '';
        currentPage = 1;
        loadMessages();
    });

    searchInput?.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            currentPage = 1;
            loadMessages();
        }
    });

    statusFilter?.addEventListener('change', () => {
        currentPage = 1;
        loadMessages();
    });
}

async function loadMessages() {
    try {
        console.log('Starting to load messages...');
        showLoadingState();
        
        const searchValue = document.getElementById('message-search')?.value || '';
        const statusValue = document.getElementById('message-status-filter')?.value || '';
        const offset = (currentPage - 1) * messagesPerPage;
        
        const params = new URLSearchParams({
            search: searchValue,
            status: statusValue,
            limit: messagesPerPage,
            offset: offset,
            sort: 'created_at',
            order: 'DESC'
        });
        
        console.log('Fetching:', `admin/api/messages.php?${params}`);
        const response = await fetch(`admin/api/messages.php?${params}`);
        
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Response data:', data);
        
        if (data.success) {
            messagesData = data.data || [];
            console.log('Messages loaded:', messagesData.length);
            displayMessages(messagesData);
            updatePagination(data.total || 0, data.limit || messagesPerPage, data.offset || 0);
        } else {
            showError('Failed to load messages: ' + (data.message || 'Unknown error'));
        }
        
    } catch (error) {
        console.error('Error loading messages:', error);
        showError('Failed to load messages: ' + error.message);
    }
}

function displayMessages(messages) {
    const messagesList = document.getElementById('messages-list');
    
    if (!messagesList) {
        console.error('messages-list element not found!');
        return;
    }
    
    if (!messages || messages.length === 0) {
        messagesList.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-envelope-open-text text-4xl mb-4 text-gray-300"></i>
                    <p class="text-lg">No messages found</p>
                    <p class="text-sm mt-2">Try adjusting your search criteria</p>
                </td>
            </tr>
        `;
        return;
    }
    
    messagesList.innerHTML = messages.map(message => `
        <tr class="hover:bg-gray-50 transition-colors duration-200 ${message.status === 'unread' ? 'bg-blue-50' : ''}">
            <td class="px-6 py-4 font-medium text-gray-900">#${message.id}</td>
            <td class="px-6 py-4">
                <div class="font-medium text-gray-900">${escapeHtml(message.full_name)}</div>
                ${message.phone ? `<div class="text-sm text-gray-500">${escapeHtml(message.phone)}</div>` : ''}
            </td>
            <td class="px-6 py-4">
                <div class="text-gray-900">${escapeHtml(message.email)}</div>
            </td>
            <td class="px-6 py-4">
                <div class="font-medium text-gray-900">${escapeHtml(message.subject)}</div>
                <div class="text-sm text-gray-500 mt-1">${escapeHtml(message.message_preview || (message.message ? message.message.substring(0, 50) + '...' : ''))}</div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                ${message.created_at_formatted || new Date(message.created_at).toLocaleString()}
            </td>
            <td class="px-6 py-4">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusClasses(message.status)}">
                    ${getStatusIcon(message.status)} ${capitalizeFirst(message.status)}
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="flex items-center justify-start gap-3">
                    <button onclick="viewMessage(${message.id})" class="text-blue-600 hover:text-blue-900 transition-colors" title="View Message">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button onclick="markAsRead(${message.id})" class="text-green-600 hover:text-green-900 transition-colors" title="Mark as Read">
                        <i class="fas fa-check"></i>
                    </button>
                    <button onclick="replyToMessage(${message.id})" class="text-purple-600 hover:text-purple-900 transition-colors" title="Reply">
                        <i class="fas fa-reply"></i>
                    </button>
                    <button onclick="deleteMessage(${message.id})" class="text-red-600 hover:text-red-900 transition-colors" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function getStatusClasses(status) {
    switch (status) {
        case 'unread':
            return 'bg-blue-100 text-blue-800';
        case 'read':
            return 'bg-yellow-100 text-yellow-800';
        case 'replied':
            return 'bg-green-100 text-green-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}

function getStatusIcon(status) {
    switch (status) {
        case 'unread':
            return '<i class="fas fa-envelope mr-1"></i>';
        case 'read':
            return '<i class="fas fa-envelope-open mr-1"></i>';
        case 'replied':
            return '<i class="fas fa-reply mr-1"></i>';
        default:
            return '<i class="fas fa-question mr-1"></i>';
    }
}

function capitalizeFirst(str) {
    if (!str) return '';
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function showLoadingState() {
    const messagesList = document.getElementById('messages-list');
    if (messagesList) {
        messagesList.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-spinner fa-spin text-4xl mb-4 text-blue-500"></i>
                    <p class="text-lg">Loading messages...</p>
                </td>
            </tr>
        `;
    }
}

function showError(message) {
    const messagesList = document.getElementById('messages-list');
    if (messagesList) {
        messagesList.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-12 text-center text-red-500">
                    <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                    <p class="text-lg">${escapeHtml(message)}</p>
                    <button onclick="loadMessages()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        Try Again
                    </button>
                </td>
            </tr>
        `;
    }
}

function updatePagination(total, limit, offset) {
    const totalPages = Math.ceil(total / limit);
    currentPage = Math.floor(offset / limit) + 1;
    console.log(`Page ${currentPage} of ${totalPages} (${total} total messages)`);
}

async function viewMessage(messageId) {
    const message = messagesData.find(m => m.id === messageId);
    if (!message) {
        showNotification('Message not found', 'error');
        return;
    }
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Message #${message.id}</h3>
                    <button onclick="this.closest('.fixed').remove()" class="text-white hover:text-gray-200 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="text-lg font-semibold">${escapeHtml(message.full_name)}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <div class="text-lg">${escapeHtml(message.email)}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <div class="text-lg">${escapeHtml(message.phone) || 'Not provided'}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${getStatusClasses(message.status)}">
                            ${getStatusIcon(message.status)} ${capitalizeFirst(message.status)}
                        </span>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <div class="text-lg font-semibold">${escapeHtml(message.subject)}</div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <div class="bg-gray-50 p-4 rounded-lg border">
                        <div class="whitespace-pre-wrap">${escapeHtml(message.message)}</div>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-500">
                    <div>
                        <label class="block font-medium mb-1">Received</label>
                        <div>${message.created_at_formatted || new Date(message.created_at).toLocaleString()}</div>
                    </div>
                    <div>
                        <label class="block font-medium mb-1">Last Updated</label>
                        <div>${new Date(message.updated_at).toLocaleString()}</div>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button onclick="markAsRead(${message.id}); this.closest('.fixed').remove();" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                        <i class="fas fa-check mr-2"></i>Mark as Read
                    </button>
                    <button onclick="replyToMessage(${message.id}); this.closest('.fixed').remove();" class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                        <i class="fas fa-reply mr-2"></i>Reply
                    </button>
                    <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Close
                    </button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    if (message.status === 'unread') {
        await markAsRead(messageId, false);
    }
}

async function markAsRead(messageId, reload = true) {
    try {
        console.log('Marking message as read:', messageId);
        
        const response = await fetch('admin/api/messages.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update',
                id: messageId,
                status: 'read'
            })
        });
        
        console.log('Mark as read response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Response error:', errorText);
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Mark as read response data:', data);
        
        if (data.success) {
            showNotification('Message marked as read', 'success');
            if (reload) {
                await loadMessages();
            }
        } else {
            showNotification('Failed to update message: ' + (data.message || 'Unknown error'), 'error');
        }
        
    } catch (error) {
        console.error('Error updating message:', error);
        showNotification('Failed to update message: ' + error.message, 'error');
    }
}

async function replyToMessage(messageId) {
    const message = messagesData.find(m => m.id === messageId);
    if (!message) {
        showNotification('Message not found', 'error');
        return;
    }
    
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
    modal.innerHTML = `
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="bg-gradient-to-r from-purple-600 to-purple-800 text-white p-6 rounded-t-2xl">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Reply to ${escapeHtml(message.full_name)}</h3>
                    <button onclick="this.closest('.fixed').remove()" class="text-white hover:text-gray-200 text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                    <div class="text-sm text-gray-600 mb-2">Original Message:</div>
                    <div class="font-medium">${escapeHtml(message.subject)}</div>
                    <div class="text-sm text-gray-600 mt-1">"${escapeHtml((message.message_preview || message.message).substring(0, 100))}..."</div>
                </div>
                <form id="reply-form-${messageId}">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" id="reply-subject-${messageId}" value="Re: ${escapeHtml(message.subject)}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Reply Message</label>
                        <textarea id="reply-message-${messageId}" rows="8" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" placeholder="Type your reply here..." required></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="this.closest('.fixed').remove()" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    modal.querySelector(`#reply-form-${messageId}`).addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const submitButton = e.target.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
        submitButton.disabled = true;
        
        const subject = document.getElementById(`reply-subject-${messageId}`).value.trim();
        const replyMessage = document.getElementById(`reply-message-${messageId}`).value.trim();
        
        if (!subject || !replyMessage) {
            showNotification('Subject and message are required', 'error');
            submitButton.innerHTML = originalButtonText;
            submitButton.disabled = false;
            return;
        }
        
        try {
            const response = await fetch('admin/api/reply_handler.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    message_id: messageId,
                    subject: subject,
                    reply_message: replyMessage,
                    admin_name: 'Admin'
                })
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.success) {
                showNotification('Reply sent successfully!', 'success');
                modal.remove();
                await loadMessages();
            } else {
                showNotification('Failed to send reply: ' + (data.message || 'Unknown error'), 'error');
            }
            
        } catch (error) {
            console.error('Error sending reply:', error);
            showNotification('Failed to send reply. Please check your connection.', 'error');
        } finally {
            submitButton.innerHTML = originalButtonText;
            submitButton.disabled = false;
        }
    });
}

async function deleteMessage(messageId) {
    const message = messagesData.find(m => m.id === messageId);
    if (!message) {
        showNotification('Message not found', 'error');
        return;
    }
    
    if (!confirm(`Are you sure you want to delete the message from ${message.full_name}?\n\nThis action cannot be undone.`)) {
        return;
    }
    
    try {
        console.log('Deleting message:', messageId);
        
        const response = await fetch('admin/api/messages.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'delete',
                id: messageId
            })
        });
        
        console.log('Delete response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            console.error('Delete response error:', errorText);
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        console.log('Delete response data:', data);
        
        if (data.success) {
            showNotification('Message deleted successfully', 'success');
            await loadMessages();
        } else {
            showNotification('Failed to delete message: ' + (data.message || 'Unknown error'), 'error');
        }
        
    } catch (error) {
        console.error('Error deleting message:', error);
        showNotification('Failed to delete message: ' + error.message, 'error');
    }
}

function showNotification(message, type = 'info') {
    const existingNotifications = document.querySelectorAll('.admin-notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `admin-notification fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transition-all duration-300 transform translate-x-full`;
    
    const iconMap = {
        success: { class: 'bg-green-500 text-white', icon: 'fa-check-circle' },
        error: { class: 'bg-red-500 text-white', icon: 'fa-exclamation-circle' },
        info: { class: 'bg-blue-500 text-white', icon: 'fa-info-circle' }
    };
    
    const config = iconMap[type] || iconMap.info;
    notification.className += ` ${config.class}`;
    
    notification.innerHTML = `
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas ${config.icon} mr-3"></i>
                <span>${escapeHtml(message)}</span>
            </div>
            <button onclick="this.closest('.admin-notification').remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    setTimeout(() => {
        if (notification.parentElement) {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}
function hideAdminNotification(notification) {
    notification.classList.add('translate-x-full');
    setTimeout(() => {
        notification.remove();
    }, 300);
}






    </script>
</body>
</html>