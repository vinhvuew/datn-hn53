@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container py-4" style="max-width: 700px;">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-gradient">📋 Danh sách người dùng nhắn tin</h4>
            </div>

            <div class="list-group">
                @forelse($users as $user)
                    <div class="list-group-item d-flex justify-content-between align-items-center p-3 mb-3 rounded-4 shadow-sm border-0 chat-item"
                        style="background-color: #fdfbff;">
                        <div class="d-flex align-items-center gap-3">
                            {{-- Avatar giả --}}
                            <div class="rounded-circle d-flex justify-content-center align-items-center text-white"
                                style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea, #764ba2); font-weight: bold;">
                                {{ strtoupper(substr($user->user->name ?? 'U' . $user->user_id, 0, 1)) }}
                            </div>

                            {{-- Tên người dùng --}}
                            <span class="fw-semibold text-dark">
                                {{ $user->user->name ?? 'Người dùng #' . $user->user_id }}
                            </span>
                        </div>

                        <div class="btn-group gap-2">
                            <a href="{{ route('admin.chat.show', $user->user_id) }}"
                                class="btn btn-sm btn-outline-success rounded-pill px-3 shadow-sm">
                                Xem 👀
                            </a>
                            <form action="{{ route('admin.chat.delete', $user->user_id) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn xoá đoạn chat này vĩnh viễn?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm">
                                    Xoá 🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-muted text-center py-5">
                        🚫 Không có cuộc trò chuyện nào được tìm thấy.
                    </div>
                @endforelse
            </div>
        </div>

        <style>
            .text-gradient {
                background: linear-gradient(to right, #6a11cb, #2575fc);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .chat-item:hover {
                background-color: #f3efff;
                transform: translateY(-1px);
                transition: all 0.2s ease-in-out;
            }
        </style>
    </main>
@endsection
