// Translation system with memory cache
const translationCache = new Map();
let currentLanguage = 'en';
const LIBRE_TRANSLATE_API = 'https://libretranslate.com/translate';

// Language mapping
const languageMap = {
    'en': 'en',
    'ko': 'ko',
    'ja': 'ja',
    'zh': 'zh',
    'ms': 'ms',
    'hi': 'hi',
    'tl': 'tl',
    'ceb': 'ceb'
};

// Add after the languageMap variable

async function translateText(text, targetLang) {
    if (!text || targetLang === 'en') return text;
    const cacheKey = `${text}_${targetLang}`;
    if (translationCache.has(cacheKey)) return translationCache.get(cacheKey);
    try {
        const response = await fetch(LIBRE_TRANSLATE_API, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({q: text, source: 'en', target: targetLang, format: 'text'})
        });
        const data = await response.json();
        const translatedText = data.translatedText || text;
        translationCache.set(cacheKey, translatedText);
        return translatedText;
    } catch (error) {
        console.error('Translation error:', error);
        return text;
    }
}

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
        translatedSpot.categories = await Promise.all(translatedSpot.categories.map(cat => translateText(cat, targetLang)));
    }
    return translatedSpot;
}

function initializeLanguageSelector() {
    const languageSelect = document.getElementById('language-select');
    languageSelect.addEventListener('change', async function() {
        currentLanguage = this.value;
        const loadingNotification = document.createElement('div');
        loadingNotification.id = 'translation-notification';
        loadingNotification.className = 'fixed top-20 right-4 bg-ocean-blue text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999]';
        loadingNotification.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Translating...';
        document.body.appendChild(loadingNotification);
        try {
            const translatedSpots = await Promise.all(allSpots.map(spot => translateSpotData(spot, currentLanguage)));
            displaySpots(translatedSpots);
            loadingNotification.innerHTML = '<i class="fas fa-check mr-2"></i>Complete!';
            loadingNotification.className = 'fixed top-20 right-4 bg-turquoise text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999]';
        } catch (error) {
            loadingNotification.innerHTML = '<i class="fas fa-times mr-2"></i>Failed';
            loadingNotification.className = 'fixed top-20 right-4 bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999]';
        }
        setTimeout(() => document.getElementById('translation-notification')?.remove(), 2000);
    });
}
// Translate single text
async function translateText(text, targetLang) {
    if (!text || targetLang === 'en') return text;
    
    const cacheKey = `${text}_${targetLang}`;
    if (translationCache.has(cacheKey)) {
        return translationCache.get(cacheKey);
    }
    
    try {
        const response = await fetch(LIBRE_TRANSLATE_API, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                q: text,
                source: 'en',
                target: targetLang,
                format: 'text'
            })
        });
        
        const data = await response.json();
        const translatedText = data.translatedText || text;
        translationCache.set(cacheKey, translatedText);
        return translatedText;
    } catch (error) {
        console.error('Translation error:', error);
        return text;
    }
}

// Translate entire spot data object
async function translateSpotData(spot, targetLang) {
    if (targetLang === 'en') return spot;
    
    const translatedSpot = { ...spot };
    const fieldsToTranslate = [
        'name', 
        'overview', 
        'things_to_do', 
        'operating_hours', 
        'contact_information', 
        'transportation'
    ];
    
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

// Initialize language selector
function initializeLanguageSelector() {
    const languageSelect = document.getElementById('language-select');
    
    if (!languageSelect) {
        console.error('Language selector not found');
        return;
    }
    
    languageSelect.addEventListener('change', async function() {
        currentLanguage = this.value;
        
        // Show loading notification
        const loadingNotification = document.createElement('div');
        loadingNotification.id = 'translation-notification';
        loadingNotification.className = 'fixed top-20 right-4 bg-ocean-blue text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999]';
        loadingNotification.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Translating content...';
        document.body.appendChild(loadingNotification);
        
        try {
            // Translate all spots
            const translatedSpots = await Promise.all(
                allSpots.map(spot => translateSpotData(spot, currentLanguage))
            );
            
            // Update display
            displaySpots(translatedSpots);
            
            // Show success message
            loadingNotification.innerHTML = '<i class="fas fa-check mr-2"></i>Translation complete!';
            loadingNotification.className = 'fixed top-20 right-4 bg-turquoise text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999]';
            
        } catch (error) {
            console.error('Translation failed:', error);
            loadingNotification.innerHTML = '<i class="fas fa-times mr-2"></i>Translation failed';
            loadingNotification.className = 'fixed top-20 right-4 bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl z-[9999]';
        }
        
        // Remove notification after 2 seconds
        setTimeout(() => {
            const notification = document.getElementById('translation-notification');
            if (notification) {
                notification.remove();
            }
        }, 2000);
    });
}

// Clear translation cache
function clearTranslationCache() {
    translationCache.clear();
    console.log('Translation cache cleared');
}

// Get cache statistics
function getTranslationCacheStats() {
    return {
        size: translationCache.size,
        currentLanguage: currentLanguage,
        languages: Object.keys(languageMap)
    };
}