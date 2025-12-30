/**
 * Project: GA4 Lazy Loader
 * Description: Optimizes Google Analytics 4 loading for better Core Web Vitals (LCP/TBT).
 * Author: Priyanshu
 */

// Configuration
const GA_ID = 'G-LRTNBF10YH'; // Yahan apni ID check kar lein
let analyticsLoaded = false;

function loadGoogleAnalytics() {
    if (analyticsLoaded) return;
    analyticsLoaded = true;

    console.log("Initializing GA4...");

    // Create Script Tag for GTAG
    const script = document.createElement('script');
    script.async = true;
    script.src = `https://www.googletagmanager.com/gtag/js?id=${GA_ID}`;
    document.head.appendChild(script);

    // Initialize DataLayer
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', GA_ID);
    
    console.log("GA4 Loaded Successfully");
}

// Event Listeners for User Interaction
// Script tabhi load hogi jab user scroll, click ya mouse move karega
window.addEventListener('scroll', loadGoogleAnalytics, {passive: true});
window.addEventListener('mousemove', loadGoogleAnalytics, {passive: true});
window.addEventListener('touchstart', loadGoogleAnalytics, {passive: true});

// Fallback: Agar user idle hai to 3.5 second baad load karein
setTimeout(loadGoogleAnalytics, 3500);
