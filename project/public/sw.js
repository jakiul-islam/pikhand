



// service-worker.js
const CACHE_NAME = 'my-app-cache-v2';

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => {
            return cache.addAll([
                '/'
            ]);
        })
    );

    self.skipWaiting();
});

self.addEventListener('activate', event => {
    event.waitUntil(
        (async () => {
            const cacheNames = await caches.keys();

            await Promise.all(
                cacheNames
                    .filter(name => name !== CACHE_NAME)
                    .map(name => caches.delete(name))
            );

            await self.clients.claim();
        })()
    );
});

self.addEventListener('fetch', event => {

    const request = event.request;

    // POST, PUT, DELETE ইত্যাদি Request Cache করবে না
    if (request.method !== 'GET') {
        return;
    }

    // অন্য Origin-এর Request Cache করবে না
    const url = new URL(request.url);

    if (url.origin !== self.location.origin) {
        return;
    }

    event.respondWith(
        (async () => {

            try {
                const networkResponse = await fetch(request);

                if (
                    networkResponse &&
                    networkResponse.status === 200 &&
                    networkResponse.type === 'basic'
                ) {
                    const cache = await caches.open(CACHE_NAME);

                    // শুধু GET Request-এর Response Cache করবে
                    await cache.put(request, networkResponse.clone());
                }

                return networkResponse;

            } catch (error) {

                // Network না থাকলে Cache থেকে Response নেবে
                const cachedResponse = await caches.match(request);

                if (cachedResponse) {
                    return cachedResponse;
                }

                // Offline অবস্থায় HTML পেজের Fallback
                if (
                    request.destination === 'document' ||
                    request.mode === 'navigate'
                ) {
                    const offlinePage = await caches.match('/');

                    if (offlinePage) {
                        return offlinePage;
                    }
                }

                return new Response('Network error', {
                    status: 503,
                    headers: {
                        'Content-Type': 'text/plain; charset=utf-8'
                    }
                });
            }

        })()
    );
});






// service-worker.js
/*const CACHE_NAME = 'my-app-cache-v1';

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
*/