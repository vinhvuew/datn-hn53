@extends('admin.layouts.master')

@section('content')
<main>
    <div class="container py-5">
        <h3 class="text-center mb-4" style="font-weight: 600; color: #333;">Danh sách người dùng nhắn tin</h3>

        <div class="list-group">
            @foreach($users as $user)
            <div class="list-group-item d-flex justify-content-between align-items-center mb-3 p-3 rounded-lg shadow-lg bg-white">
                <div class="d-flex align-items-center">
                    <div class="mr-3">
                        <img src="{{ $user->user->profile_picture ?? 'default-avatar.jpg' }}" alt="Profile Picture" class="rounded-circle border" width="50" height="50">
                    </div>
                    <span class="font-weight-semibold text-dark">{{ $user->user->name ?? 'User ' . $user->user_id }}</span>
                </div>

                <div class="btn-group">
                    <a href="{{ route('admin.chat.show', $user->user_id) }}" class="btn btn-outline-primary btn-sm rounded-pill">Xem</a>
                    <form action="{{ route('admin.chat.delete', $user->user_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" onclick="return confirm('Bạn có chắc muốn xoá đoạn chat này vĩnh viễn?')">Xoá</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
