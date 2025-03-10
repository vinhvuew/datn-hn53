@extends('admin.layouts.master')

@section('content')
    <main>
        <div class="container mt-4">
            <div id="alert-container"></div>

            <div class="card shadow-sm border-0 rounded">
                <div class="card-header  text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quản Lý Người Dùng</h5>
                    <form action="{{ route('users.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm me-2" placeholder="Nhập tên, email hoặc SĐT"
                            style="max-width: 250px;">
                        <button type="submit" class="btn btn-outline-primary btn-sm me-2">🔍 Tìm kiếm</button>

                        @if (request('search'))
                            <a href="{{ route('users.index') }}" class="btn btn-warning btn-sm">Quay Lại</a>
                        @endif
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Vai Trò</th>
                                    <th class="text-center">Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="user-row-{{ $user->id }}">
                                        <td class="text-center align-middle">{{ $user->id }}</td>
                                        <td class="align-middle">{{ $user->name }}</td>
                                        <td class="align-middle">{{ $user->email ?? '-' }}</td>
                                        <td class="align-middle">{{ $user->phone ?? '-' }}</td>
                                        <td class="align-middle">
                                            <select name="role" class="form-select form-select-sm role-select"
                                                data-user-id="{{ $user->id }}" data-old-role="{{ $user->role }}">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User
                                                </option>
                                                <option value="moderator"
                                                    {{ $user->role == 'moderator' ? 'selected' : '' }}>
                                                    Moderator</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-center align-middle">
                                            <form class="delete-form d-inline" data-user-id="{{ $user->id }}"
                                                data-user-name="{{ $user->name }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm delete-user">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Xác nhận xóa user
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function() {
                    let form = this.closest('form');
                    let userId = form.getAttribute('data-user-id');
                    let userName = form.getAttribute('data-user-name');

                    Swal.fire({
                        title: "Xác nhận xóa?",
                        text: `Bạn có chắc chắn muốn xóa người dùng "${userName}"?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Xóa",
                        cancelButtonText: "Hủy"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`{{ route('users.destroy', '') }}/${userId}`, {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        _method: "DELETE"
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: "Đã xóa!",
                                        text: "Người dùng đã bị xóa thành công.",
                                        icon: "success"
                                    });
                                    document.getElementById(`user-row-${userId}`)
                                        .remove();
                                }).catch(error => {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: "Không thể xóa người dùng.",
                                        icon: "error"
                                    });
                                });
                        }
                    });
                });
            });

            // Xác nhận thay đổi vai trò
            document.querySelectorAll('.role-select').forEach(select => {
                select.addEventListener('change', function() {
                    let userId = this.getAttribute('data-user-id');
                    let newRole = this.value;
                    let oldRole = this.getAttribute('data-old-role');

                    Swal.fire({
                        title: "Xác nhận thay đổi?",
                        text: "Bạn có chắc chắn muốn thay đổi vai trò của người dùng này?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch("{{ route('users.updateRole') }}", {
                                    method: "POST",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        "Content-Type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        user_id: userId,
                                        role: newRole
                                    })
                                }).then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: "Thành công!",
                                        text: "Vai trò đã được cập nhật.",
                                        icon: "success"
                                    });
                                    select.setAttribute('data-old-role', newRole);
                                }).catch(error => {
                                    Swal.fire({
                                        title: "Lỗi!",
                                        text: "Không thể thay đổi vai trò.",
                                        icon: "error"
                                    });
                                    select.value = oldRole;
                                });
                        } else {
                            select.value = oldRole;
                        }
                    });
                });
            });
        });
    </script>
@endsection
