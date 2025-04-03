import './bootstrap';
import Echo from "laravel-echo";
window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        let chatBox = document.getElementById("chat-box");
        chatBox.innerHTML += `<p><strong>${e.message.is_admin ? 'Admin' : 'Bạn'}:</strong> ${e.message.message}</p>`;
        chatBox.scrollTop = chatBox.scrollHeight;
    });

