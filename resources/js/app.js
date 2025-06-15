import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Initialize Pusher
window.Pusher = Pusher;

// Initialize Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '3d1daf32367492d9ffa6', // Replace with your Pusher key
    cluster: 'ap2', // Replace with your Pusher cluster
    encrypted: true
});
