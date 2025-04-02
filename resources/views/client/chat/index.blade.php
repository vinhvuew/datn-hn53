@extends('client.layouts.master')
@section('content')
<main>
    <div class="container">
        <h3>Hỗ trợ trực tiếp</h3>
        <div id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
            @foreach($messages as $message)
                <p><strong>{{ $message->admin_id ? 'Admin' : 'Bạn' }}:</strong> {{ $message->message }}</p>
            @endforeach
        </div>

        <form id="chat-form">
            @csrf
            <input type="text" id="message" name="message" class="form-control" placeholder="Nhập tin nhắn...">
            <button type="submit" class="btn btn-primary mt-2">Gửi</button>
        </form>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('message');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return; // Không gửi nếu input rỗng

            fetch("{{ route('chat.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Thêm tin nhắn vào chat-box ngay lập tức
                    chatBox.innerHTML += `<p><strong>Bạn:</strong> ${data.message.message}</p>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                    input.value = ''; // Xóa input
                }
            })
            .catch(error => console.error('Error:', error)); // Log lỗi nếu có
        });

        // Lắng nghe tin nhắn từ admin
        Echo.channel('chat.user.' + {{ Auth::id() }})
            .listen('MessageSent', (e) => {
                if (!e.is_admin) return; // Chỉ hiển thị tin nhắn từ admin
                chatBox.innerHTML += `<p><strong>Admin:</strong> ${e.message}</p>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    </script>
  </main>
@endsection
