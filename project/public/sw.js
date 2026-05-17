// service-worker.js
const CACHE_NAME = 'my-app-cache-v1';

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll([
        '/',
      ]);
    })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    (async () => {
      const cachedResponse = await caches.match(event.request);
      if (cachedResponse) return cachedResponse;

      try {
        const networkResponse = await fetch(event.request);

        if (networkResponse && networkResponse.status === 200) {
          const cache = await caches.open(CACHE_NAME);
          cache.put(event.request, networkResponse.clone());
        }

        return networkResponse;
      } catch (error) {
        // শুধুমাত্র HTML পেজের জন্য offline fallback
        if (event.request.destination === 'document' ||
            event.request.mode === 'navigate') {
          return caches.match('/'); // অথবা আপনার offline.html
        }
        return new Response('Network error', { status: 503 });
      }
    })()
  );
});
