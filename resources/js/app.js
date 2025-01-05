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