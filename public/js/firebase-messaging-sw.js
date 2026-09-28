importScripts(
    'https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js'
);

importScripts(
    'https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging-compat.js'
);

firebase.initializeApp({
    apiKey: "AIzaSyDImPXFphfurv7endIIYF6tVNH8KSd2HXg",
    authDomain: "picklet-d14f0.firebaseapp.com",
    projectId: "picklet-d14f0",
    storageBucket: "picklet-d14f0.firebasestorage.app",
    messagingSenderId: "870826237606",
    appId: "1:870826237606:web:8cf050e339d5aa67541e67"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {

    console.log(
        '[firebase-messaging-sw.js] Background message:',
        payload
    );

    const notificationTitle =
        payload.notification?.title || 'Pikhand';

    const notificationOptions = {
        body: payload.notification?.body || 'New notification',
        icon: '/icons/icon-192x192.png',
        badge: '/icons/icon-192x192.png'
    };

    self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});