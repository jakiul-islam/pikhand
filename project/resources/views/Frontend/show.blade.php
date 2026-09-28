<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging-compat.js"></script>

<script>
const firebaseConfig = {
    apiKey: "আপনার_API_KEY",
    authDomain: "আপনার_AUTH_DOMAIN",
    projectId: "আপনার_PROJECT_ID",
    storageBucket: "আপনার_STORAGE_BUCKET",
    messagingSenderId: "আপনার_MESSAGING_SENDER_ID",
    appId: "আপনার_APP_ID"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

async function enablePushNotification() {

    try {

        // Notification permission
        const permission = await Notification.requestPermission();

        if (permission !== 'granted') {
            console.log('Notification permission denied');
            return;
        }

        console.log('Notification permission granted');

        // Service Worker register
        const registration =
            await navigator.serviceWorker.register(
                '/firebase-messaging-sw.js'
            );

        console.log('Service Worker registered');

        // FCM Token
        const token = await messaging.getToken({
            vapidKey: 'এখানে আপনার Key pair বসাবেন',
            serviceWorkerRegistration: registration
        });

        if (token) {

            console.log('FCM Token:', token);

            // আপাতত শুধু token দেখব
        }

    } catch (error) {

        console.error('FCM Error:', error);

    }
}
</script>