

class TranslationManager {
    constructor() {
        this.currentLanguage = 'en';
        this.cache = new Map();
        this.isTranslating = false;
        this.maxRetries = 3;
        this.retryDelay = 1000;
        this.batchSize = 10;
        
        // Store original content to prevent HTML corruption
        this.originalContent = new Map();
        
        this.init();
    }

    init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                this.storeOriginalContent();
                this.setupEventListeners();
                this.loadSavedLanguage();
            });
        } else {
            this.storeOriginalContent();
            this.setupEventListeners();
            this.loadSavedLanguage();
        }
    }

    // Store original content when page loads
    storeOriginalContent() {
        const elementsToTranslate = document.querySelectorAll('[data-translate]');
        elementsToTranslate.forEach(element => {
            const key = element.getAttribute('data-translate');
            if (!this.originalContent.has(key)) {
                // Store clean text content, not HTML
                const cleanText = this.extractCleanText(element);
                this.originalContent.set(key, cleanText);
                element.setAttribute('data-original', cleanText);
            }
        });
    }

    // Extract clean text content, avoiding HTML tags and attributes
    extractCleanText(element) {
        // For elements that might contain HTML, get only the text content
        let text = element.textContent || element.innerText || '';
        
        // Clean up whitespace
        text = text.trim().replace(/\s+/g, ' ');
        
        // Handle special cases for common elements
        if (element.tagName === 'INPUT' && element.placeholder) {
            text = element.placeholder;
        }
        
        return text;
    }

    setupEventListeners() {
        const languageSelect = document.getElementById('language-select');
        if (languageSelect) {
            languageSelect.addEventListener('change', (e) => {
                const selectedLang = e.target.value;
                console.log('Language changed to:', selectedLang);
                
                if (selectedLang === 'en') {
                    this.restoreOriginalText();
                } else {
                    this.translatePage(selectedLang);
                }
            });
        }
    }

    showLoadingIndicator() {
        const indicator = document.getElementById('translation-loading');
        if (indicator) {
            indicator.classList.remove('opacity-0', 'invisible');
            indicator.classList.add('opacity-100', 'visible');
        }
    }

    hideLoadingIndicator() {
        const indicator = document.getElementById('translation-loading');
        if (indicator) {
            indicator.classList.add('opacity-0', 'invisible');
            indicator.classList.remove('opacity-100', 'visible');
        }
    }

    getCacheKey(text, targetLang) {
        return `${text.substring(0, 50)}|${targetLang}`;
    }

    async translateText(text, targetLanguage, retryCount = 0) {
        if (targetLanguage === 'en' || !text || !text.trim()) {
            return text;
        }

        // Skip translation for HTML-like content or URLs
        if (this.containsHTML(text) || this.containsURL(text)) {
            return text;
        }

        const cacheKey = this.getCacheKey(text, targetLanguage);
        if (this.cache.has(cacheKey)) {
            return this.cache.get(cacheKey);
        }

        try {
            const url = `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=en|${targetLanguage}`;
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.responseStatus === 200 && data.responseData.translatedText) {
                let translation = data.responseData.translatedText;
                
                // Clean up common translation artifacts
                translation = this.cleanTranslation(translation, text);
                
                this.cache.set(cacheKey, translation);
                return translation;
            } else {
                throw new Error('Translation failed: Invalid response');
            }
        } catch (error) {
            console.error('Translation error:', error);
            
            if (retryCount < this.maxRetries) {
                console.log(`Retrying translation (${retryCount + 1}/${this.maxRetries})...`);
                await new Promise(resolve => setTimeout(resolve, this.retryDelay * (retryCount + 1)));
                return this.translateText(text, targetLanguage, retryCount + 1);
            }
            
            return text; // Return original text if all retries fail
        }
    }

    // Check if text contains HTML tags
    containsHTML(text) {
        return /<[^>]*>/g.test(text);
    }

    // Check if text contains URLs
    containsURL(text) {
        return /https?:\/\/|www\./g.test(text);
    }

    // Clean up translation artifacts
    cleanTranslation(translation, original) {
        // Remove common translation artifacts
        translation = translation.replace(/^\"|\"$/g, ''); // Remove quotes
        translation = translation.trim();
        
        // If translation looks corrupted or contains HTML, return original
        if (this.containsHTML(translation) || translation.length > original.length * 3) {
            return original;
        }
        
        return translation;
    }

    async translatePage(targetLanguage) {
        if (this.isTranslating || targetLanguage === this.currentLanguage) {
            return;
        }

        console.log('Starting translation to:', targetLanguage);
        this.isTranslating = true;
        this.showLoadingIndicator();

        try {
            const elementsToTranslate = document.querySelectorAll('[data-translate]');
            const elementsArray = Array.from(elementsToTranslate);
            
            // Add translating class to all elements
            elementsArray.forEach(element => {
                element.classList.add('translating');
            });

            // Process elements in batches to avoid API rate limits
            const batches = [];
            for (let i = 0; i < elementsArray.length; i += this.batchSize) {
                batches.push(elementsArray.slice(i, i + this.batchSize));
            }

            for (const batch of batches) {
                const promises = batch.map(async (element) => {
                    try {
                        const key = element.getAttribute('data-translate');
                        const originalText = this.originalContent.get(key) || element.getAttribute('data-original') || this.extractCleanText(element);
                        
                        // Store original if not already stored
                        if (!element.getAttribute('data-original')) {
                            element.setAttribute('data-original', originalText);
                        }

                        if (!originalText || originalText.trim() === '') {
                            element.classList.remove('translating');
                            return;
                        }

                        const translatedText = await this.translateText(originalText, targetLanguage);
                        
                        if (translatedText && translatedText !== originalText && translatedText.trim() !== '') {
                            // Use fade effect for translation
                            element.style.transition = 'opacity 0.3s ease';
                            element.style.opacity = '0.5';
                            
                            setTimeout(() => {
                                // Handle different element types
                                if (element.tagName === 'INPUT' && element.placeholder) {
                                    element.placeholder = translatedText;
                                } else {
                                    element.textContent = translatedText;
                                }
                                element.style.opacity = '1';
                                element.classList.remove('translating');
                            }, 150);
                        } else {
                            element.classList.remove('translating');
                        }
                    } catch (error) {
                        console.error('Error translating element:', error);
                        element.classList.remove('translating');
                    }
                });

                await Promise.all(promises);
                
                // Small delay between batches to avoid overwhelming the API
                if (batches.indexOf(batch) < batches.length - 1) {
                    await new Promise(resolve => setTimeout(resolve, 300));
                }
            }

            this.currentLanguage = targetLanguage;
            
            // Store language preference in localStorage
            localStorage.setItem('preferred-language', targetLanguage);
            
            // Update language selector to reflect current language
            const languageSelect = document.getElementById('language-select');
            if (languageSelect && languageSelect.value !== targetLanguage) {
                languageSelect.value = targetLanguage;
            }
            
            console.log('Translation completed for language:', targetLanguage);
            
        } catch (error) {
            console.error('Page translation error:', error);
            
            // Remove translating class from all elements on error
            document.querySelectorAll('.translating').forEach(element => {
                element.classList.remove('translating');
            });
        } finally {
            this.isTranslating = false;
            this.hideLoadingIndicator();
        }
    }

    // Restore original text (useful for switching back to English)
    restoreOriginalText() {
        console.log('Restoring original text');
        const elementsToRestore = document.querySelectorAll('[data-translate]');
        
        elementsToRestore.forEach(element => {
            const key = element.getAttribute('data-translate');
            const originalText = this.originalContent.get(key) || element.getAttribute('data-original');
            
            if (originalText) {
                element.style.transition = 'opacity 0.3s ease';
                element.style.opacity = '0.5';
                
                setTimeout(() => {
                    // Handle different element types
                    if (element.tagName === 'INPUT' && element.placeholder) {
                        element.placeholder = originalText;
                    } else {
                        element.textContent = originalText;
                    }
                    element.style.opacity = '1';
                    element.classList.remove('translating');
                }, 150);
            }
        });
        
        this.currentLanguage = 'en';
        localStorage.setItem('preferred-language', 'en');
        
        // Update language selector
        const languageSelect = document.getElementById('language-select');
        if (languageSelect) {
            languageSelect.value = 'en';
        }
    }

    // Load saved language preference
    loadSavedLanguage() {
        const savedLanguage = localStorage.getItem('preferred-language');
        console.log('Loading saved language:', savedLanguage);
        
        if (savedLanguage && savedLanguage !== 'en') {
            const languageSelect = document.getElementById('language-select');
            if (languageSelect) {
                languageSelect.value = savedLanguage;
                
                // Delay translation to ensure page is fully loaded
                setTimeout(() => {
                    this.translatePage(savedLanguage);
                }, 1500);
            }
        }
    }

    // Method to translate dynamic content (for database-loaded destinations)
    async translateDynamicContent(elements, targetLanguage = null) {
        const lang = targetLanguage || this.currentLanguage;
        if (lang === 'en') return;

        const elementsArray = Array.isArray(elements) ? elements : [elements];
        
        for (const element of elementsArray) {
            const translateElements = element.querySelectorAll('[data-translate]');
            
            for (const el of translateElements) {
                const key = el.getAttribute('data-translate');
                let originalText = this.originalContent.get(key) || el.getAttribute('data-original');
                
                if (!originalText) {
                    originalText = this.extractCleanText(el);
                    this.originalContent.set(key, originalText);
                    el.setAttribute('data-original', originalText);
                }

                const translatedText = await this.translateText(originalText, lang);
                
                if (translatedText && translatedText !== originalText) {
                    el.style.transition = 'opacity 0.3s ease';
                    el.style.opacity = '0.5';
                    setTimeout(() => {
                        if (el.tagName === 'INPUT' && el.placeholder) {
                            el.placeholder = translatedText;
                        } else {
                            el.textContent = translatedText;
                        }
                        el.style.opacity = '1';
                    }, 150);
                }
            }
        }
    }

    // Get current language
    getCurrentLanguage() {
        return this.currentLanguage;
    }

    // Check if currently translating
    isCurrentlyTranslating() {
        return this.isTranslating;
    }

    // Clear cache (useful for testing)
    clearCache() {
        this.cache.clear();
        console.log('Translation cache cleared');
    }

    // Get cache statistics
    getCacheStats() {
        return {
            cacheSize: this.cache.size,
            originalContentSize: this.originalContent.size,
            currentLanguage: this.currentLanguage
        };
    }
}

// Initialize translation manager
const translationManager = new TranslationManager();

// Export for use in other scripts if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = TranslationManager;
} else {
    window.TranslationManager = TranslationManager;
    window.translationManager = translationManager;
}