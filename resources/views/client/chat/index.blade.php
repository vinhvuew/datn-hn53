@extends('client.layouts.master')

@section('content')

<main>
    <div class="container py-5">
        <h3 class="text-center mb-4" style="font-weight: 700; color: #2c3e50;">Hỗ trợ trực tiếp</h3>

        <div id="chat-box" class="bg-light p-4 rounded-3 shadow-lg" style="height: 500px; overflow-y: scroll; border: 1px solid #ddd; transition: all 0.3s ease;">
            @foreach($messages as $message)
                <div class="chat-message mb-3 p-3 rounded-lg d-flex align-items-start" style="background-color: {{ $message->admin_id ? '#e6f7ff' : '#f1f8e9' }};">
                    @if(!$message->admin_id)
                    <div class="mr-3">
                        <img src="{{ $message->user->profile_picture ?? 'default-avatar.jpg' }}" alt="User Avatar" class="rounded-circle border" width="45" height="45">
                    </div>
                    @endif
                    <div>
                        <strong class="{{ $message->admin_id ? 'text-primary' : 'text-success' }} font-weight-bold">
                            {{ $message->admin_id ? 'Admin' : 'Bạn' }}:
                        </strong>
                        <span>{{ $message->message }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <form id="chat-form" class="mt-4">
            @csrf
            <div class="input-group">
                <input type="text" id="message" name="message" class="form-control rounded-pill border-0" placeholder="Nhập tin nhắn..." aria-label="Tin nhắn">
                <button type="submit" class="btn btn-primary rounded-pill ml-2 px-4" style="transition: all 0.3s ease;">Gửi</button>
            </div>
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
                    chatBox.innerHTML += `<div class="chat-message mb-3 p-3 rounded-lg d-flex align-items-start" style="background-color: #e6f7ff;">
                                            <div class="mr-3"><img src="{{ Auth::user()->profile_picture ?? 'default-avatar.jpg' }}" alt="User Avatar" class="rounded-circle border" width="45" height="45"></div>
                                            <div><strong class="text-primary font-weight-bold">Bạn:</strong> ${data.message.message}</div>
                                        </div>`;
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
                chatBox.innerHTML += `<div class="chat-message mb-3 p-3 rounded-lg d-flex align-items-start" style="background-color: #f1f8e9;">
                                        <div class="mr-3"><img src="{{ $adminProfilePic ?? 'default-avatar.jpg' }}" alt="Admin Avatar" class="rounded-circle border" width="45" height="45"></div>
                                        <div><strong class="text-success font-weight-bold">Admin:</strong> ${e.message}</div>
                                      </div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    </script>

</main>

@endsection
