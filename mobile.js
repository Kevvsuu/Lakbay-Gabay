// MOBILE.JS - Leaflet API Map Version (Fixed Search Suggestions + MODAL Scroll)
console.log('Mobile.js loading...');

let isMobile = window.innerWidth <= 768;
let touchStartX, touchStartY;
let isTouchDragging = false;
let lastTouchEnd = 0;
let isFilterPanelCollapsed = false;

const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) || 
              (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

console.log('Device Info:', {
    isMobile: isMobile,
    isIOS: isIOS,
    width: window.innerWidth
});

// Helper function to check if element is scrollable area
function isScrollableArea(element) {
    const scrollableSelectors = [
        '.filters',
        '.search-suggestions',
        '#search-suggestions',
        '.suggestions-list',
        '.autocomplete-suggestions',
        '.search-results-dropdown',
        '#search-results-dropdown',
        '.popup-content',
        '.modal-scroll-container',  // ✅ ADDED THIS
        '#preferences-modal'         // ✅ ADDED THIS
    ];
    
    for (const selector of scrollableSelectors) {
        if (element.closest(selector)) {
            return true;
        }
    }
    return false;
}

function initializeMobile() {
    if (isMobile) {
        console.log('Initializing mobile...');
        
        const mapContainer = document.getElementById('leaflet-map');
        if (mapContainer) {
            mapContainer.addEventListener('touchstart', handleTouchStart, { passive: true });
            mapContainer.addEventListener('touchmove', handleTouchMove, { passive: false });
            mapContainer.addEventListener('touchend', handleTouchEnd, { passive: true });
        }

        initializeCollapsiblePanel();
        enableFilterScroll();
        setupSearchSuggestionsObserver();
        setupModalScrollObserver(); // ✅ ADDED THIS

        const legend = document.querySelector('.legend-container');
        if (legend) legend.style.display = 'none';

        console.log('Mobile initialized');
    }
}

function handleTouchStart(e) {
    // Allow scrolling in any scrollable area
    if (isScrollableArea(e.target)) {
        return;
    }
    
    if (e.target.closest('#popup') ||
        e.target.closest('.search-filter-container') ||
        e.target.closest('.map-toggle-btn') ||
        e.target.closest('#preferences-modal')) {  // ✅ ADDED THIS
        return;
    }

    const now = Date.now();
    if (now - lastTouchEnd <= 300) {
        e.preventDefault();
        return;
    }

    const touch = e.touches[0];
    touchStartX = touch.clientX;
    touchStartY = touch.clientY;
    isTouchDragging = false;
}

function handleTouchMove(e) {
    // Allow scrolling in any scrollable area
    if (isScrollableArea(e.target)) {
        return;
    }
    
    if (touchStartX === undefined || touchStartY === undefined) return;

    const touch = e.touches[0];
    const deltaX = Math.abs(touch.clientX - touchStartX);
    const deltaY = Math.abs(touch.clientY - touchStartY);

    if (deltaX > 10 || deltaY > 10) {
        isTouchDragging = true;
    }
}

function handleTouchEnd(e) {
    isTouchDragging = false;
    touchStartX = undefined;
    touchStartY = undefined;
    lastTouchEnd = Date.now();
}

function enableScrollForElement(element) {
    if (!element) return;
    
    // Force enable scrolling
    element.style.overflowY = 'auto';
    element.style.webkitOverflowScrolling = 'touch';
    element.style.touchAction = 'pan-y';
    element.style.overscrollBehavior = 'contain';
    
    console.log('Scroll enabled for:', element.className || element.id);
    
    // Prevent event propagation
    element.addEventListener('touchstart', function(e) {
        if (element.scrollHeight > element.clientHeight) {
            e.stopPropagation();
        }
    }, { passive: true });
    
    element.addEventListener('touchmove', function(e) {
        e.stopPropagation();
    }, { passive: true });
}

function enableFilterScroll() {
    const filters = document.querySelector('.filters');
    if (filters) {
        enableScrollForElement(filters);
    }
    
    // Enable scrolling for search suggestions (if they exist)
    const searchSuggestionsSelectors = [
        '.search-suggestions',
        '#search-suggestions', 
        '.suggestions-list',
        '.autocomplete-suggestions',
        '#search-results-dropdown',
        '.search-results-dropdown'
    ];
    
    searchSuggestionsSelectors.forEach(selector => {
        const element = document.querySelector(selector);
        if (element) {
            enableScrollForElement(element);
        }
    });
    
    // ✅ ENABLE MODAL SCROLL
    const modalScroll = document.querySelector('.modal-scroll-container');
    if (modalScroll) {
        enableScrollForElement(modalScroll);
        console.log('✅ Modal scroll enabled');
    }
}

// ✅ NEW FUNCTION: Watch for modal appearance
function setupModalScrollObserver() {
    console.log('Setting up modal scroll observer...');
    
    const observerCallback = function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType !== 1) return;
                
                // Check if modal or modal container was added
                if (node.id === 'preferences-modal' || 
                    node.querySelector && node.querySelector('#preferences-modal')) {
                    
                    console.log('✅ Preferences modal detected!');
                    
                    setTimeout(() => {
                        const modalScroll = document.querySelector('.modal-scroll-container');
                        if (modalScroll) {
                            enableScrollForElement(modalScroll);
                            console.log('✅ Modal scroll enabled on detection');
                        }
                    }, 100);
                }
                
                // Direct check for modal-scroll-container
                if (node.classList && node.classList.contains('modal-scroll-container')) {
                    enableScrollForElement(node);
                    console.log('✅ Modal scroll container detected directly');
                }
            });
        });
    };
    
    const observer = new MutationObserver(observerCallback);
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    console.log('✅ Modal observer active');
}

// Watch for dynamically created search suggestions
function setupSearchSuggestionsObserver() {
    console.log('Setting up search suggestions observer...');
    
    // Function to check and enable scroll on potential suggestion containers
    function checkAndEnableScroll(node) {
        if (node.nodeType !== 1) return; // Only element nodes
        
        // CRITICAL: Check for the exact ID from script.js
        if (node.id === 'search-results-dropdown' || node.classList.contains('search-results-dropdown')) {
            console.log('✅ Found search results dropdown!', node);
            enableScrollForElement(node);
            
            // Also enable scroll on each result item
            const resultItems = node.querySelectorAll('.search-result-item');
            resultItems.forEach(item => {
                item.style.touchAction = 'auto';
                item.style.pointerEvents = 'auto';
            });
            return true;
        }
        
        // Check if this is directly under search-bar-container
        const searchBarContainer = document.querySelector('.search-bar-container');
        if (searchBarContainer && searchBarContainer.contains(node) && node.parentElement === searchBarContainer) {
            console.log('Found direct child of search-bar-container:', node);
            enableScrollForElement(node);
            return true;
        }
        
        // Check specific selectors
        const selectors = [
            '.search-suggestions',
            '#search-suggestions',
            '.suggestions-list',
            '.autocomplete-suggestions',
            '.search-dropdown',
            '.search-results'
        ];
        
        for (const selector of selectors) {
            if (node.matches && node.matches(selector)) {
                console.log('Search suggestions detected:', selector, node);
                enableScrollForElement(node);
                return true;
            }
            // Also check children
            const child = node.querySelector(selector);
            if (child) {
                console.log('Search suggestions detected (child):', selector, child);
                enableScrollForElement(child);
                return true;
            }
        }
        
        return false;
    }
    
    // Observer callback
    const observerCallback = function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                checkAndEnableScroll(node);
            });
        });
    };
    
    const observer = new MutationObserver(observerCallback);
    
    // Observe search-bar-container if it exists
    const searchBarContainer = document.querySelector('.search-bar-container');
    if (searchBarContainer) {
        observer.observe(searchBarContainer, {
            childList: true,
            subtree: true
        });
        console.log('✅ Observing .search-bar-container');
    }
    
    // Observe search-filter-container
    const searchFilterContainer = document.querySelector('.search-filter-container');
    if (searchFilterContainer) {
        observer.observe(searchFilterContainer, {
            childList: true,
            subtree: true
        });
        console.log('✅ Observing .search-filter-container');
    }
    
    // Also observe document body as fallback
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    console.log('✅ Observing document.body');
    
    // Set up input listener on search bar
    const searchBar = document.getElementById('search-bar');
    if (searchBar) {
        searchBar.addEventListener('input', function() {
            setTimeout(() => {
                // Check for the specific dropdown
                const dropdown = document.getElementById('search-results-dropdown');
                if (dropdown) {
                    console.log('✅ Dropdown found on input, enabling scroll');
                    enableScrollForElement(dropdown);
                }
                
                // Check for any new elements
                const searchBarContainer = document.querySelector('.search-bar-container');
                if (searchBarContainer) {
                    Array.from(searchBarContainer.children).forEach(child => {
                        if (child !== searchBar && (child.children.length > 0 || child.classList.contains('search-results-dropdown'))) {
                            console.log('Found suggestions on input event:', child);
                            enableScrollForElement(child);
                        }
                    });
                }
            }, 100);
        });
        console.log('✅ Added input listener to search bar');
    }
}

function initializeCollapsiblePanel() {
    const searchFilterContainer = document.querySelector('.search-filter-container');
    if (!searchFilterContainer) return;

    if (isMobile) {
        searchFilterContainer.classList.add('collapsed');
        isFilterPanelCollapsed = true;
    }

    const toggleArea = document.createElement('div');
    toggleArea.className = 'mobile-toggle-handler';
    toggleArea.style.cssText = `
        position: absolute;
        right: -35px;
        top: 0;
        width: 35px;
        height: 100%;
        cursor: pointer;
        z-index: 1004;
    `;

    toggleArea.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        searchFilterContainer.classList.toggle('collapsed');
        isFilterPanelCollapsed = !isFilterPanelCollapsed;
    });

    searchFilterContainer.appendChild(toggleArea);
}

function preventIOSBounce() {
    document.body.addEventListener('touchmove', function(e) {
        // Always allow scrolling in scrollable areas
        if (isScrollableArea(e.target)) {
            return;
        }
        
        if (isTouchDragging) return;

        const target = e.target;
        const scrollableSelectors = [
            '.popup-content',
            '.filters',
            '.search-suggestions',
            '#search-suggestions',
            '.suggestions-list',
            '.autocomplete-suggestions',
            '#search-results-dropdown',
            '.search-results-dropdown',
            '.carousel-thumbnails',
            '.modal-scroll-container',  // ✅ ADDED
            '#preferences-modal'         // ✅ ADDED
        ];

        let isInScrollableElement = false;
        for (const selector of scrollableSelectors) {
            const scrollableElement = target.closest(selector);
            if (scrollableElement) {
                const canScroll = scrollableElement.scrollHeight > scrollableElement.clientHeight ||
                                 scrollableElement.scrollWidth > scrollableElement.clientWidth;
                if (canScroll) {
                    isInScrollableElement = true;
                    break;
                }
            }
        }

        if (!isInScrollableElement) {
            e.preventDefault();
        }
    }, { passive: false });
}

function handleOrientationChange() {
    const wasMobile = isMobile;
    isMobile = window.innerWidth <= 768;

    if (wasMobile !== isMobile) {
        if (isMobile) {
            initializeMobile();
        } else {
            const legend = document.querySelector('.legend-container');
            if (legend) legend.style.display = 'block';

            const searchFilterContainer = document.querySelector('.search-filter-container');
            if (searchFilterContainer) {
                searchFilterContainer.classList.remove('collapsed');
                isFilterPanelCollapsed = false;
            }
        }

        setTimeout(() => {
            if (typeof map !== 'undefined' && map) {
                map.invalidateSize();
            }
        }, 300);
    }
}

// Initialize on DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Ready');
    
    if (window.innerWidth <= 768) {
        console.log('Mobile detected');
        initializeMobile();
        preventIOSBounce();
    }
});

// Initialize on window.load
window.addEventListener('load', function() {
    console.log('Window Load');
    
    if (window.innerWidth <= 768) {
        isMobile = true;
        preventIOSBounce();
        
        // Re-enable filter scroll after page load
        setTimeout(enableFilterScroll, 500);
        
        // Set up observers again after load
        setTimeout(setupSearchSuggestionsObserver, 1000);
        setTimeout(setupModalScrollObserver, 1000); // ✅ ADDED
    }
});

// Handle orientation change
window.addEventListener('orientationchange', function() {
    console.log('Orientation changed');
    setTimeout(handleOrientationChange, 500);
});

// Debug helper
window.debugMobile = function() {
    console.log('Mobile Debug Info:');
    console.log('- isMobile:', isMobile);
    console.log('- Window width:', window.innerWidth);
    console.log('- isIOS:', isIOS);
    console.log('- Map instance exists:', typeof map !== 'undefined');
    
    const filters = document.querySelector('.filters');
    if (filters) {
        console.log('- Filters scrollHeight:', filters.scrollHeight);
        console.log('- Filters clientHeight:', filters.clientHeight);
        console.log('- Filters overflow-y:', window.getComputedStyle(filters).overflowY);
        console.log('- Filters can scroll:', filters.scrollHeight > filters.clientHeight);
    }
    
    const searchSuggestions = document.querySelector('#search-results-dropdown') || 
                             document.querySelector('.search-results-dropdown') ||
                             document.querySelector('.search-suggestions') || 
                             document.querySelector('#search-suggestions');
    if (searchSuggestions) {
        console.log('- Search suggestions found:', searchSuggestions.className || searchSuggestions.id);
        console.log('- Suggestions scrollHeight:', searchSuggestions.scrollHeight);
        console.log('- Suggestions clientHeight:', searchSuggestions.clientHeight);
        console.log('- Suggestions overflow-y:', window.getComputedStyle(searchSuggestions).overflowY);
        console.log('- Suggestions can scroll:', searchSuggestions.scrollHeight > searchSuggestions.clientHeight);
    } else {
        console.log('- Search suggestions: NOT FOUND (type something in search to see)');
    }
    
    // ✅ ADDED MODAL DEBUG
    const modalScroll = document.querySelector('.modal-scroll-container');
    if (modalScroll) {
        console.log('- Modal scroll found!');
        console.log('- Modal scrollHeight:', modalScroll.scrollHeight);
        console.log('- Modal clientHeight:', modalScroll.clientHeight);
        console.log('- Modal overflow-y:', window.getComputedStyle(modalScroll).overflowY);
        console.log('- Modal can scroll:', modalScroll.scrollHeight > modalScroll.clientHeight);
    } else {
        console.log('- Modal scroll: NOT FOUND (open preferences modal to see)');
    }
};

console.log('Mobile.js loaded successfully');