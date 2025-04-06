import "./bootstrap";
window.Echo.channel("admin-notifications").listen(
    "NewMessageReceived",
    (event) => {
        alert("Bạn có tin nhắn từ" + event.user_name);
    }
);
