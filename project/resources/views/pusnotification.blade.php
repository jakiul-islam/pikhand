<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/12.12.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/12.12.1/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyD5AAAgTA9uf1bwT1cUCoWyLFf733mplHo",
    authDomain: "picklet-c9e63.firebaseapp.com",
    projectId: "picklet-c9e63",
    storageBucket: "picklet-c9e63.firebasestorage.app",
    messagingSenderId: "276565133755",
    appId: "1:276565133755:web:d0a08f57a5614184fc5c9e",
    measurementId: "G-JQ5WXZRE1Y"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>
