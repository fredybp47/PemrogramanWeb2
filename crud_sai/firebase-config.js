// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDuOk1DQBXVc9GkA2XRHJj__e4bTMZubEc",
  authDomain: "crudsai-426816.firebaseapp.com",
  projectId: "crudsai-426816",
  storageBucket: "crudsai-426816.appspot.com",
  messagingSenderId: "416531799635",
  appId: "1:416531799635:web:8153eb35adb9a905b4f0a6",
  measurementId: "G-X82NSKB73B"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const auth = getAuth(app); // Inisialisasi Firebase Authentication

export { auth }; // Ekspor auth untuk digunakan di halaman HTML