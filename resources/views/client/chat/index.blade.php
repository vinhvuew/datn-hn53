@extends('client.layouts.master')
@section('content')
  <main>
    <div class="container">
        <h3>Hỗ trợ trực tiếp</h3>
        <div id="chat-box" style="height: 400px; overflow-y: scroll; border: 1px solid #ddd; padding: 10px;">
            @foreach($messages as $message)
                <p><strong>{{ $message->is_admin ? 'Admin' : 'Bạn' }}:</strong> {{ $message->message }}</p>
            @endforeach
        </div>

        <form id="chat-form">
            @csrf
            <input type="text" id="message" name="message" class="form-control" placeholder="Nhập tin nhắn...">
            <button type="submit" class="btn btn-primary mt-2">Gửi</button>
        </form>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let message = document.getElementById('message').value;

            fetch("{{ route('chat.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: message })
            }).then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                }
            });
        });
    </script>
  </main>
@endsection
