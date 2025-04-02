@extends('admin.layouts.master')
@section('content')
<main>
    <div class="container">
        <h3>Chat với {{ $messages->first()->user->name ?? 'User ' . $user_id }}</h3>
        <div id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
            @foreach($messages as $message)
                <p>
                    <strong>{{ $message->admin_id ? 'Admin' : $message->user->name }}:</strong>
                    {{ $message->message }}
                </p>
            @endforeach
        </div>

        <form id="chat-form">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="text" id="message" name="message" class="form-control" placeholder="Nhập tin nhắn...">
            <button type="submit" class="btn btn-primary mt-2">Gửi</button>
        </form>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const form = document.getElementById('chat-form');
        const input = document.getElementById('message');
        const userId = {{ $user_id }};

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            fetch("{{ route('admin.chat.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: message, user_id: userId })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Thêm tin nhắn vào chat-box ngay lập tức
                    chatBox.innerHTML += `<p><strong>Admin:</strong> ${data.message.message}</p>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                    input.value = '';
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Lắng nghe tin nhắn từ user
        Echo.channel('chat.admin')
            .listen('MessageSent', (e) => {
                if (e.user_id == userId && !e.is_admin) { // Chỉ hiển thị tin nhắn từ user hiện tại
                    chatBox.innerHTML += `<p><strong>User ${e.user_id}:</strong> ${e.message}</p>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            });
    </script>
</main>
@endsection
