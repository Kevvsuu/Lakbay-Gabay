<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings - Lakbay Gabay</title>
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

        /* HEADER */
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
            height: 80px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23f0f8ff'/%3E%3C/svg%3E") no-repeat;
            background-size: cover;
        }

        /* CARDS */
        .settings-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(64, 224, 208, 0.2);
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            box-shadow: 0 12px 40px rgba(0, 119, 190, 0.15);
            border-color: var(--turquoise);
        }

        /* SIDEBAR */
        .sidebar-item {
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            border-radius: 12px;
        }

        .sidebar-item:hover {
            background: rgba(64, 224, 208, 0.1);
            border-left-color: var(--turquoise);
        }

        .sidebar-item.active {
            background: linear-gradient(90deg, rgba(64, 224, 208, 0.2) 0%, rgba(64, 224, 208, 0.05) 100%);
            border-left-color: var(--turquoise);
            font-weight: 600;
        }

        /* TABS */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.4s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* INPUTS */
        .input-field {
            background: rgba(240, 248, 255, 0.5);
            border: 2px solid rgba(64, 224, 208, 0.3);
            transition: all 0.3s ease;
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 1rem;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--turquoise);
            background: white;
            box-shadow: 0 0 0 4px rgba(64, 224, 208, 0.1);
        }

        .input-field:disabled,
        .input-field:read-only {
            background: rgba(0, 0, 0, 0.05);
            cursor: not-allowed;
            color: rgba(44, 62, 80, 0.6);
        }

        /* BUTTONS */
        .btn-primary {
            background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--cyan-blue) 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 14px;
            font-weight: 600;
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
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--ocean-blue);
            color: white;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        }

        /* SECTION ICONS */
        .section-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* CHECKBOXES */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 14px 18px;
            border-radius: 14px;
            transition: all 0.3s ease;
            border: 2px solid rgba(64, 224, 208, 0.2);
            background: white;
        }

        .checkbox-wrapper:hover {
            background: rgba(64, 224, 208, 0.05);
            border-color: var(--turquoise);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 119, 190, 0.1);
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 22px;
            height: 22px;
            margin-right: 14px;
            cursor: pointer;
            accent-color: var(--turquoise);
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

        /* NOTIFICATIONS */
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border: 2px solid;
        }

        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* MODAL */
        .modal-backdrop {
            backdrop-filter: blur(8px);
        }

        /* FOOTER */
        .bg-pattern-dots {
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .bg-pattern {
            opacity: 0.1;
        }

        /* DANGER ZONE */
        .danger-zone {
            background: linear-gradient(135deg, rgba(254, 226, 226, 0.5) 0%, rgba(254, 202, 202, 0.5) 100%);
            border: 2px solid rgba(239, 68, 68, 0.3);
            border-radius: 16px;
            padding: 24px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .sidebar-sticky {
                position: relative !important;
                top: 0 !important;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 20px 80px;
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
                    <a href="#" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300" onclick="logout(); return false;">Logout</a>
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
                    <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5"></span>
                    <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5"></span>
                    <span class="hamburger-line block w-6 h-0.5 bg-white"></span>
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
                <a href="#" class="text-white/90 hover:text-turquoise font-medium transition-colors duration-300 py-2" onclick="logout(); return false;">Logout</a>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section pt-32 pb-20 relative">
        <div class="hero-pattern"></div>
        <div class="max-w-7xl mx-auto px-4 lg:px-8 relative z-10">
            <div class="text-center text-white">
                <div class="inline-flex items-center gap-3 bg-white/20 backdrop-blur-md px-6 py-3 rounded-full mb-6 border border-white/30">
                    <i class="fas fa-user-cog text-2xl"></i>
                    <span class="font-semibold text-lg">Account Management</span>
                </div>
                <h1 class="text-5xl lg:text-6xl font-bold font-playfair mb-4">Account Settings</h1>
                <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Manage your profile, security, and preferences</p>
                
                <a href="userdashboard.php" class="btn-secondary inline-flex items-center gap-3">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Dashboard</span>
                </a>
            </div>
        </div>
        <div class="hero-wave"></div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 lg:px-8 pb-20 -mt-8 relative z-20">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Navigation -->
            <div class="lg:w-1/4">
                <div class="settings-card p-6 sidebar-sticky" style="position: sticky; top: 100px;">
                    <h2 class="text-xl font-bold text-dark-blue mb-6 px-2">Settings Menu</h2>
                    <nav class="space-y-2">
                        <div class="sidebar-item active px-4 py-3.5" onclick="switchTab('profile')">
                            <i class="fas fa-user mr-3 text-turquoise"></i>
                            <span>Profile</span>
                        </div>
                        <div class="sidebar-item px-4 py-3.5" onclick="switchTab('password')">
                            <i class="fas fa-lock mr-3 text-turquoise"></i>
                            <span>Password</span>
                        </div>
                        <div class="sidebar-item px-4 py-3.5" onclick="switchTab('email')">
                            <i class="fas fa-envelope mr-3 text-turquoise"></i>
                            <span>Email</span>
                        </div>
                        <div class="sidebar-item px-4 py-3.5" onclick="switchTab('preferences')">
                            <i class="fas fa-sliders-h mr-3 text-turquoise"></i>
                            <span>Preferences</span>
                        </div>
                        <div class="sidebar-item px-4 py-3.5" onclick="switchTab('delete')">
                            <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                            <span class="text-red-600">Delete Account</span>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Content Area -->
            <div class="lg:w-3/4">
                
                <!-- Profile Tab -->
                <div id="profile-tab" class="tab-content active">
                    <div class="settings-card p-8">
                        <div class="flex items-center mb-8">
                            <div class="section-icon mr-4" style="background: linear-gradient(135deg, #ffd700 0%, #ffed4a 100%);">
                                <i class="fas fa-user text-dark-blue"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-dark-blue">Edit Profile</h2>
                                <p class="text-dark-blue/60 text-sm mt-1">Update your account information</p>
                            </div>
                        </div>
                        
                        <form id="edit-profile-form" class="space-y-6">
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Username</label>
                                <input type="text" id="edit-username" required class="w-full input-field" placeholder="Enter your username">
                                <p class="text-xs text-dark-blue/50 mt-2">This is how others will see you on the platform</p>
                            </div>
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Email Address</label>
                                <input type="email" id="display-email" readonly class="w-full input-field" value="Loading...">
                                <p class="text-xs text-dark-blue/50 mt-2">Go to the "Email" tab to update your email address</p>
                            </div>
                            <button type="submit" class="w-full btn-primary">
                                <i class="fas fa-save mr-2"></i>
                                Save Changes
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password Tab -->
                <div id="password-tab" class="tab-content">
                    <div class="settings-card p-8">
                        <div class="flex items-center mb-8">
                            <div class="section-icon mr-4" style="background: linear-gradient(135deg, #0077be 0%, #00a8cc 100%);">
                                <i class="fas fa-lock text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-dark-blue">Change Password</h2>
                                <p class="text-dark-blue/60 text-sm mt-1">Keep your account secure</p>
                            </div>
                        </div>
                        
                        <form id="change-password-form" class="space-y-6">
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Current Password</label>
                                <input type="password" id="current-password" required class="w-full input-field" placeholder="Enter current password">
                            </div>
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">New Password</label>
                                <input type="password" id="new-password" required minlength="8" class="w-full input-field" placeholder="Enter new password">
                                <p class="text-xs text-dark-blue/50 mt-2">Must be at least 8 characters long</p>
                            </div>
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Confirm New Password</label>
                                <input type="password" id="confirm-password" required minlength="8" class="w-full input-field" placeholder="Confirm new password">
                            </div>
                            <button type="submit" class="w-full btn-primary">
                                <i class="fas fa-key mr-2"></i>
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Email Tab -->
                <div id="email-tab" class="tab-content">
                    <div class="settings-card p-8">
                        <div class="flex items-center mb-8">
                            <div class="section-icon mr-4" style="background: linear-gradient(135deg, #40e0d0 0%, #00a8cc 100%);">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-dark-blue">Change Email</h2>
                                <p class="text-dark-blue/60 text-sm mt-1">Update your email address</p>
                            </div>
                        </div>
                        
                        <form id="change-email-form" class="space-y-6">
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Current Email</label>
                                <input type="email" id="current-email-display" readonly class="w-full input-field" value="Loading...">
                            </div>
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">New Email Address</label>
                                <input type="email" id="new-email" required class="w-full input-field" placeholder="Enter new email address">
                            </div>
                            <div>
                                <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Confirm Password</label>
                                <input type="password" id="email-password" required class="w-full input-field" placeholder="Enter your password">
                                <p class="text-xs text-dark-blue/50 mt-2">Required for security verification</p>
                            </div>
                            <button type="submit" class="w-full btn-primary">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Update Email
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Preferences Tab -->
                <div id="preferences-tab" class="tab-content">
                    <div class="settings-card p-8">
                        <div class="flex items-center mb-8">
                            <div class="section-icon mr-4" style="background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%);">
                                <i class="fas fa-sliders-h text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-dark-blue">Preferences</h2>
                                <p class="text-dark-blue/60 text-sm mt-1">Customize your travel spotlight filters</p>
                            </div>
                        </div>
                        
                        <p class="text-dark-blue/70 mb-6 text-sm">Select categories to personalize your destination recommendations</p>
                        
                        <form id="preferences-form" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Beaches & Islands">
                                    <span class="text-dark-blue font-medium">🏖️ Beaches & Islands</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Nature & Wildlife">
                                    <span class="text-dark-blue font-medium">🌿 Nature & Wildlife</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Arts & Culture">
                                    <span class="text-dark-blue font-medium">🎨 Arts & Culture</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Adventure & Extreme Sports">
                                    <span class="text-dark-blue font-medium">🏔️ Adventure Sports</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Urban & Nightlife">
                                    <span class="text-dark-blue font-medium">🌃 Urban & Nightlife</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="UNESCO Sites">
                                    <span class="text-dark-blue font-medium">🏛️ UNESCO Sites</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Spiritual & Pilgrimage">
                                    <span class="text-dark-blue font-medium">⛪ Spiritual & Pilgrimage</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Wellness Retreats and Leisure">
                                    <span class="text-dark-blue font-medium">💆 Wellness & Leisure</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Hidden Wonders">
                                    <span class="text-dark-blue font-medium">✨ Hidden Wonders</span>
                                </label>
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="filter" value="Festivals & Events">
                                    <span class="text-dark-blue font-medium">🎉 Festivals & Events</span>
                                </label>
                            </div>
                            
                            <button type="submit" class="w-full btn-primary mt-6">
                                <i class="fas fa-check mr-2"></i>
                                Save Preferences
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Delete Account Tab -->
                <div id="delete-tab" class="tab-content">
                    <div class="settings-card p-8">
                        <div class="flex items-center mb-8">
                            <div class="section-icon mr-4" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-red-600">Danger Zone</h2>
                                <p class="text-red-600/80 text-sm mt-1">Permanently delete your account</p>
                            </div>
                        </div>
                        
                        <div class="danger-zone mb-6">
                            <div class="flex items-start gap-4">
                                <div class="bg-red-500 w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-exclamation text-white text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-red-800 font-bold text-lg mb-2">
                                        This action cannot be undone!
                                    </p>
                                    <p class="text-red-700 text-sm leading-relaxed">
                                        Deleting your account will permanently remove:
                                    </p>
                                    <ul class="text-red-700 text-sm mt-2 space-y-1 ml-5 list-disc">
                                        <li>All your bookmarked destinations</li>
                                        <li>Your saved preferences and settings</li>
                                        <li>Your account information and history</li>
                                        <li>Access to all Lakbay Gabay services</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <button onclick="openDeleteModal(); return false;" type="button" class="w-full btn-danger">
                            <i class="fas fa-trash-alt mr-2"></i>
                            Delete Account Permanently
                        </button>
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

    <!-- Delete Account Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black/60 modal-backdrop z-[9999] hidden items-center justify-center p-4">
        <div class="settings-card p-8 max-w-md w-full mx-4 border-2 border-red-500/30">
            <div class="text-center mb-6">
                <div class="section-icon mx-auto mb-4" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); width: 72px; height: 72px;">
                    <i class="fas fa-exclamation-triangle text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-red-600 mb-3">Confirm Account Deletion</h3>
                <p class="text-dark-blue/80 text-sm">Enter your password to permanently delete your account and all associated data.</p>
            </div>
            
            <form id="delete-account-form" class="space-y-5">
                <div>
                    <label class="block text-dark-blue font-semibold mb-3 text-sm uppercase tracking-wide">Password Confirmation</label>
                    <input type="password" id="delete-password" required class="w-full input-field" placeholder="Enter your password">
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteModal(); return false;" class="flex-1 btn-secondary">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 btn-danger">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            
            document.getElementById(tabName + '-tab').classList.add('active');
            event.currentTarget.classList.add('active');
        }

        // Hamburger menu
        document.addEventListener('DOMContentLoaded', function() {
            const hamburgerBtn = document.getElementById('hamburger-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const header = document.getElementById('header');
            
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
            
            loadUserProfile();
            loadUserPreferences();
        });

        // Show notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            const borderColor = type === 'success' ? 'border-green-500' : 'border-red-500';
            const bgColor = type === 'success' ? 'from-green-500 to-green-600' : 'from-red-500 to-red-600';
            const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
            
            notification.className = `notification border-2 ${borderColor} p-5`;
            notification.innerHTML = `
                <div class="flex items-center gap-4">
                    <div class="section-icon" style="background: linear-gradient(135deg, ${type === 'success' ? '#10b981, #059669' : '#ef4444, #dc2626'}); width: 48px; height: 48px; font-size: 20px;">
                        <i class="fas ${icon} text-white"></i>
                    </div>
                    <div>
                        <p class="font-bold text-dark-blue text-sm">${message}</p>
                    </div>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideIn 0.3s ease-out reverse';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Load user profile
        function loadUserProfile() {
            fetch('get_user_profile.php')
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            document.getElementById('edit-username').value = data.username;
                            document.getElementById('display-email').value = data.email;
                            document.getElementById('current-email-display').value = data.email;
                        } else {
                            showNotification(data.message || 'Error loading profile', 'error');
                        }
                    } catch (e) {
                        console.error('JSON Parse Error:', e);
                        showNotification('Error loading profile data', 'error');
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    showNotification('Error connecting to server', 'error');
                });
        }

        // Load user preferences
        function loadUserPreferences() {
            fetch('get_user_preferences.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.preferences) {
                        const preferences = data.preferences.split(',');
                        document.querySelectorAll('input[name="filter"]').forEach(checkbox => {
                            if (preferences.includes(checkbox.value)) {
                                checkbox.checked = true;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error loading preferences:', error);
                });
        }

        // Edit Profile Form
        document.getElementById('edit-profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('edit-username').value.trim();
            
            if (username.length < 3) {
                showNotification('Username must be at least 3 characters!', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('username', username);
            
            fetch('update_profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Profile updated successfully!', 'success');
                } else {
                    showNotification(data.message || 'Error updating profile', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating profile', 'error');
            });
        });

        // Change Password Form
        document.getElementById('change-password-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const currentPassword = document.getElementById('current-password').value;
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            if (newPassword !== confirmPassword) {
                showNotification('New passwords do not match!', 'error');
                return;
            }
            
            if (newPassword.length < 8) {
                showNotification('Password must be at least 8 characters!', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('current_password', currentPassword);
            formData.append('new_password', newPassword);
            
            fetch('change_password.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    if (data.success) {
                        showNotification('Password updated successfully!', 'success');
                        this.reset();
                    } else {
                        showNotification(data.message || 'Error updating password', 'error');
                    }
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    showNotification('Error processing response', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating password', 'error');
            });
        });

        // Change Email Form
        document.getElementById('change-email-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newEmail = document.getElementById('new-email').value;
            const password = document.getElementById('email-password').value;
            
            const formData = new FormData();
            formData.append('new_email', newEmail);
            formData.append('password', password);
            
            fetch('change_email.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    if (data.success) {
                        showNotification('Email updated successfully!', 'success');
                        document.getElementById('display-email').value = newEmail;
                        document.getElementById('current-email-display').value = newEmail;
                        this.reset();
                    } else {
                        showNotification(data.message || 'Error updating email', 'error');
                    }
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    showNotification('Error processing response', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating email', 'error');
            });
        });

        // Preferences Form
        document.getElementById('preferences-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const selectedFilters = [];
            document.querySelectorAll('input[name="filter"]:checked').forEach(checkbox => {
                selectedFilters.push(checkbox.value);
            });
            
            const formData = new FormData();
            formData.append('preferences', selectedFilters.join(','));
            
            fetch('save_preferences.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Preferences saved successfully!', 'success');
                } else {
                    showNotification(data.message || 'Error saving preferences', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error saving preferences', 'error');
            });
        });

        // Delete Account Modal
        function openDeleteModal() {
            document.getElementById('delete-modal').classList.remove('hidden');
            document.getElementById('delete-modal').classList.add('flex');
            return false;
        }

        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            document.getElementById('delete-modal').classList.remove('flex');
            document.getElementById('delete-account-form').reset();
            return false;
        }

        // Delete Account Form
        document.getElementById('delete-account-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('delete-password').value;
            
            if (confirm('Are you absolutely sure? This will permanently delete your account and all associated data.')) {
                const formData = new FormData();
                formData.append('password', password);
                
                fetch('delete_account.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.text();
                })
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            showNotification('Account deleted successfully. Redirecting...', 'success');
                            setTimeout(() => {
                                window.location.href = 'map.php';
                            }, 2000);
                        } else {
                            showNotification(data.message || 'Error deleting account', 'error');
                        }
                    } catch (e) {
                        console.error('JSON Parse Error:', e);
                        showNotification('Error processing response', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error deleting account', 'error');
                });
            }
        });

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                fetch('logout.php')
                    .then(response => response.text())
                    .then(message => {
                        showNotification('Logged out successfully!', 'success');
                        setTimeout(() => {
                            window.location.href = 'map.php';
                        }, 1500);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error logging out', 'error');
                    });
            }
            return false;
        }
    </script>
</body>
</html>