import "./bootstrap";

// Kết nối đến Presence Channel với Laravel Echo
window.Echo.join(`chat.${roomId}`)
    .here((users) => {
        console.log("==============here============");
        console.table(users);

        if (users.length > 1) {
            document.getElementById("user-status").textContent = "Online";
            document.getElementById("user-status").style.color = "green";
        } else {
            if (roleId === 3) {
                document.getElementById("user-status").textContent =
                    "Vui lòng đợi ...";
                document.getElementById("user-status").style.color = "red";
            } else {
                document.getElementById("user-status").textContent = "Offline";
                document.getElementById("user-status").style.color = "red";
            }
        }
    })
    .joining((user) => {
        console.log("==============joining============");
        console.table(user);
        document.getElementById("user-status").textContent = "Online";
        document.getElementById("user-status").style.color = "green";
    })
    .leaving((user) => {
        console.log("==============leaving============");
        console.table(user);
        document.getElementById("user-status").textContent = "Offline";
        document.getElementById("user-status").style.color = "red";
    })
    .listen("MessageSent", (event) => {
        console.log(event.message);
        appendMessage(event.message, event.user_id);
    });

// Gửi tin nhắn
document
    .getElementById("send-message-btn")
    .addEventListener("click", function() {
        const messageInput = document.getElementById("message-input");
        const message = messageInput.value.trim();

        if (message === "") {
            alert("Vui lòng nhập tin nhắn");
            return;
        }

        // Gửi tin nhắn qua Link
        axios
            .post("/messages/send", {
                message: message,
                receiver_id: receiverId,
                room_id: roomId,
            })
            .then((response) => {
                // Sau khi gửi, thêm tin nhắn vào khung hiển thị
                appendMessage(message, userId);
                messageInput.value = ""; // Xóa nội dung sau khi gửi
            })
            .catch((error) => {
                console.error("Error sending message:", error);
            });
    });

// Hàm thêm tin nhắn vào khung hiển thị
function appendMessage(message, senderId) {
    const messageBox = document.getElementById("message-box");
    const messageElement = document.createElement("div");

    messageElement.classList.add("message"); // Thêm luôn class "message"

    // Kiểm tra vai trò và căn chỉnh tin nhắn
    if (roleId === 1 || roleId === 2) {
        if (senderId === userId) {
            messageElement.classList.add("sent"); // Tin nhắn của bạn
            messageElement.innerHTML = "<strong>Bạn: </strong>" + message; // Sử dụng innerHTML để hỗ trợ HTML
        } else {
            messageElement.classList.add("received"); // Tin nhắn của khách hàng
            messageElement.innerHTML =
                "<strong>Khách hàng: </strong>" + message;
        }
    } else if (roleId === 3) {
        if (senderId === userId) {
            messageElement.classList.add("sent"); // Tin nhắn của bạn
            messageElement.innerHTML = "<strong>Bạn: </strong>" + message;
        } else {
            messageElement.classList.add("received"); // Tin nhắn của quản trị viên
            messageElement.innerHTML =
                "<strong>Quản trị viên: </strong>" + message;
        }
    }

    // Thêm tin nhắn vào messageBox
    messageBox.appendChild(messageElement);

    // Cuộn xuống cuối cùng để thấy tin nhắn mới
    messageBox.scrollTop = messageBox.scrollHeight; // Đảm bảo scrolling đúng
}