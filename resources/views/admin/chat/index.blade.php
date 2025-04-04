@extends('admin.layouts.master')

@section('content')
<main>
    <div class="container">
        <h3>Danh sách người dùng nhắn tin</h3>

        <ul class="list-group">
            @foreach($users as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $user->user->name ?? 'User ' . $user->user_id }}
                <div>
                    <a href="{{ route('admin.chat.show', $user->user_id) }}" class="btn btn-primary btn-sm">Xem</a>
                    <form action="{{ route('admin.chat.delete', $user->user_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xoá đoạn chat này vĩnh viễn?')">Xoá</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</main>
@endsection
