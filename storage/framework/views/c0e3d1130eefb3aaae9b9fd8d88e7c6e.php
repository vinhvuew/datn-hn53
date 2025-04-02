

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbox</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #chatbox { width: 400px; height: 400px; border: 1px solid #ccc; overflow-y: scroll; padding: 10px; }
        .message { margin-bottom: 10px; padding: 5px; border-radius: 5px; background: #f1f1f1; }
    </style>
</head>
<body>
    <h2>Chatbox</h2>
    <div id="chatbox"></div>

    <input type="text" id="message" placeholder="Nhập tin nhắn" required>
    <button id="send">Gửi</button>

    <script>
        function loadMessages() {
            $.get('/messages', function(data) {
                $('#chatbox').html('');
                data.forEach(function(msg) {
                    $('#chatbox').append(`
                        <div class="message">
                            <b>${msg.user.name}:</b> ${msg.message}
                        </div>
                    `);
                });
            });
        }

        $(document).ready(function() {
            loadMessages();
            setInterval(loadMessages, 3000);

            $('#send').click(function() {
                $.post('/messages', {
                    message: $('#message').val(),
                    _token: '<?php echo e(csrf_token()); ?>'
                }, function() {
                    $('#message').val('');
                    loadMessages();
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\datn-hn53\resources\views/client/chat/room.blade.php ENDPATH**/ ?>