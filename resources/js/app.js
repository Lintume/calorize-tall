import './bootstrap';
import Chart from 'chart.js/auto';
import AOS from 'aos';
import 'aos/dist/aos.css';
window.Chart = Chart;
// Initialize AOS
AOS.init({
    duration: 1000, // Animation duration (default is 1200ms)
    once: true,     // Whether animation should happen only once
});

// PWA Install Prompt
let deferredPrompt = null;

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent the mini-infobar from appearing on mobile
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    // Update UI to show install button
    window.dispatchEvent(new CustomEvent('pwa-install-available'));
});

window.addEventListener('appinstalled', () => {
    // Clear the deferredPrompt so it can be garbage collected
    deferredPrompt = null;
    // Hide install button
    window.dispatchEvent(new CustomEvent('pwa-installed'));
});

// Global function to trigger install prompt
window.showInstallPrompt = async () => {
    if (!deferredPrompt) {
        return false;
    }
    // Show the install prompt
    deferredPrompt.prompt();
    // Wait for the user to respond to the prompt
    const { outcome } = await deferredPrompt.userChoice;
    // Clear the deferredPrompt variable
    deferredPrompt = null;
    return outcome === 'accepted';
};

// Check if install prompt is available
window.isInstallPromptAvailable = () => {
    return deferredPrompt !== null;
};

// iOS detection for PWA install hint
window.isIOS = () => {
    // Direct iOS device detection
    if (/iPad|iPhone|iPod/.test(navigator.userAgent)) return true;
    // iPadOS detection (reports as Macintosh but has touch + no mouse pointer)
    // Check for touch capability AND that it's actually mobile Safari
    if (navigator.maxTouchPoints > 1 && /Macintosh/.test(navigator.userAgent)) {
        // Additional check: real Macs with Chrome/Edge support beforeinstallprompt
        // Safari on Mac doesn't, but we only want to show hint for iOS Safari
        // Check if it's Safari (no Chrome/Edge in userAgent)
        const isSafari = /Safari/.test(navigator.userAgent) && !/Chrome|CriOS|EdgiOS|Edge/.test(navigator.userAgent);
        // On real MacBooks, Safari still doesn't fire beforeinstallprompt, but we can
        // check for mobile-specific features. iPadOS has 'ontouchstart' as native.
        // However, the safest is to check screen size as a hint
        const isMobileSize = window.screen.width <= 1366 && 'ontouchstart' in window;
        return isSafari && isMobileSize;
    }
    return false;
};

// Check if running as standalone PWA
window.isStandalone = () => {
    return window.matchMedia('(display-mode: standalone)').matches ||
        window.navigator.standalone === true;
};

// Check if iOS install hint should be shown
window.shouldShowIOSInstallHint = () => {
    // If browser supports native install prompt (Chrome, Edge, etc.), don't show iOS hint
    if (deferredPrompt !== null) return false;
    if (!window.isIOS()) return false;
    if (window.isStandalone()) return false;
    // Check if user dismissed the hint
    if (localStorage.getItem('ios-install-hint-dismissed')) return false;
    return true;
};

// Dismiss iOS install hint
window.dismissIOSInstallHint = () => {
    localStorage.setItem('ios-install-hint-dismissed', 'true');
};

// ============================================
// Pull-to-Refresh for iOS PWA Standalone Mode
// ============================================
(function initPullToRefresh() {
    // Only enable for iOS in standalone mode
    if (!window.isIOS || !window.isStandalone) return;
    
    // Wait for DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupPullToRefresh);
    } else {
        setupPullToRefresh();
    }
    
    function setupPullToRefresh() {
        // Don't initialize if not iOS standalone
        if (!window.isIOS() || !window.isStandalone()) return;
        
        // Create the pull-to-refresh indicator element
        const indicator = document.createElement('div');
        indicator.id = 'pwa-pull-refresh';
        indicator.innerHTML = `
            <div class="pwa-pull-refresh-spinner">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M21 12a9 9 0 11-6.219-8.56" stroke-linecap="round"/>
                </svg>
            </div>
            <span class="pwa-pull-refresh-text"></span>
        `;
        document.body.prepend(indicator);
        
        let startY = 0;
        let currentY = 0;
        let pulling = false;
        let refreshing = false;
        const threshold = 80;
        const maxPull = 120;
        
        // Get the spinner and text elements
        const spinner = indicator.querySelector('.pwa-pull-refresh-spinner');
        const textEl = indicator.querySelector('.pwa-pull-refresh-text');
        
        // Touch start - record starting position
        document.addEventListener('touchstart', (e) => {
            if (refreshing) return;
            // Only trigger when at top of page
            if (window.scrollY > 0) return;
            
            startY = e.touches[0].clientY;
            pulling = true;
            indicator.classList.remove('refreshing');
        }, { passive: true });
        
        // Touch move - update indicator
        document.addEventListener('touchmove', (e) => {
            if (!pulling || refreshing) return;
            if (window.scrollY > 0) {
                pulling = false;
                return;
            }
            
            currentY = e.touches[0].clientY;
            const pullDistance = Math.max(0, currentY - startY);
            
            if (pullDistance > 10) {
                // Apply resistance to the pull
                const resistance = 0.5;
                const actualPull = Math.min(pullDistance * resistance, maxPull);
                
                indicator.style.transform = `translateY(${actualPull - 60}px)`;
                indicator.style.opacity = Math.min(actualPull / threshold, 1);
                
                // Rotate spinner based on pull distance
                const rotation = (actualPull / maxPull) * 360;
                spinner.style.transform = `rotate(${rotation}deg)`;
                
                // Update text based on threshold
                if (actualPull >= threshold) {
                    textEl.textContent = 'Відпустіть';
                    indicator.classList.add('ready');
                } else {
                    textEl.textContent = 'Потягніть вниз';
                    indicator.classList.remove('ready');
                }
            }
        }, { passive: true });
        
        // Touch end - trigger refresh or reset
        document.addEventListener('touchend', () => {
            if (!pulling || refreshing) return;
            
            const pullDistance = Math.max(0, currentY - startY) * 0.5;
            
            if (pullDistance >= threshold) {
                // Trigger refresh
                refreshing = true;
                indicator.classList.add('refreshing');
                indicator.style.transform = 'translateY(10px)';
                textEl.textContent = 'Оновлення...';
                
                // Reload the page
                setTimeout(() => {
                    window.location.reload();
                }, 300);
            } else {
                // Reset indicator
                indicator.style.transform = 'translateY(-60px)';
                indicator.style.opacity = '0';
            }
            
            pulling = false;
            startY = 0;
            currentY = 0;
        }, { passive: true });
    }
})();