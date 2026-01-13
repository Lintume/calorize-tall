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