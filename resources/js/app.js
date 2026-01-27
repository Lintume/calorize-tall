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
        let startX = 0;
        let currentY = 0;
        let pulling = false;
        let pullConfirmed = false; // Only true when we've confirmed this is an intentional vertical pull
        let refreshing = false;
        const threshold = 100; // Increased from 80 - requires more intentional pull
        const maxPull = 140;
        const deadZone = 30; // Must pull at least this much before activating
        const angleThreshold = 0.6; // tan(~31°) - pull must be mostly vertical
        const hiddenY = -64; // must match CSS initial translateY to keep it fully hidden
        const refreshY = 12; // resting position while refreshing
        
        // Get the spinner and text elements
        const spinner = indicator.querySelector('.pwa-pull-refresh-spinner');
        const textEl = indicator.querySelector('.pwa-pull-refresh-text');
        
        // Touch start - record starting position
        document.addEventListener('touchstart', (e) => {
            if (refreshing) return;
            // Only trigger when at top of page
            if (window.scrollY > 0) return;
            
            startY = e.touches[0].clientY;
            startX = e.touches[0].clientX;
            pulling = true;
            pullConfirmed = false;
            indicator.classList.remove('refreshing');
            indicator.classList.remove('ready');
            // Don't show until the user actually pulls a bit
            textEl.textContent = '';
        }, { passive: true });
        
        // Touch move - update indicator
        document.addEventListener('touchmove', (e) => {
            if (!pulling || refreshing) return;
            if (window.scrollY > 0) {
                pulling = false;
                pullConfirmed = false;
                return;
            }
            
            currentY = e.touches[0].clientY;
            const currentX = e.touches[0].clientX;
            const pullDistanceY = currentY - startY;
            const pullDistanceX = Math.abs(currentX - startX);
            
            // Ignore upward movements
            if (pullDistanceY <= 0) return;
            
            // Check if this is a confirmed vertical pull
            if (!pullConfirmed) {
                // Need to move at least deadZone pixels before we decide
                const totalDistance = Math.sqrt(pullDistanceY * pullDistanceY + pullDistanceX * pullDistanceX);
                if (totalDistance < deadZone) return;
                
                // Check if the pull is predominantly vertical
                // Horizontal distance should be less than angleThreshold * vertical distance
                if (pullDistanceX > pullDistanceY * angleThreshold) {
                    // This looks like a horizontal swipe, cancel
                    pulling = false;
                    return;
                }
                
                // This is a confirmed vertical pull-down gesture
                pullConfirmed = true;
            }
            
            // Apply resistance to the pull (from original start, not from deadZone)
            const resistance = 0.4; // Reduced from 0.5 - more resistance = less aggressive
            const actualPull = Math.min(pullDistanceY * resistance, maxPull);
            
            // Only show indicator after we've pulled past a visible amount
            if (actualPull > 15) {
                // Slide the pill in from hiddenY towards visible. Cap to avoid dropping too far.
                const y = Math.min(hiddenY + actualPull, refreshY + 10);
                indicator.style.transform = `translateX(-50%) translateY(${y}px)`;
                // Make it appear gradually
                indicator.style.opacity = Math.min((actualPull - 15) / 30, 1);
                
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
            
            const pullDistance = Math.max(0, currentY - startY) * 0.4; // Match the resistance factor
            
            // Only trigger if we had a confirmed pull and it exceeded the threshold
            if (pullConfirmed && pullDistance >= threshold) {
                // Trigger refresh
                refreshing = true;
                indicator.classList.add('refreshing');
                indicator.style.transform = `translateX(-50%) translateY(${refreshY}px)`;
                indicator.style.opacity = '1';
                textEl.textContent = 'Оновлення...';
                
                // Reload the page
                setTimeout(() => {
                    window.location.reload();
                }, 300);
            } else {
                // Reset indicator
                indicator.style.transform = `translateX(-50%) translateY(${hiddenY}px)`;
                indicator.style.opacity = '0';
                textEl.textContent = '';
            }
            
            pulling = false;
            pullConfirmed = false;
            startY = 0;
            startX = 0;
            currentY = 0;
        }, { passive: true });
    }
})();