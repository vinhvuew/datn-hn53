@extends('admin.layouts.master')

@section('content')
<main>
    <div class="container py-5">
        <h3 class="text-center mb-4" style="font-weight: 600; color: #333;">Chat với {{ $messages->first()->user->name ?? 'User ' . $user_id }}</h3>

        <div id="chat-box" class="bg-light p-4 rounded-3 shadow-lg" style="height: 400px; overflow-y: scroll; border: 1px solid #ddd; max-width: 100%; transition: all 0.3s ease;">
            @foreach($messages as $message)
                <div class="chat-message mb-3 p-3 rounded-lg" style="background-color: {{ $message->admin_id ? '#e6f7ff' : '#f1f8e9' }};">
                    <strong class="{{ $message->admin_id ? 'text-primary' : 'text-success' }} ">
                        {{ $message->admin_id ? 'Admin' : $message->user->name }}:
                    </strong>
                    <span>{{ $message->message }}</span>
                </div>
            @endforeach
        </div>

        <form id="chat-form" class="mt-4">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <div class="input-group">
                <input type="text" id="message" name="message" class="form-control rounded-pill" placeholder="Nhập tin nhắn..." aria-label="Tin nhắn">
                <button type="submit" class="btn btn-primary rounded-pill ml-2 px-4">Gửi</button>
            </div>
        </form>

        <!-- Nút Quay lại -->
        <div class="text-center mt-4">
            <a href="{{ route('admin.chat.index') }}" class="btn btn-secondary rounded-pill px-4 py-2">Quay lại</a>
        </div>
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
                    chatBox.innerHTML += `<div class="chat-message mb-3 p-3 rounded-lg" style="background-color: #e6f7ff;"><strong class="text-primary">Admin:</strong> ${data.message.message}</div>`;
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
                    chatBox.innerHTML += `<div class="chat-message mb-3 p-3 rounded-lg" style="background-color: #f1f8e9;"><strong class="text-success">User ${e.user_id}:</strong> ${e.message}</div>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            });
    </script>
</main>
@endsection
