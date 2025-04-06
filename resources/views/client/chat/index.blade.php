@extends('client.layouts.master')

@section('content')
    <main>
        <div class="container py-4" style="max-width: 600px; font-family: 'Segoe UI', sans-serif;">
            <div class="text-center mb-3 py-2 rounded-4 text-white"
                style="background: linear-gradient(135deg, #ff6ec4, #7873f5); box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <h5 class="mb-0 fw-bold">💬 Hỗ trợ trực tiếp</h5>
            </div>


            <div id="chat-box" class="p-3 rounded-4 shadow-sm"
                style="height: 360px; overflow-y: auto; background: #fef9ff; border: 2px solid #f3d9fa;">
                @foreach ($messages as $message)
                    <div class="d-flex mb-2 {{ $message->admin_id ? 'justify-content-start' : 'justify-content-end' }}">
                        <div class="d-flex align-items-end {{ $message->admin_id ? '' : 'flex-row-reverse' }}">
                            <div class="me-2 ms-2">
                                <div
                                    style="width: 32px; height: 32px; border-radius: 50%; background-color: {{ $message->admin_id ? '#a5d6a7' : '#90caf9' }};">
                                </div>
                            </div>
                            <div class="p-3 rounded-4"
                                style="
                            max-width: 70%;
                            background: {{ $message->admin_id ? 'linear-gradient(135deg, #dcedc8, #a5d6a7)' : 'linear-gradient(135deg, #e3f2fd, #90caf9)' }};
                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                            color: #333;
                            font-size: 0.92rem;
                        ">
                                <div class="fw-semibold {{ $message->admin_id ? 'text-success' : 'text-primary' }}">
                                    {{ $message->admin_id ? '🌿 SHOP' : '👤 Bạn' }}:
                                </div>
                                <div>{{ $message->message }}</div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <form id="chat-form" class="mt-3">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" id="message" name="message"
                        class="form-control rounded-start-pill border-0 shadow-sm" placeholder="🌸 Nhập tin nhắn...">
                    <button type="submit" class="btn btn-gradient-pink rounded-end-pill text-white px-4 fw-bold">Gửi
                        💌</button>
                </div>
            </form>
        </div>

        <style>
            .btn-gradient-pink {
                background: linear-gradient(135deg, #ff6ec4, #7873f5);
                border: none;
            }

            .btn-gradient-pink:hover {
                background: linear-gradient(135deg, #ff85d8, #6f6dfd);
            }
        </style>

        <script>
            const chatBox = document.getElementById('chat-box');
            const form = document.getElementById('chat-form');
            const input = document.getElementById('message');


            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const message = input.value.trim();
                if (!message) return;

                fetch("{{ route('chat.send') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            message: message
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            chatBox.innerHTML += `
                        <div class="d-flex justify-content-end mb-2">
                            <div class="d-flex align-items-end flex-row-reverse">
                                <div class="ms-2">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #90caf9;"></div>
                                </div>
                                <div class="p-3 rounded-4" style="max-width: 70%; background: linear-gradient(135deg, #e3f2fd, #90caf9); box-shadow: 0 2px 5px rgba(0,0,0,0.1); font-size: 0.92rem;">
                                    <div class="fw-semibold text-primary">👤 Bạn:</div>
                                    <div>${data.message.message}</div>
                                </div>
                            </div>
                        </div>`;
                            chatBox.scrollTop = chatBox.scrollHeight;
                            input.value = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });


            Echo.channel('chat.user.' + {{ Auth::id() }})
                .listen('MessageSent', (e) => {
                    if (!e.is_admin) return;
                    chatBox.innerHTML += `
                    <div class="d-flex justify-content-start mb-2">
                        <div class="d-flex align-items-end">
                            <div class="me-2">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #a5d6a7;"></div>
                            </div>
                            <div class="p-3 rounded-4" style="max-width: 70%; background: linear-gradient(135deg, #dcedc8, #a5d6a7); box-shadow: 0 2px 5px rgba(0,0,0,0.1); font-size: 0.92rem;">
                                <div class="fw-semibold text-success">🌿 Admin:</div>
                                <div>${e.message}</div>
                            </div>
                        </div>
                    </div>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                });
        </script>
    </main>
@endsection
