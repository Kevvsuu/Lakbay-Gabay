// Enhanced DOMContentLoaded event listener
let currentCarouselPage = 0;
let totalCarouselPages = 0;
let featuredLocations = [];
let carouselInstances = {};
let autoRotationInterval = null;
let isAutoRotationPaused = false;

// Fixed fullscreen carousel object
let fullscreenCarousel = {
    isOpen: false,
    currentImageIndex: 0,
    totalImages: 0,
    images: [],
    imageOwners: [],
    locationName: '',
    sourceCarouselIndex: -1,
    isNavigating: false // Add navigation lock
};

// ACCOUNT DROPDOWN FUNCTIONALITY - ADDED THIS SECTION
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
                // Don't close dropdown for logout (it's handled by the onclick)
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
        accountDropdown.element.style.transform = 'translate(-50%, 0)'; // Remove diagonal
        
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
        accountDropdown.element.style.transform = 'translate(-50%, 10px)'; // Only vertical movement
        
        if (accountDropdown.link) {
            accountDropdown.link.classList.remove('active');
        }
        
        accountDropdown.isOpen = false;
    }
}

// Function to fetch featured locations from PHP backend
async function fetchFeaturedLocations() {
    try {
        const response = await fetch('get_featured_locations.php');
        
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            const text = await response.text();
            console.error('Server returned non-JSON response:', text.substring(0, 200));
            throw new Error('Server returned invalid response format');
        }
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching featured locations:', error);
        return [];
    }
}

// Function to create a destination card
// Function to create a destination card with responsive fixes
function createDestinationCard(location, index) {
    const images = location.images.slice(0, 3);
    const imageOwners = location.image_owners ? location.image_owners.slice(0, 3) : [];
    
    const processedImages = images.map(img => {
        if (img.startsWith('../')) {
            return img.substring(3);
        }
        if (!img.startsWith('images/') && !img.startsWith('/') && !img.startsWith('http')) {
            return 'images/' + img;
        }
        return img;
    });

    // Create image elements for carousel with onclick handler
    const imageElements = processedImages.map((img, imgIndex) => `
        <div class="absolute inset-0 transition-opacity duration-500 ${imgIndex === 0 ? 'opacity-100' : 'opacity-0'} cursor-zoom-in" 
             data-index="${imgIndex}" 
             onclick="openFullscreenCarousel(${index}, ${imgIndex})">
            <img src="${img}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                 alt="${location.name}"
                 onerror="this.onerror=null; this.src='images/placeholder-destination.jpg'">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
        </div>
    `).join('');

    const averageRating = location.avg_rating || 0;

    const fullStars = Math.floor(averageRating);
    const hasHalfStar = averageRating % 1 >= 0.5;
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    
    let starsHTML = '';
    for (let i = 0; i < fullStars; i++) starsHTML += '<i class="fas fa-star text-gold"></i>';
    if (hasHalfStar) starsHTML += '<i class="fas fa-star-half-alt text-gold"></i>';
    for (let i = 0; i < emptyStars; i++) starsHTML += '<i class="far fa-star text-gold"></i>';

    // Split multiple categories and get the first one for consistent styling
    const primaryCategory = location.category ? location.category.split(',')[0].trim() : 'Beaches & Islands';
    const features = getFeaturesByCategory(primaryCategory);
    const categoryColor = getCategoryColor(primaryCategory);

    return `
        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-2xl card-hover border border-turquoise/20 flex flex-col h-full" 
             onmouseenter="pauseAutoRotation()" onmouseleave="resumeAutoRotation()">
            <div class="relative aspect-[4/3] overflow-hidden flex-shrink-0" id="carousel-${index}">
                ${imageElements}
                
                ${processedImages.length > 1 ? `
                    <button class="carousel-nav-btn absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white backdrop-blur-sm rounded-full flex items-center justify-center text-ocean-blue hover:text-ocean-cyan transition-all duration-300 shadow-lg border border-turquoise/20" onclick="changeSlide(${index}, -1)">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button class="carousel-nav-btn absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/90 hover:bg-white backdrop-blur-sm rounded-full flex items-center justify-center text-ocean-blue hover:text-ocean-cyan transition-all duration-300 shadow-lg border border-turquoise/20" onclick="changeSlide(${index}, 1)">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                ` : ''}
                
                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-semibold text-slate-blue shadow-lg border border-turquoise/20">
                    <i class="fas fa-map-marker-alt text-ocean-cyan mr-2"></i>
                    <span>${location.municipality}, ${location.region}</span>
                </div>
                
                ${processedImages.length > 1 ? `
                    <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-sm rounded-full px-3 py-1 text-xs text-white">
                        <i class="fas fa-images mr-1"></i>
                        <span id="image-counter-${index}">1/${processedImages.length}</span>
                    </div>
                ` : ''}
                
                <!-- Click to view fullscreen hint -->
                <div class="absolute bottom-4 right-4 bg-black/60 backdrop-blur-sm rounded-full px-3 py-1 text-xs text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <i class="fas fa-expand mr-1"></i>
                    Click to view
                </div>
            </div>
            
            <div class="p-8 flex flex-col flex-grow">
                <div class="flex items-start justify-between mb-4 gap-3">
                    <h3 class="text-xl font-bold text-slate-blue font-playfair leading-tight line-clamp-2 flex-grow min-w-0">${location.name}</h3>
                    <div class="flex items-center ml-2 flex-shrink-0">
                        <div class="text-gold mr-2 text-xs flex">
                            ${starsHTML}
                        </div>
                        <div class="text-right">
                            <span class="text-base font-bold text-ocean-blue">${averageRating}</span>
                            <div class="text-xs text-slate-blue/60 whitespace-nowrap">(${location.rating_count || 0})</div>
                        </div>
                    </div>
                </div>
                
                <p class="text-slate-blue/80 text-sm leading-relaxed mb-6 line-clamp-2 min-h-[40px]">
                    ${location.overview || 'Experience the beauty and culture of this amazing destination with breathtaking views and unforgettable memories.'}
                </p>
                
                <div class="grid grid-cols-2 gap-2 mb-6">
                    ${features.slice(0, 4).map(feature => `
                        <div class="flex items-center gap-2 text-xs text-slate-blue/70 bg-azure/30 rounded-lg px-2 py-2">
                            <i class="${feature.icon} text-xs flex-shrink-0" style="color: ${categoryColor};"></i>
                            <span class="truncate font-medium">${feature.text}</span>
                        </div>
                    `).join('')}
                </div>
                
                <button onclick="viewOnMap(${location.id})" class="w-full py-3 bg-gradient-to-r from-ocean-blue via-ocean-cyan to-turquoise hover:from-ocean-dark hover:to-ocean-blue text-white font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-3 text-sm shadow-lg hover:shadow-xl transform hover:scale-105 mt-auto">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>View on Interactive Map</span>
                </button>
            </div>
        </div>
    `;
}

// Helper function to get category color
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
        'Wellness, Retreats, and Leisure': '#FF8DA1'
    };
    
    // Try exact match first
    if (colors[category]) {
        return colors[category];
    }
    
    // Try case-insensitive match
    const categoryLower = category.toLowerCase();
    for (let key in colors) {
        if (key.toLowerCase() === categoryLower) {
            return colors[key];
        }
    }
    
    // Default fallback
    console.log('No matching color found for category:', category);
    return '#0066cc';
}

// Helper function to get features based on category
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
    
    // Try exact match first
    if (features[category]) {
        return features[category];
    }
    
    // Try case-insensitive match
    const categoryLower = category.toLowerCase();
    for (let key in features) {
        if (key.toLowerCase() === categoryLower) {
            return features[key];
        }
    }
    
    // Default fallback - return based on what we can detect from category name
    console.log('No matching category found for:', category);
    return [
        { icon: 'fas fa-star', text: 'Popular' },
        { icon: 'fas fa-camera', text: 'Scenic' },
        { icon: 'fas fa-map-marker-alt', text: 'Accessible' },
        { icon: 'fas fa-heart', text: 'Recommended' }
    ];
}

function setupImageClickHandlers() {
    document.addEventListener('click', function(e) {
        // Don't handle clicks if fullscreen carousel is open
        if (fullscreenCarousel.isOpen) {
            return;
        }
        
        // Prevent clicks on fullscreen carousel elements
        if (e.target.closest('#fullscreen-carousel')) {
            return;
        }
        
        // Check if the clicked element is an image container in the destination cards
        const imageContainer = e.target.closest('[data-index]');
        const carouselContainer = e.target.closest('[id^="carousel-"]');
        
        if (imageContainer && carouselContainer) {
            const carouselId = carouselContainer.id;
            const carouselIndex = parseInt(carouselId.replace('carousel-', ''));
            const imageIndex = parseInt(imageContainer.getAttribute('data-index'));
            
            // Validate indices
            if (!isNaN(carouselIndex) && !isNaN(imageIndex) && 
                featuredLocations && featuredLocations[carouselIndex]) {
                console.log(`Opening fullscreen for carousel ${carouselIndex}, image ${imageIndex}`);
                openFullscreenCarousel(carouselIndex, imageIndex);
                e.stopPropagation();
            }
        }
    });
}

function openFullscreenCarousel(carouselIndex, imageIndex = 0) {
    console.log('Opening fullscreen carousel for:', carouselIndex, 'image:', imageIndex);
    
    // Force pause auto-rotation immediately
    pauseAutoRotation();
    
    if (!featuredLocations || !featuredLocations[carouselIndex]) {
        console.error('Location not found for index:', carouselIndex, featuredLocations);
        return;
    }
    
    const location = featuredLocations[carouselIndex];
    if (!location.images || location.images.length === 0) {
        console.error('No images found for location:', location);
        return;
    }
    
    const images = location.images.slice(0, 3).map(img => {
        if (img.startsWith('../')) return img.substring(3);
        if (!img.startsWith('images/') && !img.startsWith('/') && !img.startsWith('http')) {
            return 'images/' + img;
        }
        return img;
    });
    
    const imageOwners = location.image_owners ? location.image_owners.slice(0, 3) : [];
    
    // Ensure we have owners for each image
    while (imageOwners.length < images.length) {
        imageOwners.push('Unknown Photographer');
    }
    
    // Completely reset carousel state
    fullscreenCarousel = {
        images: images,
        imageOwners: imageOwners,
        totalImages: images.length,
        currentImageIndex: Math.max(0, Math.min(imageIndex, images.length - 1)),
        locationName: location.name,
        isOpen: true,
        sourceCarouselIndex: carouselIndex,
        isNavigating: false
    };
    
    console.log('Fullscreen carousel state:', fullscreenCarousel);
    
    // Show carousel first
    const fullscreenElement = document.getElementById('fullscreen-carousel');
    if (fullscreenElement) {
        fullscreenElement.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Initialize controls immediately to prevent layout shifts
        requestAnimationFrame(() => {
            initializeFullscreenControls();
            updateFullscreenCarouselUI();
            setupFullscreenCarouselListeners();
        });
    }
}

function updateFullscreenCarouselUI() {
    if (!fullscreenCarousel.isOpen || !fullscreenCarousel.images.length) {
        console.error('Invalid carousel state when updating UI');
        return;
    }
    
    const imageElement = document.getElementById('carousel-image-fullscreen');
    const counterElement = document.getElementById('carousel-counter-fullscreen');
    const locationElement = document.getElementById('carousel-location-name');
    const ownerElement = document.getElementById('carousel-owner-credit');
    
    const currentIndex = fullscreenCarousel.currentImageIndex;
    const currentImage = fullscreenCarousel.images[currentIndex];
    const currentOwner = fullscreenCarousel.imageOwners[currentIndex] || 'Unknown Photographer';
    
    console.log(`Updating UI - Index: ${currentIndex}, Image: ${currentImage}, Owner: ${currentOwner}`);
    
    if (imageElement) {
        // Initial load without slide animation
        imageElement.style.transition = 'opacity 0.3s ease-in-out';
        imageElement.style.transform = 'translateX(0)';
        imageElement.style.opacity = '1';
        imageElement.src = currentImage;
        
        imageElement.onerror = function() {
            this.src = 'images/placeholder-destination.jpg';
        };
    }
    
    if (counterElement) {
        counterElement.textContent = `${currentIndex + 1}/${fullscreenCarousel.totalImages}`;
    }
    
    if (locationElement) {
        locationElement.textContent = fullscreenCarousel.locationName;
    }
    
    if (ownerElement) {
        ownerElement.textContent = `Photo by: ${currentOwner}`;
    }
}

// FIXED: Function to close fullscreen carousel
function closeFullscreenCarousel() {
    console.log('Closing fullscreen carousel');
    
    // Prevent multiple close calls
    if (!fullscreenCarousel.isOpen) return;
    
    const fullscreenElement = document.getElementById('fullscreen-carousel');
    
    // Immediately hide and clean up
    if (fullscreenElement) {
        fullscreenElement.classList.add('hidden');
    }
    
    document.body.style.overflow = '';
    
    // Clear all event listeners before resetting state
    clearFullscreenEventListeners();
    
    // Reset carousel state completely
    fullscreenCarousel = {
        isOpen: false,
        currentImageIndex: 0,
        totalImages: 0,
        images: [],
        imageOwners: [],
        locationName: '',
        sourceCarouselIndex: -1,
        isNavigating: false
    };
    
    // Resume auto-rotation after delay
    setTimeout(() => {
        resumeAutoRotation();
    }, 500);
}

// FIXED: Function to navigate fullscreen carousel
function navigateFullscreenCarousel(direction) {
    console.log('Navigating fullscreen carousel:', direction, 'Current state:', fullscreenCarousel);
    
    if (!fullscreenCarousel.isOpen || !fullscreenCarousel.images.length) {
        console.error('Cannot navigate - carousel not properly initialized');
        return;
    }
    
    // Prevent rapid navigation clicks
    if (fullscreenCarousel.isNavigating) {
        console.log('Navigation blocked - already navigating');
        return;
    }
    
    fullscreenCarousel.isNavigating = true;
    
    const imageElement = document.getElementById('carousel-image-fullscreen');
    if (!imageElement) {
        fullscreenCarousel.isNavigating = false;
        return;
    }
    
    // Calculate new index with wrap-around
    let newIndex = fullscreenCarousel.currentImageIndex + direction;
    if (newIndex < 0) {
        newIndex = fullscreenCarousel.totalImages - 1;
    } else if (newIndex >= fullscreenCarousel.totalImages) {
        newIndex = 0;
    }
    
    console.log(`Navigating from ${fullscreenCarousel.currentImageIndex} to ${newIndex}`);
    
    // Slide animation: slide out current image
    const slideDirection = direction > 0 ? '-100%' : '100%';
    imageElement.style.transition = 'transform 0.4s ease-in-out, opacity 0.4s ease-in-out';
    imageElement.style.transform = `translateX(${slideDirection})`;
    imageElement.style.opacity = '0';
    
    // After slide out animation, change image and slide in
    setTimeout(() => {
        // Update index
        fullscreenCarousel.currentImageIndex = newIndex;
        
        // Set new image
        const newImage = fullscreenCarousel.images[newIndex];
        const newOwner = fullscreenCarousel.imageOwners[newIndex] || 'Unknown Photographer';
        
        // Position new image on opposite side (ready to slide in)
        const slideInFrom = direction > 0 ? '100%' : '-100%';
        imageElement.style.transition = 'none';
        imageElement.style.transform = `translateX(${slideInFrom})`;
        imageElement.style.opacity = '0';
        imageElement.src = newImage;
        
        // Update text content
        const counterElement = document.getElementById('carousel-counter-fullscreen');
        const locationElement = document.getElementById('carousel-location-name');
        const ownerElement = document.getElementById('carousel-owner-credit');
        
        if (counterElement) {
            counterElement.textContent = `${newIndex + 1}/${fullscreenCarousel.totalImages}`;
        }
        
        if (locationElement) {
            locationElement.textContent = fullscreenCarousel.locationName;
        }
        
        if (ownerElement) {
            ownerElement.textContent = `Photo by: ${newOwner}`;
        }
        
        // Force reflow
        imageElement.offsetHeight;
        
        // Slide in new image
        imageElement.style.transition = 'transform 0.4s ease-in-out, opacity 0.4s ease-in-out';
        imageElement.style.transform = 'translateX(0)';
        imageElement.style.opacity = '1';
        
        // Release navigation lock after animation completes
        setTimeout(() => {
            fullscreenCarousel.isNavigating = false;
        }, 400);
        
    }, 400); // Match the slide-out duration
}

// FIXED: Function to handle keyboard navigation
function handleFullscreenKeyboardNav(e) {
    if (!fullscreenCarousel.isOpen) return;
    
    switch(e.key) {
        case 'Escape':
            console.log('Escape key pressed - closing carousel');
            e.preventDefault();
            closeFullscreenCarousel();
            break;
        case 'ArrowLeft':
            console.log('Left arrow pressed - navigating previous');
            e.preventDefault();
            navigateFullscreenCarousel(-1);
            break;
        case 'ArrowRight':
            console.log('Right arrow pressed - navigating next');
            e.preventDefault();
            navigateFullscreenCarousel(1);
            break;
    }
}

function clearFullscreenEventListeners() {
    console.log('Clearing fullscreen event listeners');
    
    // Remove keyboard listener
    document.removeEventListener('keydown', handleFullscreenKeyboardNav);
    
    // Clear button event listeners
    const closeBtn = document.getElementById('close-carousel');
    const prevBtn = document.getElementById('carousel-prev-fullscreen');
    const nextBtn = document.getElementById('carousel-next-fullscreen');
    const fullscreenElement = document.getElementById('fullscreen-carousel');
    
    if (closeBtn) {
        closeBtn.replaceWith(closeBtn.cloneNode(true));
    }
    if (prevBtn) {
        prevBtn.replaceWith(prevBtn.cloneNode(true));
    }
    if (nextBtn) {
        nextBtn.replaceWith(nextBtn.cloneNode(true));
    }
}


function setupFullscreenCarouselListeners() {
    console.log('Setting up fullscreen carousel listeners');
    
    // Clear any existing listeners first
    clearFullscreenEventListeners();
    
    // Initialize controls with stable positioning first
    initializeFullscreenControls();
    
    // Get fresh references to elements after initialization
    const closeBtn = document.getElementById('close-carousel');
    const prevBtn = document.getElementById('carousel-prev-fullscreen');
    const nextBtn = document.getElementById('carousel-next-fullscreen');
    
    // Set up close button - ONLY way to close fullscreen
    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            console.log('Close button clicked');
            e.preventDefault();
            e.stopPropagation();
            closeFullscreenCarousel();
        }, { once: false });
    }
    
    // Set up navigation buttons with stable positioning
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            console.log('Previous button clicked');
            e.preventDefault();
            e.stopPropagation();
            navigateFullscreenCarousel(-1);
        }, { once: false });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            console.log('Next button clicked');
            e.preventDefault();
            e.stopPropagation();
            navigateFullscreenCarousel(1);
        }, { once: false });
    }
    
    document.addEventListener('keydown', handleFullscreenKeyboardNav);   
}

// Function to initialize fullscreen carousel controls and prevent layout shifting
function initializeFullscreenControls() {
    console.log('Initializing fullscreen carousel controls');
    
    const closeBtn = document.getElementById('close-carousel');
    const prevBtn = document.getElementById('carousel-prev-fullscreen');
    const nextBtn = document.getElementById('carousel-next-fullscreen');
    const fullscreenElement = document.getElementById('fullscreen-carousel');
    
    // Initialize navigation buttons with stable positioning
    if (prevBtn) {
        // Set initial stable transform and prevent any layout shifts
        prevBtn.style.position = 'absolute';
        prevBtn.style.left = '20px';
        prevBtn.style.top = '50%';
        prevBtn.style.transform = 'translateY(-50%)';
        prevBtn.style.transformOrigin = 'center center';
        prevBtn.style.zIndex = '1000';
        prevBtn.style.transition = 'transform 0.1s ease-out, opacity 0.2s ease-out';
        
        // Ensure button maintains its position during interactions
        prevBtn.addEventListener('mousedown', function(e) {
            e.preventDefault();
            this.style.transform = 'translateY(-50%) scale(0.95)';
        });
        
        prevBtn.addEventListener('mouseup', function(e) {
            this.style.transform = 'translateY(-50%) scale(1)';
        });
        
        prevBtn.addEventListener('mouseleave', function(e) {
            this.style.transform = 'translateY(-50%) scale(1)';
        });
    }
    
    if (nextBtn) {
        // Set initial stable transform and prevent any layout shifts
        nextBtn.style.position = 'absolute';
        nextBtn.style.right = '20px';
        nextBtn.style.top = '50%';
        nextBtn.style.transform = 'translateY(-50%)';
        nextBtn.style.transformOrigin = 'center center';
        nextBtn.style.zIndex = '1000';
        nextBtn.style.transition = 'transform 0.1s ease-out, opacity 0.2s ease-out';
        
        // Ensure button maintains its position during interactions
        nextBtn.addEventListener('mousedown', function(e) {
            e.preventDefault();
            this.style.transform = 'translateY(-50%) scale(0.95)';
        });
        
        nextBtn.addEventListener('mouseup', function(e) {
            this.style.transform = 'translateY(-50%) scale(1)';
        });
        
        nextBtn.addEventListener('mouseleave', function(e) {
            this.style.transform = 'translateY(-50%) scale(1)';
        });
    }
    
    if (closeBtn) {
        // Initialize close button with stable positioning
        closeBtn.style.position = 'absolute';
        closeBtn.style.top = '20px';
        closeBtn.style.right = '20px';
        closeBtn.style.zIndex = '1001';
        closeBtn.style.transformOrigin = 'center center';
        closeBtn.style.transition = 'transform 0.1s ease-out, opacity 0.2s ease-out';
        
        closeBtn.addEventListener('mousedown', function(e) {
            e.preventDefault();
            this.style.transform = 'scale(0.95)';
        });
        
        closeBtn.addEventListener('mouseup', function(e) {
            this.style.transform = 'scale(1)';
        });
        
        closeBtn.addEventListener('mouseleave', function(e) {
            this.style.transform = 'scale(1)';
        });
    }
    
    // Initialize the main image container
    const imageElement = document.getElementById('carousel-image-fullscreen');
    if (imageElement) {
        imageElement.style.transition = 'opacity 0.3s ease-out';
        imageElement.style.position = 'relative';
        imageElement.style.zIndex = '1';
    }
    
    // Initialize counter and location elements
    const counterElement = document.getElementById('carousel-counter-fullscreen');
    const locationElement = document.getElementById('carousel-location-name');
    const ownerElement = document.getElementById('carousel-owner-credit');
    
    if (counterElement) {
        counterElement.style.zIndex = '999';
        counterElement.style.position = 'relative';
    }
    
    if (locationElement) {
        locationElement.style.zIndex = '999';
        locationElement.style.position = 'relative';
    }
    
    if (ownerElement) {
        ownerElement.style.zIndex = '999';
        ownerElement.style.position = 'relative';
    }
    
    // Ensure fullscreen container has proper stacking context
    if (fullscreenElement) {
        fullscreenElement.style.zIndex = '9999';
        fullscreenElement.style.position = 'fixed';
        fullscreenElement.style.top = '0';
        fullscreenElement.style.left = '0';
        fullscreenElement.style.width = '100%';
        fullscreenElement.style.height = '100%';
    }
    
    console.log('Fullscreen carousel controls initialized successfully');
}

let autoRotationState = {
    interval: null,
    isPaused: false,
    wasRunningBeforeFullscreen: false
};

// Enhanced carousel auto-rotation functions
function startAutoRotation() {
    if (autoRotationState.interval) {
        clearInterval(autoRotationState.interval);
    }
    
    autoRotationState.interval = setInterval(() => {
        if (!autoRotationState.isPaused && !fullscreenCarousel.isOpen && totalCarouselPages > 1) {
            navigateCarousel(1);
        }
    }, 5000);
    
    autoRotationState.wasRunningBeforeFullscreen = true;
}

function pauseAutoRotation() {
    autoRotationState.isPaused = true;
    console.log('Auto-rotation paused');
}

function resumeAutoRotation() {
    if (autoRotationState.wasRunningBeforeFullscreen && !fullscreenCarousel.isOpen) {
        autoRotationState.isPaused = false;
        console.log('Auto-rotation resumed');
    }
}


// Update the carousel display
// Update the carousel display with smooth slide animation
function updateCarousel() {
    const container = document.getElementById('featured-locations-container');
    if (!container) return;
    
    // Add fade-out animation before changing content
    container.style.opacity = '0';
    container.style.transform = 'translateX(-20px)';
    
    setTimeout(() => {
        container.innerHTML = '';
        
        const startIndex = currentCarouselPage * 3;
        const endIndex = Math.min(startIndex + 3, featuredLocations.length);
        
        for (let i = startIndex; i < endIndex; i++) {
            const location = featuredLocations[i];
            const cardHTML = createDestinationCard(location, i);
            container.innerHTML += cardHTML;
        }
        
        const cardsNeeded = 3 - (endIndex - startIndex);
        for (let i = 0; i < cardsNeeded; i++) {
            container.innerHTML += '<div class="opacity-0"></div>';
        }
        
        // Fade-in animation after content is loaded
        setTimeout(() => {
            container.style.opacity = '1';
            container.style.transform = 'translateX(0)';
            
            // Initialize individual card carousels
            for (let i = startIndex; i < endIndex; i++) {
                initCarousel(i);
            }
        }, 50);
        
    }, 300); // Match this with CSS transition duration
    
    updateCarouselIndicators();
}

function updateCarouselIndicators() {
    const indicatorsContainer = document.getElementById('carousel-indicators');
    if (!indicatorsContainer) return;
    
    indicatorsContainer.innerHTML = '';
    
    for (let i = 0; i < totalCarouselPages; i++) {
        const indicator = document.createElement('button');
        indicator.className = `w-4 h-4 rounded-full transition-all duration-300 ${
            i === currentCarouselPage 
                ? 'bg-ocean-blue scale-125 shadow-lg' 
                : 'bg-slate-blue/30 hover:bg-slate-blue/50'
        }`;
        indicator.addEventListener('click', () => {
            currentCarouselPage = i;
            updateCarousel();
        });
        indicatorsContainer.appendChild(indicator);
    }
}

function navigateCarousel(direction) {
    currentCarouselPage = (currentCarouselPage + direction + totalCarouselPages) % totalCarouselPages;
    updateCarousel();
}

function viewOnMap(spotId) {
    console.log('viewOnMap called with spotId:', spotId, 'type:', typeof spotId);
    
    const location = featuredLocations.find(loc => {
        console.log('Comparing:', loc.id, 'with', spotId);
        return loc.id === spotId || loc.id == spotId;
    });
    
    console.log('Found location:', location);
    
    if (location) {
        // Ensure consistent data format
        const spotData = {
            id: location.id,
            name: location.name,
            latitude: location.latitude,
            longitude: location.longitude,
            overview: location.overview,
            category: location.category,
            region: location.region,
            province: location.province,
            municipality: location.municipality
        };
        
        console.log('Storing spot data:', spotData);
        sessionStorage.setItem('spotToCenter', JSON.stringify(spotData));
        sessionStorage.setItem('fromDestinationClick', 'true');
        
        console.log('Navigating to map.php');
        setTimeout(() => {
            window.location.href = 'map.php';
        }, 100);
    } else {
        console.error('Location not found for spotId:', spotId);
        console.log('Available locations:', featuredLocations.map(l => ({ id: l.id, name: l.name })));
    }
}
function initCarousel(carouselIndex) {
    const carousel = document.getElementById(`carousel-${carouselIndex}`);
    if (!carousel) return;
    
    const items = carousel.querySelectorAll('[data-index]');
    if (items.length === 0) return;
    
    carouselInstances[carouselIndex] = {
        items: items,
        currentIndex: 0,
        totalItems: items.length
    };
}

function changeSlide(carouselIndex, direction) {
    if (!carouselInstances[carouselIndex]) return;
    
    const carousel = carouselInstances[carouselIndex];
    const { items, currentIndex, totalItems } = carousel;
    
    items[currentIndex].classList.remove('opacity-100');
    items[currentIndex].classList.add('opacity-0');
    
    let newIndex = (currentIndex + direction) % totalItems;
    if (newIndex < 0) newIndex = totalItems - 1;
    
    items[newIndex].classList.remove('opacity-0');
    items[newIndex].classList.add('opacity-100');
    
    carouselInstances[carouselIndex].currentIndex = newIndex;
    
    const counter = document.querySelector(`#image-counter-${carouselIndex}`);
    if (counter) {
        counter.textContent = `${newIndex + 1}/${totalItems}`;
    }
}

async function populateFeaturedLocations() {
    const container = document.getElementById('featured-locations-container');
    if (!container) return;
    
    try {
        const locations = await fetchFeaturedLocations();
        featuredLocations = locations;
        
        totalCarouselPages = Math.ceil(locations.length / 3);
        
        if (locations.length === 0) {
            container.innerHTML = `
                <div class="col-span-3 text-center py-16">
                    <div class="w-24 h-24 bg-gradient-to-br from-ocean-blue to-turquoise rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-slate-blue mb-2">No destinations found</h3>
                    <p class="text-slate-blue/60">Check back later for amazing destinations!</p>
                </div>
            `;
            return;
        }
        
        updateCarousel();
        startAutoRotation();
        
        const prevBtn = document.getElementById('carousel-prev');
        const nextBtn = document.getElementById('carousel-next');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                pauseAutoRotation();
                navigateCarousel(-1);
                setTimeout(resumeAutoRotation, 2000);
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                pauseAutoRotation();
                navigateCarousel(1);
                setTimeout(resumeAutoRotation, 2000);
            });
        }
        
    } catch (error) {
        console.error('Error populating featured locations:', error);
        container.innerHTML = `
            <div class="col-span-3 text-center py-16">
                <div class="w-24 h-24 bg-gradient-to-br from-red-400 to-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-exclamation-triangle text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-semibold text-slate-blue mb-2">Failed to load destinations</h3>
                <p class="text-slate-blue/60 mb-4">Something went wrong. Please try again.</p>
                <button onclick="populateFeaturedLocations()" class="px-6 py-3 bg-gradient-to-r from-ocean-blue to-turquoise text-white rounded-lg font-semibold hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-redo mr-2"></i>Try Again
                </button>
            </div>
        `;
    }
}

function initializeHeroAnimations() {
    const heroTitle = document.querySelector('h1');
    if (heroTitle) {
        const words = heroTitle.querySelectorAll('span');
        words.forEach((word, index) => {
            word.style.animationDelay = `${index * 0.2}s`;
        });
    }

    document.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;
        
        const floatingElements = document.querySelectorAll('.floating-elements');
        floatingElements.forEach((element, index) => {
            const speed = (index + 1) * 0.02;
            const x = (mouseX - 0.5) * 100 * speed;
            const y = (mouseY - 0.5) * 100 * speed;
            element.style.transform = `translate(${x}px, ${y}px)`;
        });
    });
}

// MAIN DOMContentLoaded Event Listener
document.addEventListener('DOMContentLoaded', function() {
    currentCarouselPage = 0;
    totalCarouselPages = 0;
    featuredLocations = [];
    
    // Initialize account dropdown functionality - ADDED THIS LINE
    initializeAccountDropdown();
    checkLoginStatus(); // Add this line
    
    initializeHeroAnimations();
    populateFeaturedLocations();

    initializeHeroBackgroundRotation();
    
    // Set up event handlers
    setupImageClickHandlers();
    // Don't call setupFullscreenCarouselListeners here - it will be called when carousel opens

    // Set saved language preference
    const savedLang = localStorage.getItem('preferredLanguage');
    if (savedLang) {
        const langSelect = document.getElementById('language-select');
        if (langSelect) langSelect.value = savedLang;
    }
    
    // Enhanced header scroll effect
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (!header) return;
        
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        lastScrollTop = scrollTop;
        
        const heroElements = document.querySelectorAll('.parallax-element');
        heroElements.forEach(element => {
            const speed = 0.5;
            const yPos = -(scrollTop * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });
    
    // Enhanced back to top button
    const backToTopButton = document.getElementById('back-to-top');
    if (backToTopButton) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 400) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
                backToTopButton.style.transform = 'translateY(0) scale(1)';
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.style.transform = 'translateY(20px) scale(0.8)';
            }
        });

        backToTopButton.addEventListener('click', function() {
            const scrollDuration = 1000;
            const scrollStep = -window.scrollY / (scrollDuration / 15);
            
            function smoothScroll() {
                if (window.scrollY > 0) {
                    window.scrollBy(0, scrollStep);
                    setTimeout(smoothScroll, 15);
                }
            }
            smoothScroll();
        });
    }

    // Enhanced scroll indicator
    const scrollIndicator = document.getElementById('scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const destSection = document.getElementById('destinations');
            if (destSection) {
                destSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
            
            this.style.transform = 'translateX(-50%) scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'translateX(-50%) scale(1)';
            }, 200);
        });
    }

    // Enhanced mobile menu toggle
    const hamburgerBtn = document.getElementById('hamburger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event bubbling
            
            const isHidden = mobileMenu.classList.contains('hidden');
            const hamburgerLines = this.querySelectorAll('.hamburger-line');
            
            if (isHidden) {
                // Show menu with animation
                mobileMenu.classList.remove('hidden');
                document.body.classList.add('mobile-menu-open');
                setTimeout(() => {
                    mobileMenu.style.transition = 'all 0.3s ease-out';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transform = 'translateY(0)';
                }, 10);
                
                // Transform hamburger to X
                hamburgerLines[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                hamburgerLines[1].style.opacity = '0';
                hamburgerLines[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
                
            } else {
                // Hide menu with animation
                mobileMenu.style.opacity = '0';
                mobileMenu.style.transform = 'translateY(-10px)';
                document.body.classList.remove('mobile-menu-open');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.style.transition = '';
                }, 300);
                
                // Revert hamburger to original state
                hamburgerLines[0].style.transform = 'none';
                hamburgerLines[1].style.opacity = '1';
                hamburgerLines[2].style.transform = 'none';
            }
        });

        // Close mobile menu when clicking outside
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

        // Close mobile menu when clicking on links (optional)
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

    // Enhanced smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Add pulse animation to target section
                target.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    target.style.transition = 'transform 0.3s ease-out';
                    target.style.transform = 'scale(1)';
                }, 100);
            }
        });
    });

    // Language selector functionality with animation
    const languageSelect = document.getElementById('language-select');
    if (languageSelect) {
        languageSelect.addEventListener('change', function() {
            localStorage.setItem('preferredLanguage', this.value);
            
            // Add selection animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // Pause auto-rotation when page is not visible
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            pauseAutoRotation();
        } else {
            resumeAutoRotation();
        }
    });

    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.opacity = '1';
            }
        });
    }, observerOptions);

    // Observe elements for scroll animations
    document.querySelectorAll('.feature-card, .glass-morphism').forEach(el => {
        el.style.transform = 'translateY(50px)';
        el.style.opacity = '0';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
});

// Hero background image rotation with smooth sliding animation
function initializeHeroBackgroundRotation() {
    const heroBgCurrent = document.getElementById('hero-bg-current');
    const heroBgNext = document.getElementById('hero-bg-next');
    
    if (!heroBgCurrent || !heroBgNext) {
        console.error('Hero background elements not found');
        return;
    }
    
    const backgroundImages = [
        'images/background/1.jpg',
        'images/background/2.jpg',
        'images/background/3.jpg',
        'images/background/4.jpg',
        'images/background/5.jpg',
        'images/background/6.jpg',
        'images/background/7.jpg',
        'images/background/8.jpg'
    ];
    
    let currentImageIndex = 0;
    let isAnimating = false;
    
    // Initialize positions correctly
    heroBgCurrent.style.opacity = '1';
    heroBgNext.style.opacity = '1';
    heroBgCurrent.style.transform = 'translateX(0)';
    heroBgNext.style.transform = 'translateX(100%)';
    
    // Preload images
    backgroundImages.forEach(src => {
        const img = new Image();
        img.src = src;
    });
    
    function changeBackgroundImage() {
        if (isAnimating) return;
        
        isAnimating = true;
        
        // Calculate next image index
        const nextImageIndex = (currentImageIndex + 1) % backgroundImages.length;
        
        // Set next image to the "next" element
        heroBgNext.style.backgroundImage = `url('${backgroundImages[nextImageIndex]}')`;
        
        // Start slide animation
        heroBgCurrent.style.transform = 'translateX(-100%)'; // Current slides left
        heroBgNext.style.transform = 'translateX(0)'; // Next slides in from right
        
        // After animation completes
        setTimeout(() => {
            // Swap roles: next becomes current, current becomes next
            heroBgCurrent.style.backgroundImage = `url('${backgroundImages[nextImageIndex]}')`;
            
            // Reset positions without animation
            heroBgCurrent.style.transition = 'none';
            heroBgNext.style.transition = 'none';
            
            heroBgCurrent.style.transform = 'translateX(0)';
            heroBgNext.style.transform = 'translateX(100%)';
            
            // Force reflow
            heroBgCurrent.offsetHeight;
            heroBgNext.offsetHeight;
            
            // Re-enable transitions
            heroBgCurrent.style.transition = 'transform 1s ease-in-out';
            heroBgNext.style.transition = 'transform 1s ease-in-out';
            
            // Update current index
            currentImageIndex = nextImageIndex;
            isAnimating = false;
        }, 1000);
    }
    
    // Start auto rotation every 5 seconds
    setInterval(changeBackgroundImage, 5000);
    
    console.log('Hero background rotation initialized with smooth continuous sliding');
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
                <i class="fas fa-sign-in-alt"></i>Login
            </a>
            <a href="registerform.php" class="dropdown-item">
                <i class="fas fa-user-plus"></i>Register
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
                            window.location.href = 'index.php';
                        }, 1500);
                    })
                    .catch(error => console.error('Error:', error));
            }
        }