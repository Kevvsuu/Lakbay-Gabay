

const mapContainer = document.getElementById('map-container');
const mapWrapper = document.getElementById('map-wrapper');
const popup = document.getElementById('popup');
const filterButtons = document.querySelectorAll('.filter-btn');
const searchBar = document.getElementById('search-bar');
let scale = 3;
let translateX = 0;
let translateY = 0;
let dragging = false;
let startX, startY;
let allSpots = [];
let spotlightShown = false;
let currentSpotlightId = null;
let userBookmarks = [];
let userHasSeenSpotlight = false;
let currentRatings = [];


function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}


function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    };
    return date.toLocaleDateString('en-US', options);
}

const pinImages = {
    'Beaches & Islands': 'images/pins/beach.png',
    'Nature & Wildlife': 'images/pins/nature.png',
    'Urban & Nightlife': 'images/pins/urban.png',
    'Adventure & Extreme Sports': 'images/pins/adventure.png',
    'Arts & Culture': 'images/pins/art.png',
    'Festivals & Events': 'images/pins/festivals.png',
    'UNESCO Sites': 'images/pins/food.png',  
    'Spiritual & Pilgrimage': 'images/pins/spiritual.png',
    'Wellness Retreats and Leisure': 'images/pins/resort.png',
    'Hidden Wonders': 'images/pins/underrated.png'
};

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






// ✏️ REPLACE with this simple version
function centerMap() {
    if (map) {
        map.setView([12.8797, 121.7740], 6); // Philippines center, zoom level 6
    }
}

function centerMapOnSpot(spot) {
    if (!spot || !map) {
        console.error('Cannot center map - missing spot or map');
        return;
    }
    
    const lat = parseFloat(spot.latitude);
    const lng = parseFloat(spot.longitude);
    
    if (isNaN(lat) || isNaN(lng)) {
        console.error('Invalid coordinates');
        return;
    }
    
    console.log('Flying to:', spot.name, 'at', lat, lng);
    
    // Animate map fly-to effect
    map.flyTo([lat, lng], 15, {
        duration: 2,
        easeLinearity: 0.25
    });
    
    // Open popup after animation finishes (using existing openPopup function)
    setTimeout(() => {
        console.log('Opening popup for:', spot.name);
        openPopup(spot, false);
    }, 2300);
}

function openPopupForSpot(spot) {
    if (!spot) {
        console.error('No spot provided to openPopupForSpot');
        return;
    }
    
    console.log('Opening popup for:', spot.name);
    currentSpot = spot;
    
    // Fetch ratings and login status
    Promise.all([
        fetch(`fetch_ratings.php?spot_id=${spot.id}`).then(r => r.json()).catch(() => []),
        fetch('check_login.php').then(r => r.json()).catch(() => ({ logged_in: false }))
    ])
    .then(([ratings, loginData]) => {
        const isLoggedIn = loginData.logged_in || false;
        const isBookmarked = isSpotBookmarked(spot.id);
        const averageRating = calculateAverageRating(ratings);
        
        console.log('Data ready - building popup');
        
        // Build and display popup
        buildPopupContent(spot, false, ratings, averageRating, isLoggedIn, isBookmarked);
        
        const popup = document.getElementById('popup');
        if (popup) {
            popup.classList.add('active');
            console.log('Popup is now visible');
        }
        
        // Setup rating stars if logged in
        if (isLoggedIn) {
            setTimeout(() => initializeRatingStars(), 100);
        }
    })
    .catch(error => {
        console.error('Error opening popup:', error);
        // Show popup anyway with basic data
        buildPopupContent(spot, false, [], 0, false, false);
        const popup = document.getElementById('popup');
        if (popup) popup.classList.add('active');
    });
}
    
function proceedWithCentering(spotToCenter) {
    // Check if coordinates are valid
    if (!spotToCenter.latitude || !spotToCenter.longitude || 
        spotToCenter.latitude === null || spotToCenter.longitude === null) {
        console.warn('Cannot center on spot - invalid coordinates:', spotToCenter);
        return;
    }
    
    // Center the map on the spot's coordinates
    const latLng = [parseFloat(spotToCenter.latitude), parseFloat(spotToCenter.longitude)];
    
    // Fly to the location with animation (or use setView for instant)
    map.flyTo(latLng, 15, {
        duration: 1.5, // Animation duration in seconds
        easeLinearity: 0.25
    });
    
    // Find the marker for this spot
    const marker = allMarkers.find(m => m.spotId === spotToCenter.id);
    
    if (marker) {
        // Highlight the marker (open tooltip)
        marker.openTooltip();
        
        // Open the popup for this spot after animation
        setTimeout(() => {
            openPopup(spotToCenter);
        }, 1600); // Wait for fly animation to complete
    } else {
        // If marker not found, still open popup
        setTimeout(() => {
            openPopup(spotToCenter);
        }, 1600);
    }
}




// ===================================================================
// RANDOM PREFERRED SPOT - For "Random for You" button
// ===================================================================
async function showRandomPreferredSpot() {
    console.log('=== Showing Random Preferred Spot ===');
    
    // Close popup if open
    if (popup.classList.contains('active')) {
        closePopup();
    }
    
    // Check if data is ready
    if (!allSpots || allSpots.length === 0 || !allMarkers || allMarkers.length === 0) {
        console.log('Data not ready yet, retrying...');
        setTimeout(showRandomPreferredSpot, 500);
        return;
    }
    
    try {
        // Fetch user preferences
        const response = await fetch('get_user_preferences.php');
        const data = await response.json();
        
        if (!data.success || !data.preferences) {
            console.log('No preferences set, showing random from all spots');
            showRandomFromAllSpots();
            return;
        }
        
        // Parse preferences (comma-separated categories)
        const userPreferences = data.preferences.split(',').map(pref => pref.trim());
        console.log('User preferences:', userPreferences);
        
        if (userPreferences.length === 0) {
            console.log('Empty preferences, showing random from all spots');
            showRandomFromAllSpots();
            return;
        }
        
        // Filter spots based on user preferences
        const matchingSpots = allSpots.filter(spot => {
            if (!spot.category) return false;
            
            const spotCategories = spot.category.split(',').map(cat => cat.trim());
            
            // Check if any of the spot's categories match user preferences
            return spotCategories.some(category => userPreferences.includes(category));
        });
        
        console.log('Found matching spots:', matchingSpots.length);
        
        if (matchingSpots.length === 0) {
            console.log('No matching spots found, showing random from all spots');
            showRandomFromAllSpots();
            return;
        }
        
        // Pick random spot from matching spots
        const randomIndex = Math.floor(Math.random() * matchingSpots.length);
        const randomSpot = matchingSpots[randomIndex];
        
        console.log('Selected random preferred spot:', randomSpot.name);
        
        // Clear all markers first
        markerClusterGroup.clearLayers();
        
        // Find the marker for this spot
        const randomMarker = allMarkers.find(m => {
            return parseInt(m.spotId) === parseInt(randomSpot.id);
        });
        
        if (!randomMarker) {
            console.error('Marker not found for random spot');
            return;
        }
        
        // Add marker to map
        markerClusterGroup.addLayer(randomMarker);
        
        // Validate coordinates
        const lat = parseFloat(randomSpot.latitude);
        const lng = parseFloat(randomSpot.longitude);
        
        if (isNaN(lat) || isNaN(lng)) {
            console.error('Invalid coordinates for random spot');
            return;
        }
        
        // Fly to random location
        console.log('Flying to random preferred location:', lat, lng);
        map.flyTo([lat, lng], 12, {
            duration: 2,
            easeLinearity: 0.25
        });
        
        // Open popup after animation
        setTimeout(() => {
            console.log('Opening random preferred popup');
            openPopup(randomSpot, false, true);
        }, 2300);
        
        // Show notification
        showRandomNotification(`Showing ${randomSpot.name} - Matches your interests!`);
        
    } catch (error) {
        console.error('Error fetching preferences:', error);
        showRandomFromAllSpots();
    }
}

// Fallback: Show random from all spots
function showRandomFromAllSpots() {
    console.log('Showing random spot from all destinations');
    
    // Close popup if open
    if (popup.classList.contains('active')) {
        closePopup();
    }
    
    if (!allSpots || allSpots.length === 0) return;
    
    const randomIndex = Math.floor(Math.random() * allSpots.length);
    const randomSpot = allSpots[randomIndex];
    
    console.log('Selected random spot:', randomSpot.name);
    
    // Clear all markers first
    markerClusterGroup.clearLayers();
    
    // Find the marker for this spot
    const randomMarker = allMarkers.find(m => {
        return parseInt(m.spotId) === parseInt(randomSpot.id);
    });
    
    if (!randomMarker) {
        console.error('Marker not found for random spot');
        return;
    }
    
    // Add marker to map
    markerClusterGroup.addLayer(randomMarker);
    
    // Validate coordinates
    const lat = parseFloat(randomSpot.latitude);
    const lng = parseFloat(randomSpot.longitude);
    
    if (isNaN(lat) || isNaN(lng)) {
        console.error('Invalid coordinates for random spot');
        return;
    }
    
    // Fly to random location
    map.flyTo([lat, lng], 12, {
        duration: 2,
        easeLinearity: 0.25
    });
    
    // Open popup after animation
    setTimeout(() => {
        openPopup(randomSpot, false);
    }, 2300);
    
    // Show notification
    showRandomNotification(`Exploring ${randomSpot.name}!`);
}

// ===================================================================
// NOTIFICATION FUNCTIONS
// ===================================================================
function showRandomNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'random-notification';
    notification.innerHTML = `
        <i class="fas fa-dice"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 4000);
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification-success';
    notification.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    // Add show class for animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ===================================================================
// PREFERENCES MODAL FUNCTIONS - SINGLE VERSION (NO DUPLICATES!)
// ===================================================================
function savePreferencesFromModal() {
    const checkboxes = document.querySelectorAll('#preferences-modal input[type="checkbox"]:checked');
    const selectedPreferences = Array.from(checkboxes).map(cb => cb.value);
    
    if (selectedPreferences.length === 0) {
        alert('Please select at least one preference');
        return;
    }
    
    console.log('💾 Saving preferences:', selectedPreferences);
    
    // Save to database
    const formData = new FormData();
    formData.append('preferences', selectedPreferences.join(','));
    
    fetch('save_preferences.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('✅ Preferences saved successfully');
            closePreferencesModal();
            
            // Show success notification
            showNotification('Preferences saved! You can now use the "Random for You" button.');
            
            // ✅ SET FLAG to trigger spotlight on next load
            console.log('🎯 Setting flag to trigger spotlight after page reload');
            sessionStorage.setItem('preferencesModalClosed', 'true');
            sessionStorage.removeItem('userSeenSpotlight'); // Clear so spotlight can show
            
            // Reload page to trigger spotlight
            setTimeout(() => {
                window.location.reload();
            }, 500);
        } else {
            console.error('❌ Failed to save preferences:', data.message);
            alert('Failed to save preferences: ' + data.message);
        }
    })
    .catch(error => {
        console.error('❌ Error saving preferences:', error);
        alert('An error occurred. Please try again.');
    });
}

function skipPreferences() {
    console.log('⏭️ Skipping preferences');
    
    // Mark preferences as skipped (empty but set flag)
    const formData = new FormData();
    formData.append('preferences', ''); // Empty preferences
    
    fetch('save_preferences.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('✅ Preferences skipped');
        closePreferencesModal();
        
        // ✅ SET FLAG to trigger spotlight on next load
        console.log('🎯 Setting flag to trigger spotlight after page reload');
        sessionStorage.setItem('preferencesModalClosed', 'true');
        sessionStorage.removeItem('userSeenSpotlight'); // Clear so spotlight can show
        
        // Reload page to trigger spotlight
        setTimeout(() => {
            window.location.reload();
        }, 500);
    })
    .catch(error => {
        console.error('❌ Error skipping preferences:', error);
        closePreferencesModal();
        
        // ✅ STILL SET FLAG ON ERROR
        sessionStorage.setItem('preferencesModalClosed', 'true');
        sessionStorage.removeItem('userSeenSpotlight');
        
        setTimeout(() => {
            window.location.reload();
        }, 500);
    });
}

function closePreferencesModal() {
    const modal = document.getElementById('preferences-modal');
    if (modal) {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
}

// ===================================================================
// SPOTLIGHT FUNCTION - Shows random spot (auto-trigger OR manual)
// ===================================================================
function showSpotlight(fromButton = false) {
    console.log('=== showSpotlight called ===');
    console.log('fromButton:', fromButton);
    console.log('spotlightShown:', spotlightShown);
    console.log('allSpots length:', allSpots ? allSpots.length : 0);
    console.log('allMarkers length:', allMarkers ? allMarkers.length : 0);
    
    // ✅ If called from button, always allow (bypass checks)
    if (fromButton) {
        console.log('🎯 Called from Random button - bypassing checks');
        // Don't set spotlightShown flag for button clicks
    } else {
        // ✅ CHECK 1: Already shown this page load (only for auto-trigger)
        if (spotlightShown) {
            console.log('⏭️ Exiting - spotlight already shown this page load');
            return;
        }
        
        // ✅ IMMEDIATELY mark as shown to prevent double execution
        spotlightShown = true;
        console.log('🔒 Locked - spotlightShown set to true');
    }
    
    // Exit if data not ready
    if (!allSpots || allSpots.length === 0 || !allMarkers || allMarkers.length === 0) {
        console.log('Data not ready yet, retrying...');
        setTimeout(() => {
            if (!fromButton) spotlightShown = false; // Reset flag before retry (only for auto)
            showSpotlight(fromButton);
        }, 500);
        return;
    }
    
    console.log('✅ Starting spotlight...');
    
    // Clear all markers first
    markerClusterGroup.clearLayers();
    
    // Find hidden wonder spots (or use all spots if none found)
    const hiddenWonderSpots = allSpots.filter(spot => {
        return spot.category && spot.category.includes('Hidden Wonders');
    });
    
    const spotsToChooseFrom = hiddenWonderSpots.length > 0 ? hiddenWonderSpots : allSpots;
    console.log('Choosing from:', spotsToChooseFrom.length, 'spots');
    
    // Pick random spot
    const randomIndex = Math.floor(Math.random() * spotsToChooseFrom.length);
    const spotlightSpot = spotsToChooseFrom[randomIndex];
    
    console.log('Selected spotlight spot:', spotlightSpot.name);
    
    // Find the marker for this spot
    const spotlightMarker = allMarkers.find(m => {
        return parseInt(m.spotId) === parseInt(spotlightSpot.id);
    });
    
    if (!spotlightMarker) {
        console.error('Marker not found for spotlight spot');
        spotlightShown = true;
        return;
    }
    
    console.log('Found spotlight marker');
    
    // Add marker to map
    markerClusterGroup.addLayer(spotlightMarker);
    
    // Validate coordinates
    const lat = parseFloat(spotlightSpot.latitude);
    const lng = parseFloat(spotlightSpot.longitude);
    
    if (isNaN(lat) || isNaN(lng)) {
        console.error('Invalid coordinates for spotlight spot');
        spotlightShown = true;
        return;
    }
    
    // Fly to spotlight location
    console.log('Flying to spotlight location:', lat, lng);
    map.flyTo([lat, lng], 12, {
        duration: 2,
        easeLinearity: 0.25
    });
    
    // Open popup after animation
    setTimeout(() => {
        console.log('Opening spotlight popup');
        openPopup(spotlightSpot, true);
    }, 2300);
    
    // ✅ Mark user has seen spotlight (only for auto-trigger)
    if (!fromButton) {
        userHasSeenSpotlight = true;
        console.log('✅ Spotlight activated successfully (auto-trigger)');
    } else {
        console.log('✅ Spotlight activated successfully (manual button click)');
    }
    
    console.log('🔍 Final state - spotlightShown:', spotlightShown, 'userHasSeenSpotlight:', userHasSeenSpotlight);
}

// ===================================================================
// PAGE LOAD EVENT - Main logic controller
// ===================================================================
window.addEventListener('load', function() {
    addClearDirectionsButton();
    console.log('=== Map Page Loaded ===');
    console.log('🔍 BEFORE any logic - sessionStorage state:', {
        freshLogin: sessionStorage.getItem('freshLogin'),
        userSeenSpotlight: sessionStorage.getItem('userSeenSpotlight'),
        guestSeenSpotlight: sessionStorage.getItem('guestSeenSpotlight'),
        fromDestinationClick: sessionStorage.getItem('fromDestinationClick'),
        showPreferencesModal: sessionStorage.getItem('showPreferencesModal'),
        preferencesModalClosed: sessionStorage.getItem('preferencesModalClosed')
    });
    
    loadLanguagePreference();
    const urlParams = new URLSearchParams(window.location.search);
    const sharedSpotId = urlParams.get('spot');
    
    // Priority 1: Shared link (e.g., ?spot=123)
    if (sharedSpotId) {
        console.log('✅ Priority 1: Coming from shared link');
        userHasSeenSpotlight = true;
        spotlightShown = true;
        sessionStorage.setItem('userSeenSpotlight', 'true');
        sessionStorage.setItem('guestSeenSpotlight', 'true');
        
        waitForMarkersReady().then(() => {
            const spot = allSpots.find(s => s.id.toString() === sharedSpotId);
            if (spot) {
                const marker = allMarkers.find(m => m.spotId.toString() === sharedSpotId);
                if (marker) markerClusterGroup.addLayer(marker);
                centerMapOnSpot(spot);
            }
        });
        
        setTimeout(() => {
            loadAndCacheBookmarks().catch(console.error);
        }, 100);
        
        centerMap();
        return; // Exit early
    } 
    
    // Priority 2: Featured destination click (from index.php)
    if (sessionStorage.getItem('fromDestinationClick') === 'true') {
        console.log('✅ Priority 2: Coming from featured destination');
        userHasSeenSpotlight = true;
        spotlightShown = true;
        sessionStorage.setItem('userSeenSpotlight', 'true');
        sessionStorage.setItem('guestSeenSpotlight', 'true');
        
        const spotData = sessionStorage.getItem('spotToCenter');
        sessionStorage.removeItem('fromDestinationClick');
        sessionStorage.removeItem('spotToCenter');
        
        if (spotData) {
            try {
                const spot = JSON.parse(spotData);
                
                waitForMarkersReady().then(() => {
                    const marker = allMarkers.find(m => parseInt(m.spotId) === parseInt(spot.id));
                    if (marker) markerClusterGroup.addLayer(marker);
                    centerMapOnSpot(spot);
                });
            } catch (error) {
                console.error('Error parsing spot data:', error);
            }
        }
        
        setTimeout(() => {
            loadAndCacheBookmarks().catch(console.error);
        }, 100);
        
        centerMap();
        return; // Exit early
    }
    
    // Priority 0: CHECK FOR PREFERENCES MODAL (NEW USER JUST REGISTERED)
    const showPreferencesModal = sessionStorage.getItem('showPreferencesModal');
    if (showPreferencesModal === 'true') {
        console.log('✅ Priority 0: Showing preferences modal for NEW user');
        sessionStorage.removeItem('showPreferencesModal');
        
        // DON'T mark spotlight as shown - let it show AFTER modal is closed
        userHasSeenSpotlight = false;
        spotlightShown = true; // Prevent spotlight from triggering before modal closes
        
        checkLoginStatus().then(() => {
            const preferencesModal = document.getElementById('preferences-modal');
            if (preferencesModal) {
                console.log('📱 Showing preferences modal');
                preferencesModal.classList.remove('hidden');
                preferencesModal.classList.add('flex');
            } else {
                console.error('❌ Preferences modal element not found!');
            }
        });
        
        setTimeout(() => {
            loadAndCacheBookmarks().catch(console.error);
        }, 100);
        
        centerMap();
        console.log('🚪 Waiting for modal to close (skip/save) before showing spotlight');
        return;
    }
    
    // Priority 3: Check if modal was just closed (user clicked skip/save)
    const preferencesModalClosed = sessionStorage.getItem('preferencesModalClosed');
    if (preferencesModalClosed === 'true') {
        console.log('✅ Priority 3: Preferences modal was just closed - triggering spotlight');
        sessionStorage.removeItem('preferencesModalClosed');
        sessionStorage.setItem('userSeenSpotlight', 'true');
        
        userHasSeenSpotlight = true;
        spotlightShown = false; // Allow spotlight to show
        
        setTimeout(() => {
            console.log('🎯 Triggering spotlight after modal closed');
            showSpotlight(false); // false = auto-trigger
        }, 2500); // ✅ Changed to 2.5 seconds
        
        setTimeout(() => {
            loadAndCacheBookmarks().catch(console.error);
        }, 100);
        
        centerMap();
        return;
    }
    
    // Priority 4: Normal page load - check if spotlight should show
    console.log('✅ Priority 4: Normal page load');
    
    // ✅ PREVENT DOUBLE EXECUTION - Set flag immediately
    if (spotlightShown) {
        console.log('⏭️ Spotlight already triggered, skipping fetch');
        centerMap();
        setTimeout(() => {
            loadAndCacheBookmarks().catch(console.error);
        }, 100);
        return;
    }
    
    // Check login status
    fetch('check_login.php')
        .then(response => response.json())
        .then(data => {
            const isLoggedIn = data.logged_in || false;
            const currentUser = data.username || '';
            
            console.log('📊 Server says - isLoggedIn:', isLoggedIn, 'user:', currentUser);
            console.log('🔍 Current spotlightShown state:', spotlightShown);
            
            // ✅ DOUBLE CHECK - prevent race condition
            if (spotlightShown) {
                console.log('⏭️ Race condition detected - spotlight already triggered');
                return;
            }
            
            if (isLoggedIn) {
                // LOGGED-IN USER - Only show spotlight ONCE per session
                const hasSeenSpotlight = sessionStorage.getItem('userSeenSpotlight') === 'true';
                
                console.log('📊 Logged-in user - hasSeenSpotlight:', hasSeenSpotlight);
                
                if (!hasSeenSpotlight) {
                    console.log('🎯 First time this session - showing spotlight');
                    sessionStorage.setItem('userSeenSpotlight', 'true');
                    userHasSeenSpotlight = true;
                    spotlightShown = false; // Allow spotlight function to set it
                    setTimeout(() => showSpotlight(false), 2500); // ✅ Changed to 2.5 seconds
                } else {
                    console.log('⏭️ ✅ SKIPPING - Spotlight already shown this session');
                    spotlightShown = true;
                    userHasSeenSpotlight = true;
                }
            } else {
                // GUEST USER - Show spotlight on EVERY page load
                console.log('📊 Guest user - showing spotlight on every page load');
                spotlightShown = false; // Allow spotlight function to set it
                setTimeout(() => showSpotlight(false), 2500); // ✅ Changed to 2.5 seconds
            }
        })
        .catch(error => {
            spotlightShown = false; // Allow spotlight function to set it
            setTimeout(() => showSpotlight(false), 2500); // ✅ Changed to 2.5 seconds
        });
    
    // Always load bookmarks
    setTimeout(() => {
        loadAndCacheBookmarks().catch(console.error);
    }, 100);
    
    centerMap();
});

// ===================================================================
// MAKE FUNCTIONS GLOBALLY ACCESSIBLE
// ===================================================================
window.updateRandomButtonVisibility = updateRandomButtonVisibility;
window.savePreferencesFromModal = savePreferencesFromModal;
window.skipPreferences = skipPreferences;
window.closePreferencesModal = closePreferencesModal;
window.showRandomPreferredSpot = showRandomPreferredSpot;



// Helper function to wait for markers
function waitForMarkersReady() {
    return new Promise((resolve) => {
        let attempts = 0;
        const checkMarkers = setInterval(() => {
            attempts++;
            if (allMarkers.length > 0) {
                clearInterval(checkMarkers);
                console.log('Markers ready');
                resolve();
            } else if (attempts > 100) {
                clearInterval(checkMarkers);
                console.warn('Timeout waiting for markers');
                resolve();
            }
        }, 100);
    });
}







function closePopup() {
    console.log('=== Closing Popup ===');
    console.log('Current spot:', currentSpot);
    console.log('Has active route:', currentRoute !== null);
    
    popup.classList.remove('active');

    // Helper function to check if any filters or search are active
    const hasActiveFiltersOrSearch = () => {
        const hasActiveFilters = document.querySelector('.filter-btn.active') !== null;
        const hasActiveSearch = document.getElementById('search-bar').value.trim() !== '';
        return hasActiveFilters || hasActiveSearch;
    };

    // ✅ Check if there's an active route
    const hasActiveRoute = (typeof currentRoute !== 'undefined' && currentRoute !== null);

    // If route is active, keep everything visible and exit early
    if (hasActiveRoute) {
        console.log('✅ Route is active - keeping all markers visible');
        // Reset current spot but don't remove any markers
        currentSpot = null;
        return; // Exit early - don't remove any markers
    }

    // 1. Handle spotlight markers - only hide if no active route
    if (currentSpotlightId !== null) {
        console.log('Hiding spotlight marker:', currentSpotlightId);
        const spotlightMarker = allMarkers.find(m => m.spotId === currentSpotlightId);
        if (spotlightMarker) {
            markerClusterGroup.removeLayer(spotlightMarker);
            console.log('Spotlight marker removed');
        }
        currentSpotlightId = null;
    }

    // 2. Handle markers from featured destinations (View on Map)
    if (currentSpot) {
        const spotId = parseInt(currentSpot.id);
        console.log('Processing current spot with ID:', spotId);

        // Check if NO filters/search are active
        const hasFiltersOrSearch = hasActiveFiltersOrSearch();
        console.log('Has active filters/search:', hasFiltersOrSearch);

        // If no filters or search, hide the marker
        if (!hasFiltersOrSearch) {
            console.log('Attempting to hide marker for spot:', spotId);
            
            // Search through ALL markers to find matching spot
            const markerToHide = allMarkers.find(m => {
                const markerSpotId = parseInt(m.spotId);
                console.log('Comparing marker spotId:', markerSpotId, 'with:', spotId);
                return markerSpotId === spotId;
            });

            if (markerToHide) {
                console.log('Found marker to hide, removing from cluster group');
                markerClusterGroup.removeLayer(markerToHide);
                console.log('Marker successfully removed');
            } else {
                console.error('Marker not found for spot:', spotId);
                console.log('Available markers:', allMarkers.map(m => ({ id: m.spotId, name: m.spotName })));
            }
        } else {
            console.log('Keeping marker visible - filters or search are active');
        }

        // Clear flags
        isFromDestinationClick = false;
        destinationSpotData = null;

        // 3. Handle dashboard markers
        const dashboardSpotId = sessionStorage.getItem('dashboardSpotId');
        if (dashboardSpotId) {
            console.log('Dashboard marker found:', dashboardSpotId);
            if (currentSpot.id.toString() === dashboardSpotId) {
                if (!hasFiltersOrSearch) {
                    console.log('Hiding dashboard marker');
                    const dashboardMarker = allMarkers.find(m => parseInt(m.spotId) === parseInt(dashboardSpotId));
                    if (dashboardMarker) {
                        markerClusterGroup.removeLayer(dashboardMarker);
                        console.log('Dashboard marker removed');
                    }
                }
            }
            sessionStorage.removeItem('dashboardSpotId');
        }
    }

    // Reset current spot
    currentSpot = null;
    console.log('Popup closed - markers cleanup complete');
}

let currentImageIndex = 0;


// Existing code for map functionality...

function calculateAverageRating(ratings) {
    if (ratings.length === 0) return 0;
    const totalRating = ratings.reduce((sum, rating) => sum + rating.rating, 0);
    return (totalRating / ratings.length).toFixed(1); // Round to 1 decimal place
}

function getStarIcons(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 >= 0.5;
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    
    let stars = '';
    for (let i = 0; i < fullStars; i++) stars += '<i class="fas fa-star"></i>';
    if (hasHalfStar) stars += '<i class="fas fa-star-half-alt"></i>';
    for (let i = 0; i < emptyStars; i++) stars += '<i class="far fa-star"></i>';
    
    return stars;
}

let currentSpot = null;

async function fetchCompleteSpotData(spotId) {
    if (!spotId) {
        throw new Error('No spot ID provided');
    }
    
    console.log('Fetching complete data for spot ID:', spotId);
    
    try {
        const response = await fetch(`get_spot.php?id=${spotId}`);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const text = await response.text();
        
        if (!text.trim()) {
            throw new Error('Empty response from server');
        }
        
        try {
            const data = JSON.parse(text);
            return data;
        } catch (parseError) {
            console.error('JSON parse error. Response text:', text);
            throw new Error('Invalid JSON response from server');
        }
        
    } catch (error) {
        console.error('fetchCompleteSpotData error:', error);
        throw error;
    }
}

// Helper function for safer fetch operations
async function fetchWithErrorHandling(url) {
    try {
        const response = await fetch(url);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return response;
        
    } catch (error) {
        console.error(`Fetch error for ${url}:`, error);
        // Return a mock response to prevent further errors
        return new Response('{}', { status: 200, headers: { 'Content-Type': 'application/json' } });
    }
}

// Helper function for safe JSON parsing
async function safeJsonParse(response, fallback = null) {
    try {
        const text = await response.text();
        
        if (!text.trim()) {
            console.warn('Empty response, using fallback');
            return fallback;
        }
        
        return JSON.parse(text);
        
    } catch (error) {
        console.error('JSON parse error:', error);
        return fallback;
    }
}

// Additional debugging function - call this to test your get_spot.php
function debugSpotFetch(spotId) {
    console.log('=== DEBUG: Testing spot fetch for ID:', spotId, '===');
    
    fetch(`get_spot.php?id=${spotId}`)
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            return response.text();
        })
        .then(text => {
            console.log('Raw response text:', text);
            try {
                const json = JSON.parse(text);
                console.log('Parsed JSON:', json);
            } catch (e) {
                console.error('Failed to parse JSON:', e);
            }
        })
        .catch(error => {
            console.error('Fetch failed:', error);
        });
}

let bookmarkStateCache = new Map();

async function safeJsonParse(response, fallback = null) {
    try {
        if (!response) {
            console.warn('Response is null or undefined');
            return fallback;
        }
        
        const text = await response.text();
        
        // Check if response is HTML (error page)
        if (text.trim().startsWith('<html') || text.trim().startsWith('<!DOCTYPE')) {
            console.error('Received HTML instead of JSON:', text.substring(0, 200));
            return fallback;
        }
        
        // Check if response is empty
        if (!text.trim()) {
            console.warn('Received empty response');
            return fallback;
        }
        
        return JSON.parse(text);
    } catch (error) {
        console.error('JSON parse error:', error);
        return fallback;
    }
}

// Enhanced openPopup function
async function openPopup(spot, isSpotlight = false, isFromRandomButton = false) {
    if (!spot) {
        console.error('openPopup called with no spot data');
        return;
    }
    
    console.log('Opening popup for spot:', spot.id);
    
    // If we have incomplete data, fetch complete data
    if (!spot.things_to_do || !spot.operating_hours || !spot.nearby_accommodations) {
        console.log('Fetching complete data for incomplete spot:', spot.id);
        
        try {
            const response = await fetch(`get_spot.php?id=${spot.id}`);
            const completeSpotData = await safeJsonParse(response, null);
            
            if (completeSpotData && !completeSpotData.error) {
                spot = {...spot, ...completeSpotData};
                console.log('Complete spot data merged successfully');
            } else {
                console.warn('Failed to fetch complete spot data:', completeSpotData?.error);
            }
        } catch (error) {
            console.error('Error fetching complete spot data:', error);
        }
    }
    
    // Store current spot
    currentSpot = spot;
    
    try {
        // Fetch required data with better error handling
        const [loginResponse, ratingsResponse] = await Promise.all([
            fetch('check_login.php').catch(() => null),
            fetch(`fetch_ratings.php?spot_id=${spot.id}`).catch(() => null)
        ]);
        
        const loginData = await safeJsonParse(loginResponse, { logged_in: false });
        const ratings = await safeJsonParse(ratingsResponse, []);
        
        const isLoggedIn = loginData.logged_in || false;
        const averageRating = calculateAverageRating(ratings);
        
        // Use cached bookmark state
        const isBookmarked = isSpotBookmarked(spot.id);

        // Build and show popup
        buildPopupContent(spot, isSpotlight, ratings, averageRating, isLoggedIn, isBookmarked, isFromRandomButton);
        
        // Show popup and set current state
        popup.classList.add('active');
        currentImageIndex = 0;
        currentSpotlightId = isSpotlight ? spot.id : null;

        // Initialize rating stars if logged in
        if (isLoggedIn) {
            initializeRatingStars();
        }
        
        // Load fresh bookmarks in background if logged in
        if (isLoggedIn) {
            loadAndCacheBookmarks().catch(console.error);
        }
        
    } catch (error) {
        console.error('Error in openPopup:', error);
        // Still try to show popup with basic data
        buildPopupContent(spot, isSpotlight, [], 0, false, false);
        popup.classList.add('active');
    }
}



function getCategoryBadges(categoryString) {
    if (!categoryString) return '<p class="no-info">No category specified</p>';
    
    // Split by comma and trim whitespace
    const categories = categoryString.split(',').map(cat => cat.trim());
    
    // Create a badge for each category with its specific color
    const badges = categories.map(category => {
        const color = getCategoryColor(category);
        return `<span style="background-color: ${color}; padding: 6px 12px; border-radius: 6px; color: white; display: inline-block; margin: 4px 4px 4px 0; font-size: 14px; font-weight: 500;">
            ${category}
        </span>`;
    }).join('');
    
    return `<div style="display: flex; flex-wrap: wrap; gap: 4px;">${badges}</div>`;
}
// SHARE FUNCTIONALITY - Add this after the formatContent object (around line 650)
function createShareButton(spot) {
    return `
        <button class="share-btn" data-spot-id="${spot.id}" data-spot-name="${escapeHtml(spot.name)}" title="Share this spot">
            <i class="fas fa-share-alt"></i>
        </button>
    `;
}

function attachShareButtonListener() {
    const shareBtn = document.querySelector('.share-btn');
    if (shareBtn) {
        shareBtn.removeEventListener('click', handleShareClick); // Remove old listener
        shareBtn.addEventListener('click', handleShareClick);
    }
}

function handleShareClick() {
    const spotId = this.getAttribute('data-spot-id');
    const spotName = this.getAttribute('data-spot-name');
    shareSpot(spotId, spotName);
}

function shareSpot(spotId, spotName) {
    const shareUrl = `${window.location.origin}${window.location.pathname}?spot=${spotId}`;
    
    // Check if Web Share API is available (mobile devices)
    if (navigator.share) {
        navigator.share({
            title: `${spotName} - Lakbay Gabay`,
            text: `Check out ${spotName} on Lakbay Gabay!`,
            url: shareUrl
        }).catch(err => {
            // Only copy to clipboard if user didn't cancel
            if (err.name !== 'AbortError') {
                copyToClipboard(shareUrl, spotName);
            }
        });
    } else {
        copyToClipboard(shareUrl, spotName);
    }
}

function copyToClipboard(url, spotName) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(() => {
            showShareNotification(`Link copied! Share ${spotName} with others.`);
        }).catch(() => {
            fallbackCopyToClipboard(url, spotName);
        });
    } else {
        fallbackCopyToClipboard(url, spotName);
    }
}

function fallbackCopyToClipboard(url, spotName) {
    const textArea = document.createElement('textarea');
    textArea.value = url;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '0';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        const successful = document.execCommand('copy');
        if (successful) {
            showShareNotification(`Link copied! Share ${spotName} with others.`);
        } else {
            prompt('Copy this link to share:', url);
        }
    } catch (err) {
        prompt('Copy this link to share:', url);
    }
    
    document.body.removeChild(textArea);
}

function showShareNotification(message) {
    // Remove any existing notification
    const existingNotification = document.querySelector('.share-notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = 'share-notification';
    notification.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${message}</span>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 3000);
}

const formatContent = {
    cleanText(content) {
        if (!content) return '';
        return content.replace(/\r\n|\r|\\r/g, '\n')
                      .replace(/\\n/g, '\n')
                      .replace(/\n+/g, '\n')
                      .trim();
    },

    list(content, defaultText = 'No information available') {
        const cleanContent = this.cleanText(content);
        if (!cleanContent) return `<p class="no-info">${translate(defaultText)}</p>`;
        
        const items = cleanContent.split('\n').filter(item => item.trim() !== '');
        return items.length > 0 
            ? `<ul>${items.map(item => `<li>${item.trim()}</li>`).join('')}</ul>`
            : `<p class="no-info">${translate(defaultText)}</p>`;
    },

    operatingHours(content) {
        const cleanContent = this.cleanText(content);
        if (!cleanContent) return `<p class="no-info">${translate('Not specified')}</p>`;
        
        const hoursLines = cleanContent.split('\n')
            .filter(line => line.trim() !== '')
            .map(line => line.trim());
        
        if (hoursLines.length === 0) return `<p class="no-info">${translate('Not specified')}</p>`;
        
        if (hoursLines.length === 1 && hoursLines[0].includes(',')) {
            const items = hoursLines[0].split(',')
                .map(item => translate(item.trim()))
                .filter(item => item !== '');
            
            if (items.length > 1) {
                return `<ul class="operating-hours">${
                    items.map(item => `<li>${item}</li>`).join('')
                }</ul>`;
            }
        }
        
        return `<ul class="operating-hours">${
            hoursLines.map(line => `<li>${translate(line)}</li>`).join('')
        }</ul>`;
    },

    // NEW FORMAT: Name as text, link below as clickable
    namedLinks(content, defaultText = 'No information available') {
        const cleanContent = this.cleanText(content);
        if (!cleanContent) return `<p class="no-info">${translate(defaultText)}</p>`;
        
        const items = cleanContent.split('\n').filter(item => item.trim() !== '');
        if (items.length === 0) return `<p class="no-info">${translate(defaultText)}</p>`;
        
        return `<ul class="named-links-list">${
            items.map(item => {
                const trimmedItem = item.trim();
                // Split by colon to separate name and URL
                const colonIndex = trimmedItem.indexOf(':');
                
                if (colonIndex === -1) {
                    // No colon found, treat entire string as a link
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
                
                // Extract name and URL
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

    // Official links - simple format with just domain
    links(links) {
        if (!links) return `<p class="no-info">${translate('No official links available')}</p>`;
        
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
            : `<p class="no-info">${translate('No official links available')}</p>`;
    },

    // Safety level formatting function
    safetyLevel(level) {
        if (!level) return '<p class="no-info">Safety information not available</p>';
        
        const levels = {
            'safe': { text: 'Safe to Visit', color: '#4CAF50', icon: 'fa-check-circle' },
            'caution': { text: 'Visit with Caution', color: '#FFC107', icon: 'fa-exclamation-triangle' },
            'dangerous': { text: 'Dangerous', color: '#F44336', icon: 'fa-exclamation-circle' }
        };
        
        const safety = levels[level] || levels['safe'];
        
        return `
            <div class="safety-indicator" style="background-color: ${safety.color}20; border-left: 4px solid ${safety.color}; padding: 12px; border-radius: 4px; margin: 8px 0;">
                <i class="fas ${safety.icon}" style="color: ${safety.color}; margin-right: 8px;"></i>
                <span style="color: ${safety.color}; font-weight: 600;">${safety.text}</span>
            </div>
        `;
    },

    // Annual visitors formatting function
    annualVisitors(count) {
        if (!count || count === 0) return '<p class="no-info">Visitor data not available</p>';
        
        // Format number with commas for thousands
        const formattedCount = count.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        return `
            <div class="visitors-indicator" style="background-color: #e8f5e8; border-left: 4px solid #4CAF50; padding: 12px; border-radius: 4px; margin: 8px 0;">
                <i class="fas fa-users" style="color: #4CAF50; margin-right: 8px;"></i>
                <span style="color: #2E7D32; font-weight: 600;">${formattedCount} visitors annually</span>
            </div>
        `;
    }
};

function getFeaturesByCategory(category) {
    const features = {
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
        'Wellness Retreats and Leisure': [
            { icon: 'fas fa-spa', text: 'Wellness', color: '#FF8DA1' },
            { icon: 'fas fa-hotel', text: 'Retreats', color: '#FF8DA1' },
            { icon: 'fas fa-bed', text: 'Relaxation', color: '#FF8DA1' },
            { icon: 'fas fa-heart', text: 'Health', color: '#FF8DA1' }
        ],
        'Hidden Wonders': [
            { icon: 'fas fa-gem', text: 'Hidden Gems' },
            { icon: 'fas fa-map-marked-alt', text: 'Less Crowded' },
            { icon: 'fas fa-compass', text: 'Off the Path' },
            { icon: 'fas fa-eye', text: 'Undiscovered' }
        ]
    };
    
    return features[category] || [
        { icon: 'fas fa-star', text: 'Popular' },
        { icon: 'fas fa-camera', text: 'Scenic' },
        { icon: 'fas fa-map-marker-alt', text: 'Accessible' },
        { icon: 'fas fa-heart', text: 'Recommended' }
    ];
}

function getCategoryFeaturesHTML(categories) {
    if (!categories) return '';
    
    // Split categories and trim whitespace
    const categoryList = categories.split(',').map(cat => cat.trim());
    
    // Collect ALL unique features from ALL categories
    const allFeatures = [];
    const seenFeatures = new Set(); // To avoid duplicates
    
    categoryList.forEach(category => {
        const features = getFeaturesByCategory(category);
        features.forEach(feature => {
            // Use text as unique identifier to avoid duplicates
            if (!seenFeatures.has(feature.text)) {
                seenFeatures.add(feature.text);
                allFeatures.push({
                    icon: feature.icon,
                    text: feature.text,
                    category: category
                });
            }
        });
    });
    
    // If no features found, return empty
    if (allFeatures.length === 0) return '';
    
    // Determine if we need "Show More" (more than 8 features)
    const showMoreNeeded = allFeatures.length > 8;
    const initialFeatures = showMoreNeeded ? allFeatures.slice(0, 8) : allFeatures;
    const hiddenFeatures = showMoreNeeded ? allFeatures.slice(8) : [];
    
    // Get color for each feature from its category
    const getFeatureColor = (categoryName) => {
        return filterColors[categoryName] || '#0066cc';
    };
    
    // Build HTML for initial features
    let featuresHTML = '';
    
    initialFeatures.forEach(feature => {
        const color = getFeatureColor(feature.category);
        featuresHTML += `
            <div class="feature-item" data-category="${feature.category}">
                <i class="${feature.icon}" style="color: ${color};"></i>
                <span>${translate(feature.text)}</span>
            </div>
        `;
    });
    
    // Build HTML for hidden features
    hiddenFeatures.forEach(feature => {
        const color = getFeatureColor(feature.category);
        featuresHTML += `
            <div class="feature-item hidden-feature" data-category="${feature.category}" style="display: none;">
                <i class="${feature.icon}" style="color: ${color};"></i>
                <span>${translate(feature.text)}</span>
            </div>
        `;
    });
    
    // Add "Show More" button if needed
    if (showMoreNeeded) {
        featuresHTML += `
            <button class="show-more-features-btn" onclick="toggleFeatureDisplay(this)">
                <i class="fas fa-chevron-down"></i>
                <span>Show ${hiddenFeatures.length} More</span>
            </button>
        `;
    }
    
    return `<div class="category-features-container">${featuresHTML}</div>`;
}

function toggleFeatureDisplay(button) {
    const container = button.closest('.category-features-container');
    const hiddenFeatures = container.querySelectorAll('.hidden-feature');
    const icon = button.querySelector('i');
    const text = button.querySelector('span');
    const isExpanded = button.classList.contains('expanded');
    
    if (isExpanded) {
        // Collapse - hide features
        hiddenFeatures.forEach(feature => {
            feature.style.display = 'none';
        });
        icon.className = 'fas fa-chevron-down';
        text.textContent = `Show ${hiddenFeatures.length} More`;
        button.classList.remove('expanded');
    } else {
        // Expand - show all features
        hiddenFeatures.forEach(feature => {
            feature.style.display = 'flex';
        });
        icon.className = 'fas fa-chevron-up';
        text.textContent = 'Show Less';
        button.classList.add('expanded');
    }
}




function buildPopupContent(spot, isSpotlight, ratings, averageRating, isLoggedIn, isBookmarked, isFromRandomButton = false) {
    // Store ratings globally for sorting
    currentRatings = ratings;
    
    // Prepare content sections
    const contentSections = prepareContentSections(spot);
    
    // Get UI components
    const fullAddress = `${spot.region}, ${spot.province}, ${spot.municipality}`;
    const carouselComponents = createCarouselComponents(spot);
    const ratingStars = createRatingStars();

    const pin = document.querySelector(`.pin[data-id="${spot.id}"]`);
    if (pin) {
        pin.style.display = 'block';
        highlightPin(pin);
    }
    
    // Build the popup HTML with enhanced reviews section
    popup.innerHTML = `
        <div class="popup-header">
            <h4>${spot.name}</h4>
            <div class="popup-header-actions">
                ${createShareButton(spot)}
                ${createDirectionsButton(spot)}
                ${isLoggedIn ? `
                    <button class="bookmark-btn ${isBookmarked ? 'bookmarked' : ''}" onclick="toggleBookmark(${spot.id}, this)" title="${isBookmarked ? 'Remove bookmark' : 'Add bookmark'}">
                        <i class="fas fa-bookmark" style="${isBookmarked ? 'color: #f8d619 !important;' : ''}"></i>
                    </button>
                ` : ''}
                <button class="close-btn" onclick="closePopupOnClick()">×</button>
            </div>
        </div>
        <div class="popup-content">
			${isFromRandomButton ? createRandomForYouBadge() : createSpotlightBanner(isSpotlight)}
            
            <div class="carousel-container">
                <div class="carousel">
                    ${carouselComponents.images}
                    ${carouselComponents.controls}
                    ${carouselComponents.imageCredit}
                </div>
                ${spot.images.length > 1 ? `
                    <div class="carousel-thumbnails">
                        ${carouselComponents.thumbnails}
                    </div>
                ` : ''}
            </div>
            
            <div class="average-rating">
                <div>
                    <div class="rating-value">${averageRating}</div>
                    <div class="rating-count">${ratings.length} ${translate('ratings')}</div>
                </div>
                <div class="rating-stars">
                    ${getStarIcons(averageRating)}
                </div>
            </div>
            
            <div class="tabs">
                <div class="tab active" onclick="switchTab(event, 'overview')">${translate('Overview')}</div>
                <div class="tab" onclick="switchTab(event, 'details')">${translate('Details')}</div>
                <div class="tab" onclick="switchTab(event, 'reviews')">${translate('Reviews')}</div>
            </div>
            
            <div id="overview" class="tab-content active">
                <div class="details-section">
                    <h5><i class="fas fa-info-circle"></i> ${translate('About')}</h5>
                    <p>${spot.overview}</p>
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-tag"></i> ${translate(spot.category.includes(',') ? 'Categories' : 'Category')}</h5>
                    ${getCategoryBadges(spot.category)}
                    ${contentSections.categoryFeatures}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-map-marker-alt"></i> ${translate('Location')}</h5>
                    <p><strong>${translate('Address')}:</strong> ${fullAddress}</p>
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-shield-alt"></i> ${translate('Safety Level')}</h5>
                    ${contentSections.safetyLevel}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-users"></i> ${translate('Annual Visitors')}</h5>
                    ${contentSections.annualVisitors}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-language"></i> ${translate('Local Languages')}</h5>
                    <p>${spot.local_languages || translate('Not specified')}</p>
                </div>
            </div>

            <div id="details" class="tab-content">
                <div class="details-section">
                    <h5><i class="fas fa-umbrella-beach"></i> ${translate('Things to Do')}</h5>
                    ${contentSections.thingsToDo}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-clock"></i> ${translate('Operating Hours')}</h5>
                    ${contentSections.operatingHours}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-hotel"></i> ${translate('Nearby Accommodations')}</h5>
                    ${contentSections.nearbyAccommodations}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-utensils"></i> ${translate('Nearby Restaurants')}</h5>
                    ${contentSections.nearbyRestaurants}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-phone"></i> ${translate('Contact Information')}</h5>
                    ${contentSections.contactInformation}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-link"></i> ${translate('Official Links')}</h5>
                    ${contentSections.officialLinks}
                </div>
                
                <div class="details-section">
                    <h5><i class="fas fa-bus"></i> ${translate('Transportation')}</h5>
                    ${contentSections.transportation}
                </div>
            </div>
            
            <div id="reviews" class="tab-content">
                <div class="reviews-section">
                    <div class="reviews-header">
                        <div class="reviews-header-left">
                            <h5><i class="fas fa-comments"></i> ${translate('User Reviews')}</h5>
                            <span class="reviews-count">${ratings.length} ${ratings.length === 1 ? translate('review') : translate('reviews')}</span>
                        </div>
                        ${ratings.length > 0 ? `
                            <div class="reviews-sort">
                                <select onchange="sortReviews(this.value)" class="sort-dropdown">
                                    <option value="newest">${translate('Newest First')}</option>
                                    <option value="oldest">${translate('Oldest First')}</option>
                                    <option value="highest">${translate('Highest Rated')}</option>
                                    <option value="lowest">${translate('Lowest Rated')}</option>
                                </select>
                            </div>
                        ` : ''}
                    </div>
                    ${createReviewsList(ratings)}
                </div>
                
                <div class="rating-form">
                    <h4><i class="fas fa-star"></i> ${translate('Share Your Experience')}</h4>
                    
                ${isLoggedIn ? `
                    <div class="form-instruction">
                        <p>${translate('Rate this spot and share your experience with other travelers. Your review helps others discover amazing places!')}</p>
                    </div>
                    <div class="review-user-info">
                        <div class="current-user-display">
                            <i class="fas fa-user-circle"></i>
                            <span>${translate('Posting as')}: <strong>${userName}</strong></span>
                        </div>
                        <label class="anonymous-checkbox">
                            <input type="checkbox" id="post-anonymous" />
                            <span>${translate('Post anonymously')}</span>
                        </label>
                    </div>
                    <div class="stars" id="rating-stars">${ratingStars}</div>
                    <textarea id="comment" placeholder="${translate('Share your experience... What did you love about this place? (Optional)')}"></textarea>
                    <button onclick="submitRating(${spot.id})" class="submit-review-btn">
                        <i class="fas fa-paper-plane"></i> ${translate('Submit Review')}
                    </button>
                    ` : `
                        <div class="guest-message">
                            <i class="fas fa-user-lock guest-icon"></i>
                            <div class="guest-text">
                                <p><strong>${translate('Want to share your experience?')}</strong></p>
                                <p>${translate('Join our community of travelers! Log in to rate this spot and leave a review to help others discover amazing places.')}</p>
                            </div>
                            <button onclick="window.location.href='loginform.php'" class="login-to-review-btn">
                                <i class="fas fa-sign-in-alt"></i> ${translate('Log In to Review')}
                            </button>
                        </div>
                    `}
                </div>
            </div>
        </div>
    `;

    // Ensure proper CSS is applied for button positioning
    if (!document.getElementById('popup-action-styles')) {
        const style = document.createElement('style');
        style.id = 'popup-action-styles';
        style.textContent = `
            .popup-header-actions {
                display: flex;
                gap: 8px;
                align-items: center;
            }
            
            .share-btn {
                background: rgba(255, 255, 255, 0.2) !important;
                border: 2px solid rgba(64, 224, 208, 0.3) !important;
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
                order: 0 !important;
            }
            
            .share-btn:hover {
                background: rgba(64, 224, 208, 0.3) !important;
                color: #40e0d0 !important;
                transform: scale(1.1) !important;
                border-color: #40e0d0 !important;
            }
            
            .share-notification {
                position: fixed;
                bottom: 30px;
                left: 50%;
                transform: translateX(-50%) translateY(100px);
                background: linear-gradient(135deg, #0077be, #40e0d0);
                color: white;
                padding: 15px 25px;
                border-radius: 12px;
                box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
                z-index: 10000;
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 600;
                opacity: 0;
                transition: all 0.3s ease;
            }
            
            .share-notification.show {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
            
            .share-notification i {
                font-size: 1.2em;
            }
            
            /* Category Features Styles - Complete Section */
            .category-features-container {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
                margin-top: 12px;
                width: 100%;
            }

            .feature-item {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 12px;
                background: rgba(0, 119, 190, 0.05);
                border-radius: 8px;
                border-left: 4px solid #0077be;
                transition: all 0.3s ease;
                animation: fadeInUp 0.4s ease-out;
            }

            .feature-item[data-category="Beaches & Islands"] {
                background: rgba(64, 224, 208, 0.1);
                border-left-color: #40E0D0;
            }

            .feature-item[data-category="Nature & Wildlife"] {
                background: rgba(34, 139, 34, 0.1);
                border-left-color: #228B22;
            }

            .feature-item[data-category="Urban & Nightlife"] {
                background: rgba(160, 32, 240, 0.1);
                border-left-color: #A020F0;
            }

            .feature-item[data-category="Adventure & Extreme Sports"] {
                background: rgba(255, 165, 0, 0.1);
                border-left-color: #FFA500;
            }

            .feature-item[data-category="Arts & Culture"] {
                background: rgba(234, 36, 50, 0.1);
                border-left-color: #EA2432;
            }

            .feature-item[data-category="Festivals & Events"] {
                background: rgba(255, 255, 0, 0.15);
                border-left-color: #FFFF00;
            }

            .feature-item[data-category="UNESCO Sites"] {
                background: rgba(165, 42, 42, 0.1);
                border-left-color: #A52A2A;
            }

            .feature-item[data-category="Spiritual & Pilgrimage"] {
                background: rgba(87, 185, 255, 0.1);
                border-left-color: #57B9FF;
            }

            .feature-item[data-category="Wellness Retreats and Leisure"] {
                background: rgba(255, 141, 161, 0.1) !important;
                border-left-color: 
        #FF8DA1 !important;
            }

            /* Wellness icon - Pink */
            .feature-item[data-category="Wellness Retreats and Leisure"] i.fa-spa {
                color: 
        #FF8DA1 !important;
            }

            /* Retreats icon - Pink */
            .feature-item[data-category="Wellness Retreats and Leisure"] i.fa-hotel {
                color: 
        #FF8DA1 !important;
            }

            /* Relaxation icon - Pink */
            .feature-item[data-category="Wellness Retreats and Leisure"] i.fa-bed {
                color: 
        #FF8DA1 !important;
            }

            /* Health icon - Pink */
            .feature-item[data-category="Wellness Retreats and Leisure"] i.fa-heart {
                color: 
        #FF8DA1 !important;
            }

            .feature-item[data-category="Hidden Wonders"] {
                background: rgba(39, 39, 87, 0.1);
                border-left-color: #272757;
            }

            .feature-item:hover {
                transform: translateX(4px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .feature-item i {
                font-size: 1.3em;
                flex-shrink: 0;
                min-width: 24px;
                text-align: center;
            }

            .feature-item span {
                font-size: 0.9em;
                font-weight: 500;
                color: #333;
                line-height: 1.4;
                flex: 1;
            }

            .hidden-feature {
                animation: fadeInUp 0.4s ease-out;
            }

            .show-more-features-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 16px;
                background: rgba(0, 119, 190, 0.05);
                border: 2px dashed rgba(0, 119, 190, 0.3);
                border-radius: 8px;
                color: #0077be;
                font-size: 0.9em;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                grid-column: 1 / -1;
                width: 100%;
                margin-top: 4px;
            }

            .show-more-features-btn:hover {
                background: rgba(0, 119, 190, 0.1);
                border-color: rgba(0, 119, 190, 0.5);
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(0, 119, 190, 0.2);
            }

            .show-more-features-btn i {
                transition: transform 0.3s ease;
                font-size: 1em;
            }

            .show-more-features-btn.expanded i {
                transform: rotate(180deg);
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Tablet Responsive */
            @media (max-width: 768px) {
                .category-features-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 8px;
                }

                .feature-item {
                    padding: 8px 10px;
                    gap: 8px;
                }

                .feature-item i {
                    font-size: 1.2em;
                    min-width: 22px;
                }

                .feature-item span {
                    font-size: 0.85em;
                }

                .show-more-features-btn {
                    padding: 10px 14px;
                    font-size: 0.85em;
                }
            }

            /* Mobile Responsive */
            @media (max-width: 480px) {
                .category-features-container {
                    grid-template-columns: 1fr;
                    gap: 6px;
                    margin-top: 10px;
                }

                .feature-item {
                    padding: 10px 12px;
                    gap: 10px;
                    border-left-width: 3px;
                }

                .feature-item:hover {
                    transform: translateX(2px);
                }

                .feature-item i {
                    font-size: 1.1em;
                    min-width: 20px;
                }

                .feature-item span {
                    font-size: 0.85em;
                    line-height: 1.3;
                }

                .show-more-features-btn {
                    padding: 10px 12px;
                    font-size: 0.85em;
                    gap: 6px;
                    margin-top: 2px;
                }

                .show-more-features-btn i {
                    font-size: 0.9em;
                }
            }

            /* Extra Small Mobile */
            @media (max-width: 360px) {
                .feature-item {
                    padding: 8px 10px;
                    gap: 8px;
                }

                .feature-item i {
                    font-size: 1em;
                    min-width: 18px;
                }

                .feature-item span {
                    font-size: 0.8em;
                }

                .show-more-features-btn {
                    padding: 8px 10px;
                    font-size: 0.8em;
                }
            }
        `;
        document.head.appendChild(style);
    }
    setTimeout(() => {
        attachShareButtonListener();
    }, 0);
}


function createReviewsList(ratings) {
    if (ratings.length === 0) {
        return `<div class="no-reviews-message">
                    <i class="fas fa-comment-slash"></i>
                    <p>${translate('No reviews yet')}</p>
                    <small>${translate('Be the first to share your experience!')}</small>
                </div>`;
    }
    
    const initialDisplayCount = 3;
    const hasMoreReviews = ratings.length > initialDisplayCount;
    
    const allReviewsHTML = ratings.map((rating, index) => {
        const isHidden = index >= initialDisplayCount;
        const isAnonymous = rating.is_anonymous == 1 || rating.username === 'Anonymous';
        
        return `
        <div class="rating-item ${isHidden ? 'hidden-review' : ''}" data-review-index="${index}">
            <div class="rating-header">
                <div class="rating-user-info">
                    ${isAnonymous ? 
                        `<i class="fas fa-user-secret" style="color: #999; margin-right: 6px;"></i>` : 
                        `<i class="fas fa-user-circle" style="color: #0077be; margin-right: 6px;"></i>`
                    }
                    <span class="rating-user ${isAnonymous ? 'anonymous-user' : ''}">${escapeHtml(rating.username)}</span>
                    <span class="rating-date">${formatDate(rating.created_at)}</span>
                </div>
                <div class="rating-stars">
                    ${getStarIcons(rating.rating)}
                </div>
            </div>
            <div class="rating-comment">
                <p>${rating.comment ? escapeHtml(rating.comment) : '<em class="no-comment">' + translate('No comment provided') + '</em>'}</p>
            </div>
        </div>
        `;
    }).join('');
    
    return `
        <div class="reviews-list" id="reviews-list-container">
            ${allReviewsHTML}
        </div>
        ${hasMoreReviews ? `
            <div class="show-more-container">
                <button class="show-more-btn" onclick="toggleAllReviews()">
                    <i class="fas fa-chevron-down"></i>
                    <span>${translate('Show All')} (${ratings.length - initialDisplayCount} ${translate('more')})</span>
                </button>
            </div>
        ` : ''}
    `;
}
// Add CSS for anonymous review feature
const anonymousReviewStyles = document.createElement('style');
anonymousReviewStyles.textContent = `
    .review-user-info {
        background: linear-gradient(135deg, rgba(0, 119, 190, 0.05), rgba(64, 224, 208, 0.05));
        border-left: 4px solid #0077be;
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .current-user-display {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #333;
        font-size: 0.95em;
    }

    .current-user-display i {
        color: #0077be;
        font-size: 1.3em;
    }

    .current-user-display strong {
        color: #0077be;
        font-weight: 600;
    }

    .anonymous-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 0.9em;
        color: #666;
        user-select: none;
        transition: all 0.2s ease;
        padding: 4px 8px;
        border-radius: 6px;
    }

    .anonymous-checkbox:hover {
        color: #0077be;
        background: rgba(0, 119, 190, 0.05);
    }

    .anonymous-checkbox input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #0077be;
    }

    .anonymous-checkbox input[type="checkbox"]:checked + span {
        color: #0077be;
        font-weight: 600;
    }

    .anonymous-user {
        color: #999 !important;
        font-style: italic;
    }

    .rating-user-info i.fa-user-secret {
        opacity: 0.7;
    }

    @media (max-width: 768px) {
        .review-user-info {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            padding: 12px 14px;
        }
        
        .current-user-display,
        .anonymous-checkbox {
            font-size: 0.85em;
        }
    }
`;
document.head.appendChild(anonymousReviewStyles);

function prepareContentSections(spot) {
    return {
        thingsToDo: formatContent.list(spot.things_to_do, 'No activities listed'),
        operatingHours: formatContent.operatingHours(spot.operating_hours),
        professionalReview: formatContent.list(spot.professional_review, 'No professional review available'),
        nearbyAccommodations: formatContent.namedLinks(spot.nearby_accommodations, 'No nearby accommodations listed'),
        nearbyRestaurants: formatContent.namedLinks(spot.nearby_restaurants, 'No nearby restaurants listed'),
        contactInformation: formatContent.list(spot.contact_information, 'No contact information available'),
        transportation: formatContent.list(spot.transportation, 'No transportation information available'),
        officialLinks: formatContent.links(spot.official_links),
        safetyLevel: formatContent.safetyLevel(spot.safety_level),
        annualVisitors: formatContent.annualVisitors(spot.annual_visitors),
        categoryFeatures: getCategoryFeaturesHTML(spot.category)
    };
}

function getCategoryColor(category) {
    const colors = {
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
    
    return colors[category] || '#0066cc';
}


function toggleAllReviews() {
    const hiddenReviews = document.querySelectorAll('.rating-item.hidden-review');
    const showMoreBtn = document.querySelector('.show-more-btn');
    const isExpanded = showMoreBtn.classList.contains('expanded');
    
    if (isExpanded) {
        // Collapse - hide reviews beyond first 3
        const allReviews = document.querySelectorAll('.rating-item');
        allReviews.forEach((review, index) => {
            if (index >= 3) {
                review.classList.add('hidden-review');
            }
        });
        
        showMoreBtn.classList.remove('expanded');
        const hiddenCount = allReviews.length - 3;
        showMoreBtn.innerHTML = `
            <i class="fas fa-chevron-down"></i>
            <span>${translate('Show All')} (${hiddenCount} ${translate('more')})</span>
        `;
        
        // Smooth scroll to reviews section
        const reviewsSection = document.querySelector('.reviews-section');
        if (reviewsSection) {
            reviewsSection.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        }
    } else {
        // Expand - show all reviews
        hiddenReviews.forEach(review => {
            review.classList.remove('hidden-review');
        });
        
        showMoreBtn.classList.add('expanded');
        showMoreBtn.innerHTML = `
            <i class="fas fa-chevron-up"></i>
            <span>${translate('Show Less')}</span>
        `;
    }
}

function sortReviews(sortType) {
    if (!currentRatings || currentRatings.length === 0) return;
    
    let sortedRatings = [...currentRatings];
    
    switch(sortType) {
        case 'newest':
            sortedRatings.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            break;
        case 'oldest':
            sortedRatings.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
            break;
        case 'highest':
            sortedRatings.sort((a, b) => b.rating - a.rating);
            break;
        case 'lowest':
            sortedRatings.sort((a, b) => a.rating - b.rating);
            break;
    }
    
    // Update global ratings
    currentRatings = sortedRatings;
    
    // Regenerate the reviews list
    const reviewsHTML = createReviewsList(sortedRatings);
    
    // Create temporary div to parse new HTML
    const temp = document.createElement('div');
    temp.innerHTML = reviewsHTML;
    
    // Find and replace old elements
    const oldList = document.getElementById('reviews-list-container');
    const oldBtn = document.querySelector('.show-more-container');
    
    if (oldList) {
        const newList = temp.querySelector('#reviews-list-container');
        if (newList) {
            oldList.replaceWith(newList);
        }
    }
    
    if (oldBtn) {
        const newBtn = temp.querySelector('.show-more-container');
        if (newBtn) {
            oldBtn.replaceWith(newBtn);
        } else {
            oldBtn.remove();
        }
    }
}

function createCarouselComponents(spot) {
    console.log('Creating carousel for spot:', spot.name);
    console.log('Image owners:', spot.image_owners);
    
    let imagesHTML = '';
    let thumbnailsHTML = '';
    
    spot.images.forEach((image, index) => {
        // Get owner for this image
        let owner = 'Unknown Photographer';
        if (spot.image_owners && spot.image_owners[index]) {
            owner = spot.image_owners[index];
        }
        
        imagesHTML += `
            <img src="${image}" 
                 alt="Image ${index + 1} by ${owner}" 
                 class="${index === 0 ? 'active' : ''}" 
                 onclick="openFullScreenImage()"
                 data-index="${index}"
                 data-owner="${owner}">
        `;
        
        thumbnailsHTML += `
            <div class="carousel-thumbnail ${index === 0 ? 'active' : ''}" 
                 onclick="showImage(${index})"
                 title="Photo by: ${owner}">
                <img src="${image}" alt="Thumbnail by: ${owner}">
            </div>
        `;
    });

    // Get the first image owner for the credit display
    let firstOwner = 'Unknown Photographer';
    if (spot.image_owners && spot.image_owners[0]) {
        firstOwner = spot.image_owners[0];
    }

    return {
        images: imagesHTML,
        thumbnails: thumbnailsHTML,
        controls: spot.images.length > 1 ? `
            <button class="carousel-control prev" onclick="prevImage()">&#10094;</button>
            <button class="carousel-control next" onclick="nextImage()">&#10095;</button>
        ` : '',
        imageCredit: `
            <div class="image-credit-display" id="image-credit-display">
                Photo by: ${firstOwner}
            </div>
        `
    };
}

function getOwnerForImage(spot, index) {
    let owner = 'Unknown Photographer';
    if (spot.image_owners && spot.image_owners[index]) {
        const ownerData = spot.image_owners[index];
        if (ownerData.toString().match(/^\d+$/)) {
            owner = `Photographer ${ownerData}`;
        } else {
            owner = ownerData;
        }
    }
    return owner;
}

function createRatingStars() {
    return [1, 2, 3, 4, 5].map(i => 
        `<span class="star" data-rating="${i}">&#9733;</span>`
    ).join('');
}

function createSpotlightBanner(isSpotlight) {
    if (!isSpotlight) return '';
    
    return `
        <div class="spotlight-banner">
            <span class="spotlight-decoration decoration-1">✨</span>
            <span class="spotlight-decoration decoration-2">✨</span>
            <span class="spotlight-decoration decoration-3">⭐</span>
            <span class="spotlight-decoration decoration-4">⭐</span>
            
            <div class="spotlight-icon-wrapper">
                <div class="spotlight-rays">
                    <div class="ray"></div>
                    <div class="ray"></div>
                    <div class="ray"></div>
                    <div class="ray"></div>
                    <div class="ray"></div>
                    <div class="ray"></div>
                    <div class="ray"></div>
                    <div class="ray"></div>
                </div>
                <div class="spotlight-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
            </div>
            
            <span class="spotlight-text">${translate('SPOTLIGHT OF THE DAY')}</span>
        </div>
    `;
}

function createRandomForYouBadge() {
    return `
        <div class="random-for-you-banner">
            <span class="random-decoration decoration-1">🎲</span>
            <span class="random-decoration decoration-2">🎲</span>
            <span class="random-decoration decoration-3">✨</span>
            <span class="random-decoration decoration-4">✨</span>
            
            <div class="random-icon-wrapper">
                <div class="random-pulse-rings">
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring"></div>
                </div>
                <div class="random-icon">
                    <i class="fas fa-dice"></i>
                </div>
            </div>
            
            <span class="random-text">${translate('BASED ON YOUR PREFERENCES')}</span>
        </div>
    `;
}

async function submitRating(spotId) {
    const response = await fetch('check_login.php');
    const data = await response.json();
    const isLoggedIn = data.logged_in;

    if (!isLoggedIn) {
        alert('You must be logged in to rate a spot.');
        window.location.href = 'loginform.php';
        return;
    }

    const ratingForm = document.querySelector('.rating-form');
    const rating = ratingForm.dataset.rating;
    const comment = document.getElementById('comment').value;
    const isAnonymous = document.getElementById('post-anonymous')?.checked || false;

    if (!rating) {
        alert('Please select a rating.');
        return;
    }

    const formData = new FormData();
    formData.append('spot_id', spotId);
    formData.append('rating', rating);
    formData.append('comment', comment);
    formData.append('is_anonymous', isAnonymous ? '1' : '0');

    fetch('rate_spot.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        alert(message);
        const currentSpot = allSpots.find(spot => spot.id == spotId);
        if (currentSpot) {
            openPopup(currentSpot);
        }
    })
    .catch(error => console.error('Error:', error));
}


function initializeRatingStars() {
    const starsContainer = document.getElementById('rating-stars');
    if (!starsContainer) return;

    let selectedRating = 0;
    const stars = starsContainer.querySelectorAll('.star');
    const ratingForm = document.querySelector('.rating-form');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.rating);
            ratingForm.dataset.rating = selectedRating;
            updateStars(stars, selectedRating);
        });
        
        star.addEventListener('mouseover', function() {
            updateStars(stars, parseInt(this.dataset.rating));
        });
        
        star.addEventListener('mouseout', function() {
            updateStars(stars, selectedRating);
        });
    });

    function updateStars(stars, rating) {
        stars.forEach((s, i) => {
            s.classList.toggle('active', i < rating);
        });
    }
}

function switchTab(event, tabId) {
    // Update active tab
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => tab.classList.remove('active'));
    event.currentTarget.classList.add('active');
    
    // Update active content
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => content.classList.remove('active'));
    document.getElementById(tabId).classList.add('active');
}

function showImage(index) {
    if (!currentSpot || !currentSpot.images || index >= currentSpot.images.length) return;
    
    console.log(`Showing image ${index} for spot:`, currentSpot.name);
    console.log('Image owners array:', currentSpot.image_owners);
    
    currentImageIndex = index;
    
    // Update images
    const carouselImages = document.querySelectorAll('.carousel img');
    carouselImages.forEach((img, i) => {
        img.classList.toggle('active', i === index);
    });
    
    // Get owner for the current image
    let owner = 'Unknown Photographer';
    if (currentSpot.image_owners && currentSpot.image_owners[index]) {
        owner = currentSpot.image_owners[index];
        console.log(`Image ${index} owner:`, owner);
    }
    
    // Update image credit display
    let creditDisplay = document.getElementById('image-credit-display');
    
    if (creditDisplay) {
        creditDisplay.textContent = `Photo by: ${owner}`;
        console.log('Updated credit display to:', `Photo by: ${owner}`);
    } else {
        // Create credit display if it doesn't exist
        console.log('Credit display not found, creating new one');
        const carouselContainer = document.querySelector('.carousel-container');
        if (carouselContainer) {
            const newCredit = document.createElement('div');
            newCredit.id = 'image-credit-display';
            newCredit.className = 'image-credit-display';
            newCredit.textContent = `Photo by: ${owner}`;
            
            carouselContainer.appendChild(newCredit);
            console.log('Created new credit display');
        }
    }
    
    // Update thumbnails
    const thumbnails = document.querySelectorAll('.carousel-thumbnail');
    thumbnails.forEach((thumb, i) => {
        thumb.classList.toggle('active', i === index);
    });
}

function prevImage() {
    const images = document.querySelectorAll('.carousel img');
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    showImage(currentImageIndex);
}

function nextImage() {
    const images = document.querySelectorAll('.carousel img');
    currentImageIndex = (currentImageIndex + 1) % images.length;
    showImage(currentImageIndex);
}

function openFullScreenImage() {
    if (!currentSpot) return;

    let currentOwner = 'Unknown Photographer';
    if (currentSpot.image_owners && currentSpot.image_owners[currentImageIndex]) {
        currentOwner = currentSpot.image_owners[currentImageIndex];
    }

    const fullScreenContainer = document.createElement('div');
    fullScreenContainer.className = 'fullscreen-image-container';
    fullScreenContainer.innerHTML = `
        <div class="fullscreen-image-overlay"></div>
        <img src="${currentSpot.images[currentImageIndex]}" alt="Photo by: ${currentOwner}" class="fullscreen-image">
        <div class="image-credit-display" style="position: absolute; bottom: 30px; left: 30px; background: rgba(0, 0, 0, 0.8); color: white; padding: 10px 15px; border-radius: 6px; font-size: 14px; font-weight: 500; z-index: 2001;">
            Photo by: ${currentOwner}
        </div>
        <button class="close-fullscreen-btn" onclick="closeFullScreenImage()">×</button>
        ${currentSpot.images.length > 1 ? `
            <button class="carousel-control prev" onclick="fullScreenPrevImage()">&#10094;</button>
            <button class="carousel-control next" onclick="fullScreenNextImage()">&#10095;</button>
        ` : ''}
    `;
    
    fullScreenContainer.dataset.currentIndex = currentImageIndex;
    fullScreenContainer.dataset.images = JSON.stringify(currentSpot.images);
    fullScreenContainer.dataset.imageOwners = JSON.stringify(currentSpot.image_owners || []);
    
    document.body.appendChild(fullScreenContainer);
}
let fullScreenCurrentIndex = 0;

function fullScreenPrevImage() {
    const fullScreenContainer = document.querySelector('.fullscreen-image-container');
    if (!fullScreenContainer) return;
    
    const images = JSON.parse(fullScreenContainer.dataset.images);
    const imageOwners = JSON.parse(fullScreenContainer.dataset.imageOwners || '[]');
    let currentIndex = parseInt(fullScreenContainer.dataset.currentIndex);
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    
    fullScreenContainer.dataset.currentIndex = currentIndex;
    currentImageIndex = currentIndex;
    
    let currentOwner = 'Unknown Photographer';
    if (imageOwners && imageOwners[currentIndex]) {
        currentOwner = imageOwners[currentIndex].toString().trim() || 'Unknown Photographer';
    }
    
    const fullscreenImg = fullScreenContainer.querySelector('.fullscreen-image');
    const fullscreenCredit = fullScreenContainer.querySelector('.image-credit-display');
    
    fullscreenImg.src = images[currentIndex]; // FIXED: Use images array
    fullscreenImg.alt = `Photo by: ${currentOwner}`;
    fullscreenCredit.textContent = `Photo by: ${currentOwner}`;
    
    showImage(currentIndex);
}

function fullScreenNextImage() {
    const fullScreenContainer = document.querySelector('.fullscreen-image-container');
    if (!fullScreenContainer) return;
    
    const images = JSON.parse(fullScreenContainer.dataset.images);
    const imageOwners = JSON.parse(fullScreenContainer.dataset.imageOwners || '[]');
    let currentIndex = parseInt(fullScreenContainer.dataset.currentIndex);
    currentIndex = (currentIndex + 1) % images.length;
    
    fullScreenContainer.dataset.currentIndex = currentIndex;
    currentImageIndex = currentIndex;
    
    let currentOwner = 'Unknown Photographer';
    if (imageOwners && imageOwners[currentIndex]) {
        currentOwner = imageOwners[currentIndex].toString().trim() || 'Unknown Photographer';
    }
    
    const fullscreenImg = fullScreenContainer.querySelector('.fullscreen-image');
    const fullscreenCredit = fullScreenContainer.querySelector('.image-credit-display');
    
    fullscreenImg.src = images[currentIndex]; // FIXED: Use images array
    fullscreenImg.alt = `Photo by: ${currentOwner}`;
    fullscreenCredit.textContent = `Photo by: ${currentOwner}`;
    
    showImage(currentIndex);
}

function closeFullScreenImage() {
    const fullScreenContainer = document.querySelector('.fullscreen-image-container');
    if (fullScreenContainer) {
        fullScreenContainer.remove();
    }
}


function closePopupOnClick() {
    closePopup();
}

function loadMunicipalities() {
    const province = document.getElementById('province').value;
    const municipalitySelect = document.getElementById('municipality');
    municipalitySelect.innerHTML = '<option value="" disabled selected>Select Municipality/City</option>';
    if (province && provinces[province]) {
        provinces[province].forEach(municipality => {
            const option = document.createElement('option');
            option.value = municipality;
            option.textContent = municipality;
            municipalitySelect.appendChild(option);
        });
    }
}


function hideAllPins() {
    hideAllLeafletMarkers();
}

searchBar.addEventListener('keyup', function (e) {
    if (e.key === 'Enter') {
        const searchTerm = this.value.trim();
        
        if (searchTerm) {
            // Perform search
        } else {
            // If search is cleared, hide all markers
            hideAllLeafletMarkers();
        }
        
        // Deactivate filter buttons
        filterButtons.forEach(button => {
            button.classList.remove('active');
            button.style.backgroundColor = '';
            button.style.color = '';
            button.style.borderLeftColor = '';
            button.style.boxShadow = '';
            button.style.setProperty('--dot-color', '');
        });
    }
});

// Create search button
const searchButton = document.createElement('button');
searchButton.id = 'search-button';
searchButton.setAttribute('aria-label', 'Search');
searchButton.innerHTML = '<i class="fas fa-search"></i>';
const searchBarContainer = searchBar.parentNode;
searchBarContainer.appendChild(searchButton);

// Search on button click
searchButton.addEventListener('click', function () {
    const searchTerm = searchBar.value.trim();
    
    if (searchTerm) {
        // Perform search
    } else {
        // If search is empty, hide all markers
        hideAllLeafletMarkers();
    }
    
    // Deactivate filter buttons
    filterButtons.forEach(button => {
        button.classList.remove('active');
        button.style.backgroundColor = '';
        button.style.color = '';
        button.style.borderLeftColor = '';
        button.style.boxShadow = '';
        button.style.setProperty('--dot-color', '');
    });
});

function testImageLoading() {
    Object.values(pinImages).forEach(src => {
        const testImg = new Image();
        testImg.onload = function () {
            console.log(`Image loaded successfully: ${src}`);
        };
        testImg.onerror = function () {
            console.error(`Error loading image: ${src}`);
        };
        testImg.src = src;
    });
}



function determinePrimaryCategory(categories) {
    // Define category priority (you can adjust this order)
    const priority = [
        'UNESCO Sites',
        'Hidden Wonders', 
        'Nature & Wildlife',
        'Adventure & Extreme Sports',
        'Beaches & Islands',

        'Arts & Culture',
        'Spiritual & Pilgrimage',
        'Wellness Retreats and Leisure',
        'Urban & Nightlife',
        'Festivals & Events'
    ];
    
    // Find the highest priority category that exists in the spot's categories
    for (const category of priority) {
        if (categories.includes(category)) {
            return category;
        }
    }
    
    // Fallback to first category if no priority match
    return categories[0] || 'Beaches & Islands';
}

fetch('fetch_spot_data.php')
    .then(response => response.json())
    .then(data => {
        console.log('Raw Fetched Data:', data);
        
        // Process the data
        allSpots = data.map(spot => {
            if (spot.image_owners && typeof spot.image_owners === 'string') {
                spot.image_owners = spot.image_owners.split(',').map(owner => owner.trim());
            }
            if (!spot.image_owners) {
                spot.image_owners = [];
            }
            return spot;
        });
        
        // Initialize Leaflet map and create markers (but don't display them)
        initializeLeafletMap();
        createLeafletMarkers(); // Creates markers but doesn't add to map
        
        // IMPORTANT: Don't call showAllMarkers() here
        // Markers will only show when:
        // 1. A filter is clicked
        // 2. A search is performed
        // 3. Spotlight is shown
        // 4. Direct navigation from dashboard/featured
        
        // Show spotlight after a short delay
        setTimeout(showSpotlight, 500);
    })
    .catch(error => console.error('Error fetching spot data:', error));

// Add these new helper functions:
function showPinTooltip(marker, name, category) {
    // For Leaflet markers, use built-in tooltip functionality
    if (marker && marker instanceof L.Marker) {
        // Bind and open tooltip with custom content
        marker.bindTooltip(`
            <div class="pin-tooltip-name">${name}</div>
            <div class="pin-tooltip-category">${category}</div>
        `, {
            permanent: false,
            direction: 'top',
            offset: [0, -32],
            className: 'custom-tooltip pin-tooltip'
        }).openTooltip();
    }
}

function hidePinTooltip() {
    const existingTooltip = document.querySelector('.pin-tooltip');
    if (existingTooltip) {
        existingTooltip.remove();
    }
}

function highlightPin(pin) {
    // Reset all pins first
    document.querySelectorAll('.pin').forEach(p => {
        p.style.filter = 'drop-shadow(0 2px 4px rgba(0,0,0,0.3))';
        p.style.zIndex = '100';
    });
    
    // Highlight the selected pin
    pin.style.filter = 'drop-shadow(0 0 10px rgba(255,215,0,0.7))';
    pin.style.zIndex = '1000';
}

// Enhanced Search Functionality with Dropdown Results
// Enhanced Search Functionality with Dropdown Results
// Enhanced Search Functionality with Direct Search Support
let searchResultsCache = [];
let isSearching = false;
let currentSearchResults = [];


function initializeEnhancedSearch() {
    console.log('Initializing enhanced search...');
    
    const searchBar = document.getElementById('search-bar');
    const searchButton = document.getElementById('search-button');
    
    if (!searchBar) return;

    // Ensure the search bar container has position relative
    const searchBarContainer = searchBar.closest('.search-bar-container');
    if (searchBarContainer) {
        searchBarContainer.style.position = 'relative';
    }

    // Create search results container
    const searchResultsContainer = document.createElement('div');
    searchResultsContainer.id = 'search-results-dropdown';
    searchResultsContainer.className = 'search-results-dropdown';
    
    // Append to the search bar container (not just parent)
    const container = searchBar.closest('.search-bar-container') || searchBar.parentElement;
    container.appendChild(searchResultsContainer);

    // Add CSS for results dropdown (keep existing CSS)
    if (!document.getElementById('search-results-styles')) {
        const style = document.createElement('style');
        style.id = 'search-results-styles';
        style.textContent = `
            .search-bar-container {
                position: relative !important;
            }

            .search-results-dropdown {
                position: absolute !important;
                top: calc(100% + 8px) !important;
                left: 0 !important;
                right: 0 !important;
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                max-height: 280px;
                overflow-y: auto;
                z-index: 1010 !important;
                display: none;
            }

            .search-results-dropdown.active {
                display: block;
            }

            .search-result-item {
                padding: 12px 16px;
                border-bottom: 1px solid #f0f0f0;
                cursor: pointer;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .search-result-item:hover {
                background-color: #f8f8f8;
                padding-left: 20px;
            }

            .search-result-item:last-child {
                border-bottom: none;
            }

            .search-result-image {
                width: 50px;
                height: 50px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                flex-shrink: 0;
                background: #f0f0f0;
            }

            .search-result-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .search-result-content {
                flex: 1;
            }

            .search-result-name {
                font-weight: 600;
                color: #0077be;
                font-size: 0.95rem;
                margin-bottom: 2px;
            }

            .search-result-category {
                font-size: 0.8rem;
                color: #999;
            }

            .search-loading {
                padding: 20px;
                text-align: center;
                color: #0077be;
            }

            .search-loading-spinner {
                display: inline-block;
                width: 16px;
                height: 16px;
                border: 2px solid #f3f3f3;
                border-top: 2px solid #0077be;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                margin-right: 8px;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            .search-no-results {
                padding: 20px;
                text-align: center;
                color: #999;
                font-size: 0.9rem;
            }

            @media (max-width: 768px) {
                .search-results-dropdown {
                    max-height: 280px;
                    overflow-y: scroll;
                    -webkit-overflow-scrolling: touch;
                    z-index: 1100;
                }
            }
        `;
        document.head.appendChild(style);
    }
    // SEARCH INPUT EVENT - Show suggestions
    searchBar.addEventListener('input', function(e) {
        const searchTerm = e.target.value.trim();
        
        if (searchTerm.length === 0) {
            hideSearchResults();
            return;
        }

        if (searchTerm.length < 2) {
            return;
        }

        performSearch(searchTerm);
    });

    // ENTER KEY - Perform direct search without selecting suggestion
    searchBar.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const searchTerm = this.value.trim();
            
            if (searchTerm) {
                performDirectSearch(searchTerm);
                hideSearchResults();
            }
        }
    });

    // SEARCH BUTTON CLICK - Perform direct search
    if (searchButton) {
        searchButton.addEventListener('click', function() {
            const searchTerm = searchBar.value.trim();
            
            if (searchTerm) {
                performDirectSearch(searchTerm);
                hideSearchResults();
            } else {
                hideAllLeafletMarkers();
            }
        });
    }

    // Close results when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('#search-bar') && !e.target.closest('#search-results-dropdown')) {
            hideSearchResults();
        }
    });

    // Event delegation for search result clicks
    document.addEventListener('click', function(e) {
        const resultItem = e.target.closest('.search-result-item');
        if (resultItem) {
            const index = resultItem.getAttribute('data-result-index');
            if (index !== null && currentSearchResults[index]) {
                selectSearchResult(currentSearchResults[index].spot);
            }
        }
    });

    console.log('Enhanced search initialized');
}

// NEW FUNCTION: Perform direct search and show all matching pins
function performDirectSearch(searchTerm) {
    console.log('=== Direct Search ===');
    console.log('Search term:', searchTerm);
    
    // ✅ FIX 1: Clear directions/route FIRST
    if (currentRoute) {
        console.log('Clearing route before search');
        clearDirections();
    }
    
    // Close popup if open
    if (popup.classList.contains('active')) {
        closePopup();
    }
    
    const term = searchTerm.toLowerCase();
    const matchingMarkers = [];
    
    // ✅ FIX 2: Clear ALL filters and reset their styles
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(btn => {
        btn.classList.remove('active');
        btn.style.backgroundColor = '';
        btn.style.color = '';
        btn.style.borderLeftColor = '';
        btn.style.boxShadow = '';
        btn.style.setProperty('--dot-color', '');
    });
    
    // Hide filter panel on mobile
    if (window.innerWidth <= 768) {
        const searchFilterContainer = document.querySelector('.search-filter-container');
        if (searchFilterContainer) {
            searchFilterContainer.classList.add('collapsed');
            // Update mobile.js variable if it exists
            if (typeof window.isFilterPanelCollapsed !== 'undefined') {
                window.isFilterPanelCollapsed = true;
            }
        }
    }
    
    // Find all matching markers
    allMarkers.forEach(marker => {
        const spot = marker.spotData;
        
        // Create search text
        const searchText = [
            spot.name,
            spot.category,
            spot.region,
            spot.province,
            spot.municipality,
            spot.overview
        ].filter(Boolean).join(' ').toLowerCase();
        
        // Check if matches
        if (searchText.includes(term)) {
            matchingMarkers.push(marker);
        }
    });
    
    console.log('Found matching markers:', matchingMarkers.length);
    
    if (matchingMarkers.length === 0) {
        alert(`No destinations found for "${searchTerm}"`);
        hideAllLeafletMarkers();
        return;
    }
    
    // Clear and add matching markers to map
    markerClusterGroup.clearLayers();
    matchingMarkers.forEach(marker => {
        markerClusterGroup.addLayer(marker);
    });
    
    // Calculate bounds and zoom to fit all markers
    if (matchingMarkers.length === 1) {
        // Single result - zoom to it
        const latLng = matchingMarkers[0].getLatLng();
        map.flyTo(latLng, 12, {
            duration: 1.5
        });
    } else {
        // Multiple results - fit bounds
        const group = new L.featureGroup(matchingMarkers);
        map.fitBounds(group.getBounds().pad(0.1), {
            duration: 1.5,
            maxZoom: 12
        });
    }
    
    // Show notification
    showSearchNotification(`Found ${matchingMarkers.length} destination${matchingMarkers.length > 1 ? 's' : ''} for "${searchTerm}"`);
}

// Show notification
function showSearchNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'search-notification';
    notification.innerHTML = `
        <i class="fas fa-check-circle"></i>
        <span>${message}</span>
    `;
    notification.style.cssText = `
        position: fixed;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        background: linear-gradient(135deg, #0077be, #40e0d0);
        color: white;
        padding: 15px 25px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 119, 190, 0.3);
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 600;
        opacity: 0;
        transition: all 0.3s ease;
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateX(-50%) translateY(0)';
    }, 10);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(-50%) translateY(100px)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 300);
    }, 3000);
}

// Existing performSearch for suggestions
function performSearch(searchTerm) {
    console.log('Searching for suggestions:', searchTerm);
    
    isSearching = true;
    showSearchLoading();

    setTimeout(() => {
        const results = searchDestinations(searchTerm);
        console.log('Found results:', results.length);
        currentSearchResults = results;
        displaySearchResults(results, searchTerm);
        isSearching = false;
    }, 300);
}

// Existing searchDestinations function
function searchDestinations(searchTerm) {
    const term = searchTerm.toLowerCase();
    const results = [];

    if (!allSpots || allSpots.length === 0) {
        return results;
    }

    allSpots.forEach(spot => {
        const searchText = [
            spot.name,
            spot.category,
            spot.region,
            spot.province,
            spot.municipality,
            spot.overview
        ].filter(Boolean).join(' ').toLowerCase();

        if (searchText.includes(term)) {
            results.push({
                spot: spot,
                matchType: 'exact'
            });
        }
    });

    results.sort((a, b) => {
        const aName = a.spot.name.toLowerCase();
        const bName = b.spot.name.toLowerCase();
        
        const aStartsWith = aName.startsWith(term);
        const bStartsWith = bName.startsWith(term);
        
        if (aStartsWith && !bStartsWith) return -1;
        if (!aStartsWith && bStartsWith) return 1;
        return 0;
    });

    return results.slice(0, 10);
}

// Keep existing helper functions
function showSearchLoading() {
    const container = document.getElementById('search-results-dropdown');
    container.innerHTML = `
        <div class="search-loading">
            <span class="search-loading-spinner"></span>
            Searching destinations...
        </div>
    `;
    container.classList.add('active');
}

function displaySearchResults(results, searchTerm) {
    const container = document.getElementById('search-results-dropdown');

    if (results.length === 0) {
        container.innerHTML = `
            <div class="search-no-results">
                No destinations found for "${searchTerm}"
            </div>
        `;
        container.classList.add('active');
        return;
    }

    let html = '';
    results.forEach((result, index) => {
        const spot = result.spot;
        let imageUrl = 'images/placeholder-destination.jpg';
        if (spot.images && spot.images.length > 0) {
            imageUrl = spot.images[0];
        }

        html += `
            <div class="search-result-item" data-result-index="${index}">
                <div class="search-result-image">
                    <img src="${imageUrl}" alt="${spot.name}" onerror="this.src='images/placeholder-destination.jpg'" />
                </div>
                <div class="search-result-content">
                    <div class="search-result-name">${spot.name}</div>
                    <div class="search-result-category">
                        ${spot.municipality}, ${spot.region}
                    </div>
                </div>
            </div>
        `;
    });

    container.innerHTML = html;
    container.classList.add('active');
}

function hideSearchResults() {
    const container = document.getElementById('search-results-dropdown');
    container.classList.remove('active');
}

function selectSearchResult(spot) {
    console.log('=== Search Result Selected ===');
    console.log('Spot:', spot);
    
    if (!spot || !spot.id) {
        console.error('Invalid spot data');
        return;
    }

    // ✅ FIX: Clear directions/route FIRST
    if (currentRoute) {
        console.log('Clearing route before showing search result');
        clearDirections();
    }

    const lat = parseFloat(spot.latitude);
    const lng = parseFloat(spot.longitude);
    
    if (isNaN(lat) || isNaN(lng)) {
        console.error('Invalid coordinates for spot:', lat, lng);
        return;
    }

    hideSearchResults();
    clearSearchBar();

    // ✅ Also clear any active filters
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(btn => {
        btn.classList.remove('active');
        btn.style.backgroundColor = '';
        btn.style.color = '';
        btn.style.borderLeftColor = '';
        btn.style.boxShadow = '';
        btn.style.setProperty('--dot-color', '');
    });

    const marker = allMarkers.find(m => {
        return parseInt(m.spotId) === parseInt(spot.id);
    });
    
    if (marker) {
        markerClusterGroup.clearLayers();
        markerClusterGroup.addLayer(marker);
    }

    map.flyTo([lat, lng], 15, {
        duration: 2,
        easeLinearity: 0.25
    });

    setTimeout(() => {
        openPopup(spot, false);
    }, 2300);
}

function clearSearchBar() {
    const searchBar = document.getElementById('search-bar');
    searchBar.value = '';
}

// New function to reset zoom and show all pins
// Modified function to reset zoom and show all pins
function resetZoomAndShowAllPins() {
    console.log('=== Resetting Zoom and Showing All Pins ===');
    
    // Clear any active category filters
    const filterButtons = document.querySelectorAll('.filter-button');
    filterButtons.forEach(button => {
        button.classList.remove('active');
        button.style.backgroundColor = '';
        button.style.color = '';
        button.style.borderLeftColor = '';
        button.style.boxShadow = '';
        button.style.setProperty('--dot-color', '');
    });
    
    // Show all markers
    markerClusterGroup.clearLayers();
    allMarkers.forEach(marker => {
        markerClusterGroup.addLayer(marker);
    });
    
    // Fit map to show all markers (smart view)
    setTimeout(() => {
        fitMapToAllMarkers();
    }, 100);
}


// Function to fit map to all markers
function fitMapToAllMarkers() {
    const visibleMarkers = markerClusterGroup.getLayers();
    
    if (visibleMarkers.length === 0) {
        centerMap();
        return;
    }
    
    if (visibleMarkers.length === 1) {
        const latLng = visibleMarkers[0].getLatLng();
        map.setView(latLng, 10, {
            animate: true,
            duration: 1
        });
    } else {
        const group = new L.featureGroup(visibleMarkers);
        map.fitBounds(group.getBounds().pad(0.1), {
            animate: true,
            duration: 1,
            maxZoom: 12
        });
    }
}

searchBar.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        
        // Just reset zoom and show all pins
        resetZoomAndShowAllPins();
        
        // Clear search bar
        clearSearchBar();
        
        // Hide search dropdown
        hideSearchResults();
    }
});

function getCategoryIcon(category) {
    const iconMap = {
        'Beaches & Islands': 'fas fa-umbrella-beach',
        'Nature & Wildlife': 'fas fa-leaf',
        'Urban & Nightlife': 'fas fa-city',
        'Adventure & Extreme Sports': 'fas fa-mountain',
        'Arts & Culture': 'fas fa-palette',
        'Festivals & Events': 'fas fa-calendar-alt',
        'UNESCO Sites': 'fas fa-landmark',
        'Spiritual & Pilgrimage': 'fas fa-praying-hands',
        'Wellness, Retreats, and Leisure': 'fas fa-spa',
        'Hidden Wonders': 'fas fa-gem'
    };
    return iconMap[category] || 'fas fa-map-marker-alt';
}

function getCategoryImage(category) {
    const imageMap = {
        'Beaches & Islands': 'images/pins/beach.png',
        'Nature & Wildlife': 'images/pins/nature.png',
        'Urban & Nightlife': 'images/pins/urban.png',
        'Adventure & Extreme Sports': 'images/pins/adventure.png',
        'Arts & Culture': 'images/pins/art.png',
        'Festivals & Events': 'images/pins/festivals.png',
        'UNESCO Sites': 'images/pins/food.png',
        'Spiritual & Pilgrimage': 'images/pins/spiritual.png',
        'Wellness, Retreats, and Leisure': 'images/pins/resort.png',
        'Hidden Wonders': 'images/pins/underrated.png'
    };
    return imageMap[category] || 'images/placeholder-destination.jpg';
}
// NEW FUNCTION: Fit map view to show all filtered markers
function fitMapToFilteredMarkers() {
    const visibleMarkers = markerClusterGroup.getLayers();
    
    if (visibleMarkers.length === 0) {
        // No markers, reset to default view
        centerMap();
        return;
    }
    
    if (visibleMarkers.length === 1) {
        // Single marker, center on it with fixed zoom
        const latLng = visibleMarkers[0].getLatLng();
        map.setView(latLng, 10, {
            animate: true,
            duration: 1
        });
    } else {
        // Multiple markers, fit bounds to show all
        const group = new L.featureGroup(visibleMarkers);
        map.fitBounds(group.getBounds().pad(0.1), {
            animate: true,
            duration: 1,
            maxZoom: 12
        });
    }
}

// UPDATED FILTER BUTTON CLICK HANDLER - CLEARS DIRECTIONS BEFORE FILTERING

filterButtons.forEach(button => {
    button.addEventListener('click', function () {
        const category = this.id;
        const color = filterColors[category];
        
        // ✅ CLEAR DIRECTIONS/ROUTE FIRST
        if (currentRoute) {
            console.log('Clearing route before applying filter');
            clearDirections();
        }
        
        // Close popup if open
        if (popup.classList.contains('active')) {
            closePopup();
        }
        
        searchBar.value = '';
        sessionStorage.removeItem('dashboardSpotId');
        currentSpotlightId = null;
        
        // Hide filter panel on mobile
        if (window.innerWidth <= 768) {
            const searchFilterContainer = document.querySelector('.search-filter-container');
            if (searchFilterContainer) {
                searchFilterContainer.classList.add('collapsed');
                // Update mobile.js variable if it exists
                if (typeof window.isFilterPanelCollapsed !== 'undefined') {
                    window.isFilterPanelCollapsed = true;
                }
            }
        }
        
        // Check if THIS button is currently active
        const wasActive = this.classList.contains('active');
        
        if (wasActive) {
            // If clicking an already active button, deactivate it and hide all markers
            this.classList.remove('active');
            this.style.backgroundColor = '';
            this.style.color = '';
            this.style.borderLeftColor = '';
            this.style.boxShadow = '';
            this.style.setProperty('--dot-color', '');
            
            // Hide all markers and reset zoom
            hideAllLeafletMarkers();
            centerMap(); // Reset to default Philippines view
        } else {
            // Activate this button
            this.classList.add('active');
            this.style.backgroundColor = `${color}25`;
            this.style.color = color;
            this.style.borderLeftColor = color;
            this.style.boxShadow = `0 3px 8px ${color}25`;
            this.style.setProperty('--dot-color', color);
            
            // Deactivate other buttons
            filterButtons.forEach(otherButton => {
                if (otherButton !== this && otherButton.classList.contains('active')) {
                    otherButton.classList.remove('active');
                    otherButton.style.backgroundColor = '';
                    otherButton.style.color = '';
                    otherButton.style.borderLeftColor = '';
                    otherButton.style.boxShadow = '';
                    otherButton.style.setProperty('--dot-color', '');
                }
            });
            
            // Filter markers by category and reset zoom
            filterMarkersByCategory(category);
            
            // Reset zoom and fit all filtered markers
            setTimeout(() => {
                fitMapToFilteredMarkers();
            }, 100);
        }
    });
});
document.head.insertAdjacentHTML('beforeend', `
<style>
.pin {
    position: absolute;
    width: 16px;
    height: 16px;
    background-size: 16px 16px; /* Force exact size /
    background-repeat: no-repeat;
    background-position: center bottom;
    transform: translate(-50%, -100%);
    / Adjust transform-origin if needed */
    transform-origin: center bottom;
    pointer-events: auto;
    z-index: 100;
}
.pin:hover {
    transform: translate(-50%, -100%) scale(1.3);
    z-index: 1000;
}
.pin-tooltip {
    position: fixed;
    transform: translate(-50%, -100%);
    background: rgba(0,0,0,0.8);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    pointer-events: none;
    z-index: 10000;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    backdrop-filter: blur(2px);
    animation: tooltipFadeIn 0.2s ease-out;
}
.pin-tooltip-name {
    font-weight: bold;
    margin-bottom: 2px;
}
.pin-tooltip-category {
    font-size: 12px;
    opacity: 0.8;
}

</style>
`);


// Prevent zooming inside the pop-out window
popup.addEventListener('wheel', (e) => {
    e.stopPropagation();
});

function debugImagePaths() {
    const debugDiv = document.createElement('div');
    debugDiv.style.position = 'fixed';
    debugDiv.style.top = '10px';
    debugDiv.style.right = '10px';
    debugDiv.style.backgroundColor = 'rgba(255,255,255,0.8)';
    debugDiv.style.padding = '10px';
    debugDiv.style.zIndex = '1000';
    debugDiv.style.maxWidth = '300px';

    let html = '<h3>Pin Images Debug</h3>';
    Object.entries(pinImages).forEach(([category, path]) => {
        html += `<p><strong>${category}:</strong> <img src="${path}" height="20"> ${path}</p>`;
    });

    debugDiv.innerHTML = html;
    document.body.appendChild(debugDiv);
}


// Keep your existing function (for backward compatibility

let isLoggedIn = false;
let userName = '';

let accountDropdown = {
    isOpen: false,
    element: null,
    link: null,
    container: null
};

// ========================================
// ACCOUNT DROPDOWN FUNCTIONS
// ========================================
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

function initializeAccountDropdown() {
    accountDropdown.link = document.querySelector('.account-link');
    accountDropdown.element = document.querySelector('.dropdown-menu');
    accountDropdown.container = document.querySelector('.account-dropdown');
    
    if (accountDropdown.link && accountDropdown.element) {
        if (accountDropdown.container) {
            accountDropdown.container.classList.remove('group');
        }
        
        // Handle click on account link
        accountDropdown.link.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
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

// ========================================
// LOGIN STATUS FUNCTIONS
// ========================================
async function checkLoginStatus() {
    try {
        const response = await fetch('check_login.php');
        const data = await safeJsonParse(response, { logged_in: false });
        isLoggedIn = data.logged_in || false;
        userName = data.username || '';
        
        console.log('🔐 Login Status Check:', {
            isLoggedIn: isLoggedIn,
            userName: userName
        });
        
        // Reset spotlight tracking on login status change
        if (isLoggedIn) {
            userHasSeenSpotlight = sessionStorage.getItem('userSeenSpotlight') === 'true';
            await loadAndCacheBookmarks();
        } else {
            userHasSeenSpotlight = false;
            userBookmarks = [];
            bookmarkStateCache.clear();
            
            // Clear bookmark icons
            document.querySelectorAll('.bookmark-btn').forEach(btn => {
                btn.classList.remove('bookmarked');
                const icon = btn.querySelector('i');
                if (icon) {
                    icon.className = 'far fa-bookmark';
                    icon.style.color = '#666';
                }
            });
        }
        
        // ✅ Show/hide random button based on login status
        updateRandomButtonVisibility(isLoggedIn);
        
        // Update account dropdown (desktop)
        updateAccountDropdown();
        
        // Update mobile account section
        updateMobileAccountSection();
        
        // Translate mobile navigation links
        if (typeof translateMobileNavLinks === 'function') {
            translateMobileNavLinks();
        }
    } catch (error) {
        console.error('Error checking login status:', error);
    }
}

// ✅ NEW: Separate function to update random button visibility
function updateRandomButtonVisibility(isLoggedIn) {
    const randomBtn = document.getElementById('random-btn');
    
    if (!randomBtn) {
        console.warn('⚠️ Random button not found in DOM');
        return;
    }
    
    console.log('🎲 Updating random button visibility. IsLoggedIn:', isLoggedIn);
    
    if (isLoggedIn) {
        randomBtn.classList.add('show-for-logged-in');
        console.log('✅ Random button should now be visible');
    } else {
        randomBtn.classList.remove('show-for-logged-in');
        console.log('❌ Random button hidden (guest user)');
    }
}

// Make it globally accessible
window.updateRandomButtonVisibility = updateRandomButtonVisibility;

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
    const mobileAccountSection = document.querySelector('#mobile-account-section');
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
                <i class="fas fa-sign-out-alt w-5 text-center"></i>
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

// ========================================
// MAIN INITIALIZATION - SINGLE DOMContentLoaded
// ========================================


// ========================================
// MAKE FUNCTIONS GLOBALLY ACCESSIBLE
// ========================================
window.showAccountDropdown = showAccountDropdown;
window.hideAccountDropdown = hideAccountDropdown;

// Function to translate mobile navigation links
async function translateMobileNavLinks() {
    if (currentLanguage === 'en') return;
    
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    for (const link of mobileNavLinks) {
        const originalText = link.getAttribute('data-translate');
        if (originalText && typeof translateText === 'function') {
            try {
                const translatedText = await translateText(originalText, currentLanguage);
                link.textContent = translatedText;
            } catch (error) {
                console.warn('Translation failed for mobile nav link:', originalText, error);
            }
        }
    }
}


// Updated function with better error handling and arrow reset
function populateAccountDropdownWithClicks(isLoggedIn, userData) {
    const dropdown = document.getElementById('account-dropdown');
    if (!dropdown) {
        console.warn('Dropdown element not found');
        return;
    }
    
    if (isLoggedIn) {
        dropdown.innerHTML = `
            <a href="userdashboard.php" class="dropdown-item" data-translate="Dashboard">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
            <a href="#" class="dropdown-item" onclick="logout(); return false;" data-translate="Logout">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        `;
    } else {
        dropdown.innerHTML = `
            <a href="loginform.php" class="dropdown-item" data-translate="Login">
                <i class="fas fa-sign-in-alt"></i>Login
            </a>
            <a href="registerform.php" class="dropdown-item" data-translate="Register">
                <i class="fas fa-user-plus"></i>Register
            </a>
        `;
    }
    
    // Add click handlers to dropdown items to close dropdown after click
    const dropdownItems = dropdown.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Hide dropdown after clicking an item (except for logout which is handled differently)
            if (!this.getAttribute('onclick')) {
                setTimeout(() => {
                    if (typeof hideAccountDropdown === 'function') {
                        hideAccountDropdown();
                    } else {
                        // Fallback if function is not available
                        dropdown.classList.remove('show');
                        dropdown.style.opacity = '0';
                        dropdown.style.visibility = 'hidden';
                        dropdown.style.transform = 'translateY(-10px)';
                        
                        // Reset arrow
                        const accountLink = document.querySelector('.account-link');
                        if (accountLink) {
                            accountLink.classList.remove('active');
                        }
                    }
                }, 100);
            }
        });
    });
    
    // Apply translations if not in English
    if (typeof currentLanguage !== 'undefined' && currentLanguage !== 'en') {
        const translatableElements = dropdown.querySelectorAll('[data-translate]');
        translatableElements.forEach(async (element) => {
            const originalText = element.getAttribute('data-translate');
            if (typeof translateText === 'function') {
                try {
                    const translatedText = await translateText(originalText, currentLanguage);
                    
                    const icon = element.querySelector('i');
                    if (icon) {
                        element.innerHTML = '';
                        element.appendChild(icon);
                        element.appendChild(document.createTextNode(translatedText));
                    } else {
                        element.textContent = translatedText;
                    }
                } catch (error) {
                    console.warn('Translation failed for:', originalText, error);
                }
            }
        });
    }
    
    console.log('Dropdown populated for', isLoggedIn ? 'logged in user' : 'guest');
}

// Your existing logout function
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        fetch('logout.php')
            .then(response => response.text())
            .then(message => {
                // ✅ Clear ALL tracking flags
                userHasSeenSpotlight = false;
                sessionStorage.removeItem('userSeenSpotlight');
                sessionStorage.removeItem('freshLogin');
                sessionStorage.removeItem('loginTimestamp');
                
                // Clear bookmark data
                userBookmarks = [];
                bookmarkStateCache.clear();
                
                // Clear visual bookmark indicators
                document.querySelectorAll('.bookmark-btn').forEach(btn => {
                    btn.classList.remove('bookmarked');
                    const icon = btn.querySelector('i');
                    if (icon) {
                        icon.className = 'far fa-bookmark';
                        icon.style.color = '#666';
                    }
                });
                
                // Show logout notification
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-turquoise text-white px-6 py-4 rounded-2xl shadow-2xl font-bold flex items-center transition-opacity duration-300';
                notification.style.zIndex = '10003'; // ✅ Changed to 10003 (higher than dropdown's 10002)
                notification.innerHTML = '<i class="fas fa-check mr-2"></i>Logged out successfully!';
                document.body.appendChild(notification);
                
                // Remove notification and redirect
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.remove();
                        checkLoginStatus();
                        window.location.href = 'map.php';
                    }, 300);
                }, 1500);
            })
            .catch(error => console.error('Error:', error));
    }
}



// Translation functions
let currentLanguage = 'en';
let translationCache = new Map();

// Function to translate text using the API with better formatting preservation
async function translateText(text, targetLang) {
    if (!text || targetLang === 'en') return text;
    
    // Check cache first
    const cacheKey = `${text}_${targetLang}`;
    if (translationCache.has(cacheKey)) {
        return translationCache.get(cacheKey);
    }
    
    try {
        // Preserve various formatting markers
        const markedText = text
            .replace(/\n/g, '{{NEWLINE}}')
            .replace(/\r\n/g, '{{NEWLINE}}')
            .replace(/\r/g, '{{RETURN}}')
            .replace(/\t/g, '{{TAB}}')
            .replace(/\\n/g, '{{ESCAPED_NEWLINE}}')
            .replace(/\\r/g, '{{ESCAPED_RETURN}}');
        
        const response = await fetch(`translate.php?text=${encodeURIComponent(markedText)}&target_lang=${targetLang}`);
        const data = await response.json();
        
        // Restore formatting markers
        let translatedText = data.responseData.translatedText || text;
        translatedText = translatedText
            .replace(/{{NEWLINE}}/g, '\n')
            .replace(/{{RETURN}}/g, '\r')
            .replace(/{{TAB}}/g, '\t')
            .replace(/{{ESCAPED_NEWLINE}}/g, '\\n')
            .replace(/{{ESCAPED_RETURN}}/g, '\\r')
            // Handle various translation API quirks
            .replace(/\{\{NEWLINE\}\}/g, '\n')
            .replace(/\{\{ NEWLINE \}\}/g, '\n')
            .replace(/\{ \{ NEWLINE \} \}/g, '\n')
            // Fix common translation artifacts
            .replace(/\\n/g, '\n')
            .replace(/\\r/g, '\r')
            .replace(/\\/g, '');
        
        // Cache the result
        translationCache.set(cacheKey, translatedText);
        
        return translatedText;
    } catch (error) {
        console.error('Translation error:', error);
        return text;
    }
}

function initializeLanguageSelector() {
    const savedLang = localStorage.getItem('preferredLanguage') || 'en';
    const languageSelect = document.getElementById('language-select');
    if (languageSelect) {
        languageSelect.value = savedLang;
        currentLanguage = savedLang;
    }
}

function loadLanguagePreference() {
    const savedLang = localStorage.getItem('preferredLanguage');
    if (savedLang) {
        currentLanguage = savedLang;
        document.getElementById('language-select').value = savedLang;
        translatePage(savedLang);
    }
}

// Function to translate all elements with data-translate attribute
async function translatePage(lang) {
    currentLanguage = lang;
    
    // Ensure icons are present before translation
    ensureFilterIcons();
    
    // Translate static elements including mobile nav
    const elements = document.querySelectorAll('[data-translate]');
    for (const element of elements) {
        const originalText = element.dataset.translate;
        if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
            const translatedPlaceholder = await translateText(originalText, lang);
            element.setAttribute('placeholder', translatedPlaceholder);
        } else if (element.classList.contains('filter-btn')) {
            const icon = element.querySelector('i');
            const translatedText = await translateText(originalText, lang);
            
            if (icon) {
                element.innerHTML = '';
                element.appendChild(icon);
                element.appendChild(document.createTextNode(' ' + translatedText));
            } else {
                element.textContent = translatedText;
            }
        } else if (element.classList.contains('mobile-nav-link')) {
            // Handle mobile nav links translation
            const translatedText = await translateText(originalText, lang);
            element.textContent = translatedText;
        } else {
            const translatedText = await translateText(originalText, lang);
            element.textContent = translatedText;
        }
    }

    // Translate map toggle
    const mapToggle = document.getElementById('map-toggle');
    if (mapToggle) {
        const mapToggleText = mapToggle.querySelector('span');
        const originalText = mapToggleText.getAttribute('data-translate');
        const translatedText = await translateText(originalText, lang);
        mapToggleText.textContent = translatedText;
    }
    
    // Translate dynamic content in popup if it's open
    if (currentSpot && document.getElementById('popup').classList.contains('active')) {
        await translatePopupContent(currentSpot, lang);
    }
    
    // Ensure icons are still there after translation
    ensureFilterIcons();
}

// Function to translate popup content
async function translatePopupContent(spot, lang) {
    if (lang === 'en') return; // No need to translate if English
    
    // Translate the main content
    const translateFields = [
        'overview', 'things_to_do', 'professional_review', 
        'nearby_accommodations', 'nearby_restaurants', 
        'contact_information', 'transportation', 'operating_hours'
    ];
    
    for (const field of translateFields) {
        if (spot[field]) {
            spot[field] = await translateText(spot[field], lang);
        }
    }
    
    // Reopen the popup with translated content
    openPopup(spot, currentSpotlightId === spot.id);
}

// Initialize language selector
document.getElementById('language-select').addEventListener('change', async (e) => {
    const lang = e.target.value;
    localStorage.setItem('preferredLanguage', lang);
    await translatePage(lang);
    // Ensure icons are still there after translation
    ensureFilterIcons();
});

// Helper function to use in your code
function translate(text) {
    if (currentLanguage === 'en') return text;

    return text; 
}

function ensureFilterIcons() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    const iconMap = {
        'Beaches & Islands': 'fas fa-umbrella-beach',
        'Nature & Wildlife': 'fas fa-leaf',
        'Urban & Nightlife': 'fas fa-city',
        'Adventure & Extreme Sports': 'fas fa-mountain',
        'Arts & Culture': 'fas fa-palette',
        'Festivals & Events': 'fas fa-calendar-alt',
        'UNESCO Sites': 'fas fa-landmark',
        'Spiritual & Pilgrimage': 'fas fa-praying-hands',
        'Wellness, Retreats, and Leisure': 'fas fa-spa',
        'Hidden Wonders': 'fas fa-gem'
    };
    
    filterButtons.forEach(button => {
        const category = button.id;
        const iconClass = iconMap[category];
        
        if (iconClass) {
            // Check if icon already exists
            const existingIcon = button.querySelector('i');
            if (!existingIcon) {
                // Create and prepend icon
                const icon = document.createElement('i');
                icon.className = `${iconClass} mr-2`;
                button.insertBefore(icon, button.firstChild);
            } else {
                // Ensure correct classes
                existingIcon.className = `${iconClass} mr-2`;
            }
        }
    });
}

// Load and cache bookmarks
async function loadAndCacheBookmarks() {
    try {
        const response = await fetch('get_bookmarks.php');
        const bookmarksData = await safeJsonParse(response, []);
        
        // Handle different response formats
        if (Array.isArray(bookmarksData)) {
            userBookmarks = bookmarksData;
        } else if (bookmarksData && typeof bookmarksData === 'object') {
            userBookmarks = bookmarksData.bookmarks || [];
        } else {
            userBookmarks = [];
        }
        
        // Update cache
        bookmarkStateCache.clear();
        userBookmarks.forEach(bookmark => {
            bookmarkStateCache.set(bookmark.id.toString(), true);
        });
        
        // Update all bookmark icons on the page
        updateAllBookmarkIcons();
        
        return userBookmarks;
    } catch (error) {
        console.error('Error loading bookmarks:', error);
        userBookmarks = [];
        return [];
    }
}

// Check if a spot is bookmarked (with cache)
function isSpotBookmarked(spotId) {
    const id = spotId.toString();
    return bookmarkStateCache.has(id) && bookmarkStateCache.get(id);
}

// Update all bookmark icons on the current page
function updateAllBookmarkIcons() {
    // Update bookmark icons in spot cards
    document.querySelectorAll('.spot-card').forEach(card => {
        const spotId = card.dataset.spotId;
        if (spotId) {
            const bookmarkBtn = card.querySelector('.bookmark-btn');
            if (bookmarkBtn) {
                updateBookmarkIcon(bookmarkBtn, isSpotBookmarked(spotId));
            }
        }
    });
    
    // Update bookmark icon in popup if open
    const popupBookmarkBtn = document.querySelector('.popup .bookmark-btn');
    if (popupBookmarkBtn && currentSpot) {
        updateBookmarkIcon(popupBookmarkBtn, isSpotBookmarked(currentSpot.id));
    }
}

// Update bookmark icon appearance
function updateBookmarkIcon(bookmarkBtn, isBookmarked) {
    if (!bookmarkBtn) return;
    
    const icon = bookmarkBtn.querySelector('i');
    if (!icon) return;
    
    if (isBookmarked) {
        icon.className = 'fas fa-bookmark';
        icon.style.color = '#ffd700'; // Yellow color
        bookmarkBtn.classList.add('bookmarked');
        bookmarkBtn.title = 'Remove from bookmarks';
    } else {
        icon.className = 'far fa-bookmark';
        icon.style.color = '#666';
        bookmarkBtn.classList.remove('bookmarked');
        bookmarkBtn.title = 'Add to bookmarks';
    }
}
// Enhanced bookmark toggle function
async function toggleBookmark(spotId, bookmarkBtn = null) {
    try {
        // Check login status first
        const loginResponse = await fetch('check_login.php');
        const loginData = await safeJsonParse(loginResponse, { logged_in: false });
        
        if (!loginData.logged_in) {
            alert('Please log in to bookmark spots');
            // Redirect to login page
            window.location.href = 'loginform.php';
            return;
        }
        
        const isCurrentlyBookmarked = isSpotBookmarked(spotId);
        const action = isCurrentlyBookmarked ? 'remove' : 'add';
        
        // Optimistically update UI
        bookmarkStateCache.set(spotId.toString(), !isCurrentlyBookmarked);
        if (bookmarkBtn) {
            updateBookmarkIcon(bookmarkBtn, !isCurrentlyBookmarked);
        }
        updateAllBookmarkIcons();
        
        // Send request to server
        const formData = new FormData();
        formData.append('spot_id', spotId);
        formData.append('action', action);
        
        const response = await fetch('toggle_bookmark.php', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        });
        
        const result = await safeJsonParse(response, null);
        
        if (!result || result.error) {
            // Revert optimistic update on error
            bookmarkStateCache.set(spotId.toString(), isCurrentlyBookmarked);
            if (bookmarkBtn) {
                updateBookmarkIcon(bookmarkBtn, isCurrentlyBookmarked);
            }
            updateAllBookmarkIcons();
            
            alert(result?.error || 'Failed to update bookmark');
            return;
        }
        
        // Refresh bookmarks from server to ensure consistency
        await loadAndCacheBookmarks();
        
    } catch (error) {
        console.error('Error toggling bookmark:', error);
        // Revert optimistic update on error
        bookmarkStateCache.set(spotId.toString(), isSpotBookmarked(spotId));
        if (bookmarkBtn) {
            updateBookmarkIcon(bookmarkBtn, isSpotBookmarked(spotId));
        }
        updateAllBookmarkIcons();
        alert('Failed to update bookmark');
    }
}






let map;
let markersLayer;
let markerClusterGroup;
let allMarkers = [];

// Initialize Leaflet Map
function initializeLeafletMap() {
    console.log('🗺️ INITIALIZING LEAFLET MAP');
    
    const philippinesCenter = [12.8797, 121.7740];
    
    // Define Philippines boundaries (approximate bounds)
    const philippinesBounds = L.latLngBounds(
        [4.5, 116.0],  // Southwest coordinates
        [21.5, 127.0]  // Northeast coordinates
    );
    
    map = L.map('leaflet-map', {
        center: philippinesCenter,
        zoom: 6,
        minZoom: 5,
        maxZoom: 18,
        zoomControl: false,
        attributionControl: true,
        maxBounds: philippinesBounds,
        maxBoundsViscosity: 1.0  // Makes the bounds completely solid (no dragging outside)
    });
    
    console.log('✅ Map object created:', map);
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);
    
    // Initialize marker cluster group
    markerClusterGroup = L.markerClusterGroup({
        maxClusterRadius: 50,
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true,
        disableClusteringAtZoom: 15,
        iconCreateFunction: function(cluster) {
            const count = cluster.getChildCount();
            let size = 'small';
            if (count > 10) size = 'medium';
            if (count > 20) size = 'large';
            
            return L.divIcon({
                html: '<div><span>' + count + '</span></div>',
                className: 'marker-cluster marker-cluster-' + size,
                iconSize: new L.Point(40, 40)
            });
        }
    });
    
    map.addLayer(markerClusterGroup);
    
    console.log('✅ Leaflet map initialized');
}

// Create custom marker icon
function createCustomMarkerIcon(category, primaryCategory) {
    const iconUrl = pinImages[primaryCategory] || pinImages['Beaches & Islands'];
    
    return L.divIcon({
        className: 'custom-marker-icon',
        html: `<div style="
            width: 32px;
            height: 32px;
            background-image: url('${iconUrl}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center bottom;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        "></div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });
}

// REMOVED: percentageToLatLng function (no longer needed)

// Create and add markers to map
function createLeafletMarkers() {
    // Clear existing markers
    markerClusterGroup.clearLayers();
    allMarkers = [];
    
    allSpots.forEach(spot => {
        // Use latitude and longitude directly from the API
        // Check if coordinates exist and are valid
        if (!spot.latitude || !spot.longitude || 
            spot.latitude === null || spot.longitude === null ||
            isNaN(spot.latitude) || isNaN(spot.longitude)) {
            console.warn(`⚠️ Skipping spot "${spot.name}" - invalid coordinates:`, spot.latitude, spot.longitude);
            return; // Skip this spot
        }
        
        const latLng = [parseFloat(spot.latitude), parseFloat(spot.longitude)];
        
        // Determine primary category
        let categories = [];
        if (spot.category) {
            categories = spot.category.split(',').map(cat => cat.trim());
        }
        const primaryCategory = determinePrimaryCategory(categories);
        
        // Create custom icon
        const icon = createCustomMarkerIcon(spot.category, primaryCategory);
        
        // Create marker
        const marker = L.marker(latLng, {
            icon: icon,
            title: spot.name
        });
        
        // Store spot data with marker
        marker.spotData = spot;
        marker.spotId = spot.id;
        marker.spotName = spot.name;
        marker.spotCategory = spot.category;
        marker.primaryCategory = primaryCategory;
        
        // Add click event
        marker.on('click', function() {
            openPopup(spot);
        });
        
        // Add hover tooltip
        marker.bindTooltip(spot.name, {
            permanent: false,
            direction: 'top',
            offset: [0, -32],
            className: 'custom-tooltip'
        });
        
        // IMPORTANT: Store markers but DON'T add to cluster group yet
        allMarkers.push(marker);
        // REMOVED: markerClusterGroup.addLayer(marker);
    });
}

function filterMarkersByCategory(category) {
    markerClusterGroup.clearLayers();
    
    allMarkers.forEach(marker => {
        const markerCategories = marker.spotCategory || '';
        
        if (markerCategories.includes(category)) {
            markerClusterGroup.addLayer(marker);
        }
    });
}

// Show all markers
function showAllMarkers() {
    markerClusterGroup.clearLayers();
    allMarkers.forEach(marker => {
        markerClusterGroup.addLayer(marker);
    });
}

// Hide all markers
function hideAllLeafletMarkers() {
    markerClusterGroup.clearLayers();
}

// Search markers

const tooltipStyles = `
<style>
.custom-tooltip {
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    backdrop-filter: blur(2px);
    border: none;
}

.custom-tooltip::before {
    border-top-color: rgba(0, 0, 0, 0.8);
}
</style>
`;
document.head.insertAdjacentHTML('beforeend', tooltipStyles);
window.onload = checkLoginStatus;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize account dropdown
    initializeAccountDropdown();
    addClearDirectionsButton(); 
    // Check login status
    checkLoginStatus();
    
    // ========================================
    // DIRECTIONS BUTTON EVENT DELEGATION
    // ========================================
    document.addEventListener('click', function(e) {
        if (e.target.closest('.directions-btn')) {
            const btn = e.target.closest('.directions-btn');
            const spotId = btn.getAttribute('data-spot-id');
            const spotLat = parseFloat(btn.getAttribute('data-lat'));
            const spotLng = parseFloat(btn.getAttribute('data-lng'));
            const spotName = btn.getAttribute('data-spot-name');
            
            openDirectionsModal(spotId, spotLat, spotLng, spotName);
        }
    });
    
    // ========================================
    // FIX TOUCH SCROLLING FOR MODAL
    // ========================================
    setTimeout(function() {
        const modalScrollContainer = document.querySelector('.modal-scroll-container');
        
        if (modalScrollContainer) {
            console.log('✅ Enabling touch scroll for modal');
            
            // Force enable touch scrolling
            modalScrollContainer.style.touchAction = 'pan-y';
            modalScrollContainer.style.webkitOverflowScrolling = 'touch';
            modalScrollContainer.style.overflowY = 'scroll';
            
            // Remove any blocking event listeners
            const clone = modalScrollContainer.cloneNode(true);
            if (modalScrollContainer.parentNode) {
                modalScrollContainer.parentNode.replaceChild(clone, modalScrollContainer);
            }
            
            console.log('✅ Touch scroll enabled');
        }
    }, 1000);
    
    // Re-apply fix when modal opens (if it gets recreated)
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.id === 'preferences-modal' || (node.querySelector && node.querySelector('#preferences-modal'))) {
                        setTimeout(function() {
                            const modal = document.querySelector('.modal-scroll-container');
                            if (modal) {
                                modal.style.touchAction = 'pan-y';
                                modal.style.webkitOverflowScrolling = 'touch';
                                modal.style.overflowY = 'scroll';
                                console.log('✅ Touch scroll re-enabled for new modal');
                            }
                        }, 100);
                    }
                });
            }
        });
    });
    
    observer.observe(document.body, { childList: true, subtree: true });
    
    // ========================================
    // MOBILE HAMBURGER MENU
    // ========================================
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            const isHidden = mobileMenu.classList.contains('hidden');
            const hamburgerLines = this.querySelectorAll('.hamburger-line');
            
            if (isHidden) {
                // Open mobile menu
                mobileMenu.classList.remove('hidden');
                document.body.classList.add('mobile-menu-open');
                setTimeout(() => {
                    mobileMenu.style.transition = 'all 0.3s ease-out';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                }, 10);
                
                hamburgerLines[0].style.transform = 'rotate(45deg) translate(6px, 6px)';
                hamburgerLines[1].style.opacity = '0';
                hamburgerLines[2].style.transform = 'rotate(-45deg) translate(6px, -6px)';
                
            } else {
                // Close mobile menu
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
        
        // Close menu when clicking outside
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
        
        // Close menu when clicking on a link
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
    
    // ========================================
    // HEADER SCROLL EFFECT
    // ========================================
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
    
    // ========================================
    // MAP TOGGLE TEXT TRANSLATION
    // ========================================
    if (typeof currentLanguage !== 'undefined' && currentLanguage !== 'en') {
        const mapToggle = document.getElementById('map-toggle');
        if (mapToggle) {
            const mapToggleText = mapToggle.querySelector('span');
            if (mapToggleText) {
                const originalText = mapToggleText.getAttribute('data-translate');
                if (originalText && typeof translateText === 'function') {
                    translateText(originalText, currentLanguage).then(translatedText => {
                        mapToggleText.textContent = translatedText;
                    });
                }
            }
        }
    }
    
    setTimeout(() => {
        initializeEnhancedSearch();
    }, 500);

    if (typeof initializeLanguageSelector === 'function') {
        initializeLanguageSelector();
    }
    
    if (typeof ensureFilterIcons === 'function') {
        ensureFilterIcons();
    }
});

// Global variables for directions
let userLocationMarker = null;
let currentRoute = null;
let userCurrentLocation = null;

// Make currentRoute globally accessible
window.currentRoute = null;

// ========================================
// DIRECTIONS MODAL
// ========================================

function createDirectionsButton(spot) {
    return `
        <button class="directions-btn" 
                data-spot-id="${spot.id}" 
                data-lat="${spot.latitude}" 
                data-lng="${spot.longitude}"
                data-spot-name="${escapeHtml(spot.name)}" 
                title="Get directions to this spot"
                style="background: rgba(255, 255, 255, 0.2) !important; 
                       border: 2px solid rgba(64, 224, 208, 0.3) !important; 
                       color: rgba(255, 255, 255, 0.8) !important; 
                       font-size: 1.3em !important;
                       cursor: pointer !important; 
                       transition: all 0.3s ease !important; 
                       padding: 10px !important; 
                       border-radius: 12px !important; 
                       width: 44px !important; 
                       height: 44px !important; 
                       display: flex !important; 
                       align-items: center !important; 
                       justify-content: center !important; 
                       flex-shrink: 0 !important;"
                onclick="openDirectionsModal(${spot.id}, ${spot.latitude}, ${spot.longitude}, '${escapeHtml(spot.name).replace(/'/g, "\\'")}')">
            <i class="fas fa-directions"></i>
        </button>
    `;
}

function openDirectionsModal(spotId, destinationLat, destinationLng, spotName) {
    console.log('Opening directions modal for:', spotName);
    
    // Remove existing modal if any
    const existingModal = document.getElementById('directions-modal');
    if (existingModal) existingModal.remove();
    
    // Create modal
    const modal = document.createElement('div');
    modal.id = 'directions-modal';
    modal.className = 'directions-modal';
    modal.innerHTML = `
        <div class="directions-modal-content">
            <div class="directions-modal-header">
                <h3><i class="fas fa-route"></i> Get Directions</h3>
                <button class="close-modal-btn" onclick="closeDirectionsModal()">×</button>
            </div>
            <div class="directions-modal-body">
                <p class="destination-info">
                    <i class="fas fa-map-marker-alt"></i> 
                    <strong>Destination:</strong> ${spotName}
                </p>
                
                <div class="location-options">
                    <h4>Choose your starting location:</h4>
                    
                    <button class="location-option-btn" onclick="useCurrentLocation(${destinationLat}, ${destinationLng}, '${spotName.replace(/'/g, "\\'")}')">
                        <i class="fas fa-crosshairs"></i>
                        <div>
                            <strong>Use Current Location</strong>
                            <small>Get your location via GPS</small>
                        </div>
                    </button>
                    
                    <div class="divider">OR</div>
                    
                    <div class="manual-location">
                        <label for="manual-address">Enter your location:</label>
                        <div class="input-group">
                            <input type="text" 
                                   id="manual-address" 
                                   class="manual-address-input" 
                                   placeholder="e.g., SM Mall of Asia, Manila"
                                   onkeypress="if(event.key === 'Enter') searchManualLocation(${destinationLat}, ${destinationLng}, '${spotName.replace(/'/g, "\\'")}')">
                            <button class="search-location-btn" onclick="searchManualLocation(${destinationLat}, ${destinationLng}, '${spotName.replace(/'/g, "\\'")}')">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <small class="help-text">Enter an address, landmark, or place name</small>
                    </div>
                </div>
                
                <div id="directions-status" class="directions-status"></div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Show modal with animation
    setTimeout(() => modal.classList.add('show'), 10);
}

function closeDirectionsModal() {
    const modal = document.getElementById('directions-modal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }
}

// ========================================
// GET USER'S CURRENT LOCATION (GPS)
// ========================================

function useCurrentLocation(destinationLat, destinationLng, spotName) {
    const statusDiv = document.getElementById('directions-status');
    statusDiv.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Getting your location...</div>';
    
    if (!navigator.geolocation) {
        statusDiv.innerHTML = '<div class="error"><i class="fas fa-exclamation-circle"></i> Geolocation not supported by your browser</div>';
        return;
    }
    
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;
            
            statusDiv.innerHTML = '<div class="success"><i class="fas fa-check-circle"></i> Location found! Calculating route...</div>';
            
            // Store user location
            userCurrentLocation = { lat: userLat, lng: userLng };
            
            // Calculate and display route
            calculateRoute(userLat, userLng, destinationLat, destinationLng, spotName);
            
            // Close modal after 1 second
            setTimeout(closeDirectionsModal, 1000);
        },
        (error) => {
            let errorMsg = 'Unable to get your location';
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMsg = 'Location permission denied. Please enable location access.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMsg = 'Location information unavailable.';
                    break;
                case error.TIMEOUT:
                    errorMsg = 'Location request timed out.';
                    break;
            }
            statusDiv.innerHTML = `<div class="error"><i class="fas fa-exclamation-circle"></i> ${errorMsg}</div>`;
        },
        {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        }
    );
}

// ========================================
// MANUAL LOCATION SEARCH (GEOCODING)
// ========================================

async function searchManualLocation(destinationLat, destinationLng, spotName) {
    const input = document.getElementById('manual-address');
    const address = input.value.trim();
    const statusDiv = document.getElementById('directions-status');
    
    if (!address) {
        statusDiv.innerHTML = '<div class="error"><i class="fas fa-exclamation-circle"></i> Please enter a location</div>';
        return;
    }
    
    statusDiv.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Searching for location...</div>';
    
    try {
        // Use Nominatim (OpenStreetMap) geocoding API
        const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}&countrycodes=ph&limit=1`);
        const results = await response.json();
        
        if (results.length === 0) {
            statusDiv.innerHTML = '<div class="error"><i class="fas fa-exclamation-circle"></i> Location not found. Try a different address.</div>';
            return;
        }
        
        const userLat = parseFloat(results[0].lat);
        const userLng = parseFloat(results[0].lon);
        
        statusDiv.innerHTML = '<div class="success"><i class="fas fa-check-circle"></i> Location found! Calculating route...</div>';
        
        // Store user location
        userCurrentLocation = { lat: userLat, lng: userLng };
        
        // Calculate and display route
        calculateRoute(userLat, userLng, destinationLat, destinationLng, spotName);
        
        // Close modal after 1 second
        setTimeout(closeDirectionsModal, 1000);
        
    } catch (error) {
        console.error('Geocoding error:', error);
        statusDiv.innerHTML = '<div class="error"><i class="fas fa-exclamation-circle"></i> Error searching location. Please try again.</div>';
    }
}

// ========================================
// CALCULATE AND DISPLAY ROUTE
// ========================================

function calculateRoute(startLat, startLng, endLat, endLng, destinationName) {
    console.log('Calculating route from', startLat, startLng, 'to', endLat, endLng);
    
    // Clear existing route
    if (currentRoute) {
        map.removeControl(currentRoute);
    }
    
    // Remove existing user location marker
    if (userLocationMarker) {
        map.removeLayer(userLocationMarker);
    }
    
    // Add user location marker (blue marker)
    const userIcon = L.divIcon({
        className: 'user-location-marker',
        html: '<div style="background: #4285F4; width: 20px; height: 20px; border-radius: 50%; border: 4px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);"></div>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });
    
    userLocationMarker = L.marker([startLat, startLng], { icon: userIcon })
        .addTo(map)
        .bindTooltip('Your Location', { permanent: false, direction: 'top' });
    
    // Create route using Leaflet Routing Machine with OSRM
    currentRoute = L.Routing.control({
        waypoints: [
            L.latLng(startLat, startLng),
            L.latLng(endLat, endLng)
        ],
        router: L.Routing.osrmv1({
            serviceUrl: 'https://router.project-osrm.org/route/v1',
            timeout: 30000
        }),
        routeWhileDragging: false,
        showAlternatives: false,
        addWaypoints: false,
        draggableWaypoints: false,
        fitSelectedRoutes: true,
        lineOptions: {
            styles: [
                { color: '#0077be', opacity: 0.8, weight: 6 },
                { color: '#40e0d0', opacity: 1, weight: 4 }
            ],
            addWaypoints: false
        },
        altLineOptions: {
            styles: []
        },
        createMarker: function(i, waypoint, n) {
            // Don't create markers (we handle them manually)
            return null;
        },
        show: true,
        collapsible: true
    }).addTo(map);
    
    // Update global reference
    window.currentRoute = currentRoute;
    
    // Add custom close button to routing container after it's created
    setTimeout(() => {
        addCustomCloseButton();
    }, 500);
    
    // Show success notification
    showDirectionsNotification(`Route to ${destinationName} calculated!`);
    
    // Show clear button
    toggleClearDirectionsButton(true);
    
    // Fit map to show entire route
    currentRoute.on('routesfound', function(e) {
        const routes = e.routes;
        if (routes && routes.length > 0) {
            const summary = routes[0].summary;
            
            // Log route details
            console.log('Route found:', {
                distance: (summary.totalDistance / 1000).toFixed(2) + ' km',
                time: Math.round(summary.totalTime / 60) + ' minutes'
            });
        }
    });
    
    // Handle routing errors
    currentRoute.on('routingerror', function(e) {
        console.error('Routing error:', e);
        showDirectionsNotification('Unable to calculate route. Please try again.');
    });
}

// ========================================
// ADD CUSTOM CLOSE BUTTON TO ROUTING CONTAINER
// ========================================

function addCustomCloseButton() {
    const routingContainer = document.querySelector('.leaflet-routing-container');
    
    if (!routingContainer) {
        console.log('Routing container not found yet, retrying...');
        setTimeout(addCustomCloseButton, 200);
        return;
    }
    
    // Check if close button already exists
    if (routingContainer.querySelector('.custom-routing-close-btn')) {
        return;
    }
    
    // Hide all default Leaflet routing buttons (the blue X button)
    const defaultButtons = routingContainer.querySelectorAll('button');
    defaultButtons.forEach(btn => {
        // Don't hide collapse/expand button
        if (!btn.classList.contains('leaflet-routing-collapse-btn')) {
            btn.style.display = 'none';
        }
    });
    
    // Create custom close button
    const closeBtn = document.createElement('button');
    closeBtn.className = 'custom-routing-close-btn';
    closeBtn.innerHTML = '<i class="fas fa-times"></i>';
    closeBtn.title = 'Close directions';
    closeBtn.onclick = clearDirections;
    
    // Add button to routing container
    routingContainer.appendChild(closeBtn);
    
    console.log('✅ Custom close button added to routing container');
}

// ========================================
// CLEAR DIRECTIONS
// ========================================

function clearDirections() {
    if (currentRoute) {
        map.removeControl(currentRoute);
        currentRoute = null;
        window.currentRoute = null;
    }
    
    if (userLocationMarker) {
        map.removeLayer(userLocationMarker);
        userLocationMarker = null;
    }
    
    userCurrentLocation = null;
    
    toggleClearDirectionsButton(false);
    
    showDirectionsNotification('Route cleared');
}

// Add clear directions button to your UI
function addClearDirectionsButton() {
    // Check if button already exists
    if (document.getElementById('clear-directions-btn')) return;
    
    const button = document.createElement('button');
    button.id = 'clear-directions-btn';
    button.className = 'clear-directions-btn';
    button.innerHTML = '<i class="fas fa-times-circle"></i> Clear Route';
    button.onclick = clearDirections;
    button.style.cssText = `
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        padding: 12px 20px;
        background: linear-gradient(135deg, #ff4444, #ff6666);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        display: none;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(255, 68, 68, 0.3);
        transition: all 0.3s ease;
    `;
    
    document.body.appendChild(button);
}

// Show/hide clear button when route exists
function toggleClearDirectionsButton(show) {
    const button = document.getElementById('clear-directions-btn');
    if (button) {
        button.style.display = show ? 'flex' : 'none';
    }
}

// ========================================
// NOTIFICATION SYSTEM
// ========================================

function showDirectionsNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'directions-notification';
    notification.innerHTML = `
        <i class="fas fa-route"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => notification.classList.add('show'), 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Make functions globally accessible
window.openDirectionsModal = openDirectionsModal;
window.closeDirectionsModal = closeDirectionsModal;
window.useCurrentLocation = useCurrentLocation;
window.searchManualLocation = searchManualLocation;
window.clearDirections = clearDirections;

