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

        .user-msg { color: #1a73e8; font-weight: bold; margin-bottom: 5px; }
        .bot-msg { color: black; margin-bottom: 10px; }

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

        /* Style sản phẩm trả về */
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            background: #fff;
            font-size: 14px;
            color: black;
        }

        .product-card img {
            max-width: 100%;
            max-height: 100px;
            margin-bottom: 5px;
            border-radius: 4px;
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
            <span style="vertical-align: middle;">Chat AI- Legend Shoes</span>
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

            chatBox.innerHTML += `<div class="user-msg">🧑 Bạn: ${message}</div>`;
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
                chatBox.innerHTML += `<div class="bot-msg">${data.reply}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
        }
    </script>

</body>
</html>
