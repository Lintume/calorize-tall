// Service Worker for Calorize PWA
// Version is updated automatically by Vite build hash in asset URLs

const CACHE_NAME = 'calorize-v1';

// Assets to precache on install (app shell)
const PRECACHE_ASSETS = [
  '/favicon/favicon.svg',
  '/favicon/apple-touch-icon.png',
  '/logo.png',
];

// Install: precache essential assets
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(PRECACHE_ASSETS);
    })
  );
  // Activate immediately
  self.skipWaiting();
});

// Activate: clean old caches
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames
          .filter((name) => name.startsWith('calorize-') && name !== CACHE_NAME)
          .map((name) => caches.delete(name))
      );
    })
  );
  // Take control of all pages immediately
  self.clients.claim();
});

// Fetch strategy
self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);
  
  // Skip non-GET requests
  if (event.request.method !== 'GET') return;
  
  // Skip cross-origin requests (except fonts)
  if (url.origin !== self.location.origin) {
    // Cache Google Fonts
    if (url.hostname === 'fonts.gstatic.com' || url.hostname === 'fonts.googleapis.com') {
      event.respondWith(staleWhileRevalidate(event.request));
    }
    return;
  }
  
  // Strategy based on request type
  if (isVersionedAsset(url)) {
    // Versioned assets (with hash in filename): Cache First (immutable)
    event.respondWith(cacheFirst(event.request));
  } else if (isStaticAsset(url)) {
    // Static assets without hash: Stale While Revalidate
    event.respondWith(staleWhileRevalidate(event.request));
  } else if (isNavigationRequest(event.request)) {
    // HTML pages: Network First (Livewire needs fresh HTML)
    event.respondWith(networkFirst(event.request));
  }
});

// Check if URL is a versioned asset (Vite adds hash to filename)
function isVersionedAsset(url) {
  // Vite format: app-Bk9zwCy4.css, app-Cjmz0njS.js
  return /\/build\/assets\/.*-[a-zA-Z0-9]{8}\.(js|css|woff2?)$/.test(url.pathname);
}

// Check if URL is a static asset
function isStaticAsset(url) {
  return /\.(js|css|woff2?|ttf|eot|svg|png|jpg|jpeg|gif|ico|webp)$/.test(url.pathname);
}

// Check if request is for HTML page
function isNavigationRequest(request) {
  return request.mode === 'navigate' || 
         (request.method === 'GET' && request.headers.get('accept')?.includes('text/html'));
}

// Cache First strategy - for immutable versioned assets
async function cacheFirst(request) {
  const cached = await caches.match(request);
  if (cached) return cached;
  
  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    // Return offline fallback if available
    return new Response('Offline', { status: 503 });
  }
}

// Stale While Revalidate - serve cache, update in background
async function staleWhileRevalidate(request) {
  const cache = await caches.open(CACHE_NAME);
  const cached = await cache.match(request);
  
  const fetchPromise = fetch(request).then((response) => {
    if (response.ok) {
      cache.put(request, response.clone());
    }
    return response;
  }).catch(() => cached);
  
  return cached || fetchPromise;
}

// Network First - for HTML pages
async function networkFirst(request) {
  try {
    const response = await fetch(request);
    if (response.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    const cached = await caches.match(request);
    if (cached) return cached;
    
    // Return basic offline page
    return new Response(
      '<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><title>Offline</title></head><body style="font-family:system-ui;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;background:#fafaf9"><div style="text-align:center"><h1 style="color:#78716c">Ви офлайн</h1><p style="color:#a8a29e">Перевірте інтернет-зʼєднання</p></div></body></html>',
      { 
        status: 503,
        headers: { 'Content-Type': 'text/html; charset=utf-8' }
      }
    );
  }
}

// Listen for messages from the app
self.addEventListener('message', (event) => {
  if (event.data === 'skipWaiting') {
    self.skipWaiting();
  }
});
