

<button type="button"
        onclick="enablePushNotification()"
        class="btn btn-primary">
    🔔 Enable Notifications
</button>




<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.13.2/firebase-messaging-compat.js"></script>

<script>
const firebaseConfig = {
    apiKey: "AIzaSyDImPXFphfurv7endIIYF6tVNH8KSd2HXg",
    authDomain: "picklet-d14f0.firebaseapp.com",
    projectId: "picklet-d14f0",
    storageBucket: "picklet-d14f0.firebasestorage.app",
    messagingSenderId: "870826237606",
    appId: "1:870826237606:web:8cf050e339d5aa67541e67"
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
            vapidKey: 'BOb1ADUQgAZZL2DzdCduqdfrlF87-zj_Kl712GFI4T-H1TDgn5VHZ1m-diqKNEU3AXec8-o_Xzh9NYzMDc81yJw',
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