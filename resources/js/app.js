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