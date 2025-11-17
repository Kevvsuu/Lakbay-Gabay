<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Philippines Map - Lakbay Gabay</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="mobile.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet MarkerCluster Plugin -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
 

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
                      theme: {
                        extend: {
                          colors: {
                            'primary-blue': '#0077be',
                            'secondary-blue': '#00a8cc',
                            'turquoise': '#40e0d0',
                            'light-blue': '#f0f8ff',
                            'dark-slate': '#2c3e50',
                            'gold': '#ffd700',
                            'ocean-blue': '#0096c7',  
                          },
                          fontFamily: {
                            inter: ['Inter', 'sans-serif'],
                            playfair: ['Playfair Display', 'serif'],
                          }
                        }
                      }
                    }
    </script>

<style>
.translating::after {
    content: '...';
    animation: dots 1.5s steps(5, end) infinite;
}

@keyframes dots {
    0%, 20% { content: '.'; }
    40% { content: '..'; }
    60%, 100% { content: '...'; }
}

body {
    margin: 0;
    padding: 0;
    font-family: 'Inter', sans-serif; /* Changed from Montserrat */
    height: 100vh;
    display: block; /* Changed from flex */
    overflow: hidden;
}


.header {
    display: flex;
    justify-content: center;
}


/* Header background matching index.php */
.header-bg {
    background: linear-gradient(135deg, #2c3e50 0%, #005a94 50%, #2c3e50 100%) !important;
    backdrop-filter: blur(16px) saturate(180%) !important;
}

.logo a {
    font-family: 'Playfair Display', serif !important;
    font-size: 1.90rem;        /* base size */
    letter-spacing: -0.03em;   /* even tighter letters */
    word-spacing: -3px;        /* tighter spacing between words */
    display: inline-block;
    margin-left: -5px;         /* slight more left shift */
    line-height: 1;            /* remove extra vertical space */
    vertical-align: middle;    /* aligns inline element vertically */
    transform: translateY(2px); /* nudge text slightly down */
}






nav a {
	font-bold !important;
}
button, .filter-btn, [class*="filter"] {
	font-bold !important;
}

#search-button {
    padding: 15px;
    width: 50px;
    height: 50px;
    min-width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 
        0 4px 15px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    flex-shrink: 0;
}

#search-button i {
    font-size: 1.3em;
    color: rgba(44, 62, 80, 0.9);
}

#search-button:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(64, 224, 208, 0.4);
    box-shadow: 
        0 8px 25px rgba(0, 119, 190, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

#search-button:hover i {
    color: #0077be;
}



.search-filter-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 23px;
    padding: 25px;
    position: absolute;
    top: 90px;
    left: 25px;
    width: 390px;
    z-index: 1000;
    
    /* Glass-morphism effect */
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    box-shadow: 
        0 8px 32px rgba(0, 119, 190, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2),
        inset 0 -1px 0 rgba(255, 255, 255, 0.1);
    
    /* Subtle animation */

}

.search-filter-container::before {
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
}

.search-bar-container {
    display: flex;
    width: 100%;
    align-items: center;
    gap: 10px;
}

.search-bar {
    padding: 15px 20px;
    font-size: 1.1em;
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 15px;
    width: 100%;
    box-sizing: border-box;
    
    /* Glass effect for search bar */
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    
    box-shadow: 
        0 4px 15px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
    color: rgba(44, 62, 80, 0.9);
}

.search-bar:focus {
    outline: none;
    border-color: rgba(64, 224, 208, 0.5);
    background: rgba(255, 255, 255, 0.35);
    box-shadow: 
        0 0 0 4px rgba(0, 119, 190, 0.1),
        0 4px 20px rgba(0, 119, 190, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
}

.search-bar::placeholder {
    color: rgba(136, 136, 136, 0.8);
    font-weight: 400;
}

.filters {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 100%;
    max-height: calc(100vh - 250px);
    overflow-y: auto;
    padding-right: 8px;
}



.filter-btn {
    padding: 16px 25px;
    font-size: 1.05em;
    font-weight: 600;
    border: none;
    border-radius: 15px;
    
    /* Glass button effect */
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    
    color: rgba(44, 62, 80, 0.9);
    cursor: pointer;
    transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    text-align: left;
    width: 100%;
    box-sizing: border-box;
    box-shadow: 
        0 4px 15px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;

}

.filter-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(64, 224, 208, 0.2), 
        transparent);
    transition: left 0.8s ease; /* Slower shine effect */
    z-index: -1; /* Add this to place it behind the content */
}

.filter-btn.active::before {
    display: none; /* Disable the shine effect on active buttons */
}

.filter-btn:hover::before {
    left: 100%;
}

.filter-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(64, 224, 208, 0.4);
    box-shadow: 
        0 8px 25px rgba(0, 119, 190, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);

    color: #0077be;
}


.filter-btn.active {
    background: rgba(0, 119, 190, 0.35); /* Increased opacity */
    border-color: rgba(255, 215, 0, 0.7); /* More visible border */
    color: #0077be;
    box-shadow: 
        0 8px 25px rgba(0, 119, 190, 0.4), /* Stronger shadow */
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    font-weight: 700;

}


/* Enhanced Popup Styles */
#popup {
    position: fixed;
    top: 74px;
    right: -45%;
    width: 39%;
    height: calc(100% - 74px);

    /* Softer glass-morphism */
    background: rgba(255, 255, 255, 0.65); /* More solid for readability */
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-left: 2px solid rgba(64, 224, 208, 0.3);

    box-shadow: 
        -10px 0 40px rgba(0, 119, 190, 0.15),
        inset 1px 0 0 rgba(255, 255, 255, 0.1);

    transition: right 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1000;
    padding: 0;
    overflow: hidden;
    font-family: 'Montserrat', sans-serif;
    border-radius: 15px 0 0 15px;
    visibility: hidden;
}

#popup::before {
    content: '';
    position: absolute;
    top: 0;
    right: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.05), 
        transparent);
    animation: glassShimmerReverse 10s linear infinite;
}

#popup.active {
    right: 0;
    visibility: visible;
    animation: popupGlassEntrance 0.6s ease-out;
}

.popup-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 25px 30px !important;
    background: linear-gradient(135deg, #0077be, #00a8cc, #40e0d0) !important;
    color: white !important;
    position: relative !important;
    gap: 15px !important;
    margin-bottom: 0;
}

.popup-header h4 {
    margin: 0 !important;
    font-size: 1.9em !important;
    font-weight: 700 !important;
    color: white !important;
    letter-spacing: 0.5px !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
    flex: 1 !important;
    min-width: 0 !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    white-space: nowrap !important;
    margin-right: 15px !important;
}

.popup-header-actions {
    display: flex !important;
    align-items: center !important;
    gap: 15px !important;
    flex-shrink: 0 !important;
    margin-left: auto !important;
}

.details-section {
    margin-bottom: 30px;
    padding: 20px;

    /* Solid white instead of glass */
    background: #ffffff;
    
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-left: 3px solid #40e0d0; /* turquoise accent */
    border-radius: 15px;
    box-shadow: 
        0 4px 20px rgba(0, 119, 190, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

.bookmark-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 2px solid rgba(255, 215, 0, 0.3) !important;
    font-size: 1.3em !important;
    cursor: pointer !important;
    color: rgba(255, 255, 255, 0.8) !important;
    transition: all 0.3s ease !important;
    padding: 10px !important;
    border-radius: 12px !important;
    width: 44px !important;
    height: 44px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
    order: 1 !important;
}

.bookmark-btn:hover {
    background: rgba(255, 215, 0, 0.2) !important;
    color: #ffd700 !important;
    transform: scale(1.1) !important;
    border-color: #ffd700 !important;
}

.bookmark-btn.bookmarked i {
    color: #ffd700 !important;
}

.close-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    font-size: 24px !important;
    cursor: pointer !important;
    color: white !important;
    transition: all 0.3s ease !important;
    width: 44px !important;
    height: 44px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 12px !important;
    flex-shrink: 0 !important;
    order: 2 !important;
}

.close-btn:hover {
    background: rgba(255, 255, 255, 0.3) !important;
    transform: rotate(90deg) scale(1.1) !important;
    border-color: white !important;
}

.popup-content {
    height: calc(100% - 90px);
    overflow-y: auto;
    padding: 0 30px 30px;
    scrollbar-width: thin;
    scrollbar-color: rgba(0, 119, 190, 0.3) transparent;
    
    /* Glass effect for content area */
    background: rgba(255, 255, 255, 0.05);
}
.popup-content::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}
.popup-content::-webkit-scrollbar-thumb {
    background: rgba(0, 119, 190, 0.3);
    border-radius: 10px;
    backdrop-filter: blur(5px);
}
.popup-content::-webkit-scrollbar {
    width: 8px;
}

.popup-content::-webkit-scrollbar-track {
    background: rgba(64, 224, 208, 0.1);
    border-radius: 10px;
}

.popup-content::-webkit-scrollbar-thumb {
    background: linear-gradient(45deg, #0077be, #40e0d0);
    border-radius: 10px;
}

/* Enhanced Carousel */
.carousel-container {
    position: relative !important;
    height: 320px;
    width: 100%;
    overflow: hidden;
    border-radius: 15px;
    margin-bottom: 20px;
    margin-top: 20px;
    
    /* Enhanced glass shadow */
    box-shadow: 
        0 8px 30px rgba(0, 119, 190, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.image-credit-display {
    position: absolute !important;
    bottom: 15px !important;
    left: 15px !important;
    background: rgba(44, 62, 80, 0.9) !important;
    color: white !important;
    padding: 8px 14px !important;
    border-radius: 10px !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    z-index: 200 !important;
    backdrop-filter: blur(10px) !important;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
    transition: all 0.3s ease !important;
    border: 1px solid rgba(64, 224, 208, 0.3) !important;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    pointer-events: none !important;
    max-width: calc(100% - 60px);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.carousel {
    position: relative;
    height: 100%;
    width: 100%;
    border-radius: 15px;
    overflow: hidden;
}

.carousel img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.6s ease;
}

.carousel img.active {
    opacity: 1;
}

.carousel-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    color: #0077be;
    border: 2px solid rgba(0, 119, 190, 0.2);
    padding: 12px;
    cursor: pointer;
    z-index: 100;
    font-size: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.carousel-control.prev {
    left: 20px;
}

.carousel-control.next {
    right: 20px;
}

.carousel-control:hover {
    background: #0077be;
    color: white;
    transform: translateY(-50%) scale(1.1);
    border-color: #0077be;
}

.carousel-thumbnails {
    display: flex;
    gap: 10px;
    margin-top: 15px;
    overflow-x: auto;
    padding-bottom: 8px;
}

.carousel-thumbnail {
    width: 70px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    opacity: 0.7;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    flex-shrink: 0;
}

.carousel-thumbnail:hover {
    opacity: 1;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.carousel-thumbnail.active {
    opacity: 1;
    border-color: #0077be;
    box-shadow: 0 0 0 2px #40e0d0;
}

.carousel-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Enhanced Tabs */
.tabs {
    display: flex;
    border-bottom: 2px solid rgba(64, 224, 208, 0.2);
    margin: 25px 0 20px;
}

.tab {
    padding: 12px 18px;
    cursor: pointer;
    font-weight: 600;
    color: #666;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    position: relative;
    background: transparent;
}

.tab::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.tab:hover::before {
    opacity: 1;
}

.tab.active {
    color: #0077be;
    border-bottom-color: #40e0d0;
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
}

.tab-content {
    display: none;
    animation: fadeIn 0.4s ease;
}

.tab-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Enhanced Details Section */


/* Named Links List (Accommodations & Restaurants) */
/* Named Links List (Accommodations & Restaurants) */
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

.named-link-item:before {
    display: none; /* Remove default bullet */
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

.official-link-item:before {
    display: none; /* Remove default bullet */
}

.official-link-item .link-url {
    font-weight: 600;
    font-size: 0.95em;
}

/* General Details Section Styles */
.details-section {
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(0, 119, 190, 0.1);
}

.details-section:last-child {
    border-bottom: none;
}

.details-section h5 {
    color: #0077be;
    margin-bottom: 15px;
    font-size: 1.2em;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.details-section h5 i {
    margin-right: 10px;
    font-size: 1em;
    color: #40e0d0;
}

.details-section p, .details-section ul {
    margin: 10px 0;
    line-height: 1.8;
    color: #2c3e50;
}

.details-section ul:not(.named-links-list):not(.official-links-list) {
    padding-left: 25px;
}

.details-section li:not(.named-link-item):not(.official-link-item) {
    margin-bottom: 10px;
    position: relative;
}

.details-section li:not(.named-link-item):not(.official-link-item):before {
    content: "•";
    color: #40e0d0;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}

/* No Info Message */
.no-info {
    color: #7f8c8d;
    font-style: italic;
    padding: 12px;
    background: rgba(127, 140, 141, 0.05);
    border-radius: 6px;
    text-align: center;
}
                                
/* Enhanced List Styles */
.asian-list {
    list-style-type: none;
    padding-left: 1.2em;
}

.asian-list li {
    position: relative;
    margin-bottom: 8px;
    line-height: 1.7;
    padding-left: 5px;
    transition: all 0.2s ease;
}

.asian-list li:hover {
    transform: translateX(3px);
    color: #0077be;
}

.asian-list li:before {
    content: "•";
    color: #40e0d0;
    font-weight: bold;
    position: absolute;
    left: -1.2em;
    width: 1em;
    font-size: 1.2em;
}

/* Enhanced Link Styles (for other links not in named-links or official-links) */
.details-section a:not(.link-url),
.popup-content a:not(.link-url) {
    color: #0077be;
    text-decoration: none;
    font-weight: 600;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
    position: relative;
    padding: 2px 4px;
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
    border-radius: 4px;
    display: inline-block;
}

.details-section a:not(.link-url):hover,
.popup-content a:not(.link-url):hover {
    color: #40e0d0;
    border-bottom-color: #40e0d0;
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 119, 190, 0.15);
}

.details-section a:not(.link-url)::after,
.popup-content a:not(.link-url)::after {
    content: '\f35d';
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    margin-left: 6px;
    font-size: 0.85em;
    opacity: 0.7;
}

/* Language-specific bullets */
.lang-ja .asian-list li:before {
    content: "・";
    color: #0077be;
}

.lang-zh .asian-list li:before,
.lang-zh-CN .asian-list li:before,
.lang-zh-TW .asian-list li:before {
    content: "●";
    color: #00a8cc;
}

.lang-ko .asian-list li:before {
    content: "◦";
    color: #40e0d0;
}

.lang-tl .asian-list li:before,
.lang-ceb .asian-list li:before {
    content: "▸";
    color: #0077be;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .named-link-item,
    .official-link-item {
        padding: 14px 16px;
    }
    
    .link-name {
        font-size: 1em;
    }
    
    .link-url {
        font-size: 0.88em;
        padding: 5px 10px;
    }
}

/* Enhanced Rating Section */
.average-rating {
    background: linear-gradient(135deg, rgba(240, 248, 255, 0.8), rgba(64, 224, 208, 0.1));
    padding: 20px;
    border-radius: 15px;
    margin: 25px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid rgba(64, 224, 208, 0.3);
    box-shadow: 0 5px 20px rgba(0, 119, 190, 0.1);
}

.rating-value {
    font-size: 2em;
    font-weight: 800;
    color: #0077be;
}

.rating-stars {
    display: flex;
    align-items: center;
    color: #ffd700;
}

.rating-count {
    font-size: 0.9em;
    color: #666;
    margin-left: 12px;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 20px;
    position: absolute;
    right: 40px;
    top: 50%;
    transform: translateY(-50%);
}


/* Hamburger Button */
.hamburger-btn {
    width: 35px;
    height: 28px;
    background: transparent;
    border: none;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 0;
    z-index: 1001;
    position: relative;
    transition: transform 0.3s ease;
}

.hamburger-btn:hover {
    transform: scale(1.1);
}

.hamburger-line {
    width: 100%;
    height: 3px;
    background: white;
    border-radius: 3px;
    transition: all 0.3s ease;
    transform-origin: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
}

.hamburger-btn.active .hamburger-line:nth-child(1) {
    transform: translateY(12px) rotate(45deg);
    background: #ffd700;
}

.hamburger-btn.active .hamburger-line:nth-child(2) {
    opacity: 0;
}

.hamburger-btn.active .hamburger-line:nth-child(3) {
    transform: translateY(-12px) rotate(-45deg);
    background: #ffd700;
}


/* Map Container */

#leaflet-map {
    width: 100%;
    height: 100vh;
    z-index: 1;
}

#map-container {
    width: 100%;
    height: 100vh;
    position: relative;
    overflow: hidden;
    cursor: default; /* Changed from grab - Leaflet handles cursor */
    padding-top: 90px;
}

#map-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Remove transform properties - Leaflet handles this */
}

.map-image {
    display: block;
    width: 100%;
    height: auto;
    object-fit: contain;
    user-select: none;
    -webkit-user-drag: none;
    filter: drop-shadow(0 8px 25px rgba(0, 119, 190, 0.2));
    border-radius: 15px;
}

.custom-marker-icon {
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center bottom;
    border: none;
    transition: filter 0.2s ease;
}

.custom-marker-icon:hover {
    filter: drop-shadow(0 3px 5px rgba(0,0,0,0.4));
    z-index: 1000 !important;
}

/* Leaflet popup customization */
.leaflet-popup-content-wrapper {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 119, 190, 0.2);
}

.leaflet-popup-tip {
    background: rgba(255, 255, 255, 0.95);
}

/* Hide default Leaflet attribution if desired */
.leaflet-control-attribution {
    font-size: 10px;
    background: rgba(255, 255, 255, 0.7);
}

/* MarkerCluster styles */
.marker-cluster-small,
.marker-cluster-medium,
.marker-cluster-large {
    background-color: rgba(0, 119, 190, 0.6);
    backdrop-filter: blur(5px);
}

.marker-cluster-small div,
.marker-cluster-medium div,
.marker-cluster-large div {
    background-color: rgba(64, 224, 208, 0.6);
    color: white;
    font-weight: bold;
}


/* Premium Random For You Banner Styles */
.random-for-you-banner {
    position: relative;
    background: linear-gradient(to right, #a855f7 0%, #d946ef 100%);
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 20px 40px;
    margin-bottom: 15px;
    margin-top: 20px;
    border-radius: 12px;
    box-shadow: 
        0 10px 30px rgba(168, 85, 247, 0.4),
        0 5px 15px rgba(217, 70, 239, 0.3);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.random-for-you-banner::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #a855f7, #d946ef, #a855f7, #d946ef);
    background-size: 300% 300%;
    border-radius: 12px;
    z-index: -1;
    animation: gradient-rotate 6s ease infinite;
    opacity: 0.4;
}

.random-for-you-banner::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 3s infinite;
}

.random-icon-wrapper {
    position: relative;
    margin-bottom: 0;
    flex-shrink: 0;
}

.random-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #c084fc 0%, #e879f9 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 6px 18px rgba(192, 132, 252, 0.5),
        0 0 0 6px rgba(255, 255, 255, 0.2),
        inset 0 2px 6px rgba(255, 255, 255, 0.6),
        inset 0 -2px 6px rgba(147, 51, 234, 0.4);
    position: relative;
    animation: float-icon 3s ease-in-out infinite;
}

.random-pulse-rings {
    position: absolute;
    width: 80px;
    height: 80px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.pulse-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border: 2px solid rgba(168, 85, 247, 0.4);
    border-radius: 50%;
    animation: pulse-expand 3s ease-out infinite;
}

.pulse-ring:nth-child(1) {
    animation-delay: 0s;
}

.pulse-ring:nth-child(2) {
    animation-delay: 1s;
}

.pulse-ring:nth-child(3) {
    animation-delay: 2s;
}

.random-icon i {
    font-size: 26px;
    color: #ffffff;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    animation: dice-bounce 2s ease-in-out infinite;
}

.random-text {
    font-weight: 700;
    font-size: 1em;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #ffffff;
    position: relative;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', sans-serif;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    white-space: nowrap;
}

.random-decoration {
    position: absolute;
    font-size: 14px;
    opacity: 0.25;
    animation: twinkle 2s ease-in-out infinite;
}

.decoration-1 {
    top: 10px;
    left: 15px;
    animation-delay: 0s;
}

.decoration-2 {
    top: 10px;
    right: 15px;
    animation-delay: 0.7s;
}

.decoration-3 {
    bottom: 10px;
    left: 15px;
    animation-delay: 1.4s;
}

.decoration-4 {
    bottom: 10px;
    right: 15px;
    animation-delay: 2.1s;
}

@keyframes pulse-expand {
    0% {
        transform: scale(0.8);
        opacity: 0.8;
    }
    100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

@keyframes dice-bounce {
    0%, 100% {
        transform: scale(1) rotate(0deg);
    }
    25% {
        transform: scale(1.1) rotate(90deg);
    }
    50% {
        transform: scale(1) rotate(180deg);
    }
    75% {
        transform: scale(1.1) rotate(270deg);
    }
}

@media (max-width: 768px) {
    .random-for-you-banner {
        padding: 15px 30px;
        gap: 10px;
    }
    
    .random-icon {
        width: 42px;
        height: 42px;
    }
    
    .random-icon i {
        font-size: 22px;
    }
    
    .random-text {
        font-size: 0.9em;
        letter-spacing: 2px;
    }
    
    .random-decoration {
        font-size: 12px;
    }
}
/* Premium Spotlight Banner Styles */

.spotlight-banner {
    position: relative;
    background: linear-gradient(to right, #ff8c42 0%, #ff6b35 100%);
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 20px 40px;
    margin-bottom: 15px;
    margin-top: 20px;
    border-radius: 12px;
    box-shadow: 
        0 10px 30px rgba(255, 107, 53, 0.4),
        0 5px 15px rgba(255, 140, 66, 0.3);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.spotlight-banner::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, #ff8c42, #ff6b35, #ff8c42, #ff6b35);
    background-size: 300% 300%;
    border-radius: 12px;
    z-index: -1;
    animation: gradient-rotate 6s ease infinite;
    opacity: 0.4;
}

.spotlight-banner::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 50%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 3s infinite;
}

.spotlight-icon-wrapper {
    position: relative;
    margin-bottom: 0;
    flex-shrink: 0;
}

.spotlight-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #ffb347 0%, #ffcc33 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 6px 18px rgba(255, 179, 71, 0.5),
        0 0 0 6px rgba(255, 255, 255, 0.2),
        inset 0 2px 6px rgba(255, 255, 255, 0.6),
        inset 0 -2px 6px rgba(255, 140, 0, 0.4);
    position: relative;
    animation: float-icon 3s ease-in-out infinite;
}

.spotlight-rays {
    position: absolute;
    width: 80px;
    height: 80px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.ray {
    position: absolute;
    width: 2px;
    height: 16px;
    background: linear-gradient(to bottom, rgba(255, 200, 100, 0.5), transparent);
    left: 50%;
    top: 0;
    transform-origin: 50% 40px;
    animation: ray-rotate 8s linear infinite;
}

.ray:nth-child(1) { transform: translate(-50%, 0) rotate(0deg); }
.ray:nth-child(2) { transform: translate(-50%, 0) rotate(45deg); }
.ray:nth-child(3) { transform: translate(-50%, 0) rotate(90deg); }
.ray:nth-child(4) { transform: translate(-50%, 0) rotate(135deg); }
.ray:nth-child(5) { transform: translate(-50%, 0) rotate(180deg); }
.ray:nth-child(6) { transform: translate(-50%, 0) rotate(225deg); }
.ray:nth-child(7) { transform: translate(-50%, 0) rotate(270deg); }
.ray:nth-child(8) { transform: translate(-50%, 0) rotate(315deg); }

.spotlight-icon svg {
    width: 26px;
    height: 26px;
    fill: #ffffff;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    animation: pulse-star 2s ease-in-out infinite;
}

.spotlight-text {
    font-weight: 700;
    font-size: 1em;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #ffffff;
    position: relative;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Helvetica Neue', sans-serif;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    white-space: nowrap;
}

.spotlight-decoration {
    position: absolute;
    font-size: 14px;
    opacity: 0.25;
    animation: twinkle 2s ease-in-out infinite;
}

.decoration-1 {
    top: 10px;
    left: 15px;
    animation-delay: 0s;
}

.decoration-2 {
    top: 10px;
    right: 15px;
    animation-delay: 0.7s;
}

.decoration-3 {
    bottom: 10px;
    left: 15px;
    animation-delay: 1.4s;
}

.decoration-4 {
    bottom: 10px;
    right: 15px;
    animation-delay: 2.1s;
}

@keyframes gradient-rotate {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes shimmer {
    0% {
        left: -100%;
    }
    100% {
        left: 100%;
    }
}

@keyframes float-icon {
    0%, 100% {
        transform: translateY(0) scale(1);
    }
    50% {
        transform: translateY(-6px) scale(1.03);
    }
}

@keyframes ray-rotate {
    0% {
        transform: translate(-50%, 0) rotate(0deg);
        opacity: 0.6;
    }
    50% {
        opacity: 0.3;
    }
    100% {
        transform: translate(-50%, 0) rotate(360deg);
        opacity: 0.6;
    }
}

@keyframes pulse-star {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

@keyframes twinkle {
    0%, 100% {
        opacity: 0.3;
        transform: scale(1);
    }
    50% {
        opacity: 0.7;
        transform: scale(1.2);
    }
}

@media (max-width: 768px) {
    .spotlight-banner {
        padding: 15px 30px;
        gap: 10px;
    }
    
    .spotlight-icon {
        width: 42px;
        height: 42px;
    }
    
    .spotlight-icon svg {
        width: 22px;
        height: 22px;
    }
    
    .spotlight-text {
        font-size: 0.9em;
        letter-spacing: 2px;
    }
    
    .spotlight-decoration {
        font-size: 12px;
    }
}


/* Map Toggle Button */
.map-toggle-container {
    position: absolute;
    top: 120px;
    left: 440px;
    z-index: 1000;
}

.map-toggle-btn {
    padding: 15px 25px;
    font-size: 1em;
    font-weight: 600;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    overflow: hidden;
    bottom: 7px;

    /* Glass effect */
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border: 1px solid rgba(255, 255, 255, 0.25);

    /* Shadows for depth */
    box-shadow: 
        0 6px 20px rgba(0, 119, 190, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);

    color: #2c3e50;
}

/* Shine effect */
.map-toggle-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.25),
        transparent
    );
    transition: left 0.5s ease;
}

.map-toggle-btn:hover::before {
    left: 100%;
}

/* Hover state */
.map-toggle-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    box-shadow: 0 8px 25px rgba(0, 119, 190, 0.25);
    transform: translateY(-3px);
    color: #0077be;
}

/* Active state */
.map-toggle-btn.active {
    background: linear-gradient(
        135deg,
        rgba(0, 119, 190, 0.2),
        rgba(64, 224, 208, 0.2)
    );
    color: #0077be;
    box-shadow: 0 6px 20px rgba(0, 119, 190, 0.3);
    border-left: 4px solid #0077be;
}

/* Icon styling */
.map-toggle-btn i {
    font-size: 1.1em;
    transition: transform 0.3s ease;
}

.map-toggle-btn:hover i {
    transform: scale(1.1);
}


/* Safety and Visitor Indicators */
.safety-indicator,
.visitors-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: rgba(240, 248, 255, 0.8);
    border-radius: 10px;
    margin: 5px 0;
    transition: all 0.3s ease;
    border-left: 3px solid #40e0d0;
}

.safety-indicator:hover,
.visitors-indicator:hover {
    transform: translateX(8px);
    background: rgba(0, 119, 190, 0.1);
    box-shadow: 0 3px 12px rgba(0, 119, 190, 0.1);
}

.safety-indicator i,
.visitors-indicator i {
    color: #0077be;
    font-size: 1.1em;
}



/* Enhanced Reviews Section for Guest Users */
.reviews-section {
    margin-bottom: 2rem;
    background: white;
    padding: 30px;
    border-radius: 15px;
    border: 1px solid rgba(64, 224, 208, 0.2);
    box-shadow: 0 5px 20px rgba(0, 119, 190, 0.08);
}

/* Reviews Header with Sort */
.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(64, 224, 208, 0.15);
    flex-wrap: wrap;
    gap: 15px;
}

.reviews-header-left {
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.reviews-header h5 {
    margin: 0;
    color: #0077be;
    font-weight: 700;
    font-size: 1.4em;
    display: flex;
    align-items: center;
    gap: 10px;
}

.reviews-header h5 i {
    color: #40e0d0;
    font-size: 1.1em;
}

.reviews-count {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    color: #0077be;
    font-weight: 600;
    border: 1px solid rgba(64, 224, 208, 0.2);
}

.reviews-sort {
    margin-left: auto;
}

.sort-dropdown {
    padding: 10px 16px;
    border: 2px solid rgba(64, 224, 208, 0.3);
    border-radius: 10px;
    background: white;
    color: #2c3e50;
    font-size: 0.95em;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
    outline: none;
}

.sort-dropdown:hover {
    border-color: #0077be;
    box-shadow: 0 4px 12px rgba(0, 119, 190, 0.1);
}

.sort-dropdown:focus {
    border-color: #40e0d0;
    box-shadow: 0 0 0 3px rgba(64, 224, 208, 0.1);
}

.reviews-list {
    padding-right: 5px;
}

.rating-item {
    padding: 25px;
    background: white;
    border: 1px solid rgba(0, 119, 190, 0.1);
    border-left: 4px solid #40e0d0;
    border-radius: 12px;
    margin-bottom: 20px;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    position: relative;
    overflow: hidden;
}
                                
.rating-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(64, 224, 208, 0.08), 
        transparent);
    transition: left 0.6s ease;
    z-index: 0;
}

.rating-item:hover::before {
    left: 100%;
}

.rating-item:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 20px rgba(0, 119, 190, 0.12);
    border-left-color: #0077be;
    border-left-width: 5px;
}
                                
.rating-item.hidden-review {
    display: none;
    animation: fadeOut 0.3s ease;
}

.rating-item:not(.hidden-review) {
    animation: fadeInSlide 0.4s ease;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-10px);
    }
}

.rating-header {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 15px;
    align-items: start;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}

.rating-user-info {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.rating-user {
    font-weight: 700;
    color: #0077be;
    font-size: 1.15em;
    display: flex;
    align-items: center;
    gap: 8px;
}

.rating-user::before {
    content: '👤';
    font-size: 0.9em;
}

.rating-date {
    font-size: 0.85em;
    color: #666;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 5px;
}

.rating-date::before {
    content: '📅';
    font-size: 0.9em;
}

.rating-stars {
    display: flex;
    align-items: center;
    gap: 3px;
    color: #ffd700;
    font-size: 1.2em;
    filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
}

.rating-comment {
    margin-top: 15px;
    position: relative;
    z-index: 1;
}

.rating-comment p {
    margin: 0;
    line-height: 1.7;
    color: #2c3e50;
    font-size: 1em;
    padding: 15px;
    background: rgba(240, 248, 255, 0.5);
    border-radius: 8px;
    border-left: 3px solid rgba(64, 224, 208, 0.3);
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.no-comment {
    color: #999;
    font-style: italic;
    font-size: 0.95em;
}

.show-more-container {
    text-align: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 2px dashed rgba(64, 224, 208, 0.2);
}

.show-more-btn {
    padding: 15px 35px;
    background: linear-gradient(135deg, #0077be, #40e0d0);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.05em;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 119, 190, 0.2);
}

.show-more-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.2), 
        transparent);
    transition: left 0.5s ease;
}

.show-more-btn:hover::before {
    left: 100%;
}

.show-more-btn:hover {
    background: linear-gradient(135deg, #005a9e, #30d0c0);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
}

.show-more-btn i {
    font-size: 1.1em;
    transition: transform 0.3s ease;
}

.show-more-btn:hover i {
    transform: scale(1.15);
}

.show-more-btn.expanded i {
    transform: rotate(180deg);
}

.show-more-btn.expanded:hover i {
    transform: rotate(180deg) scale(1.15);
}

.no-reviews-message {
    text-align: center;
    padding: 4rem 2rem;
    color: #666;
    background: linear-gradient(135deg, 
        rgba(240, 248, 255, 0.5), 
        rgba(64, 224, 208, 0.05));
    border-radius: 15px;
    border: 2px dashed rgba(64, 224, 208, 0.3);
}

.no-reviews-message i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: #ccc;
    display: block;
    animation: float 3s ease-in-out infinite;
}

.no-reviews-message p {
    margin: 0.8rem 0;
    font-size: 1.2em;
    font-weight: 600;
    color: #0077be;
}

.no-reviews-message small {
    color: #888;
    font-size: 1em;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

/* Rating Form */
.rating-form {
    background: white;
    padding: 25px;
    border-radius: 15px;
    margin-top: 30px;
    border: 1px solid rgba(64, 224, 208, 0.3);
    box-shadow: 0 5px 20px rgba(0, 119, 190, 0.1);
}

.rating-form h4 {
    margin: 0 0 20px 0;
    color: #0077be;
    font-weight: 700;
    font-size: 1.4em;
    display: flex;
    align-items: center;
    gap: 10px;
}

.rating-form h4 i {
    color: #40e0d0;
}

.form-instruction {
    background: linear-gradient(135deg, rgba(240, 248, 255, 0.8), rgba(64, 224, 208, 0.1));
    padding: 15px;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    font-size: 0.95em;
    color: #2c3e50;
    border-left: 4px solid #40e0d0;
}

.form-instruction p {
    margin: 0;
    line-height: 1.5;
}

.stars {
    font-size: 32px;
    cursor: pointer;
    margin: 20px 0;
    display: flex;
    gap: 8px;
    justify-content: center;
}

.star {
    color: #ddd;
    transition: all 0.3s ease;
    position: relative;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.star:hover, .star.active {
    color: #ffd700;
    transform: scale(1.2);
}

.rating-form textarea {
    width: 100%;
    height: 120px;
    margin: 20px 0;
    padding: 15px;
    border: 2px solid rgba(64, 224, 208, 0.3);
    border-radius: 10px;
    resize: none;
    font-family: 'Montserrat', sans-serif;
    transition: all 0.3s ease;
    background: white;
    font-size: 1em;
    line-height: 1.5;
    box-sizing: border-box;
}

.rating-form textarea:focus {
    outline: none;
    border-color: #0077be;
    box-shadow: 0 0 0 4px rgba(0, 119, 190, 0.1);
    transform: translateY(-2px);
}

.rating-form textarea::placeholder {
    color: #999;
    font-weight: 400;
}

.submit-review-btn {
    padding: 15px 20px;
    background: linear-gradient(135deg, #0077be, #00a8cc);
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 1.1em;
    transition: all 0.3s ease;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.submit-review-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.submit-review-btn:hover::before {
    left: 100%;
}

.submit-review-btn:hover {
    background: linear-gradient(135deg, #005a9e, #007a94);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
}

/* Guest Message */
.guest-message {
    text-align: center;
    padding: 2.5rem;
    background: linear-gradient(135deg, rgba(240, 248, 255, 0.8), rgba(64, 224, 208, 0.1));
    border-radius: 15px;
    border: 2px solid rgba(64, 224, 208, 0.3);
    margin-top: 1rem;
}

.guest-icon {
    font-size: 3rem;
    color: #0077be;
    margin-bottom: 1.5rem;
    display: block;
}

.guest-text {
    margin-bottom: 2rem;
}

.guest-text p {
    margin: 0.75rem 0;
    color: #2c3e50;
    line-height: 1.6;
}

.guest-text p:first-child {
    font-size: 1.2em;
    font-weight: 700;
    color: #0077be;
}

.guest-text p:last-child {
    font-size: 1em;
    color: #666;
}

.login-to-review-btn {
    background: linear-gradient(135deg, #0077be, #40e0d0);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 1.1em;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    position: relative;
    overflow: hidden;
    text-decoration: none;
}

.login-to-review-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.login-to-review-btn:hover::before {
    left: 100%;
}

.login-to-review-btn:hover {
    background: linear-gradient(135deg, #005a9e, #30d0c0);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
    color: white;
    text-decoration: none;
}

.login-to-review-btn i {
    font-size: 1.1em;
    transition: transform 0.3s ease;
}

.login-to-review-btn:hover i {
    transform: scale(1.1);
}

/* Scrollbar styling */
.reviews-list::-webkit-scrollbar {
    width: 8px;
}

.reviews-list::-webkit-scrollbar-track {
    background: rgba(240, 248, 255, 0.5);
    border-radius: 4px;
}

.reviews-list::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #0077be, #40e0d0);
    border-radius: 4px;
}

.reviews-list::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #005a9e, #30d0c0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .reviews-section {
        padding: 20px;
        margin-bottom: 1.5rem;
    }
    
    .reviews-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .reviews-header h5 {
        font-size: 1.2em;
    }
    
    .reviews-count {
        font-size: 0.85rem;
        padding: 6px 12px;
    }
    
    .reviews-sort {
        margin-left: 0;
        width: 100%;
    }
    
    .sort-dropdown {
        width: 100%;
        padding: 12px 16px;
    }
    
    .rating-item {
        padding: 20px 15px;
        margin-bottom: 15px;
    }
    
    .rating-item:hover {
        transform: translateX(4px);
    }
    
    .rating-header {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .rating-user {
        font-size: 1.05em;
    }
    
    .rating-stars {
        font-size: 1.1em;
    }
    
    .rating-comment p {
        padding: 12px;
        font-size: 0.95em;
    }
    
    .show-more-btn {
        padding: 12px 25px;
        font-size: 1em;
    }
    
    .guest-message {
        padding: 2rem 1.5rem;
    }
    
    .guest-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .guest-text p:first-child {
        font-size: 1.1em;
    }
    
    .login-to-review-btn {
        padding: 12px 25px;
        font-size: 1em;
    }
    
    .rating-form {
        padding: 20px;
    }
    
    .rating-form h4 {
        font-size: 1.2em;
    }
}

@media (max-width: 576px) {
    .reviews-section {
        padding: 15px;
        border-radius: 12px;
    }
    
    .reviews-header h5 {
        font-size: 1.1em;
    }
    
    .rating-item {
        padding: 15px 12px;
        border-left-width: 3px;
    }
    
    .rating-user {
        font-size: 1em;
    }
    
    .rating-date {
        font-size: 0.8em;
    }
    
    .rating-stars {
        font-size: 1em;
    }
    
    .rating-comment p {
        padding: 10px;
        font-size: 0.9em;
    }
    
    .rating-form {
        padding: 15px;
    }
    
    .rating-form h4 {
        font-size: 1.1em;
    }
    
    .stars {
        font-size: 28px;
        gap: 6px;
    }
    
    .rating-form textarea {
        padding: 12px;
        font-size: 0.95em;
    }
    
    .submit-review-btn {
        padding: 12px 18px;
        font-size: 1em;
    }
    
    .guest-message {
        padding: 1.5rem 1rem;
    }
    
    .guest-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }
    
    .guest-text p:first-child {
        font-size: 1em;
    }
    
    .guest-text p:last-child {
        font-size: 0.9em;
    }
    
    .login-to-review-btn {
        padding: 10px 20px;
        font-size: 0.95em;
        gap: 8px;
    }
    
    .show-more-btn {
        padding: 10px 20px;
        font-size: 0.95em;
        gap: 8px;
    }
    
    .no-reviews-message {
        padding: 3rem 1.5rem;
    }
    
    .no-reviews-message i {
        font-size: 3rem;
    }
    
    .no-reviews-message p {
        font-size: 1em;
    }
}                     
                                
                                
/* Fullscreen Image Styles */
.fullscreen-image-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.95);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10010;
    backdrop-filter: blur(10px);
}

.fullscreen-image-container .carousel-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    color: #0077be;
    border: 2px solid rgba(0, 119, 190, 0.2);
    padding: 15px;
    cursor: pointer;
    z-index: 10010;
    font-size: 24px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.fullscreen-image-container .carousel-control.prev {
    left: 40px;
}

.fullscreen-image-container .carousel-control.next {
    right: 40px;
}

.fullscreen-image-container .carousel-control:hover {
    background: #0077be;
    color: white;
    transform: translateY(-50%) scale(1.1);
    border-color: #0077be;
}

.fullscreen-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.fullscreen-image {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
    border-radius: 10px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
}

.close-fullscreen-btn {
    position: absolute;
    top: 30px;
    right: 30px;
    background: rgba(255, 255, 255, 0.9);
    border: 2px solid rgba(0, 119, 190, 0.2);
    font-size: 28px;
    color: #0077be;
    cursor: pointer;
    z-index: 10010;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.close-fullscreen-btn:hover {
    background: #0077be;
    color: white;
    transform: scale(1.1);
    border-color: #0077be;
}





/* Responsive Design */
@media (max-width: 1200px) {
    .search-filter-container {
        width: 320px;
        left: 20px;
    }
    
    #popup {
        width: 50%;
        right: -50%;
    }
    
    .carousel-container {
        height: 280px;
    }
    
    .map-toggle-container {
        left: 370px;
    }
}

@media (max-width: 992px) {
    .search-filter-container {
        width: 280px;
        padding: 20px;
    }
    
    .popup-header h4 {
        font-size: 1.6em !important;
    }
    
    .map-toggle-container {
        left: 320px;
    }
    
    .legend-container {
        right: 20px;
        max-width: 300px;
    }
}

@media (max-width: 768px) {
    .header {
        padding: 15px 25px;
    }
    
    .logo a {
        font-size: 1.6rem;
    }
    
    .nav-links {
        gap: 20px;
    }
    
    .nav-links a {
        font-size: 1rem;
    }
    
    .search-filter-container {
        width: 250px;
        left: 15px;
        top: 100px;
    }
    
    #popup {
        width: 75%;
        right: -75%;
        top: 70px;
        height: calc(100% - 70px);
    }

    .popup-header {
        padding: 20px 25px !important;
    }
    
    .popup-header h4 {
        font-size: 1.4em !important;
    }

    .carousel-container {
        height: 220px;
    }

    .filter-btn {
        padding: 14px 18px;
        font-size: 1rem;
    }
    
    .map-toggle-container {
        left: 280px;
    }
    
    .map-toggle-btn {
        padding: 12px 18px;
    }
    
    .legend-container {
        top: 110px;
        right: 15px;
        max-width: 250px;
        padding: 15px;
    }
}

@media (max-width: 576px) {
    .header {
        padding: 12px 20px;
    }
    
    .logo a {
        font-size: 1.4rem;
    }
    
    .nav-links {
        gap: 15px;
    }
    
    .search-filter-container {
        width: 220px;
        left: 10px;
        top: 90px;
        padding: 15px;
    }
    
    #popup {
        width: 90%;
        right: -90%;
        top: 60px;
        height: calc(100% - 60px);
    }

    .popup-header {
        padding: 15px 20px !important;
    }
    
    .popup-header h4 {
        font-size: 1.2em !important;
        max-width: 65%;
    }
    
    .carousel-container {
        height: 180px;
    }
    
    .tab {
        padding: 8px 12px;
        font-size: 0.9em;
    }

    .filter-btn {
        padding: 12px 16px;
        font-size: 0.95em;
    }
    
    .map-toggle-container {
        left: 240px;
        top: 110px;
    }
    
    .map-toggle-btn {
        padding: 10px 15px;
        font-size: 0.9em;
    }
    
    .map-toggle-btn span {
        display: none;
    }
    
    .legend-container {
        top: 90px;
        right: 10px;
        max-width: 200px;
        padding: 12px;
    }
    
    .legend-header h5 {
        font-size: 1em;
    }
    
    .legend-item {
        padding: 8px 10px;
        gap: 10px;
    }
    
    .legend-label {
        font-size: 0.85em;
    }
    
    #user-panel {
        width: 280px;
        right: -280px;
    }
}

@media (max-width: 768px) {
    .reviews-section {
        padding: 20px;
    }
    
    .reviews-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .reviews-sort {
        margin-left: 0;
        width: 100%;
    }
    
    .sort-dropdown {
        width: 100%;
    }
    
    .rating-item {
        padding: 20px;
    }
    
    .rating-header {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .rating-stars {
        justify-self: start;
    }
    
    .show-more-btn {
        padding: 12px 28px;
        font-size: 1em;
    }
}

@media (max-width: 576px) {
    .reviews-section {
        padding: 15px;
    }
    
    .reviews-header h5 {
        font-size: 1.2em;
    }
    
    .reviews-count {
        padding: 6px 12px;
        font-size: 0.85em;
    }
    
    .rating-item {
        padding: 15px;
        margin-bottom: 15px;
    }
    
    .rating-user {
        font-size: 1.05em;
    }
    
    .rating-comment p {
        padding: 12px;
        font-size: 0.95em;
    }
    
    .no-reviews-message {
        padding: 3rem 1.5rem;
    }
    
    .no-reviews-message i {
        font-size: 3rem;
    }
}

#mobile-menu {
    transition: all 0.3s ease-out;
    transform: translateY(-10px);
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    background: transparent !important;
}

#mobile-menu:not(.hidden) {
    transform: translateY(0);
    opacity: 1;
    max-height: 500px;
    background: transparent !important;
}

/* Prevent body scroll when mobile menu is open */
body.mobile-menu-open {
    overflow: hidden;
    /* Removed position: fixed which was causing the background to disappear */
}

/* Mobile menu account section */
#mobile-menu .border-t {
    border-color: rgba(255, 255, 255, 0.2) !important;
}

.mobile-nav-links {
    display: none;
    flex-direction: column;
    gap: 15px;
    padding: 5px 30px 30px;
    margin: 0;
    background: transparent !important;
    border-radius: 0;
}
/* Account dropdown container */
.account-dropdown {
    position: relative;
    z-index: 9999;
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
    z-index: 9999;
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


.dropdown-item:last-child {
    border-bottom: none;
}

.dropdown-item:hover::before {
    left: 100%;
}

.dropdown-item:hover::before {
    left: 100%;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
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

/* Change account link color when dropdown is open */
.account-link.active {
    color: #40e0d0 !important;
}


@keyframes scale-in {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-scale-in {
    animation: scale-in 0.3s ease-out;
}

#preferences-modal input[type="checkbox"]:checked {
    accent-color: #40e0d0;
}
/* Random Button Styles */
.random-btn {
    background: linear-gradient(135deg, #9333ea, #c026d3) !important;
    color: white !important;
    border: 2px solid #a855f7 !important;
    font-weight: 600 !important;
    box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3) !important;
    position: relative;
    overflow: hidden;
}

.random-btn {
    display: none;
}

/* Show random button for logged-in users */
.random-btn.show-for-logged-in {
    display: flex;
}

.random-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s ease;
}

.random-btn:hover {
    background: linear-gradient(135deg, #a855f7, #d946ef) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(147, 51, 234, 0.5) !important;
}

.random-btn:hover::before {
    left: 100%;
}

.random-btn i {
    animation: dice-roll 2s infinite;
}

@keyframes dice-roll {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(90deg); }
    50% { transform: rotate(180deg); }
    75% { transform: rotate(270deg); }
}

.random-btn:hover i {
    animation: dice-roll 0.5s infinite;
}

/* Random Notification */
/* Random Notification */
.random-notification {
    position: fixed;
    top: 120px;
    right: 20px;
    background: linear-gradient(135deg, #9333ea, #c026d3);
    color: white;
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(147, 51, 234, 0.4);
    z-index: 10000;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    font-size: 14px;
    max-width: 350px;
    opacity: 0;
    transform: translateX(100px);
    transition: all 0.3s ease;
}

.random-notification.show {
    opacity: 1;
    transform: translateX(0);
}

.random-notification i {
    font-size: 18px;
    animation: dice-roll 2s infinite;
}

.random-notification span {
    font-size: 13px;
    line-height: 1.4;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .random-notification {
        top: 110px;
        right: 10px;
        left: 10px;
        max-width: calc(100% - 20px);
        padding: 8px 12px;
        font-size: 11px;
        border-radius: 8px;
        gap: 8px;
    }
    
    .random-notification i {
        font-size: 14px;
    }
    
    .random-notification span {
        font-size: 11px;
        line-height: 1.3;
    }
}

@media (max-width: 480px) {
    .random-notification {
        top: 105px;
        padding: 6px 10px;
        font-size: 10px;
        gap: 6px;
    }
    
    .random-notification i {
        font-size: 12px;
    }
    
    .random-notification span {
        font-size: 10px;
        line-height: 1.2;
    }
}

.notification-success {
    position: fixed;
    top: 120px;
    right: 20px;
    background: linear-gradient(135deg, #0077be, #40e0d0);
    color: white;
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 119, 190, 0.3);
    z-index: 10000;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    font-size: 14px;
    max-width: 350px;
    opacity: 0;
    transform: translateX(100px);
    transition: all 0.3s ease;
}

.notification-success.show {
    opacity: 1;
    transform: translateX(0);
}

.notification-success i {
    font-size: 18px;
    flex-shrink: 0;
}

.notification-success span {
    font-size: 13px;
    line-height: 1.4;
}
//map route css
/* Directions Button in Popup */
.directions-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    border: 2px solid rgba(76, 175, 80, 0.3) !important;
    font-size: 1.3em !important;
    cursor: pointer !important;
    color: rgba(255, 255, 255, 0.8) !important;
    transition: all 0.3s ease !important;
    padding: 10px !important;
    border-radius: 12px !important;
    width: 44px !important;
    height: 44px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
    order: 0.5 !important; /* Between share and bookmark */
}

.directions-btn:hover {
    background: rgba(76, 175, 80, 0.3) !important;
    color: #4CAF50 !important;
    transform: scale(1.1) !important;
    border-color: #4CAF50 !important;
}

/* Directions Modal */
.directions-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.directions-modal.show {
    opacity: 1;
}

.directions-modal-content {
    background: white;
    border-radius: 20px;
    max-width: 550px;
    width: 100%;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: modalSlideUp 0.3s ease-out;
    overflow: hidden;
}

@keyframes modalSlideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.directions-modal-header {
    background: linear-gradient(135deg, #0077be, #40e0d0);
    color: white;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.directions-modal-header h3 {
    margin: 0;
    font-size: 1.5em;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 12px;
}

.close-modal-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-size: 28px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.close-modal-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: rotate(90deg);
}

.directions-modal-body {
    padding: 30px;
}

.destination-info {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
    padding: 15px 20px;
    border-radius: 12px;
    border-left: 4px solid #0077be;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.destination-info i {
    color: #0077be;
    font-size: 1.2em;
}

.location-options h4 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 1.1em;
}

.location-option-btn {
    width: 100%;
    padding: 18px 20px;
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
    border: 2px solid rgba(0, 119, 190, 0.2);
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 15px;
}

.location-option-btn:hover {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1));
    border-color: #0077be;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 119, 190, 0.2);
}

.location-option-btn i {
    font-size: 1.5em;
    color: #0077be;
    flex-shrink: 0;
}

.location-option-btn div {
    text-align: left;
    flex: 1;
}

.location-option-btn strong {
    display: block;
    color: #0077be;
    font-size: 1.05em;
    margin-bottom: 4px;
}

.location-option-btn small {
    color: #666;
    font-size: 0.9em;
}

.divider {
    text-align: center;
    margin: 25px 0;
    position: relative;
    color: #999;
    font-weight: 600;
    font-size: 0.9em;
}

.divider::before,
.divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #ddd;
}

.divider::before {
    left: 0;
}

.divider::after {
    right: 0;
}

.manual-location label {
    display: block;
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 0.95em;
}

.input-group {
    display: flex;
    gap: 10px;
    margin-bottom: 8px;
    flex-wrap: nowrap;
    align-items: stretch;
}

.manual-address-input {
    flex: 1;
    padding: 14px 18px;
    border: 2px solid rgba(0, 119, 190, 0.2);
    border-radius: 12px;
    font-size: 1em;
    transition: all 0.3s ease;
    outline: none;
    min-width: 0;
}

.manual-address-input:focus {
    border-color: #0077be;
    box-shadow: 0 0 0 4px rgba(0, 119, 190, 0.1);
}

.search-location-btn {
    padding: 14px 20px;
    background: linear-gradient(135deg, #0077be, #40e0d0);
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 55px;
    flex-shrink: 0;
}

.search-location-btn:hover {
    background: linear-gradient(135deg, #005a9e, #30c0b0);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 119, 190, 0.3);
}

.help-text {
    color: #666;
    font-size: 0.85em;
    font-style: italic;
}

/* Status Messages */
.directions-status {
    margin-top: 20px;
    padding: 15px;
    border-radius: 10px;
    font-size: 0.95em;
}

.directions-status .loading,
.directions-status .success,
.directions-status .error {
    display: flex;
    align-items: center;
    gap: 10px;
}

.directions-status .loading {
    background: rgba(255, 193, 7, 0.1);
    color: #f57c00;
    border-left: 4px solid #ff9800;
}

.directions-status .success {
    background: rgba(76, 175, 80, 0.1);
    color: #388e3c;
    border-left: 4px solid #4CAF50;
}

.directions-status .error {
    background: rgba(244, 67, 54, 0.1);
    color: #c62828;
    border-left: 4px solid #f44336;
}

.directions-status i {
    font-size: 1.2em;
}

/* Directions Button Styling - Sky Blue Theme */
/* Directions Button Styling - Force Sky Blue, Remove Yellow */
.directions-btn,
.directions-btn:hover,
.directions-btn:focus,
.directions-btn:active,
.directions-btn:focus-visible,
.directions-btn:focus-within {
    outline: none !important;
    outline-color: transparent !important;
    outline-width: 0 !important;
    outline-style: none !important;
    outline-offset: 0 !important;
    box-shadow: none !important;
    -webkit-tap-highlight-color: transparent !important;
}

/* Force remove Firefox outline */
.directions-btn::-moz-focus-inner {
    border: 0 !important;
    outline: none !important;
}

/* Sky Blue Hover - Override everything */
.directions-btn:hover {
    background: rgba(64, 224, 208, 0.3) !important;
    color: #40E0D0 !important;
    border-color: #40E0D0 !important;
    box-shadow: 0 4px 12px rgba(64, 224, 208, 0.3) !important;
}
/* Clear Directions Button */
.clear-directions-btn:hover {
    background: linear-gradient(135deg, #d32f2f, #f44336) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 68, 68, 0.4) !important;
}

/* User Location Marker */
.user-location-marker {
    animation: pulse-user-location 2s infinite;
}

@keyframes pulse-user-location {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.7;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Destination Marker */
.destination-marker {
    animation: bounce-destination 1s ease-out;
}

@keyframes bounce-destination {
    0% {
        transform: translateY(-100px) scale(0);
        opacity: 0;
    }
    60% {
        transform: translateY(10px) scale(1.1);
        opacity: 1;
    }
    80% {
        transform: translateY(-5px) scale(0.95);
    }
    100% {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

/* ========================================
   LEAFLET ROUTING CONTAINER - FIXED VERSION
   ======================================== */

.leaflet-routing-container {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(15px) !important;
    -webkit-backdrop-filter: blur(15px) !important;
    border: 1px solid rgba(0, 119, 190, 0.2) !important;
    border-radius: 15px !important;
    box-shadow: 0 8px 32px rgba(0, 119, 190, 0.2) !important;
    padding: 0 !important;
    max-width: 350px !important;
    min-width: 320px !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
    overflow: hidden !important;
    z-index: 900 !important;
    position: relative !important;
}

.leaflet-bottom.leaflet-left .leaflet-routing-container,
.leaflet-top.leaflet-left .leaflet-routing-container,
.leaflet-top.leaflet-right .leaflet-routing-container {
    position: fixed !important;
    top: 80px !important;
    left: 430px !important;
    bottom: auto !important;
    right: auto !important;
    max-height: calc(100vh - 200px) !important;
}

/* Routing Header */
.leaflet-routing-container h2,
.leaflet-routing-container h3 {
    background: linear-gradient(135deg, #0077be, #40e0d0) !important;
    color: white !important;
    margin: 0 !important;
    padding: 15px 50px 15px 20px !important; 
    font-size: 1.1em !important;
    font-weight: 700 !important;
    font-family: 'Playfair Display', serif !important;
    border-radius: 0 !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

.leaflet-routing-container h2::before,
.leaflet-routing-container h3::before {
    content: '🗺️';
    font-size: 1.2em;
}

/* Routing Alternatives Container */
.leaflet-routing-alternatives-container {
    background: transparent !important;
    padding: 15px !important;
    max-height: 400px !important;
    overflow-y: auto !important;
}

/* Individual Route Alternative */
.leaflet-routing-alt {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05)) !important;
    border: 2px solid rgba(0, 119, 190, 0.15) !important;
    border-left: 4px solid #0077be !important;
    border-radius: 12px !important;
    padding: 12px 15px !important;
    margin-bottom: 12px !important;
    transition: all 0.3s ease !important;
}

.leaflet-routing-alt:hover {
    background: linear-gradient(135deg, rgba(0, 119, 190, 0.1), rgba(64, 224, 208, 0.1)) !important;
    border-left-color: #40e0d0 !important;
    transform: translateX(5px) !important;
    box-shadow: 0 4px 12px rgba(0, 119, 190, 0.15) !important;
}

/* Route Summary (Distance & Time) */
.leaflet-routing-alt h3 {
    background: transparent !important;
    color: #0077be !important;
    font-size: 1.05em !important;
    font-weight: 700 !important;
    font-family: 'Inter', sans-serif !important;
    padding: 0 0 10px 0 !important;
    margin: 0 0 10px 0 !important;
    border-bottom: 2px solid rgba(64, 224, 208, 0.3) !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}

.leaflet-routing-alt h3::before {
    content: '📍';
    font-size: 1em;
}

/* Turn-by-Turn Instructions */
.leaflet-routing-alt table {
    width: 100% !important;
    border-collapse: collapse !important;
}

.leaflet-routing-alt tr {
    border-bottom: 1px solid rgba(0, 119, 190, 0.1) !important;
    transition: none !important; /* Remove hover transition */
}

.leaflet-routing-alt tr:hover {
    background: transparent !important; /* No background on hover */
}

.leaflet-routing-alt tr:last-child {
    border-bottom: none !important;
}

.leaflet-routing-alt td {
    padding: 10px 8px !important;
    font-size: 0.9em !important;
    color: #2c3e50 !important;
    line-height: 1.5 !important;
}

/* Instruction Icon Column */
.leaflet-routing-alt td:first-child {
    width: 30px !important;
    text-align: center !important;
    color: #0077be !important;
    font-size: 1.1em !important;
}

/* Distance Column */
.leaflet-routing-alt td:last-child {
    text-align: right !important;
    font-weight: 600 !important;
    color: #40e0d0 !important;
    white-space: nowrap !important;
}

/* Instruction Icons */
.leaflet-routing-icon {
    display: inline-block !important;
    width: 20px !important;
    height: 20px !important;
    background-size: contain !important;
    background-repeat: no-repeat !important;
    filter: hue-rotate(180deg) brightness(0.8) !important;
}

/* Collapse/Expand Button - COMPLETELY REMOVED FROM EXISTENCE */
.leaflet-routing-collapse-btn,
.leaflet-routing-container > button,
.leaflet-routing-container button[class*="collapse"],
.leaflet-routing-container button[class*="expand"],
.leaflet-routing-container .leaflet-routing-collapse-btn,
button.leaflet-routing-collapse-btn {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
    height: 0 !important;
    width: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
    border: none !important;
    position: absolute !important;
    left: -9999px !important;
    overflow: hidden !important;
}

/* Scrollbar Styling */
.leaflet-routing-alternatives-container::-webkit-scrollbar {
    width: 8px !important;
}

.leaflet-routing-alternatives-container::-webkit-scrollbar-track {
    background: rgba(240, 248, 255, 0.5) !important;
    border-radius: 4px !important;
}

.leaflet-routing-alternatives-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #0077be, #40e0d0) !important;
    border-radius: 4px !important;
}

.leaflet-routing-alternatives-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #005a9e, #30c0b0) !important;
}

/* Error State */
.leaflet-routing-error {
    background: rgba(244, 67, 54, 0.1) !important;
    color: #c62828 !important;
    padding: 12px 15px !important;
    margin: 10px !important;
    border-radius: 10px !important;
    border-left: 4px solid #f44336 !important;
    font-weight: 500 !important;
}

/* ========================================
   RESPONSIVE DESIGN
   ======================================== */

/* Tablets (769px - 1024px) */
@media (max-width: 1024px) {
    .leaflet-top.leaflet-right .leaflet-routing-container,
    .leaflet-top.leaflet-left .leaflet-routing-container,
    .leaflet-bottom.leaflet-left .leaflet-routing-container {
        top: 100px !important;
        left: 340px !important;
        max-height: calc(100vh - 180px) !important;
    }
    
    .custom-routing-close-btn {
        width: 30px !important;
        height: 30px !important;
        top: 10px !important;
        right: 10px !important;
        font-size: 15px !important;
    }
}

/* Standard Mobile Devices (768px and below) - KEEP BOTTOM POSITION */
@media (max-width: 768px) {
    .leaflet-routing-container {
        max-width: 95vw !important;
        min-width: 280px !important;
        font-size: 14px !important;
    }
    
    /* MOBILE: Move to bottom for thumb accessibility */
    .leaflet-top.leaflet-right .leaflet-routing-container,
    .leaflet-bottom.leaflet-left .leaflet-routing-container {
        position: fixed !important;
        top: auto !important;
        bottom: 15px !important;
        left: 50% !important;
        right: auto !important;
        transform: translateX(-50%) !important;
        max-width: calc(100vw - 30px) !important;
        max-height: 50vh !important;
    }
    
    .custom-routing-close-btn {
        width: 28px !important;
        height: 28px !important;
        top: 8px !important;
        right: 8px !important;
        font-size: 14px !important;
        border-width: 1.5px !important;
    }
    
    .leaflet-routing-container h2,
    .leaflet-routing-container h3 {
        padding: 12px 45px 12px 15px !important;
        font-size: 1em !important;
    }
    
    .leaflet-routing-alternatives-container {
        padding: 12px !important;
        max-height: calc(50vh - 100px) !important;
    }
    
    .leaflet-routing-alt {
        padding: 10px 12px !important;
        margin-bottom: 10px !important;
    }
    
    .leaflet-routing-alt h3 {
        font-size: 0.95em !important;
        padding: 0 0 8px 0 !important;
        margin: 0 0 8px 0 !important;
    }
    
    .leaflet-routing-alt td {
        padding: 8px 6px !important;
        font-size: 0.85em !important;
    }
    
    .leaflet-routing-alt td:first-child {
        width: 25px !important;
        font-size: 1em !important;
    }
    
    .leaflet-routing-collapse-btn {
        display: none !important;
    }
}

/* Small Phones (480px and below) */
@media (max-width: 480px) {
    .leaflet-routing-container {
        max-width: calc(100vw - 20px) !important;
        min-width: 0 !important;
        font-size: 12px !important;
        border-radius: 12px !important;
    }
    
    .leaflet-top.leaflet-right .leaflet-routing-container,
    .leaflet-bottom.leaflet-left .leaflet-routing-container {
        bottom: 10px !important;
        left: 50% !important;
        max-width: calc(100vw - 20px) !important;
        max-height: 45vh !important;
    }
    
    .custom-routing-close-btn {
        width: 26px !important;
        height: 26px !important;
        top: 6px !important;
        right: 6px !important;
        font-size: 13px !important;
    }
    
    .leaflet-routing-container h2,
    .leaflet-routing-container h3 {
        padding: 10px 40px 10px 12px !important;
        font-size: 0.9em !important;
    }
    
    .leaflet-routing-container h2::before,
    .leaflet-routing-container h3::before {
        font-size: 1em;
    }
    
    .leaflet-routing-alternatives-container {
        padding: 10px !important;
        max-height: calc(45vh - 90px) !important;
    }
    
    .leaflet-routing-alt {
        padding: 8px 10px !important;
        margin-bottom: 8px !important;
        border-radius: 10px !important;
    }
    
    .leaflet-routing-alt h3 {
        font-size: 0.85em !important;
        padding: 0 0 6px 0 !important;
        margin: 0 0 6px 0 !important;
    }
    
    .leaflet-routing-alt h3::before {
        font-size: 0.9em;
    }
    
    .leaflet-routing-alt td {
        padding: 6px 4px !important;
        font-size: 0.8em !important;
    }
    
    .leaflet-routing-alt td:first-child {
        width: 20px !important;
        font-size: 0.9em !important;
    }
    
    .leaflet-routing-alt td:last-child {
        font-size: 0.75em !important;
    }
    
    .leaflet-routing-icon {
        width: 16px !important;
        height: 16px !important;
    }
    
    .leaflet-routing-collapse-btn {
        display: none !important;
    }
}

/* Extra Small Phones (375px and below) */
@media (max-width: 375px) {
    .leaflet-routing-container {
        font-size: 11px !important;
    }
    
    .leaflet-top.leaflet-right .leaflet-routing-container,
    .leaflet-bottom.leaflet-left .leaflet-routing-container {
        max-height: 40vh !important;
    }
    
    .custom-routing-close-btn {
        width: 24px !important;
        height: 24px !important;
        top: 5px !important;
        right: 5px !important;
        font-size: 12px !important;
    }
    
    .leaflet-routing-container h2,
    .leaflet-routing-container h3 {
        padding: 8px 35px 8px 10px !important;
        font-size: 0.85em !important;
    }
    
    .leaflet-routing-alternatives-container {
        padding: 8px !important;
        max-height: calc(40vh - 80px) !important;
    }
    
    .leaflet-routing-alt {
        padding: 6px 8px !important;
        margin-bottom: 6px !important;
    }
    
    .leaflet-routing-alt h3 {
        font-size: 0.8em !important;
        padding: 0 0 5px 0 !important;
        margin: 0 0 5px 0 !important;
    }
    
    .leaflet-routing-alt td {
        padding: 5px 3px !important;
        font-size: 0.75em !important;
    }
    
    .leaflet-routing-alt td:first-child {
        width: 18px !important;
    }
    
    .leaflet-routing-collapse-btn {
        display: none !important;
    }
}

/* Loading State */
.leaflet-routing-container.loading {
    position: relative;
}

.leaflet-routing-container.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}

/* Animation for New Routes */
@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInBottom {
    from {
        opacity: 0;
        transform: translate(-50%, 100px);
    }
    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}

/* Desktop animation - slide in from left */
@media (min-width: 769px) {
    .leaflet-routing-container {
        animation: slideInFromLeft 0.4s ease-out;
    }
}

/* Mobile animation - slide up from bottom */
@media (max-width: 768px) {
    .leaflet-routing-container {
        animation: slideInBottom 0.4s ease-out;
    }
}

/* Print Styles */
@media print {
    .leaflet-routing-container {
        background: white !important;
        border: 2px solid #0077be !important;
        box-shadow: none !important;
        position: relative !important;
        transform: none !important;
    }
    
    .custom-routing-close-btn {
        display: none !important;
    }
    
    .leaflet-routing-alt {
        page-break-inside: avoid;
    }
}

/* Touch device optimization */
@media (hover: none) and (pointer: coarse) {
    .custom-routing-close-btn {
        width: 36px !important;
        height: 36px !important;
        font-size: 16px !important;
    }
    
    .custom-routing-close-btn:active {
        transform: scale(0.9) !important;
        background: rgba(0, 119, 190, 1) !important;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .custom-routing-close-btn {
        border-width: 2px !important;
        font-weight: bold !important;
    }
}

/* Reduced motion preference */
@media (prefers-reduced-motion: reduce) {
    .custom-routing-close-btn,
    .leaflet-routing-container,
    .leaflet-routing-alt {
        animation: none !important;
        transition: none !important;
    }
    
    .custom-routing-close-btn:hover {
        transform: none !important;
    }
}
</style>
</head>
<body>

<div class="fixed top-0 left-0 right-0 header-bg transition-all duration-300 z-[10000]" id="header" style="padding: 18px 32px;">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <div class="logo -ml-1">
            <a href="index.php" class="font-bold font-playfair uppercase text-white tracking-tighter leading-none hover:text-turquoise transition-colors duration-300">
                Lakbay Gabay
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex items-center gap-6">
            <nav class="hidden md:flex items-center" style="gap: 23px;">
                <a href="index.php" 
                   style="font-family: 'Inter', sans-serif;
                          color: rgba(255, 255, 255, 0.9);
                          text-decoration: none;
                          transition: color 0.3s ease;"
                   onmouseover="this.style.color='#40e0d0'" 
                   onmouseout="this.style.color='rgba(255, 255, 255, 0.9)'">
                    <b>Home</b>
                </a>

                <a href="map.php" 
                   style="font-family: 'Inter', sans-serif;
                          color: rgba(255, 255, 255, 0.9);
                          text-decoration: none;
                          transition: color 0.3s ease;"
                   onmouseover="this.style.color='#40e0d0'" 
                   onmouseout="this.style.color='rgba(255, 255, 255, 0.9)'">
                    <b>Destination</b>
                </a>

                <a href="griddestination.php" 
                   style="font-family: 'Inter', sans-serif;
                          color: rgba(255, 255, 255, 0.9);
                          text-decoration: none;
                          transition: color 0.3s ease;"
                   onmouseover="this.style.color='#40e0d0'" 
                   onmouseout="this.style.color='rgba(255, 255, 255, 0.9)'">
                    <b>All Destination</b>
                </a>

                <a href="contact.php" 
                   style="font-family: 'Inter', sans-serif;
                          color: rgba(255, 255, 255, 0.9);
                          text-decoration: none;
                          transition: color 0.3s ease;"
                   onmouseover="this.style.color='#40e0d0'" 
                   onmouseout="this.style.color='rgba(255, 255, 255, 0.9)'">
                    <b>Contact</b>
                </a>

                <a href="about_us.php" 
                   style="font-family: 'Inter', sans-serif;
                          color: rgba(255, 255, 255, 0.9);
                          text-decoration: none;
                          transition: color 0.3s ease;"
                   onmouseover="this.style.color='#40e0d0'" 
                   onmouseout="this.style.color='rgba(255, 255, 255, 0.9)'">
                    <b>About</b>
                </a>

                <!-- Account Dropdown -->
                <div class="account-dropdown" style="position: relative;">
                    <a href="#" 
                       class="account-link" 
                       style="font-family: 'Inter', sans-serif;
                              color: rgba(255, 255, 255, 0.9);
                              text-decoration: none;
                              transition: color 0.3s ease;
                              display: flex;
                              align-items: center;"
                       onmouseover="this.style.color='#40e0d0'" 
                       onmouseout="if(!this.classList.contains('active')) this.style.color='rgba(255, 255, 255, 0.9)'">
                        <b>Account</b>
                    </a>
                    <div class="dropdown-menu" id="account-dropdown">
                        <!-- Dropdown content -->
                    </div>
                </div>
            </nav>

            <!-- Language Selector -->
            <select class="bg-white/10 text-white rounded-lg px-4 py-2 text-sm cursor-pointer hover:bg-white/20 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-turquoise" id="language-select">
                <option value="en" class="bg-ocean-blue text-white">English (EN)</option>
                <option value="ko" class="bg-ocean-blue text-white">Korean (KO)</option>
                <option value="ja" class="bg-ocean-blue text-white">Japanese (JA)</option>
                <option value="zh" class="bg-ocean-blue text-white">Chinese (ZH)</option>
                <option value="ms" class="bg-ocean-blue text-white">Malay (MS)</option>
                <option value="hi" class="bg-ocean-blue text-white">Hindi (HI)</option>
                <option value="tl" class="bg-ocean-blue text-white">Filipino (TL)</option>
                <option value="ceb" class="bg-ocean-blue text-white">Cebuano (CEB)</option>
            </select>

            <!-- Hamburger Button for User Panel (Mobile) -->
            <button class="hamburger-btn md:hidden flex flex-col justify-center items-center w-8 h-8 relative z-2001" id="hamburger-btn">
                <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5 transition-all duration-300"></span>
                <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5 transition-all duration-300"></span>
                <span class="hamburger-line block w-6 h-0.5 bg-white transition-all duration-300"></span>
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
            <!-- Mobile Account Section -->
            <div class="border-t border-white/20 pt-3 mt-2" id="mobile-account-section">
                <div class="text-white/70 text-sm font-semibold mb-2">ACCOUNT</div>
                <div class="px-2 py-1 text-white/80 text-sm mb-2">
                    Loading...
                </div>
            </div>
        </nav>
    </div>
</div>



<!-- Map Container -->
<div id="map-container">
    <div class="search-filter-container">
        <div class="search-bar-container">
            <input type="text" id="search-bar" class="search-bar" placeholder="Search destinations..." data-translate-placeholder="Search destinations...">
        </div>
        <div class="filters">
            <button class="filter-btn" id="Beaches & Islands" data-translate="Beaches & Islands">
                <i class="fas fa-umbrella-beach mr-2"></i>
                Beaches & Islands
            </button>
            <button class="filter-btn" id="Nature & Wildlife" data-translate="Nature & Wildlife">
                <i class="fas fa-leaf mr-2"></i>
                Nature & Wildlife
            </button>
            <button class="filter-btn" id="Urban & Nightlife" data-translate="Urban & Nightlife">
                <i class="fas fa-city mr-2"></i>
                Urban & Nightlife
            </button>
            <button class="filter-btn" id="Adventure & Extreme Sports" data-translate="Adventure & Extreme Sports">
                <i class="fas fa-mountain mr-2"></i>
                Adventure & Extreme Sports
            </button>
            <button class="filter-btn" id="Arts & Culture" data-translate="Arts & Culture">
                <i class="fas fa-palette mr-2"></i>
                Arts & Culture
            </button>
            <button class="filter-btn" id="Festivals & Events" data-translate="Festivals & Events">
                <i class="fas fa-calendar-alt mr-2"></i>
                Festivals & Events
            </button>
            <button class="filter-btn" id="UNESCO Sites" data-translate="UNESCO Sites">
                <i class="fas fa-landmark mr-2"></i>
                UNESCO Sites
            </button>
            <button class="filter-btn" id="Spiritual & Pilgrimage" data-translate="Spiritual & Pilgrimage">
                <i class="fas fa-praying-hands mr-2"></i>
                Spiritual & Pilgrimage
            </button>
            <button class="filter-btn" id="Wellness Retreats and Leisure" data-translate="Wellness Retreats and Leisure">
                <i class="fas fa-spa mr-2"></i>
                Wellness Retreats and Leisure
            </button>
            <button class="filter-btn" id="Hidden Wonders" data-translate="Hidden Wonders">
                <i class="fas fa-gem mr-2"></i>
                Hidden Wonders
            </button>
            <button id="random-btn" class="filter-btn random-btn" onclick="showRandomPreferredSpot()" data-translate="Random for You" title="Show random spot based on your preferences">
                <i class="fas fa-dice mr-2"></i>
                Random for You
            </button>
        </div>
    </div>
    
    <div id="map-wrapper">
        <div id="leaflet-map"></div>
    </div>
</div>


<div id="preferences-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full mx-auto overflow-hidden animate-scale-in max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-ocean-blue via-cyan-blue to-turquoise p-4 sm:p-6 text-white flex-shrink-0">
            <div class="flex items-center justify-center mb-3 sm:mb-4">
                <div class="bg-white/20 p-3 sm:p-4 rounded-full">
                    <i class="fas fa-sliders-h text-2xl sm:text-3xl md:text-4xl"></i>
                </div>
            </div>
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center mb-1 sm:mb-2">Personalize Your Experience</h2>
            <p class="text-center text-white/90 text-xs sm:text-sm md:text-base">Select your travel interests to get personalized recommendations</p>
        </div>
        
        <!-- Modal Body - Scrollable -->
        <div class="p-4 sm:p-6 md:p-8 overflow-y-auto flex-1 modal-scroll-container">
            <p class="text-gray-700 mb-4 sm:mb-6 text-center text-xs sm:text-sm md:text-base">Choose the types of destinations you're most interested in exploring:</p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 mb-4 sm:mb-6">
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Beaches & Islands" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🏖️ Beaches & Islands</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Nature & Wildlife" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🌿 Nature & Wildlife</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Arts & Culture" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🎨 Arts & Culture</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Adventure & Extreme Sports" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🏔️ Adventure & Sports</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Urban & Nightlife" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🌃 Urban & Nightlife</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="UNESCO Sites" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🏛️ UNESCO Sites</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Spiritual & Pilgrimage" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">⛪ Spiritual & Pilgrimage</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Wellness Retreats and Leisure" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🧘 Wellness & Leisure</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Hidden Wonders" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">💎 Hidden Wonders</span>
                </label>
                
                <label class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-turquoise hover:bg-turquoise/5 transition-all active:scale-95">
                    <input type="checkbox" value="Festivals & Events" class="w-4 h-4 sm:w-5 sm:h-5 text-turquoise rounded focus:ring-turquoise mr-2 sm:mr-3 flex-shrink-0">
                    <span class="font-medium text-gray-700 text-sm sm:text-base">🎉 Festivals & Events</span>
                </label>
            </div>
            
            <!-- Modal Actions -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                <button onclick="skipPreferences()" class="w-full sm:flex-1 px-4 sm:px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-100 transition-all active:scale-95 text-sm sm:text-base">
                    Skip for Now
                </button>
                <button onclick="savePreferencesFromModal()" class="w-full sm:flex-1 px-4 sm:px-6 py-3 bg-gradient-to-r from-ocean-blue to-turquoise text-white rounded-xl font-semibold hover:shadow-lg transition-all active:scale-95 text-sm sm:text-base">
                    Save Preferences
                </button>
            </div>
        </div>
    </div>
</div>

<div id="popup">
    <!-- Popup content will be dynamically added here -->
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
<script src="mobile.js"></script>
<script src="direcstion.js"></script>
</body>
</html>