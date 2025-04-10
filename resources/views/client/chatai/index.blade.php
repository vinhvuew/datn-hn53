<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chat AI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }

        #chat-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            cursor: pointer;
            z-index: 999;
            padding: 10px;
        }

        #chat-toggle img {
            display: block;
            width: 28px;
            height: 28px;
            margin: auto;
        }

        #chat-container {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 380px;
            max-height: 550px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            z-index: 998;
            flex-direction: column;
        }

        #chat-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            position: relative;
        }

        #chat-close {
            position: absolute;
            right: 10px;
            top: 8px;
            background: transparent;
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        #chat-box {
            padding: 10px;
            height: 370px;
            overflow-y: auto;
            background: #f9f9f9;
        }

        #chat-box::after {
            content: "";
            display: block;
            clear: both;
        }

        .message {
            max-width: 80%;
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 12px;
            display: inline-block;
            clear: both;
            line-height: 1.4;
        }

        .user-msg {
            background-color: #dcf8c6;
            float: right;
            text-align: right;
        }

        .bot-msg {
            background-color: #f1f0f0;
            float: left;
            text-align: left;
        }

        #chat-input-area {
            display: flex;
            border-top: 1px solid #ccc;
        }

        #message {
            flex: 1;
            padding: 8px;
            border: none;
            outline: none;
        }

        #send-btn {
            padding: 8px 12px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .product-card .btn {
            display: inline-block;
            margin-top: 5px;
            padding: 4px 10px;
            background: #28a745;
            color: white;
            text-decoration: none;
            font-size: 13px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <!-- Nút mở chat -->
    <button id="chat-toggle">
        <img src="{{ asset('client/img/AIlogo.png') }}" alt="Chat AI">
    </button>

    <!-- Khung chat -->
    <div id="chat-container">
        <div id="chat-header">
            <img src="{{ asset('client/img/AIlogo.png') }}" alt="Chat AI" style="width: 28px; height: 28px; vertical-align: middle; margin-right: 8px;">
            <span style="vertical-align: middle;">Chat AI - Legend Shoes</span>
            <button id="chat-close">❌</button>
        </div>
        
        <div id="chat-box"></div>
        <div id="chat-input-area">
            <input type="text" id="message" placeholder="Nhập câu hỏi..." />
            <button id="send-btn">Gửi</button>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('chat-toggle');
        const closeBtn = document.getElementById('chat-close');
        const chatContainer = document.getElementById('chat-container');
        const sendBtn = document.getElementById('send-btn');
        const chatBox = document.getElementById('chat-box');

        toggleBtn.addEventListener('click', () => {
            chatContainer.style.display = 'flex';
            toggleBtn.style.display = 'none';
        });

        closeBtn.addEventListener('click', () => {
            chatContainer.style.display = 'none';
            toggleBtn.style.display = 'block';
        });

        sendBtn.addEventListener('click', sendMessage);
        document.getElementById('message').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') sendMessage();
        });

        function sendMessage() {
            const messageInput = document.getElementById('message');
            const message = messageInput.value.trim();
            if (!message) return;

            // Tin nhắn của người dùng (bên phải)
            chatBox.innerHTML += `<div class="message user-msg">🧑 Bạn: ${message}</div>`;
            messageInput.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            fetch('/chat-ai/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message })
            })
            .then(res => res.json())
            .then(data => {
                // Tin nhắn của chatbot (bên trái)
                chatBox.innerHTML += `<div class="message bot-msg">🤖 AI: ${data.reply}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        }
    </script>

</body>
</html>
