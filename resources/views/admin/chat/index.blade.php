@extends('admin.layouts.master')

@section('content')
<main>
    <div class="container py-5">
        <h3 class="mb-4">Danh sách người dùng cần hỗ trợ</h3>

        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    @foreach($users as $user)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $user->user->name ?? 'User ' . $user->user_id }}</strong>
                            <p class="mb-0 text-muted">{{ $user->user->email ?? 'Email chưa có' }}</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.chat.show', $user->user_id) }}" class="btn btn-info btn-sm mr-2">
                                <i class="bi bi-eye"></i> Xem
                            </a>
                            <form action="{{ route('admin.chat.delete', $user->user_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xoá đoạn chat này vĩnh viễn?')">
                                    <i class="bi bi-trash"></i> Xoá
                                </button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection
